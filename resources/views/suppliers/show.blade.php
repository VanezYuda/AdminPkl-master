@extends('layouts.sidebar')
@section('content')
<div class="pc-container">
    <div class="pc-content">
      <!-- [ breadcrumb ] start -->
      <div class="page-header">
        <div class="page-block">
          <div class="page-header-title">
            <h5 class="mb-0 font-medium">Typography</h5>
          </div>
          <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="/dashboard/index.html">Home</a></li>
            <li class="breadcrumb-item"><a href="javascript: void(0)">Suppliers</a></li>
            <li class="breadcrumb-item" aria-current="page">Supplier</li>
          </ul>
        </div>
      </div>
      <div class="container-fluid">
        <h4 class="mb-3">Detail Supplier</h4>
    
        <div class="card">
            <div class="card-body">
    
                <div class="mb-3">
                    <label class="fw-bold">Nama Supplier:</label>
                    <p>{{ $supplier->nama_supplier }}</p>
                </div>
    
                <div class="mb-3">
                    <label class="fw-bold">Telepon:</label>
                    <p>{{ $supplier->telepon ?? '-' }}</p>
                </div>
    
                <div class="mb-3">
                    <label class="fw-bold">Email:</label>
                    <p>{{ $supplier->email ?? '-' }}</p>
                </div>
    
                <div class="mb-3">
                    <label class="fw-bold">Alamat:</label>
                    <p>{{ $supplier->alamat ?? '-' }}</p>
                </div>
    
                <div class="mb-3">
                    <label class="fw-bold">Dibuat pada:</label>
                    <p>{{ $supplier->created_at->format('d M Y H:i') }}</p>
                </div>
    
                <div class="mb-3">
                    <label class="fw-bold">Diupdate pada:</label>
                    <p>{{ $supplier->updated_at->format('d M Y H:i') }}</p>
                </div>
    
                <a href="{{ route('suppliers.index') }}" class="btn btn-secondary">
                    Kembali
                </a>
    
                <a href="{{ route('suppliers.edit', $supplier->id) }}" class="btn btn-warning">
                    Edit
                </a>
    
                <form action="{{ route('suppliers.destroy', $supplier->id) }}"
                    method="POST"
                    class="d-inline"
                    onsubmit="return confirm('Yakin ingin menghapus supplier ini?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        Hapus
                    </button>
                </form>
    
            </div>
        </div>
    </div>

@endsection