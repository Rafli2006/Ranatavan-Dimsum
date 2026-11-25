<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Dashboard') - Ranatavan Dimsum</title>

    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Google Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700;800&family=Playfair+Display:wght@600;700;800&display=swap" rel="stylesheet">

    {{-- Bootstrap Icons --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        :root {
            --primary: #70452c;
            --primary-dark: #4e3020;
            --primary-light: #946747;
            --caramel: #bd9068;
            --cream: #f8f5f0;
            --cream-dark: #eee5da;
            --ivory: #fffdf9;
            --text: #38291f;
            --text-muted: #918477;
            --border: #eee6dd;
            --success: #32845d;
            --danger: #c65b50;
            --warning: #d49b42;
            --shadow: 0 8px 30px rgba(74, 48, 29, 0.06);
            --shadow-hover: 0 14px 35px rgba(74, 48, 29, 0.11);
            --radius: 16px;
        }

        * {
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            background: var(--cream);
            color: var(--text);
            font-family: 'DM Sans', sans-serif;
            font-size: 14px;
            line-height: 1.6;
        }

        a {
            transition: all .25s ease;
        }

        /* NAVBAR */

        .navbar {
            background: var(--primary-dark);
            box-shadow: 0 4px 18px rgba(45, 27, 16, .12);
        }

        .navbar-brand {
            color: white !important;
            font-family: 'Playfair Display', serif;
            font-size: 20px;
            font-weight: 700;
            letter-spacing: .2px;
        }

        .navbar-brand:hover {
            color: #f2d5b5 !important;
        }

        .navbar-brand img {
            object-fit: cover;
        }

        /* SIDEBAR */

        .sidebar {
            background: linear-gradient(180deg, #70452c 0%, #4e3020 100%);
            min-height: calc(100vh - 56px);
            padding: 25px 16px;
        }

        .sidebar a {
            display: flex;
            align-items: center;
            gap: 12px;
            color: #f8eee4;
            text-decoration: none;
            padding: 12px 14px;
            border-radius: 10px;
            margin-bottom: 6px;
            font-size: 13px;
            font-weight: 500;
            transition: all .25s ease;
        }

        .sidebar a:hover {
            background: rgba(255, 255, 255, .13);
            color: white;
            transform: translateX(3px);
        }

        .sidebar a.active {
            background: #bd9068;
            color: #fff;
            font-weight: 700;
            box-shadow: 0 5px 15px rgba(0, 0, 0, .12);
        }

        .sidebar-heading {
            color: #d9b99a;
            font-size: 10px;
            font-weight: 800;
            letter-spacing: 1.6px;
            padding: 0 12px;
            margin: 22px 0 12px;
        }

        /* CONTENT */

        .content {
            padding: 30px;
        }

        .page-title {
            font-family: 'Playfair Display', serif;
            font-size: 29px;
            font-weight: 700;
            color: var(--primary-dark);
        }

        .page-subtitle {
            color: var(--text-muted);
            font-size: 13px;
        }

        /* CARD */

        .card {
            background: var(--ivory);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            transition: all .25s ease;
        }

        .card-hover:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-hover);
        }

        .card-header {
            background: transparent;
            border-bottom: 1px solid var(--border);
            padding: 18px 22px;
            color: var(--primary-dark);
            font-weight: 700;
        }

        .card-body {
            padding: 22px;
        }

        /* BUTTON */

        .btn {
            border-radius: 9px;
            font-family: 'DM Sans', sans-serif;
            font-size: 13px;
            font-weight: 600;
            padding: 9px 16px;
            transition: all .25s ease;
        }

        .btn-cokelat {
            background: var(--primary);
            color: white;
            border: 1px solid var(--primary);
        }

        .btn-cokelat:hover {
            background: var(--primary-dark);
            border-color: var(--primary-dark);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 5px 14px rgba(112, 69, 44, .2);
        }

        .btn-outline-cokelat {
            color: var(--primary);
            border: 1px solid var(--primary);
            background: transparent;
        }

        .btn-outline-cokelat:hover {
            color: white;
            background: var(--primary);
        }

        /* FORM */

        .form-label {
            color: var(--primary-dark);
            font-size: 13px;
            font-weight: 700;
            margin-bottom: 7px;
        }

        .form-control,
        .form-select {
            background-color: #fffefa;
            border: 1px solid #e9dfd4;
            border-radius: 9px;
            padding: 11px 13px;
            color: var(--text);
            font-size: 13px;
            transition: all .2s ease;
        }

        .form-control:focus,
        .form-select:focus {
            background: white;
            border-color: var(--caramel);
            box-shadow: 0 0 0 .2rem rgba(189, 144, 104, .15);
        }

        .form-control::placeholder {
            color: #b5a99d;
        }

        /* TABLE */

        .table {
            --bs-table-bg: transparent;
            margin-bottom: 0;
            vertical-align: middle;
        }

        .table thead th {
            background: #f6f0e8;
            color: var(--primary);
            border-bottom: 1px solid var(--border);
            padding: 15px 13px;
            font-size: 11px;
            font-weight: 800;
            letter-spacing: .5px;
            text-transform: uppercase;
            white-space: nowrap;
        }

        .table tbody td {
            padding: 15px 13px;
            color: #716358;
            font-size: 13px;
            border-color: #f1ebe4;
        }

        .table tbody tr {
            transition: background .2s ease;
        }

        .table tbody tr:hover {
            background: #fcf8f2;
        }

        /* BADGES */

        .badge {
            padding: 6px 10px;
            border-radius: 7px;
            font-size: 10px;
            font-weight: 700;
        }

        /* ALERT */

        .alert {
            border: none;
            border-radius: 11px;
            padding: 14px 17px;
            font-size: 13px;
            box-shadow: 0 3px 12px rgba(0, 0, 0, .03);
        }

        /* PAGINATION */

        .pagination {
            gap: 4px;
        }

        .pagination .page-link {
            border: none;
            border-radius: 7px;
            color: var(--primary);
            background: #f5eee6;
            font-size: 12px;
            margin: 0 2px;
        }

        .pagination .page-item.active .page-link {
            background: var(--primary);
            color: white;
        }

        .pagination .page-link:hover {
            background: var(--cream-dark);
            color: var(--primary-dark);
        }

        /* FOOTER */

        .page-footer {
            color: #aa9c90;
            text-align: center;
            font-size: 11px;
            padding: 25px 0 10px;
        }

        /* SCROLLBAR */

        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f1ebe4;
        }

        ::-webkit-scrollbar-thumb {
            background: #c4a58a;
            border-radius: 20px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: var(--primary-light);
        }

        /* RESPONSIVE */

        @media (max-width: 767px) {
            .content {
                padding: 18px 14px;
            }

            .page-title {
                font-size: 23px;
            }

            .sidebar {
                min-height: auto;
            }

            .card-body {
                padding: 16px;
            }
        }

    </style>

    @stack('styles')
</head>

<body>

    @yield('content')

    {{-- Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    @stack('scripts')

</body>
</html>
