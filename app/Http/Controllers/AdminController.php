<?php

namespace App\Http\Controllers;

use App\Models\Aspirasi;
use App\Models\Feedback;
use App\Models\User;
use App\Models\Kategori;
use Illuminate\Http\Request;
use App\Exports\AspirasiExport;
use Maatwebsite\Excel\Facades\Excel;

class AdminController extends Controller
{
    
    public function dashboard()
    {
        $totalAspi = Aspirasi::count();
        $aspilDiajukan = Aspirasi::where('status', 'Diajukan')->count();
        $aspilDiproses = Aspirasi::where('status', 'Diproses')->count();
        $aspilSelesai = Aspirasi::where('status', 'Selesai')->count();

        return view('admin.dashboard', compact('totalAspi', 'aspilDiajukan', 'aspilDiproses', 'aspilSelesai'));
    }

    
    public function listAspirasi(Request $request)
    {
        $query = Aspirasi::with(['user', 'kategori']);

        // Filter berdasarkan status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter berdasarkan kategori
        if ($request->filled('kategori_id')) {
            $query->where('kategori_id', $request->kategori_id);
        }

        // Filter berdasarkan siswa
        if ($request->filled('user_id')) {
            $query->where('user_id', $request->user_id);
        }

        // Filter berdasarkan rentang tanggal (opsional kalau kamu pakai field ini)
        if ($request->filled('tanggal_dari') && $request->filled('tanggal_sampai')) {
            $query->whereBetween('tanggal_pengajuan', [
                $request->tanggal_dari,
                $request->tanggal_sampai,
            ]);
        }

        // Filter bulan saja / kombinasi (bulan + tahun)
        if ($request->filled('bulan')) {
            $query->whereMonth('tanggal_pengajuan', (int) $request->bulan);
        }

        // Filter tahun saja / kombinasi (bulan + tahun)
        if ($request->filled('tahun')) {
            $query->whereYear('tanggal_pengajuan', (int) $request->tahun);
        }

        $aspirasis = $query->orderBy('tanggal_pengajuan', 'desc')->paginate(10)
         ->withQueryString();

        $kategoris = Kategori::all();
        $siswas = User::where('role', 'siswa')->get();

        return view('admin.list_aspirasi', compact('aspirasis', 'kategoris', 'siswas'));
    }

    
    public function detailAspirasi($id)
    {
        $aspirasi = Aspirasi::with(['user', 'kategori', 'feedback'])->findOrFail($id);
        return view('admin.detail_aspirasi', compact('aspirasi'));
    }

    
    public function showFeedbackForm($id)
    {
        $aspirasi = Aspirasi::with(['user', 'kategori', 'feedback'])->findOrFail($id);
        return view('admin.feedback', compact('aspirasi'));
    }

    
    public function saveFeedback(Request $request, $id)
    {
        $aspirasi = Aspirasi::with('feedback')->findOrFail($id);

        $validated = $request->validate([
            'isi_feedback' => 'required|string',
            'status' => 'required|in:Diajukan,Diproses,Selesai',
        ]);

        // Update status aspirasi
        $aspirasi->update(['status' => $validated['status']]);

        // Hapus feedback lama jika ada
        if ($aspirasi->feedback) {
            $aspirasi->feedback->delete();
        }

        // Buat feedback baru
        Feedback::create([
            'aspirasi_id' => $id,
            'isi_feedback' => $validated['isi_feedback'],
            'tanggal_feedback' => now()->format('Y-m-d'),
        ]);

        return redirect()->route('admin.detail', $id)->with('success', 'Feedback berhasil disimpan!');
    }

    
    public function exportExcel(Request $request)
{
    return Excel::download(
        new AspirasiExport($request),
        'data_aspirasi.xlsx'
    );
}

public function print(Request $request)
{
    $query = Aspirasi::with(['user','kategori']);

    if ($request->status) {
        $query->where('status', $request->status);
    }

    if ($request->kategori_id) {
        $query->where('kategori_id', $request->kategori_id);
    }

    if ($request->user_id) {
        $query->where('user_id', $request->user_id);
    }

    if ($request->bulan) {
        $query->whereMonth('tanggal_pengajuan', $request->bulan);
    }

    if ($request->tahun) {
        $query->whereYear('tanggal_pengajuan', $request->tahun);
    }

    $aspirasis = $query->orderBy('tanggal_pengajuan','desc')->get();

    return view('admin.print', compact('aspirasis'));
}
}
