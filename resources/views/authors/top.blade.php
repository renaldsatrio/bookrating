@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h1 class="mb-4 text-center">Top 10 Most Famous Authors</h1>

    <div class="card shadow-sm p-4">
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>Author</th>
                        <th>Total Voter</th>
                    </tr>
                </thead>
                <tbody id="authors-table">
                    <tr><td colspan="2" class="text-center">Loading...</td></tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    async function loadAuthors() {
        let res = await fetch(`/api/authors/top`);
        let data = await res.json();
        let tbody = document.getElementById('authors-table');
        tbody.innerHTML = '';
        data.forEach(author => {
            tbody.innerHTML += `
                <tr>
                    <td>${author.name}</td>
                    <td><span class="badge bg-primary">${author.voter_count}</span></td>
                </tr>
            `;
        });
    }
    loadAuthors();
</script>
@endsection
