<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title', 'Admin - PadosiAgent')</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('admin_assets/admin_code.css') }}">
  <script src="{{ asset('admin_assets/admin_code.js') }}"></script>
  @stack('scripts')
</head>
<body>
<nav style="position:fixed;top:0;left:0;right:0;z-index:40;background:white;border-bottom:1px solid #d7e0ea;padding:12px 24px;display:flex;align-items:center;justify-content:space-between;">
  <div style="display:flex;align-items:center;gap:12px;">
    <img src="{{ asset('admin_assets/images/logo.png') }}" alt="PadosiAgent logo" style="width:160px;height:68.43px;object-fit:contain;display:block;">
  </div>
  <div style="display:flex;align-items:center;gap:16px;">
    <span class="badge badge-primary">Admin</span>
    <a href="{{ route('admin.logout') }}" style="font-size:13px;color:#ef4444;text-decoration:none;font-weight:600;display:flex;align-items:center;gap:4px;">🚪 Logout</a>
  </div>
</nav>

<div class="content-container">
    <div style="margin-top: 80px;">
        @yield('content')
    </div>
</div>
</body>
</html>
