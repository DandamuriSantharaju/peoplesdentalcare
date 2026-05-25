@extends('layouts.admin')
@section('title', 'Appointments — Peoples Dental Care Admin')
@php $activePage = 'appointments'; @endphp

@section('content')

<div class="topbar">
  <h1>Appointments</h1>
  <a href="{{ route('admin.appointments.create') }}" class="btn-add">
    <i class="fas fa-plus"></i> New Appointment
  </a>
</div>

@if(session('success'))
  <div class="alert-success-custom">
    <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
  </div>
@endif

<div class="stat-cards">
  <div class="stat-card">
    <div class="stat-icon blue"><i class="fas fa-calendar-alt"></i></div>
    <div class="stat-info"><strong>{{ $total }}</strong><span>Total</span></div>
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

<div class="table-section">
  <div class="table-header">
    <h5>All Appointments</h5>
    <form method="GET" action="{{ route('admin.appointments') }}">
      <div class="filters-bar">
        <input type="text" name="search" class="filter-input"
               placeholder="Search name/phone/email..."
               value="{{ request('search') }}" style="width:190px;"/>
        <select name="status" class="filter-input">
          <option value="all">All Status</option>
          <option value="pending"   {{ request('status')=='pending'   ? 'selected' : '' }}>Pending</option>
          <option value="confirmed" {{ request('status')=='confirmed' ? 'selected' : '' }}>Confirmed</option>
          <option value="cancelled" {{ request('status')=='cancelled' ? 'selected' : '' }}>Cancelled</option>
        </select>
        <input type="date" name="date_from" class="filter-input" value="{{ request('date_from') }}"/>
        <input type="date" name="date_to"   class="filter-input" value="{{ request('date_to') }}"/>
        <input type="hidden" name="per_page" value="{{ $perPage }}"/>
        <button type="submit" class="btn-filter"><i class="fas fa-search me-1"></i>Filter</button>
        <a href="{{ route('admin.appointments') }}" class="btn-reset">Reset</a>
      </div>
    </form>
  </div>

  <div class="table-responsive">
    <table class="table">
      <thead>
        <tr>
          <th>#</th><th>Patient</th><th>Service</th>
          <th>Date & Time</th><th>Status</th>
          <th>Booked On</th><th>Actions</th>
        </tr>
      </thead>
      <tbody>
        @forelse($appointments as $appt)
        <tr>
          <td style="color:#7a9ab5;font-size:0.78rem;">{{ $appt->id }}</td>
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
            <span class="badge-status badge-{{ $appt->status }}">{{ ucfirst($appt->status) }}</span>
          </td>
          <td style="color:#7a9ab5;font-size:0.78rem;">
            {{ $appt->created_at->format('d M Y, h:i A') }}
          </td>
          <td>
            <div class="d-flex gap-1 flex-wrap">
              <a href="{{ route('admin.appointments.show', $appt->id) }}" class="btn-action btn-view" title="View"><i class="fas fa-eye"></i></a>
              <a href="{{ route('admin.appointments.edit', $appt->id) }}" class="btn-action btn-edit" title="Edit"><i class="fas fa-pen"></i></a>
              @if($appt->status !== 'confirmed')
                <a href="{{ route('admin.appointment.status', [$appt->id, 'confirmed']) }}" class="btn-action btn-confirm" title="Confirm"><i class="fas fa-check"></i></a>
              @endif
              @if($appt->status !== 'cancelled')
                <a href="{{ route('admin.appointment.status', [$appt->id, 'cancelled']) }}" class="btn-action btn-cancel-appt" title="Cancel"><i class="fas fa-ban"></i></a>
              @endif
              <form action="{{ route('admin.appointments.destroy', $appt->id) }}" method="POST"
                    style="display:inline;" onsubmit="return confirm('Delete this appointment?')">
                @csrf @method('DELETE')
                <button type="submit" class="btn-action btn-del" title="Delete"><i class="fas fa-trash"></i></button>
              </form>
            </div>
          </td>
        </tr>
        @empty
        <tr>
          <td colspan="7" class="text-center py-5" style="color:#7a9ab5;">
            <i class="fas fa-calendar-times fa-2x mb-3 d-block"></i>No appointments found.
          </td>
        </tr>
        @endforelse
      </tbody>
    </table>
  </div>

  <div class="pagination-bar">
    <div class="d-flex align-items-center gap-3">
      <span class="pagination-info">
        Showing {{ $appointments->firstItem() ?? 0 }} to {{ $appointments->lastItem() ?? 0 }}
        of {{ $appointments->total() }} appointments
      </span>
      <form method="GET" action="{{ route('admin.appointments') }}" id="perPageForm">
        <input type="hidden" name="search"    value="{{ request('search') }}"/>
        <input type="hidden" name="status"    value="{{ request('status') }}"/>
        <input type="hidden" name="date_from" value="{{ request('date_from') }}"/>
        <input type="hidden" name="date_to"   value="{{ request('date_to') }}"/>
        <select name="per_page" class="per-page-select" onchange="document.getElementById('perPageForm').submit()">
          <option value="10"  {{ $perPage==10  ? 'selected':'' }}>10 rows</option>
          <option value="20"  {{ $perPage==20  ? 'selected':'' }}>20 rows</option>
          <option value="50"  {{ $perPage==50  ? 'selected':'' }}>50 rows</option>
          <option value="100" {{ $perPage==100 ? 'selected':'' }}>100 rows</option>
        </select>
      </form>
    </div>
    {{ $appointments->links() }}
  </div>
</div>

@endsection