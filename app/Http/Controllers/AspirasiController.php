<?php

namespace App\Http\Controllers;

use App\Models\Aspirasi;
use App\Models\Kategori;
use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AspirasiController extends Controller
{
    /**
     * Tampilkan beranda siswa
     */
    public function index()
    {
        $user = Auth::user();
        $totalAspi = $user->aspirasis()->count();
        $aspilDiajukan = $user->aspirasis()->where('status', 'Diajukan')->count();
        $aspilDiproses = $user->aspirasis()->where('status', 'Diproses')->count();
        $aspilSelesai = $user->aspirasis()->where('status', 'Selesai')->count();

        return view('siswa.index', compact('totalAspi', 'aspilDiajukan', 'aspilDiproses', 'aspilSelesai'));
    }

    /**
     * Tampilkan form aspirasi
     */
    public function create()
    {
        $kategoris = Kategori::all();
        return view('siswa.form_aspirasi', compact('kategoris'));
    }

    /**
     * Simpan aspirasi baru
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'kategori_id' => 'required|exists:kategoris,id',
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string'
        ]);

        $validated['user_id'] = Auth::id();
        $validated['tanggal_pengajuan'] = now()->format('Y-m-d');
        $validated['status'] = 'Diajukan';

        Aspirasi::create($validated);

        return redirect()->route('aspirasi.histori')->with('success', 'Aspirasi berhasil dikirim!');
    }

    /**
     * Tampilkan histori aspirasi siswa
     */
    public function histori()
    {
        $aspirasis = Auth::user()->aspirasis()->orderBy('created_at', 'desc')->get();
        return view('siswa.histori', compact('aspirasis'));
    }

    /**
     * Tampilkan detail aspirasi dengan feedback
     */
    public function show($id)
    {
        $aspirasi = Aspirasi::findOrFail($id);
        
        // Cek otorisasi
        if ($aspirasi->user_id != Auth::id() && !Auth::user()->isAdmin()) {
            abort(403);
        }

        return view('siswa.detail_aspirasi', compact('aspirasi'));
    }
}
