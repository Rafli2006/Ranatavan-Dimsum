<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title') - Ranatavan Dimsum</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f8f5f0;
            font-family: Arial, sans-serif;
        }

        .navbar {
            background-color: #70452c;
        }

        .navbar-brand {
            color: white;
            font-weight: bold;
        }

        .navbar-brand:hover {
            color: #f5dfc5;
        }

        .sidebar {
            background-color: #70452c;
            min-height: calc(100vh - 56px);
            padding: 20px 15px;
        }

        .sidebar a {
            display: block;
            color: white;
            text-decoration: none;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 8px;
        }

        .sidebar a:hover {
            background-color: #946747;
        }

        .content {
            padding: 25px;
        }

        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 3px 10px rgba(0,0,0,0.05);
        }

        .btn-cokelat {
            background-color: #70452c;
            color: white;
        }

        .btn-cokelat:hover {
            background-color: #54321f;
            color: white;
        }
    </style>

    @stack('styles')
</head>
<body>

    @yield('content')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    @stack('scripts')
</body>
</html>
