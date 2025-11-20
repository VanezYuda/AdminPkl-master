@extends('layouts.sidebar')

@section('title', 'Kategori')

@section('content')

    <link rel="stylesheet" href="{{ asset('css/kategori.css') }}">
    <link rel="stylesheet" href="{{ asset('css/alert.css') }}">

    <style>
        /* ===================================================================
               RESPONSIVE FIX for Datta Able + Kategori Page
               =================================================================== */

        /* Wrapper mengikuti sidebar */
        .page-container {
            padding: 20px;
            margin-left: 260px;
            transition: all .3s ease;
        }

        .pc-sidebar-hide .page-container {
            margin-left: 80px;
        }

        @media (max-width: 991px) {
            .page-container {
                margin-left: 0 !important;
                padding: 15px;
            }
        }

        /* TOP BAR RESPONSIVE */
        .top-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 10px;
        }

        .search-group {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .search-box {
            width: 220px;
        }

        @media (max-width: 576px) {
            .search-box {
                width: 100%;
            }
        }

        /* TABLE WRAPPER RESPONSIVE */
        .table-modern {
            min-width: 600px;
        }

        .table-responsive {
            overflow-x: auto;
        }

        /* PAGINATION RESPONSIVE */
        .pagination-wrapper {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            row-gap: 10px;
            padding: 10px 15px;
        }

        .pagination-right {
            display: flex;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
        }

        @media (max-width: 480px) {
            .pagination-info {
                width: 100%;
                text-align: left;
            }
        }

        /* CONTEXT MENU RESPONSIVE */
        #contextMenu {
            z-index: 2000;
            width: 140px;
        }

        @media (max-width: 480px) {
            #contextMenu {
                width: 120px;
            }
        }

        /* MODAL RESPONSIVE */
        .modal-content {
            width: 450px;
            max-width: 95%;
        }

        @media (max-width: 480px) {
            .modal-content {
                width: 95%;
                padding: 15px;
            }
        }
    </style>



    {{-- DELETE POPUP --}}
    <div id="deleteOverlay" class="overlay" style="display:none;"></div>

    <div id="deleteModal" class="delete-modal" style="display:none;">
        <div class="modal-header">
            <div class="warning-icon"><span>!</span></div>
            <button class="close-btn" onclick="closeDeleteModal()">×</button>
        </div>

        <h2 class="modal-title">Hapus Kategori?</h2>
        <p class="modal-text">Data yang dihapus tidak dapat dikembalikan.</p>

        <div class="modal-actions">
            <button class="cancel-btn" onclick="closeDeleteModal()">Cancel</button>

            <form id="deleteForm" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button class="delete-btn row">Delete</button>
            </form>
        </div>
    </div>



    <div class="page-container">
        <div class="pc-content">

            <h2 class="title">Kategori</h2>
            <p class="subtitle">Home / Product</p>

            <div class="top-bar">

                <!-- FILTER DI KIRI -->
                <button type="button" class="filterBtn filter-left">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"></polygon>
                    </svg>
                </button>

                <!-- SEARCH BAR -->
                <div class="search-group">
                    <div class="search-bar">
                        <input type="text" id="kategori-search" class="searchInput" placeholder="Search...">

                        <span class="searchIcon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <circle cx="11" cy="11" r="8"></circle>
                                <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                            </svg>
                        </span>
                    </div>
                </div>

                <!-- ADD BUTTON DI KANAN -->
                <button class="add-btn" onclick="openCreateModal()">
                    <i class="bi bi-plus-lg me-1"></i> Add Category
                </button>

            </div>



            <div class="card border-0 shadow-sm mt-3">
                <div class="card-body table-responsive p-0">

                    <table class="table mb-0 align-middle table-modern" id="kategori-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama Kategori</th>
                                <th>Keterangan</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($kategori as $k)
                                <tr oncontextmenu="openContext(event, '{{ $k->id }}', '{{ $k->nama }}', '{{ $k->keterangan }}')"
                                    onclick="openContext(event, '{{ $k->id }}', '{{ $k->nama }}', '{{ $k->keterangan }}')">
                                    <td>{{ $loop->iteration + ($kategori->currentPage() - 1) * $kategori->perPage() }}</td>
                                    <td>{{ $k->nama }}</td>
                                    <td>{{ $k->keterangan }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <input type="hidden" id="totalData" value="{{ $kategori->total() }}">
                    <input type="hidden" id="perPage" value="{{ $kategori->perPage() }}">
                    <input type="hidden" id="currentPage" value="{{ $kategori->currentPage() }}">
                    <input type="hidden" id="lastPage" value="{{ $kategori->lastPage() }}">

                    <div class="pagination-wrapper">

                        <div class="pagination-info" id="pageInfo"></div>

                        <div class="pagination-right">
                            <label class="rows-label">
                                Rows per page:
                                <select id="rowsPerPage">
                                    <option {{ $kategori->perPage() == 5 ? 'selected' : '' }}>5</option>
                                    <option {{ $kategori->perPage() == 10 ? 'selected' : '' }}>10</option>
                                    <option {{ $kategori->perPage() == 25 ? 'selected' : '' }}>25</option>
                                    <option {{ $kategori->perPage() == 50 ? 'selected' : '' }}>50</option>
                                </select>
                            </label>

                            <div class="page-number" id="pageNumber"></div>

                            <button class="page-btn prev" id="prevBtn">❮</button>
                            <button class="page-btn next" id="nextBtn">❯</button>
                        </div>

                    </div>

                </div>
            </div>

        </div>
    </div>



    {{-- CREATE MODAL --}}
    <div id="createModal" class="modal">
        <div class="modal-content">
            <h3 class="modal-title">Add Kategori</h3>

            <form action="{{ route('kategori.store') }}" method="POST">
                @csrf

                <label>Nama Kategori</label>
                <input type="text" name="nama" required>

                <label>Keterangan</label>
                <textarea name="keterangan" required></textarea>

                <div class="modal-btn-group">
                    <button type="button" class="close-btn" onclick="closeCreateModal()">Cancel</button>
                    <button type="submit" class="save-btn">Save</button>
                </div>
            </form>
        </div>
    </div>


    {{-- EDIT MODAL --}}
    <div id="editModal" class="modal">
        <div class="modal-content">
            <h3 class="modal-title">Edit Kategori</h3>

            <form id="editForm" method="POST">
                @csrf
                @method('PUT')

                <label>Nama Kategori</label>
                <input type="text" name="nama" id="editNama" required>

                <label>Keterangan</label>
                <textarea name="keterangan" id="editKeterangan" required></textarea>

                <div class="modal-btn-group">
                    <button type="button" class="close-btn" onclick="closeEditModal()">Cancel</button>
                    <button type="submit" class="save-btn">Update</button>
                </div>
            </form>
        </div>
    </div>



    {{-- CONTEXT MENU --}}
    <div id="contextMenu">
        <button id="ctxEdit">Edit</button>
        <button id="ctxDelete">Delete</button>
    </div>

    <script src="{{ asset('js/semua.js') }}"></script>
@endsection
