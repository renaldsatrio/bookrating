@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h1 class="mb-4 text-center">Rate a Book</h1>

    <div class="card shadow-sm p-4">
        <form id="rating-form">
            <div class="mb-3">
                <label class="form-label fw-bold">Author</label>
                <select id="author-select" class="form-select" onchange="filterBooks(this.value)">
                    <option value="">-- Choose Author --</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">Book</label>
                <select id="book-select" class="form-select">
                    <option>-- Select book by author --</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">Rating</label>
                <select id="rating" class="form-select">
                    @foreach(range(1,10) as $num)
                        <option value="{{ $num }}">{{ $num }}</option>
                    @endforeach
                </select>
            </div>

            <div class="text-end">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
</div>

<script>
    async function loadAuthors() {
        let res = await fetch(`/api/authors/top`);
        let data = await res.json();
        let authorSelect = document.getElementById('author-select');
        authorSelect.innerHTML = '<option value="">-- Choose Author --</option>';
        data.forEach(a => {
            let opt = document.createElement('option');
            opt.value = a.id;
            opt.text = a.name;
            authorSelect.appendChild(opt);
        });
    }

    async function filterBooks(authorId) {
        if(!authorId) return;
        let res = await fetch(`/api/books/by-author/${authorId}`);
        let books = await res.json();
        let bookSelect = document.getElementById('book-select');
        bookSelect.innerHTML = "";
        books.forEach(b => {
            let opt = document.createElement('option');
            opt.value = b.id;
            opt.text = b.title;
            bookSelect.appendChild(opt);
        });
    }

    document.getElementById('rating-form').addEventListener('submit', async (e) => {
        e.preventDefault();
        let payload = {
            book_id: document.getElementById('book-select').value,
            rating: document.getElementById('rating').value
        };
        let res = await fetch('/api/ratings', {
            method: 'POST',
            headers: {'Content-Type': 'application/json', 'Accept': 'application/json'},
            body: JSON.stringify(payload)
        });
        if(res.ok){
            alert('Rating submitted!');
        } else {
            alert('Failed to submit rating');
        }
    });

    loadAuthors();
</script>
@endsection
