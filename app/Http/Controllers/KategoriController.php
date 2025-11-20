<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index()
    {
        $perPage = $request->per_page ?? 5;
        $kategori = Kategori::paginate($perPage);
        return view('kategori.index', compact('kategori'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'keterangan' => 'required',
        ]);

        Kategori::create([
            'nama' => $request->nama,
            'keterangan' => $request->keterangan
        ]);

        return redirect()->back()->with('success', 'Kategori berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'keterangan' => 'required',
        ]);

        $kategori = Kategori::findOrFail($id);
        $kategori->update([
            'nama' => $request->nama,
            'keterangan' => $request->keterangan
        ]);

        return redirect()->back()->with('success', 'Kategori berhasil diperbarui!');
    }

    public function destroy($id)
    {
        Kategori::findOrFail($id)->delete();

        return redirect()->back()->with('success', 'Kategori berhasil dihapus!');
    }
}
