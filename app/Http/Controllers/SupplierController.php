<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
 public function index(Request $request)
{
    $perPage = $request->get('per_page', 3);

    $suppliers = Supplier::orderBy('id', 'desc')
        ->paginate($perPage)
        ->withQueryString();

    return view('suppliers.index', compact('suppliers', 'perPage'));
}



    public function create()
    {
        return view('suppliers.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_supplier' => 'required|string|max:255',
            'alamat'        => 'nullable|string',
            'telepon'       => 'nullable|string|max:20',
            'email'         => 'nullable|email|max:255',
        ]);

        Supplier::create($validated);

        return redirect()->route('suppliers.index')
            ->with('success', 'Supplier berhasil ditambahkan.');
    }

    // <-- PERHATIKAN: parameternya $supplier, bukan $id

    public function show(Supplier $supplier)
    {
        return view('suppliers.show', compact('supplier'));
    }

    public function edit(Supplier $supplier)
    {
        return view('suppliers.edit', compact('supplier'));
    }

    public function update(Request $request, Supplier $supplier)
    {
        $validated = $request->validate([
            'nama_supplier' => 'required|string|max:255',
            'alamat'        => 'nullable|string',
            'telepon'       => 'nullable|string|max:20',
            'email'         => 'nullable|email|max:255',
        ]);

        $supplier->update($validated);

        return redirect()->route('suppliers.index')
            ->with('success', 'Supplier berhasil diupdate.');
    }

    public function destroy(Supplier $supplier)
    {
        $supplier->delete();

        return redirect()->route('suppliers.index')
            ->with('success', 'Supplier berhasil dihapus.');
    }
}
