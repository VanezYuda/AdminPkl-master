@extends('layouts.sidebar')

@section('content')
<link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    <div class="pc-container">
        <div class="pc-content">

            {{-- HEADER / BREADCRUMB --}}
            <div class="page-header">
                <div class="page-block">
                    <div class="page-header-title">
                        <h5 class="mb-0 font-medium">Daftar Supplier</h5>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/dashboard/index.html">Home</a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Suppliers</a></li>
                        <li class="breadcrumb-item" aria-current="page">List</li>
                    </ul>
                </div>
            </div>

            <div class="footSup">
                {{-- KIRI: ICON + SEARCH --}}
                <div class="SecL">
                    {{-- icon filter --}}
                    <button type="button" class="filterBtn">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-filter"><polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"></polygon></svg>
                    </button>

                    {{-- search --}}
                    <div class="searchWrap">
                        <span class="searchIcon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="myiconG">
                                <circle cx="11" cy="11" r="8"></circle>
                                <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                            </svg>
                        </span>
                        <input type="text" id="supplier-search" class="searchInput" placeholder="Search...">
                    </div>
                </div>

                {{-- KANAN: ADD CUSTOMER --}}
                <a href="{{ route('suppliers.create') }}" class="btnAddCustomer">
                    <i class="bi bi-plus-lg me-1"></i>
                    Add customer
                </a>
            </div>


            <div class="container-fluid">

                {{-- ALERT SUCCESS --}}
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                {{-- TABEL SUPPLIER --}}
                <div class="card border-0 shadow-sm">
                    <div class="card-body table-responsive p-0">
                        <table cltable mb-0 align-middle table-modern" id="supplier-table">
                            <thead>ass="
                                <tr>
                                    <th style="width: 50px">#</th>
                                    <th>Nama Supplier</th>
                                    <th>Alamat</th>
                                    <th>Telepon</th>
                                    <th>Email</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($suppliers as $index => $supplier)
                                    <tr class="supplier-row" data-edit-url="{{ route('suppliers.edit', $supplier->id) }}"
                                        data-delete-url="{{ route('suppliers.destroy', $supplier->id) }}">
                                        <td>{{ $suppliers->firstItem() + $index }}</td>
                                        <td>{{ $supplier->nama_supplier }}</td>
                                        <td>{{ $supplier->alamat ?? '-' }}</td>
                                        <td>{{ $supplier->telepon ?? '-' }}</td>
                                        <td>{{ $supplier->email ?? '-' }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center py-4">Belum ada data supplier.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="paginationBar">
                        {{-- KIRI: INFO JUMLAH DATA --}}
                        <div class="leftInfo">
                            {{ $suppliers->firstItem() }}–{{ $suppliers->lastItem() }} of {{ $suppliers->total() }}
                        </div>

                        {{-- KANAN: ROWS PER PAGE + PAGE + ARROW --}}
                        <div class="rightInfo">

                            {{-- rows per page --}}
                            <div class="d-flex align-items-center gap-2">
                                <span>Rows per page:</span>
                              <select id="per-page-select" class="rowsSelect">
                                    @foreach([3,6,9] as $size)
                                        <option value="{{ $size }}" {{ request('per_page', 3) == $size ? 'selected' : '' }}>
                                            {{ $size }}
                                        </option>
                                    @endforeach
                                </select>

                            </div>

                            {{-- nomor halaman --}}
                            <span class="pageInfo">
                                {{ $suppliers->currentPage() }}/{{ $suppliers->lastPage() }}
                            </span>

                            {{-- tombol prev + next --}}

<div class="pageArrows">

    {{-- PREV --}}
    @if ($suppliers->onFirstPage())
        <button class="pageBtn disabledBtn">
             <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left">
                <line x1="19" y1="12" x2="5" y2="12"></line>
                <polyline points="12 19 5 12 12 5"></polyline>
            </svg>
        </button>
    @else
        <a href="{{ $suppliers->appends(['per_page' => $perPage])->previousPageUrl() }}" class="pageBtn">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left">
                <line x1="19" y1="12" x2="5" y2="12"></line>
                <polyline points="12 19 5 12 12 5"></polyline>
            </svg>
        </a>
    @endif

    {{-- NEXT --}}
    @if ($suppliers->hasMorePages())
        <a href="{{ $suppliers->appends(['per_page' => $perPage])->nextPageUrl() }}" class="pageBtn">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right">
                <line x1="5" y1="12" x2="19" y2="12"></line>
                <polyline points="12 5 19 12 12 19"></polyline>
            </svg>
        </a>
    @else
        <button class="pageBtn disabledBtn">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right">
                <line x1="5" y1="12" x2="19" y2="12"></line>
                <polyline points="12 5 19 12 12 19"></polyline>
            </svg>
        </button>
    @endif

</div>

                        </div>
                    </div>


                </div>

            </div>
        </div>
    </div>

    {{-- CONTEXT MENU KLIK KANAN --}}
    <div id="rowContextMenu" class="context-menu">
        <button type="button" class="context-item" id="context-edit">
            <i class="bi bi-pencil-square me-2"></i> Edit
        </button>
        <button type="button" class="context-item text-danger" id="context-delete">
            <i class="bi bi-trash3 me-2"></i> Delete
        </button>
    </div>

    {{-- FORM DELETE GLOBAL UNTUK CONTEXT MENU --}}
    <form id="context-delete-form" method="POST" style="display: none;">
        @csrf
        @method('DELETE')
    </form>

    {{-- STYLE KHUSUS --}}
    <style>
        .table-modern thead tr {
            background: #f6f7fb;
            border-bottom: 1px solid #e2e4f0;
        }

        .table-modern thead th {
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: .04em;
            color: #8b8fa3;
            border-bottom: none !important;
        }

        .table-modern tbody tr {
            cursor: pointer;
        }

        .table-modern tbody tr:hover {
            background: #f9fafc;
        }

        .context-menu {
            position: absolute;
            min-width: 140px;
            background: #ffffff;
            border-radius: 6px;
            box-shadow: 0 8px 20px rgba(15, 23, 42, 0.12);
            padding: 4px 0;
            display: none;
            z-index: 9999;
        }

        .context-menu.show {
            display: block;
        }

        .context-menu .context-item {
            width: 100%;
            border: none;
            background: transparent;
            text-align: left;
            padding: 6px 12px;
            font-size: 13px;
            display: flex;
            align-items: center;
        }

        .context-menu .context-item:hover {
            background: #f1f5f9;
        }

        .footSup {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            margin-bottom: 16px;
        }

        /* kiri: filter + search */
        .SecL {
            display: flex;
            align-items: center;
            flex: 1;
            /* biar search bisa melebar */
            gap: 8px;
        }

        .filterBtn {
            width: 36px;
            height: 36px;
            border-radius: 8px;
            border: 1px solid #d1d5e0;
            background: #ffffff;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .filterBtn i {
            font-size: 14px;
            color: #475569;
        }

        /* bungkus search */
        .searchWrap {
            position: relative;
            flex: 1;
        }



        .myiconG {
            font-size: 5px;
            position: absolute;
            left: 10px;
            top: 50%;
            transform: translateY(-50%);
            color: #9ca3af;
        }
        .searchInput {
            width: 30%;
            height: 36px;
            border-radius: 8px;
            border: 1px solid #d1d5e0;
            background: #f9fafb;
            padding-left: 34px;
            font-size: 14px;
        }

        .searchInput:focus {
            border-color: #8290ad !important;
            outline: none;
        }


        /* kanan: tombol add customer */
        .btnAddCustomer {
            flex-shrink: 0;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            height: 36px;
            padding: 0 20px;
            border-radius: 5px;
            background: #2563eb;
            color: #ffffff;
            font-size: 14px;
            font-weight: 500;
            text-decoration: none;
        }

        .btnAddCustomer:hover {
            background: #1d4ed8;
            color: #ffffff;
        }

        .paginationBar {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 12px 16px;
    font-size: 14px;
    color: #6b7280;
}

.rightInfo {
    display: flex;
    align-items: center;
    gap: 16px;
}

.rowsSelect {
    height: 32px;
    border-radius: 6px;
    border: 1px solid #d1d5db;
    padding: 0 24px 0 10px;
}

.pageInfo {
    font-size: 13px;
    color: #4b5563;
}

.pageArrows {
    display: flex;
    align-items: center;
    gap: 6px;           /* supaya kiri & kanan nempel samping */
}

.pageBtn {
    width: 32px;
    height: 32px;
    border-radius: 6px;
    border: 1px solid #d1d5db;
    background: #ffffff;
    display: inline-flex;   /* <-- penting: inline-flex, bukan flex */
    align-items: center;
    justify-content: center;
    text-decoration: none;
    color: #6b7280;
}

.pageBtn:hover {
    background: #f3f4f6;
}

.disabledBtn {
    opacity: 0.4;
    cursor: not-allowed;
}


    </style>

    {{-- SCRIPT --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const rows = document.querySelectorAll('.supplier-row');
            const menu = document.getElementById('rowContextMenu');
            const deleteForm = document.getElementById('context-delete-form');
            const editBtn = document.getElementById('context-edit');
            const deleteBtn = document.getElementById('context-delete');
            let currentEditUrl = null;
            let currentDeleteUrl = null;

            // klik kanan tiap baris
            rows.forEach(row => {
                row.addEventListener('contextmenu', function(e) {
                    e.preventDefault();

                    currentEditUrl = this.dataset.editUrl;
                    currentDeleteUrl = this.dataset.deleteUrl;

                    // posisi menu
                    menu.style.top = e.pageY + 'px';
                    menu.style.left = e.pageX + 'px';
                    menu.classList.add('show');
                });
            });

            // klik di luar menu -> sembunyikan
            document.addEventListener('click', function(e) {
                if (!menu.contains(e.target)) {
                    menu.classList.remove('show');
                }
            });

            // tombol Edit
            editBtn.addEventListener('click', function() {
                if (currentEditUrl) {
                    window.location.href = currentEditUrl;
                }
            });

            // tombol Delete
            deleteBtn.addEventListener('click', function() {
                if (currentDeleteUrl) {
                    if (confirm('Yakin ingin menghapus supplier ini?')) {
                        deleteForm.action = currentDeleteUrl;
                        deleteForm.submit();
                    }
                }
            });

            // search simpel di client-side
            const searchInput = document.getElementById('supplier-search');
            if (searchInput) {
                searchInput.addEventListener('input', function() {
                    const term = this.value.toLowerCase();
                    rows.forEach(row => {
                        const text = row.innerText.toLowerCase();
                        row.style.display = text.includes(term) ? '' : 'none';
                    });
                });
            }

            // rows per page (butuh index controller pakai request('per_page'))
            const perPageSelect = document.getElementById('per-page-select');

    perPageSelect.addEventListener('change', function () {
        const perPage = this.value;
        const url = new URL(window.location.href);

        // set jumlah row per page
        url.searchParams.set('per_page', perPage);

        // tiap ganti jumlah row, balik ke halaman 1 biar aman
        url.searchParams.set('page', 1);

        window.location.href = url.toString();
});
});
    </script>
@endsection
