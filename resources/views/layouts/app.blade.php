<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <title>{{ config('app.name', 'Bookstore') }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f5f7fa;
            margin: 0;
            padding: 0;
            color: #333;
        }
        nav {
            background: #2563eb;
            color: white;
            padding: 1rem;
        }
        nav a {
            color: white;
            text-decoration: none;
            margin-right: 1rem;
        }
        nav a:hover {
            text-decoration: underline;
        }
        .container {
            max-width: 1000px;
            margin: 2rem auto;
            padding: 1rem;
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
        }
        h1 {
            margin-bottom: 1rem;
        }
        form {
            margin-bottom: 1.5rem;
        }
        input, select, button {
            padding: 0.5rem;
            margin-right: 0.5rem;
            border: 1px solid #ccc;
            border-radius: 6px;
        }
        button {
            background: #2563eb;
            color: white;
            border: none;
            cursor: pointer;
        }
        button:hover {
            background: #1e40af;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 1rem;
        }
        table th, table td {
            border: 1px solid #ddd;
            padding: 0.75rem;
            text-align: left;
        }
        table th {
            background: #f3f4f6;
        }
        tr:hover {
            background: #f9fafb;
        }
        .pagination {
            margin-top: 1.5rem;
        }
        
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav>
        {{-- <a href="{{ url('/') }}">📚 Bookstore</a> --}}
        <a href="{{ route('books.index') }}">Books</a>
        <a href="{{ route('authors.top') }}">Top Authors</a>
        <a href="{{ route('rating.create') }}">Rate a Book</a>
    </nav>

    <!-- Content -->
    <div class="container">
        @yield('content')

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    </div>
</body>
</html>
