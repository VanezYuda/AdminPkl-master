function openCreateModal() {
        document.getElementById('createModal').style.display = 'flex';
    }

    function closeCreateModal() {
        document.getElementById('createModal').style.display = 'none';
    }

    /* ==================================================
                       FUNGSI MODAL EDIT
    =====================================================*/
    function openEditModal(id, nama, ket) {
        closeContext();

        document.getElementById('editModal').style.display = 'flex';
        document.getElementById('editNama').value = nama;
        document.getElementById('editKeterangan').value = ket;

        document.getElementById('editForm').action = '/kategori/' + id;
    }

    function closeEditModal() {
        document.getElementById('editModal').style.display = 'none';
    }

    /* ==================================================
                   CONTEXT MENU
    =====================================================*/
    let selectedId = null,
        selectedNama = "",
        selectedKet = "";

    function openContext(event, id, nama, ket) {
        event.preventDefault();

        const menu = document.getElementById("contextMenu");

        selectedId = id;
        selectedNama = nama;
        selectedKet = ket;

        menu.style.left = event.pageX + "px";
        menu.style.top = event.pageY + "px";
        menu.style.display = "block";
    }

    function closeContext() {
        document.getElementById("contextMenu").style.display = "none";
    }

    document.addEventListener("click", function(e) {
        if (!e.target.closest("#contextMenu")) {
            closeContext();
        }
    });

    /* ==================================================
                   CONTEXT MENU: EDIT
    =====================================================*/
    document.getElementById("ctxEdit").onclick = function() {
        openEditModal(selectedId, selectedNama, selectedKet);
    };

    /* ==================================================
                   CONTEXT MENU: DELETE
    =====================================================*/
    document.getElementById("ctxDelete").onclick = function() {
        openDeleteModal('/kategori/' + selectedId);
    };

    /* ==================================================
                        DELETE MODAL
    =====================================================*/
    function openDeleteModal(url) {
        document.getElementById('deleteOverlay').style.display = 'block';
        document.getElementById('deleteModal').style.display = 'block';

        document.getElementById('deleteForm').action = url;
    }

    function closeDeleteModal() {
        document.getElementById('deleteOverlay').style.display = 'none';
        document.getElementById('deleteModal').style.display = 'none';
    }

    /* ==================================================
                         PAGINATION
    =====================================================*/
    let total = parseInt(document.getElementById("totalData").value);
    let perPage = parseInt(document.getElementById("perPage").value);
    let currentPage = parseInt(document.getElementById("currentPage").value);
    let lastPage = parseInt(document.getElementById("lastPage").value);

    function renderPagination() {
        let start = (currentPage - 1) * perPage + 1;
        let end = Math.min(currentPage * perPage, total);

        document.getElementById("pageInfo").textContent = `${start}–${end} of ${total}`;
        document.getElementById("pageNumber").textContent = `${currentPage} / ${lastPage}`;
    }

    renderPagination();

    document.getElementById("nextBtn").onclick = () => {
        if (currentPage < lastPage) {
            window.location.href = `?page=${currentPage + 1}&per_page=${perPage}`;
        }
    };

    document.getElementById("prevBtn").onclick = () => {
        if (currentPage > 1) {
            window.location.href = `?page=${currentPage - 1}&per_page=${perPage}`;
        }
    };

    document.getElementById("rowsPerPage").onchange = function() {
        let newPerPage = this.value;
        window.location.href = `?page=1&per_page=${newPerPage}`;
    };
