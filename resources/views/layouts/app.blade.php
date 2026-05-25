<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>@yield('title', 'Peoples Dental Care')</title>

  <!-- Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <!-- Font Awesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet"/>
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700;800&family=DM+Sans:wght@300;400;500;600&family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet"/>
  <!-- Main CSS — always loaded -->
  <link rel="stylesheet" href="{{ asset('css/style.css') }}"/>
  <!-- Page specific CSS -->
  @yield('css')
</head>
<body>

  {{-- TOP HEADER BAR — written once here --}}
  @include('components.topbar')

  {{-- NAVBAR — written once here --}}
  @include('components.navbar')

  {{-- PAGE CONTENT — each page fills this --}}
  @yield('content')

  {{-- FOOTER — written once here --}}
  @include('components.footer')

  {{-- APPOINTMENT MODAL — available on every page --}}
  @include('components.appointment-modal')


  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <!-- Main JS — always loaded -->
  <script src="{{ asset('js/main.js') }}"></script>
  <!-- Page specific JS -->
  @yield('js')

</body>
</html>