@extends('layouts.admin')
@section('title', $patient->name.' — Patient Detail')
@php $activePage = 'patients'; @endphp

@section('css')
<style>
  .btn-back{background:#f0f5fa;color:#033C67;border:1.5px solid #dce8f2;border-radius:8px;padding:9px 18px;font-size:0.84rem;font-weight:600;text-decoration:none;display:inline-flex;align-items:center;gap:7px;transition:all 0.2s ease;}
  .btn-back:hover{background:#033C67;color:#fff;border-color:#033C67;}
  .profile-card{background:#fff;border-radius:16px;box-shadow:0 4px 16px rgba(3,60,103,0.07);padding:28px;margin-bottom:24px;}
  .profile-header{display:flex;align-items:center;gap:24px;margin-bottom:28px;padding-bottom:24px;border-bottom:1px solid #edf3f8;}
  .profile-avatar{width:80px;height:80px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:2rem;font-weight:800;flex-shrink:0;}
  .avatar-male{background:#dbeafe;color:#1D84B5;}
  .avatar-female{background:#fce7f3;color:#db2777;}
  .avatar-other{background:#ede9fe;color:#7c3aed;}
  .profile-name{font-family:'Playfair Display',serif;font-size:1.5rem;font-weight:800;color:#033C67;margin:0 0 4px;}
  .profile-sub{color:#7a9ab5;font-size:0.84rem;}
  .info-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:20px;}
  .info-item label{font-size:0.72rem;font-weight:700;color:#7a9ab5;letter-spacing:0.5px;text-transform:uppercase;display:block;margin-bottom:4px;}
  .info-item span{font-size:0.88rem;color:#033C67;font-weight:600;}
  .notes-card{background:#fffbeb;border:1.5px solid #fef3c7;border-radius:12px;padding:18px;margin-top:20px;}
  .notes-card h6{font-size:0.78rem;font-weight:700;color:#ca8a04;text-transform:uppercase;letter-spacing:0.5px;margin-bottom:10px;}
  .notes-card p{font-size:0.86rem;color:#78350f;margin:0;line-height:1.6;}
  .mini-stats{display:grid;grid-template-columns:repeat(4,1fr);gap:16px;margin-bottom:24px;}
  .mini-stat{background:#fff;border-radius:12px;padding:16px 20px;box-shadow:0 4px 16px rgba(3,60,103,0.07);text-align:center;}
  .mini-stat strong{display:block;font-size:1.4rem;font-weight:800;color:#033C67;}
  .mini-stat span{font-size:0.75rem;color:#7a9ab5;font-weight:500;}
  @media(max-width:767px){.info-grid{grid-template-columns:1fr 1fr;}.mini-stats{grid-template-columns:1fr 1fr;}}
</style>
@endsection

@section('content')

<div class="topbar">
  <h1>Patient Detail</h1>
  <a href="{{ route('admin.patients') }}" class="btn-back"><i class="fas fa-arrow-left"></i> Back</a>
</div>

@php
  $totalVisits     = $patient->appointments->count();
  $completedVisits = $patient->appointments->where('status','completed')->count();
  $pendingVisits   = $patient->appointments->where('status','pending')->count();
  $lastVisit       = $patient->appointments->first();
@endphp

<div class="mini-stats">
  <div class="mini-stat"><strong>{{ $totalVisits }}</strong><span>Total Visits</span></div>
  <div class="mini-stat"><strong style="color:#16a34a;">{{ $completedVisits }}</strong><span>Completed</span></div>
  <div class="mini-stat"><strong style="color:#ca8a04;">{{ $pendingVisits }}</strong><span>Pending</span></div>
  <div class="mini-stat"><strong style="font-size:1rem;color:#1D84B5;">{{ $lastVisit ? \Carbon\Carbon::parse($lastVisit->date)->format('d M Y') : '—' }}</strong><span>Last Visit</span></div>
</div>

<div class="profile-card">
  <div class="profile-header">
    <div class="profile-avatar avatar-{{ $patient->gender ?? 'other' }}">{{ $patient->initial }}</div>
    <div>
      <h2 class="profile-name">{{ $patient->name }}</h2>
      <div class="profile-sub">
        Patient #{{ $patient->id }} &nbsp;·&nbsp;
        Registered {{ $patient->created_at->format('d M Y') }} &nbsp;·&nbsp;
        <span style="color:{{ $patient->status==='active' ? '#16a34a' : '#dc2626' }};font-weight:700;">{{ ucfirst($patient->status) }}</span>
      </div>
    </div>
  </div>
  <div class="info-grid">
    <div class="info-item"><label><i class="fas fa-phone me-1"></i> Phone</label><span>{{ $patient->phone ?? '—' }}</span></div>
    <div class="info-item"><label><i class="fas fa-envelope me-1"></i> Email</label><span>{{ $patient->email ?? '—' }}</span></div>
    <div class="info-item"><label><i class="fas fa-venus-mars me-1"></i> Gender</label><span>{{ $patient->gender ? ucfirst($patient->gender) : '—' }}</span></div>
    <div class="info-item"><label><i class="fas fa-birthday-cake me-1"></i> Date of Birth</label><span>{{ $patient->date_of_birth ? $patient->date_of_birth->format('d M Y') : '—' }}@if($patient->age) <small style="color:#7a9ab5;">({{ $patient->age }} yrs)</small>@endif</span></div>
    <div class="info-item"><label><i class="fas fa-tint me-1"></i> Blood Group</label><span style="color:#dc2626;font-size:1rem;">{{ $patient->blood_group ?? '—' }}</span></div>
    <div class="info-item"><label><i class="fas fa-map-marker-alt me-1"></i> Address</label><span>{{ $patient->address ?? '—' }}</span></div>
  </div>
  @if($patient->medical_notes)
  <div class="notes-card">
    <h6><i class="fas fa-notes-medical me-2"></i>Medical Notes</h6>
    <p>{{ $patient->medical_notes }}</p>
  </div>
  @endif
</div>

<div class="page-card">
  <div class="page-card-header">
    <h5><i class="fas fa-history me-2" style="color:#1D84B5"></i>Appointment History</h5>
    <span style="font-size:0.82rem;color:#7a9ab5;">{{ $totalVisits }} total visits</span>
  </div>
  <div class="table-responsive">
    <table class="table">
      <thead><tr><th>#</th><th>Date & Time</th><th>Service</th><th>Notes</th><th>Status</th><th>Booked On</th></tr></thead>
      <tbody>
        @forelse($patient->appointments as $appt)
        <tr>
          <td style="color:#7a9ab5;font-size:0.78rem;">{{ $appt->id }}</td>
          <td><div style="font-weight:600;color:#033C67;font-size:0.86rem;">{{ $appt->date ? \Carbon\Carbon::parse($appt->date)->format('d M Y') : '—' }}</div>@if($appt->time)<div style="font-size:0.76rem;color:#7a9ab5;">{{ $appt->time }}</div>@endif</td>
          <td style="font-size:0.84rem;">{{ $appt->service ?? '—' }}</td>
          <td style="font-size:0.83rem;color:#7a9ab5;max-width:200px;">{{ $appt->notes ? \Str::limit($appt->notes,60) : '—' }}</td>
          <td><span class="badge-status badge-{{ $appt->status }}">{{ ucfirst($appt->status) }}</span></td>
          <td style="font-size:0.78rem;color:#7a9ab5;">{{ $appt->created_at->format('d M Y') }}</td>
        </tr>
        @empty
        <tr><td colspan="6" class="text-center py-4" style="color:#7a9ab5;"><i class="fas fa-calendar-times fa-2x mb-2 d-block"></i>No appointments yet.</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>

@endsection