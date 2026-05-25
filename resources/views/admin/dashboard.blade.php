@extends('layouts.admin')

@section('title', 'Dashboard — Peoples Dental Care Admin')

@php $activePage = 'dashboard'; @endphp

@section('content')

  {{-- TOP BAR --}}
  <div class="topbar">
    <h1>Dashboard</h1>
    <span class="badge-date">
      <i class="fas fa-calendar me-2"></i>{{ now()->format('D, d M Y') }}
    </span>
  </div>

  @if(session('success'))
    <div class="alert-success-custom">
      <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
    </div>
  @endif

  {{-- STAT CARDS --}}
  <div class="stat-cards">
    <div class="stat-card">
      <div class="stat-icon blue"><i class="fas fa-calendar-alt"></i></div>
      <div class="stat-info"><strong>{{ $total }}</strong><span>Total Appointments</span></div>
    </div>
    <div class="stat-card">
      <div class="stat-icon yellow"><i class="fas fa-clock"></i></div>
      <div class="stat-info"><strong>{{ $pending }}</strong><span>Pending</span></div>
    </div>
    <div class="stat-card">
      <div class="stat-icon green"><i class="fas fa-check-circle"></i></div>
      <div class="stat-info"><strong>{{ $confirmed }}</strong><span>Confirmed</span></div>
    </div>
    <div class="stat-card">
      <div class="stat-icon red"><i class="fas fa-times-circle"></i></div>
      <div class="stat-info"><strong>{{ $cancelled }}</strong><span>Cancelled</span></div>
    </div>
  </div>

  {{-- APPOINTMENTS TABLE --}}
  <div class="table-section">
    <div class="table-header">
      <!-- <h5>All Appointments</h5> -->
       <h5>Today's Appointments <small style="font-size:0.75rem;color:#7a9ab5;font-family:'DM Sans',sans-serif;font-weight:500;">— {{ now()->format('d M Y') }}</small></h5>
      <div class="d-flex gap-3 align-items-center flex-wrap">
        <div class="filter-tabs">
          <button class="filter-tab active" onclick="filterTable('all',this)">All</button>
          <button class="filter-tab" onclick="filterTable('pending',this)">Pending</button>
          <button class="filter-tab" onclick="filterTable('confirmed',this)">Confirmed</button>
          <button class="filter-tab" onclick="filterTable('cancelled',this)">Cancelled</button>
        </div>
        <div class="search-box">
          <i class="fas fa-search"></i>
          <input type="text" id="searchInput" placeholder="Search patient..."/>
        </div>
      </div>
    </div>
    <div class="table-responsive">
      <table class="table" id="apptTable">
        <thead>
          <tr>
            <th>#</th><th>Patient</th><th>Service</th>
            <th>Date & Time</th><th>Status</th>
            <th>Booked On</th><th>Actions</th>
          </tr>
        </thead>
        <tbody>
          @forelse($appointments as $appt)
          <tr data-status="{{ $appt->status }}">
            <td style="color:#7a9ab5;font-size:0.80rem;">{{ $appt->id }}</td>
            <td>
              <div class="user-name">{{ $appt->name }}</div>
              <div class="user-sub">{{ $appt->phone }}</div>
              @if($appt->email)<div class="user-sub">{{ $appt->email }}</div>@endif
            </td>
            <td>{{ $appt->service ?? '—' }}</td>
            <td>
              {{ $appt->date ? \Carbon\Carbon::parse($appt->date)->format('d M Y') : '—' }}
              @if($appt->time)<br><small style="color:#7a9ab5;">{{ $appt->time }}</small>@endif
            </td>
            <td>
              <span class="badge-status badge-{{ $appt->status }}">
                {{ ucfirst($appt->status) }}
              </span>
            </td>
            <td style="color:#7a9ab5;font-size:0.80rem;">
              {{ $appt->created_at->format('d M Y, h:i A') }}
            </td>
            <td>
              <div class="d-flex gap-1">
                @if($appt->status !== 'confirmed')
                  <a href="{{ route('admin.appointment.status', [$appt->id, 'confirmed']) }}"
                     class="btn-action btn-confirm" title="Confirm">
                    <i class="fas fa-check"></i>
                  </a>
                @endif
                @if($appt->status !== 'cancelled')
                  <a href="{{ route('admin.appointment.status', [$appt->id, 'cancelled']) }}"
                     class="btn-action btn-cancel-appt" title="Cancel">
                    <i class="fas fa-ban"></i>
                  </a>
                @endif
                <form action="{{ route('admin.appointments.destroy', $appt->id) }}"
                      method="POST" style="display:inline;"
                      onsubmit="return confirm('Delete this appointment?')">
                  @csrf @method('DELETE')
                  <button type="submit" class="btn-action btn-del" title="Delete">
                    <i class="fas fa-trash"></i>
                  </button>
                </form>
              </div>
            </td>
          </tr>
          @empty
          <tr>
            <td colspan="7" class="text-center py-5" style="color:#7a9ab5;">
              <i class="fas fa-calendar-times fa-2x mb-3 d-block"></i>
              No appointments scheduled for today.
            </td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>

@endsection