@extends('layouts.admin')
@section('title', 'View Appointment — Admin')
@php $activePage = 'appointments'; @endphp

@section('css')
<style>
  .detail-card{background:#fff;border-radius:16px;box-shadow:0 4px 16px rgba(3,60,103,0.07);overflow:hidden;}
  .detail-header{padding:28px;background:linear-gradient(135deg,#033C67,#1D84B5);display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:16px;}
  .patient-avatar-lg{width:64px;height:64px;border-radius:50%;background:rgba(255,255,255,0.15);display:flex;align-items:center;justify-content:center;font-size:1.8rem;color:#7DD3F8;flex-shrink:0;}
  .patient-header-info h2{font-family:'Playfair Display',serif;font-size:1.5rem;margin:0;color:#fff;}
  .patient-header-info p{color:rgba(255,255,255,0.70);margin:4px 0 0;font-size:0.85rem;}
  .badge-status-lg{padding:7px 18px;border-radius:20px;font-size:0.82rem;font-weight:700;}
  .badge-pending-lg{background:rgba(254,249,195,0.25);color:#fef9c3;border:1.5px solid rgba(254,249,195,0.40);}
  .badge-confirmed-lg{background:rgba(220,252,231,0.25);color:#86efac;border:1.5px solid rgba(220,252,231,0.40);}
  .badge-cancelled-lg{background:rgba(254,226,226,0.25);color:#fca5a5;border:1.5px solid rgba(254,226,226,0.40);}
  .detail-body{padding:28px;}
  .detail-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:20px;margin-bottom:24px;}
  .detail-item{background:#f8fbfe;border-radius:12px;padding:16px 18px;border:1.5px solid #edf3f8;}
  .detail-label{font-size:0.72rem;font-weight:700;color:#7a9ab5;text-transform:uppercase;letter-spacing:0.5px;margin-bottom:6px;}
  .detail-value{font-size:0.92rem;font-weight:600;color:#033C67;}
  .detail-value.muted{color:#7a9ab5;font-weight:400;}
  .notes-box{background:#f8fbfe;border-radius:12px;padding:20px;border:1.5px solid #edf3f8;}
  .notes-text{font-size:0.90rem;color:#1a2a3a;line-height:1.7;white-space:pre-wrap;}
  .action-bar{display:flex;gap:10px;flex-wrap:wrap;margin-top:24px;padding-top:20px;border-top:1px solid #edf3f8;}
  .btn-back{background:#f0f5fa;color:#7a9ab5;border:1.5px solid #dce8f2;border-radius:8px;padding:10px 20px;font-size:0.85rem;font-weight:600;text-decoration:none;display:inline-flex;align-items:center;gap:7px;}
  .btn-back:hover{background:#dce8f2;color:#033C67;}
  .btn-edit-full{background:linear-gradient(135deg,#033C67,#1D84B5);color:#fff;border:none;border-radius:8px;padding:10px 22px;font-size:0.85rem;font-weight:700;text-decoration:none;display:inline-flex;align-items:center;gap:7px;}
  .btn-edit-full:hover{color:#fff;opacity:0.9;}
  @media(max-width:991px){.detail-grid{grid-template-columns:repeat(2,1fr);}}
  @media(max-width:767px){.detail-grid{grid-template-columns:1fr;}}
</style>
@endsection

@section('content')

<div class="topbar">
  <h1>Appointment Details</h1>
  <a href="{{ route('admin.appointments') }}" class="btn-back">
    <i class="fas fa-arrow-left"></i> Back
  </a>
</div>

<div class="detail-card">
  <div class="detail-header">
    <div class="d-flex align-items-center gap-3">
      <div class="patient-avatar-lg"><i class="fas fa-user"></i></div>
      <div class="patient-header-info">
        <h2>{{ $appointment->name }}</h2>
        <p>
          <i class="fas fa-phone me-2"></i>{{ $appointment->phone }}
          @if($appointment->email)
            &nbsp;·&nbsp; <i class="fas fa-envelope me-2"></i>{{ $appointment->email }}
          @endif
        </p>
      </div>
    </div>
    <span class="badge-status-lg badge-{{ $appointment->status }}-lg">
      {{ ucfirst($appointment->status) }}
    </span>
  </div>

  <div class="detail-body">
    <div class="detail-grid">
      <div class="detail-item">
        <div class="detail-label"><i class="fas fa-tooth me-1"></i> Service</div>
        <div class="detail-value {{ $appointment->service ? '' : 'muted' }}">
          {{ $appointment->service ?? 'Not specified' }}
        </div>
      </div>
      <div class="detail-item">
        <div class="detail-label"><i class="fas fa-calendar me-1"></i> Appointment Date</div>
        <div class="detail-value {{ $appointment->date ? '' : 'muted' }}">
          {{ $appointment->date ? \Carbon\Carbon::parse($appointment->date)->format('d M Y, l') : 'Not set' }}
        </div>
      </div>
      <div class="detail-item">
        <div class="detail-label"><i class="fas fa-clock me-1"></i> Time</div>
        <div class="detail-value {{ $appointment->time ? '' : 'muted' }}">
          {{ $appointment->time ?? 'Not set' }}
        </div>
      </div>
      <div class="detail-item">
        <div class="detail-label"><i class="fas fa-map-marker-alt me-1"></i> Address</div>
        <div class="detail-value {{ $appointment->address ? '' : 'muted' }}">
          {{ $appointment->address ?? 'Not provided' }}
        </div>
      </div>
      <div class="detail-item">
        <div class="detail-label"><i class="fas fa-calendar-plus me-1"></i> Booked On</div>
        <div class="detail-value">{{ $appointment->created_at->format('d M Y, h:i A') }}</div>
      </div>
      <div class="detail-item">
        <div class="detail-label"><i class="fas fa-hashtag me-1"></i> Appointment ID</div>
        <div class="detail-value">#{{ $appointment->id }}</div>
      </div>
    </div>

    <div class="notes-box">
      <div class="detail-label"><i class="fas fa-notes-medical me-1"></i> Patient Problem / Notes</div>
      @if($appointment->notes)
        <div class="notes-text">{{ $appointment->notes }}</div>
      @else
        <div class="detail-value muted">No notes provided.</div>
      @endif
    </div>

    <div class="action-bar">
      <a href="{{ route('admin.appointments.edit', $appointment->id) }}" class="btn-edit-full">
        <i class="fas fa-pen"></i> Edit Appointment
      </a>
      @if($appointment->status !== 'confirmed')
        <a href="{{ route('admin.appointment.status', [$appointment->id, 'confirmed']) }}"
           class="btn-back" style="color:#16a34a;border-color:#bbf7d0;background:#dcfce7;">
          <i class="fas fa-check"></i> Confirm
        </a>
      @endif
      @if($appointment->status !== 'cancelled')
        <a href="{{ route('admin.appointment.status', [$appointment->id, 'cancelled']) }}"
           class="btn-back" style="color:#ca8a04;border-color:#fde68a;background:#fef9c3;">
          <i class="fas fa-ban"></i> Cancel
        </a>
      @endif
      <a href="{{ route('admin.appointments') }}" class="btn-back">
        <i class="fas fa-arrow-left"></i> Back to List
      </a>
    </div>
  </div>
</div>

@endsection