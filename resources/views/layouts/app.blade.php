<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('page_title', 'Nội dung')</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        :root {
            --blue-50:  #eff8ff;
            --blue-100: #dbeffe;
            --blue-200: #bfe3fe;
            --blue-400: #38b2f8;
            --blue-500: #0ea5e9;
            --blue-600: #0284c7;
            --blue-700: #0369a1;
            --surface:  #f0f7ff;
            --white:    #ffffff;
            --text-main:#0f2a3f;
            --text-muted:#64899f;
            --shadow-sm: 0 1px 4px rgba(14,165,233,.08), 0 1px 2px rgba(0,0,0,.04);
            --shadow-md: 0 4px 20px rgba(14,165,233,.12), 0 1px 4px rgba(0,0,0,.06);
            --radius-xl: 16px;
            --radius-lg: 12px;
            --radius-md: 8px;
        }

        *, *::before, *::after { box-sizing: border-box; }

        body {
            background: var(--surface);
            font-family: 'Plus Jakarta Sans', sans-serif;
            color: var(--text-main);
            min-height: 100vh;
            padding-bottom: 60px;
        }

        /* ── decorative background mesh ── */
        body::before {
            content: '';
            position: fixed;
            inset: 0;
            background:
                radial-gradient(ellipse 800px 500px at 10% -10%, rgba(186,230,255,.35) 0%, transparent 60%),
                radial-gradient(ellipse 600px 400px at 90% 100%,  rgba(186,230,255,.25) 0%, transparent 60%);
            pointer-events: none;
            z-index: 0;
        }

        .app-wrapper {
            position: relative;
            z-index: 1;
        }

        /* ── TOP BAR ── */
        .topbar {
            background: rgba(255,255,255,.82);
            backdrop-filter: blur(14px);
            -webkit-backdrop-filter: blur(14px);
            border-bottom: 1px solid var(--blue-100);
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .topbar-inner {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 1.5rem;
            height: 62px;
        }

        /* ── Brand ── */
        .brand {
            display: flex;
            align-items: center;
            gap: .55rem;
            text-decoration: none;
            font-weight: 700;
            font-size: 1.05rem;
            color: var(--blue-700);
            letter-spacing: -.3px;
        }

        .brand-icon {
            width: 34px; height: 34px;
            background: linear-gradient(135deg, var(--blue-500), var(--blue-700));
            border-radius: var(--radius-md);
            display: flex; align-items: center; justify-content: center;
            font-size: .95rem;
            box-shadow: 0 2px 8px rgba(14,165,233,.35);
        }

        /* ── Nav links ── */
        .nav-links {
            display: flex;
            align-items: center;
            gap: .25rem;
            list-style: none;
            margin: 0; padding: 0;
        }

        .nav-links a {
            display: flex;
            align-items: center;
            gap: .4rem;
            padding: .42rem .85rem;
            border-radius: var(--radius-md);
            font-size: .875rem;
            font-weight: 500;
            color: var(--text-muted);
            text-decoration: none;
            transition: background .18s, color .18s;
            white-space: nowrap;
        }

        .nav-links a:hover {
            background: var(--blue-50);
            color: var(--blue-600);
        }

        .nav-links a.active {
            background: var(--blue-100);
            color: var(--blue-700);
            font-weight: 600;
        }

        .nav-links a .nav-emoji {
            font-size: .9rem;
            line-height: 1;
        }

        /* active indicator pip */
        .nav-links a.active::after {
            content: '';
            position: absolute;
            bottom: -1px;
            left: 50%; transform: translateX(-50%);
            width: 20px; height: 2px;
            background: var(--blue-500);
            border-radius: 2px;
        }

        .nav-links li { position: relative; }

        /* ── Right slot (avatar / badge) ── */
        .topbar-right {
            display: flex;
            align-items: center;
            gap: .6rem;
        }

        .avatar {
            width: 34px; height: 34px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--blue-200), var(--blue-400));
            display: flex; align-items: center; justify-content: center;
            font-size: .75rem;
            font-weight: 700;
            color: var(--blue-700);
            border: 2px solid var(--white);
            box-shadow: var(--shadow-sm);
            cursor: pointer;
        }

        /* ── Breadcrumb strip ── */
        .breadcrumb-strip {
            padding: .6rem 0 0;
            font-size: .78rem;
            color: var(--text-muted);
        }

        .breadcrumb-strip span { color: var(--blue-600); font-weight: 600; }

        /* ── Page header ── */
        .page-header {
            margin-bottom: 1.5rem;
        }

        .page-header h1 {
            font-size: 1.45rem;
            font-weight: 700;
            letter-spacing: -.4px;
            margin: 0;
            color: var(--text-main);
        }

        .page-header p {
            font-size: .85rem;
            color: var(--text-muted);
            margin: .25rem 0 0;
        }

        /* ── Content card ── */
        .content-card {
            background: var(--white);
            border-radius: var(--radius-xl);
            box-shadow: var(--shadow-md);
            border: 1px solid var(--blue-100);
            padding: 2rem;
            animation: fadeUp .35s ease both;
        }

        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(12px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        /* ── Footer ── */
        .app-footer {
            text-align: center;
            padding: 2rem 0 1.5rem;
            font-size: .78rem;
            color: var(--text-muted);
            position: fixed;
            bottom: 0;
            width: 100%;
        }

        /* ── Responsive ── */
        @media (max-width: 768px) {
            .nav-links a span.nav-label { display: none; }
            .nav-links a { padding: .4rem .6rem; font-size: 1rem; }
            .topbar-right .avatar-label { display: none; }
        }

        /* ═══════════════════════════════════════
           SHARED COMPONENT STYLES
        ═══════════════════════════════════════ */

        .btn-primary-custom {
            display: inline-flex; align-items: center; gap: .35rem;
            padding: .52rem 1.1rem;
            background: linear-gradient(135deg, var(--blue-500), var(--blue-700));
            color: #fff; font-size: .85rem; font-weight: 600;
            border-radius: var(--radius-md); text-decoration: none; border: none; cursor: pointer;
            box-shadow: 0 2px 8px rgba(14,165,233,.35);
            transition: box-shadow .18s, transform .12s;
        }
        .btn-primary-custom:hover { color: #fff; box-shadow: 0 4px 14px rgba(14,165,233,.45); transform: translateY(-1px); }

        .btn-outline-custom {
            padding: .5rem 1rem; background: transparent; color: var(--blue-600);
            border: 1.5px solid #7dd3fc; border-radius: var(--radius-md);
            font-size: .85rem; font-weight: 600; cursor: pointer; white-space: nowrap;
            transition: background .16s, color .16s;
        }
        .btn-outline-custom:hover { background: var(--blue-50); color: var(--blue-700); }

        .btn-xs-primary {
            padding: .28rem .65rem; background: var(--blue-500); color: #fff;
            border: none; border-radius: 6px; font-size: .78rem; font-weight: 600; cursor: pointer;
            transition: background .15s;
        }
        .btn-xs-primary:hover { background: var(--blue-600); }

        .btn-xs-danger {
            padding: .28rem .65rem; background: #fee2e2; color: #dc2626;
            border: none; border-radius: 6px; font-size: .78rem; font-weight: 600; cursor: pointer;
            transition: background .15s;
        }
        .btn-xs-danger:hover { background: #fecaca; }

        .btn-xs-info {
            display: inline-block; padding: .28rem .75rem;
            background: var(--blue-100); color: var(--blue-700);
            border: none; border-radius: 6px; font-size: .78rem; font-weight: 600;
            cursor: pointer; text-decoration: none; transition: background .15s;
        }
        .btn-xs-info:hover { background: var(--blue-200); color: var(--blue-700); }

        .search-bar { display: flex; align-items: center; gap: .5rem; flex-wrap: wrap; }
        .search-input-wrap { position: relative; display: flex; align-items: center; }
        .search-icon { position: absolute; left: .7rem; color: var(--text-muted); pointer-events: none; }
        .input-field {
            padding: .5rem .75rem .5rem 2.1rem;
            border: 1.5px solid var(--blue-100); border-radius: var(--radius-md);
            font-size: .85rem; font-family: inherit; color: var(--text-main);
            background: var(--blue-50); width: 200px;
            transition: border-color .16s, box-shadow .16s;
        }
        .input-field:focus { outline: none; border-color: var(--blue-400); box-shadow: 0 0 0 3px rgba(14,165,233,.12); background: #fff; }
        .select-field {
            padding: .5rem .75rem; border: 1.5px solid var(--blue-100); border-radius: var(--radius-md);
            font-size: .85rem; font-family: inherit; color: var(--text-main);
            background: var(--blue-50); cursor: pointer; transition: border-color .16s;
        }
        .select-field:focus { outline: none; border-color: var(--blue-400); }

        .table-wrap { overflow-x: auto; border-radius: var(--radius-lg); border: 1px solid var(--blue-100); }
        .data-table { width: 100%; border-collapse: collapse; font-size: .875rem; }
        .data-table thead tr { background: var(--blue-50); border-bottom: 1.5px solid var(--blue-100); }
        .data-table th {
            padding: .75rem 1rem; text-align: left; font-size: .75rem; font-weight: 700;
            text-transform: uppercase; letter-spacing: .05em; color: var(--blue-700); white-space: nowrap;
        }
        .data-table td { padding: .75rem 1rem; border-bottom: 1px solid var(--blue-50); color: var(--text-main); vertical-align: middle; }
        .data-table tbody tr:last-child td { border-bottom: none; }
        .data-table tbody tr { transition: background .14s; }
        .data-table tbody tr:hover { background: var(--blue-50); }

        .id-badge {
            display: inline-flex; align-items: center; justify-content: center;
            width: 28px; height: 28px; background: var(--blue-100); color: var(--blue-700);
            border-radius: 6px; font-size: .78rem; font-weight: 700;
        }
        .tag-blue { display: inline-block; padding: .2rem .6rem; background: var(--blue-100); color: var(--blue-700); border-radius: 20px; font-size: .78rem; font-weight: 600; }
        .credit-badge { display: inline-block; padding: .22rem .7rem; background: linear-gradient(135deg, var(--blue-100), var(--blue-200)); color: var(--blue-700); border-radius: 20px; font-size: .8rem; font-weight: 700; }
        .date-chip, .time-chip { display: inline-block; padding: .22rem .65rem; background: var(--blue-50); color: var(--blue-600); border: 1px solid var(--blue-100); border-radius: 6px; font-size: .82rem; font-weight: 500; }

        .status-badge { display: inline-flex; align-items: center; gap: .25rem; padding: .25rem .65rem; border-radius: 20px; font-size: .78rem; font-weight: 700; }
        .status-badge.success { background: #dcfce7; color: #166534; }
        .status-badge.warning { background: #fef9c3; color: #854d0e; }
        .status-badge.danger  { background: #fee2e2; color: #991b1b; }

        .status-select { padding: .3rem .6rem; border-radius: var(--radius-md); border: 1.5px solid var(--blue-100); font-size: .82rem; font-family: inherit; font-weight: 600; cursor: pointer; background: var(--blue-50); color: var(--text-main); transition: border-color .15s; }
        .status-select:focus { outline: none; border-color: var(--blue-400); }
        .status-select--green { background: #dcfce7; border-color: #86efac; color: #166534; }
        .status-select--blue  { background: var(--blue-100); border-color: var(--blue-200); color: var(--blue-700); }
        .status-select--gray  { background: #f3f4f6; border-color: #d1d5db; color: #374151; }

        .qty-input { width: 72px; padding: .3rem .5rem; border: 1.5px solid var(--blue-100); border-radius: 6px; font-size: .85rem; font-family: inherit; background: var(--blue-50); color: var(--text-main); text-align: center; transition: border-color .15s; }
        .qty-input:focus { outline: none; border-color: var(--blue-400); background: #fff; }

        .flash-success { display: flex; align-items: center; gap: .5rem; padding: .75rem 1rem; background: #dcfce7; color: #166534; border: 1px solid #86efac; border-radius: var(--radius-md); font-size: .875rem; font-weight: 600; }

        .empty-state { text-align: center; padding: 2.5rem 1rem !important; color: var(--text-muted); font-size: .875rem; }
        .fw-semibold { font-weight: 600; }
        .text-muted-custom { color: var(--text-muted); }

        /* ═══════════════════════════════════════
           FORM STYLES
        ═══════════════════════════════════════ */

        .back-link {
            display: inline-flex; align-items: center; gap: .3rem;
            font-size: .82rem; font-weight: 600; color: var(--blue-600);
            text-decoration: none; margin-bottom: 1.25rem;
            transition: color .15s;
        }
        .back-link:hover { color: var(--blue-700); }

        .app-form { max-width: 640px; }

        .form-row-2 { display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; }
        @media (max-width: 560px) { .form-row-2 { grid-template-columns: 1fr; } }

        .form-group { margin-bottom: 1.1rem; }

        .form-label {
            display: block; margin-bottom: .4rem;
            font-size: .82rem; font-weight: 600; color: var(--text-main);
        }
        .required { color: #ef4444; margin-left: .1rem; }

        .form-input, .form-select-input {
            width: 100%; padding: .58rem .82rem; 
            border: 1.5px solid var(--blue-100); border-radius: var(--radius-md);
            font-size: .875rem; font-family: inherit; color: var(--text-main);
            background: var(--blue-50);
            transition: border-color .16s, box-shadow .16s, background .16s;
        }
        .form-input:focus, .form-select-input:focus {
            outline: none; border-color: var(--blue-400);
            box-shadow: 0 0 0 3px rgba(14,165,233,.12); background: #fff;
        }
        .form-input.is-invalid, .form-select-input.is-invalid {
            border-color: #f87171; background: #fff5f5;
        }
        .form-select-input { cursor: pointer; appearance: auto; }

        .form-error { display: block; margin-top: .3rem; font-size: .78rem; color: #dc2626; font-weight: 500; }

        /* prefix input (₫) */
        .input-prefix-wrap { position: relative; display: flex; align-items: center; }
        .input-prefix {
            position: absolute; left: .82rem; font-size: .85rem;
            font-weight: 700; color: var(--blue-600); pointer-events: none;
        }
        .form-input.has-prefix { padding-left: 1.8rem; }

        .form-actions {
            display: flex; align-items: center; gap: .75rem;
            margin-top: 1.75rem; padding-top: 1.25rem;
            border-top: 1px solid var(--blue-100);
        }
        .btn-cancel {
            padding: .52rem 1.1rem; background: transparent;
            color: var(--text-muted); border: 1.5px solid var(--blue-100);
            border-radius: var(--radius-md); font-size: .85rem; font-weight: 600;
            text-decoration: none; transition: border-color .15s, color .15s;
        }
        .btn-cancel:hover { border-color: var(--blue-300, #7dd3fc); color: var(--text-main); }

        .form-section-title {
            font-size: .78rem; font-weight: 700; text-transform: uppercase;
            letter-spacing: .06em; color: var(--blue-700);
            margin: 1.25rem 0 .75rem; padding-bottom: .4rem;
            border-bottom: 1.5px solid var(--blue-100);
        }

        /* Product picker */
        .product-picker { display: flex; flex-direction: column; gap: .5rem; margin-bottom: .5rem; }
        .product-pick-row {
            display: flex; align-items: center; justify-content: space-between;
            padding: .65rem .9rem; background: var(--blue-50);
            border: 1px solid var(--blue-100); border-radius: var(--radius-md);
            transition: border-color .15s;
        }
        .product-pick-row:hover { border-color: var(--blue-200); }
        .product-pick-info { display: flex; align-items: center; gap: .6rem; flex-wrap: wrap; }
        .product-pick-name { font-weight: 600; font-size: .875rem; }
        .product-pick-price { font-size: .82rem; color: var(--blue-600); font-weight: 600; }

        /* Flash error */
        .flash-error {
            display: flex; align-items: center; gap: .5rem; padding: .75rem 1rem;
            background: #fee2e2; color: #991b1b; border: 1px solid #fca5a5;
            border-radius: var(--radius-md); font-size: .875rem; font-weight: 600;
        }

        /* Detail meta card */
        .detail-meta-card {
            background: var(--blue-50); border: 1px solid var(--blue-100);
            border-radius: var(--radius-lg); padding: 1.1rem 1.3rem;
            display: flex; flex-direction: column; gap: .65rem;
        }
        .detail-meta-row { display: flex; align-items: center; gap: 1rem; }
        .detail-meta-label { min-width: 110px; font-size: .78rem; font-weight: 700; text-transform: uppercase; letter-spacing: .05em; color: var(--blue-700); }
        .detail-meta-value { font-size: .9rem; color: var(--text-main); }
    </style>
</head>

<body>
<div class="app-wrapper">

    <!-- TOP BAR -->
    <header class="topbar">
        <div class="container topbar-inner">

            <!-- Brand -->
            <a class="brand" href="#">
                <div class="brand-icon">🚀</div>
                Laravel App
            </a>

            <!-- Nav -->
            <nav>
                <ul class="nav-links">
                    <li>
                        <a href="/students" class="{{ request()->is('students*') ? 'active' : '' }}">
                            <span class="nav-emoji">🎓</span>
                            <span class="nav-label">Sinh viên</span>
                        </a>
                    </li>
                    <li>
                        <a href="/products" class="{{ request()->is('products*') ? 'active' : '' }}">
                            <span class="nav-emoji">📦</span>
                            <span class="nav-label">Sản phẩm</span>
                        </a>
                    </li>
                    <li>
                        <a href="/courses" class="{{ request()->is('courses*') ? 'active' : '' }}">
                            <span class="nav-emoji">📘</span>
                            <span class="nav-label">Môn học</span>
                        </a>
                    </li>
                    <li>
                        <a href="/orders" class="{{ request()->is('orders*') ? 'active' : '' }}">
                            <span class="nav-emoji">🛒</span>
                            <span class="nav-label">Đơn hàng</span>
                        </a>
                    </li>
                    <li>
                        <a href="/bookings" class="{{ request()->is('bookings*') ? 'active' : '' }}">
                            <span class="nav-emoji">📅</span>
                            <span class="nav-label">Đặt lịch</span>
                        </a>
                    </li>
                </ul>
            </nav>

            <!-- Right slot -->
            <div class="topbar-right">
                <div class="avatar">AD</div>
            </div>

        </div>
    </header>

    <!-- PAGE BODY -->
    <main class="container mt-4 pb-2">

        <!-- Breadcrumb -->
        <div class="breadcrumb-strip mb-3">
            Trang chủ &rsaquo; <span>@yield('page_title', 'Nội dung')</span>
        </div>

        <!-- Page header -->
        <div class="page-header"> 
            <p>@yield('page_desc', 'Quản lý và theo dõi dữ liệu của bạn.')</p>
        </div>

        <!-- Content card -->
        <div class="content-card">
            @yield('content')
        </div>
    </main>

    <!-- FOOTER -->
    <footer class="app-footer">
        © {{ date('Y') }} Laravel &mdash; Built with Nguyễn Trí Dũng❤️
    </footer>

</div>
</body>
</html>