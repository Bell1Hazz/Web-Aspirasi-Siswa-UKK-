<?php

namespace App\Http\Controllers;

use App\Models\Aspirasi;
use App\Models\Feedback;
use App\Models\User;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    /**
     * Tampilkan dashboard admin
     */
    public function dashboard()
    {
        $totalAspi = Aspirasi::count();
        $aspilDiajukan = Aspirasi::where('status', 'Diajukan')->count();
        $aspilDiproses = Aspirasi::where('status', 'Diproses')->count();
        $aspilSelesai = Aspirasi::where('status', 'Selesai')->count();

        return view('admin.dashboard', compact('totalAspi', 'aspilDiajukan', 'aspilDiproses', 'aspilSelesai'));
    }

    /**
     * Tampilkan daftar aspirasi dengan filter
     */
    public function listAspirasi(Request $request)
    {
        $query = Aspirasi::with('user', 'kategori');

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

        // Filter berdasarkan tanggal
        if ($request->filled('tanggal_dari') && $request->filled('tanggal_sampai')) {
            $query->whereBetween('tanggal_pengajuan', [
                $request->tanggal_dari,
                $request->tanggal_sampai
            ]);
        }

        // Filter berdasarkan bulan
        if ($request->filled('bulan') && $request->filled('tahun')) {
            $query->byBulan($request->bulan, $request->tahun);
        }

        $aspirasis = $query->orderBy('created_at', 'desc')->paginate(10);
        
        $kategoris = Kategori::all();
        $siswas = User::where('role', 'siswa')->get();

        return view('admin.list_aspirasi', compact('aspirasis', 'kategoris', 'siswas'));
    }

    /**
     * Tampilkan detail aspirasi
     */
    public function detailAspirasi($id)
    {
        $aspirasi = Aspirasi::with('user', 'kategori', 'feedback')->findOrFail($id);
        return view('admin.detail_aspirasi', compact('aspirasi'));
    }

    /**
     * Tampilkan form feedback
     */
    public function showFeedbackForm($id)
    {
        $aspirasi = Aspirasi::findOrFail($id);
        return view('admin.feedback', compact('aspirasi'));
    }

    /**
     * Simpan feedback dan update status
     */
    public function saveFeedback(Request $request, $id)
    {
        $aspirasi = Aspirasi::findOrFail($id);

        $validated = $request->validate([
            'isi_feedback' => 'required|string',
            'status' => 'required|in:Diajukan,Diproses,Selesai'
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
            'tanggal_feedback' => now()->format('Y-m-d')
        ]);

        return redirect()->route('admin.detail', $id)->with('success', 'Feedback berhasil disimpan!');
    }

    /**
     * Export data aspirasi ke CSV/Excel (optional)
     */
    public function export()
    {
        $aspirasis = Aspirasi::with('user', 'kategori', 'feedback')->get();
        return view('admin.export', compact('aspirasis'));
    }
}
