{{-- NAVBAR COMPONENT --}}
{{-- This file is included in layouts/app.blade.php --}}
{{-- Used on every page automatically --}}
{{-- $currentPage variable passed from controller to highlight active link --}}

<nav class="main-navbar navbar navbar-expand-lg sticky-top">
  <div class="container">

    {{-- LOGO --}}
    <a class="navbar-brand d-flex align-items-center gap-2" href="{{ route('home') }}">
      <div class="logo-wrapper">
        <img src="{{ asset('assets/logo.jpg') }}" alt="Logo" class="main-logo default-logo">
        <img src="{{ asset('assets/sticky-logo.png') }}" alt="Sticky Logo" class="main-logo sticky-logo">
      </div>
    </a>

    {{-- HAMBURGER --}}
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav">
      <span class="navbar-toggler-icon"></span>
    </button>

    {{-- MENU --}}
    <div class="collapse navbar-collapse" id="mainNav">
      <ul class="navbar-nav mx-auto gap-1">
        <li class="nav-item">
          <a class="nav-link {{ $currentPage === 'home' ? 'active' : '' }}" href="{{ route('home') }}">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ $currentPage === 'home' ? '' : '' }}" href="{{ route('home') }}#about">About</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ $currentPage === 'services' ? 'active' : '' }}" href="{{ route('services') }}">Services</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ $currentPage === 'home' ? '' : '' }}" href="{{ route('home') }}#team">Our Team</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ $currentPage === 'contact' ? 'active' : '' }}" href="{{ route('contact') }}">Contact</a>
        </li>
      </ul>
      <!-- <a href="{{ route('home') }}#appointment" class="btn btn-appointment">
        Appointment <i class="fas fa-calendar-alt ms-1"></i>
      </a> -->
      <a href="#" onclick="openApptModal(); return false;" class="btn btn-appointment">
  Appointment <i class="fas fa-calendar-alt ms-1"></i>
</a>
    </div>

  </div>
</nav>