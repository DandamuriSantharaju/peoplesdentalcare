<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>@yield('title', 'Admin — Peoples Dental Care')</title>

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <!-- Font Awesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet"/>
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;800&family=DM+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet"/>
  <!-- Admin CSS — shared for all admin pages -->
  <link rel="stylesheet" href="{{ asset('css/admin.css') }}"/>

  @yield('css')
</head>
<body>

  {{-- SHARED SIDEBAR --}}
  @include('admin.partials.sidebar', ['activePage' => $activePage ?? ''])

  {{-- PAGE CONTENT --}}
  <main class="main-content">
    @yield('content')
  </main>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <!-- Admin JS — shared for all admin pages -->
  <script src="{{ asset('js/admin.js') }}"></script>

  @yield('js')
</body>
</html>