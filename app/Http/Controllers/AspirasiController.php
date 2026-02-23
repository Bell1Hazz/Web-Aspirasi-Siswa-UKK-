<?php

namespace App\Http\Controllers;

use App\Models\Aspirasi;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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

    
    public function create()
    {
        $kategoris = Kategori::all();
        return view('siswa.form_aspirasi', compact('kategoris'));
    }

    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'kategori_id' => 'required|exists:kategoris,id',
            'judul'       => 'required|string|max:255',
            'deskripsi'   => 'required|string',
            'gambar'      => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        
        $path = $request->file('gambar')->store('aspirasi', 'public');

        Aspirasi::create([
            'user_id'           => Auth::id(),
            'kategori_id'       => $validated['kategori_id'],
            'judul'             => $validated['judul'],
            'deskripsi'         => $validated['deskripsi'],
            'gambar'            => $path, 
            'tanggal_pengajuan' => now()->toDateString(),
            'status'            => 'Diajukan',
        ]);

        return redirect()->route('aspirasi.histori')->with('success', 'Aspirasi berhasil dikirim!');
    }

    
    public function histori()
    {
        $aspirasis = Auth::user()->aspirasis()->orderBy('created_at', 'desc')->with(['kategori','feedback'])->paginate(5);
        return view('siswa.histori', compact('aspirasis'));
    }

    
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
