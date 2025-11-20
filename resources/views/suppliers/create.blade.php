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
        <h4 class="mb-3">Tambah Supplier</h4>
    
        <div class="card">
            <div class="card-body">
                <form action="{{ route('suppliers.store') }}" method="POST">
                    @csrf
    
                    <div class="mb-3">
                        <label class="form-label">Nama Supplier</label>
                        <input type="text" name="nama_supplier"
                               class="form-control @error('nama_supplier') is-invalid @enderror"
                               value="{{ old('nama_supplier') }}" required>
                        @error('nama_supplier')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
    
                    <div class="mb-3">
                        <label class="form-label">Telepon</label>
                        <input type="text" name="telepon"
                               class="form-control @error('telepon') is-invalid @enderror"
                               value="{{ old('telepon') }}">
                        @error('telepon')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
    
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email"
                               class="form-control @error('email') is-invalid @enderror"
                               value="{{ old('email') }}">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
    
                    <div class="mb-3">
                        <label class="form-label">Alamat</label>
                        <textarea name="alamat"
                                  class="form-control @error('alamat') is-invalid @enderror"
                                  rows="3">{{ old('alamat') }}</textarea>
                        @error('alamat')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
    
                    <a href="{{ route('suppliers.index') }}" class="btn btn-secondary">
                        Kembali
                    </a>
                    <button type="submit" class="btn btn-primary">
                        Simpan
                    </button>
                </form>
            </div>
        </div>
    </div>

@endsection