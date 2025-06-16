<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'إدارة الحسابات')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        .navbar-brand { font-weight: bold; }
        .card { box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
        .btn-group-sm > .btn { margin: 2px; }
        .currency-badge { font-size: 0.8em; }
        .balance-positive { color: #28a745; }
        .balance-negative { color: #dc3545; }
        .transaction-deposit { border-right: 4px solid #28a745; }
        .transaction-withdrawal { border-right: 4px solid #dc3545; }
        .amount-positive { color: #28a745; font-weight: bold; }
        .amount-negative { color: #dc3545; font-weight: bold; }

        /* تحسينات الـ pagination */
        .pagination {
            margin-bottom: 0;
        }
        .pagination .page-link {
            color: #0d6efd;
            border: 1px solid #dee2e6;
            padding: 0.5rem 0.75rem;
            margin: 0 2px;
            border-radius: 0.375rem;
            transition: all 0.15s ease-in-out;
        }
        .pagination .page-link:hover {
            color: #0a58ca;
            background-color: #e9ecef;
            border-color: #adb5bd;
        }
        .pagination .page-item.active .page-link {
            background-color: #0d6efd;
            border-color: #0d6efd;
            color: white;
        }
        .pagination .page-item.disabled .page-link {
            color: #6c757d;
            background-color: #fff;
            border-color: #dee2e6;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="{{ route('people.index') }}">
                <i class="fas fa-calculator me-2"></i>إدارة الحسابات
            </a>
            <div class="navbar-nav me-auto">
                <a class="nav-link" href="{{ route('people.index') }}">الأشخاص</a>
                <a class="nav-link" href="{{ route('currencies.index') }}">العملات</a>
                <a class="nav-link" href="{{ route('reports.index') }}">التقارير</a>
            </div>
            <div class="navbar-nav">
                <span class="nav-link">مرحباً، {{ Auth::user()->name }}</span>
                <a class="nav-link" href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt me-2"></i>تسجيل خروج
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-circle me-2"></i>
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
</body>
</html>
