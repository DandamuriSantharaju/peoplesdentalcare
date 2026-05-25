{{-- ADMIN SIDEBAR COMPONENT --}}
{{-- Usage: @include('admin.partials.sidebar', ['activePage' => 'dashboard']) --}}

<!-- Mobile Toggle Button -->
<button class="sidebar-toggle" id="sidebarToggle">
  <i class="fas fa-bars"></i>
</button>

<!-- Sidebar Overlay (mobile) -->
<div class="sidebar-overlay" id="sidebarOverlay"></div>

<!-- Sidebar -->
<aside class="sidebar" id="sidebar">
  <div class="sidebar-logo">
    <h4>Peoples Dental Care</h4>
    <span>Admin Panel</span>
  </div>

  <nav class="sidebar-nav">
    <a class="nav-item-admin {{ ($activePage ?? '') === 'dashboard'   ? 'active' : '' }}"
       href="{{ route('admin.dashboard') }}">
      <i class="fas fa-th-large"></i> Dashboard
    </a>
    <a class="nav-item-admin {{ ($activePage ?? '') === 'appointments' ? 'active' : '' }}"
       href="{{ route('admin.appointments') }}">
      <i class="fas fa-calendar-check"></i> Appointments
    </a>
    <a class="nav-item-admin {{ ($activePage ?? '') === 'patients'    ? 'active' : '' }}"
       href="{{ route('admin.patients') }}">
      <i class="fas fa-user-injured"></i> Patients
    </a>
    <a class="nav-item-admin {{ ($activePage ?? '') === 'doctors'     ? 'active' : '' }}"
       href="{{ route('admin.doctors') }}">
      <i class="fas fa-user-md"></i> Doctors / Staff
    </a>
    <a class="nav-item-admin {{ ($activePage ?? '') === 'users'       ? 'active' : '' }}"
       href="{{ route('admin.users') }}">
      <i class="fas fa-users-cog"></i> Admin Users
    </a>
    <a class="nav-item-admin {{ ($activePage ?? '') === 'password'    ? 'active' : '' }}"
       href="{{ route('admin.change.password') }}">
      <i class="fas fa-key"></i> Change Password
    </a>
    <a class="nav-item-admin" href="{{ route('home') }}" target="_blank">
      <i class="fas fa-globe"></i> View Website
    </a>
  </nav>

  <div class="sidebar-footer">
    <div class="admin-badge">
      <div class="admin-avatar">
        <i class="fas fa-user-shield"></i>
      </div>
      <div class="admin-info">
        <span>{{ Auth::guard('admin')->user()->name }}</span>
        <small>{{ Auth::guard('admin')->user()->email }}</small>
      </div>
    </div>
    <form action="{{ route('admin.logout') }}" method="POST">
      @csrf
      <button type="submit" class="btn-logout">
        <i class="fas fa-sign-out-alt me-2"></i> Logout
      </button>
    </form>
  </div>
</aside>