@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h1 class="mb-4 text-center">List of Books</h1>

    <!-- Filter Form -->
    <div class="row g-2 mb-4">
        <div class="col-md-6">
            <input type="text" id="search" class="form-control" placeholder="🔍 Search by book or author">
        </div>
        <div class="col-md-3">
            <select id="per_page" class="form-select">
                @foreach(range(10,100,10) as $num)
                    <option value="{{ $num }}">Show {{ $num }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-3">
            <button onclick="loadBooks()" class="btn btn-primary w-100">Filter</button>
        </div>
    </div>

    <!-- Books Table -->
    <div class="table-responsive shadow-sm rounded">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-dark">
                <tr>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Voter</th>
                    <th>Avg Rating ⭐</th>
                </tr>
            </thead>
            <tbody id="books-table">
                <tr><td colspan="4" class="text-center">Loading...</td></tr>
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <nav class="mt-4">
        <ul id="pagination" class="pagination justify-content-center"></ul>
    </nav>
</div>

<script>
    async function loadBooks(page = 1) {
        let search = document.getElementById('search').value;
        let perPage = document.getElementById('per_page').value;
        let res = await fetch(`${window.location.origin}/api/books?page=${page}&per_page=${perPage}&search=${search}`);
        let data = await res.json();

        let tbody = document.getElementById('books-table');
        tbody.innerHTML = "";
        data.data.forEach(book => {
            tbody.innerHTML += `
                <tr>
                    <td>${book.title}</td>
                    <td>${book.author?.name ?? '-'}</td>
                    <td>${book.ratings_count}</td>
                    <td><span class="badge bg-success">${Number(book.ratings_avg_rating).toFixed(2)}</span></td>
                </tr>
            `;
        });

        // pagination
        let pag = document.getElementById('pagination');
        pag.innerHTML = '';

        let current = data.current_page;
        let last = data.last_page;
        let start = Math.max(1, current - 2);   // 2 halaman sebelum current
        let end = Math.min(last, current + 2);  // 2 halaman setelah current

        // Tombol "First"
        if (current > 3) {
            pag.innerHTML += `
                <li class="page-item">
                    <a class="page-link" href="javascript:void(0)" onclick="loadBooks(1)">First</a>
                </li>
                <li class="page-item disabled"><span class="page-link">...</span></li>
            `;
        }

        // Nomor halaman
        for (let i = start; i <= end; i++) {
            pag.innerHTML += `
                <li class="page-item ${i === current ? 'active' : ''}">
                    <a class="page-link" href="javascript:void(0)" onclick="loadBooks(${i})">${i}</a>
                </li>
            `;
        }

        // Tombol "Last"
        if (end < last) {
            pag.innerHTML += `
                <li class="page-item disabled"><span class="page-link">...</span></li>
                <li class="page-item">
                    <a class="page-link" href="javascript:void(0)" onclick="loadBooks(${last})">Last</a>
                </li>
            `;
        }

    }
    loadBooks();
</script>
@endsection
