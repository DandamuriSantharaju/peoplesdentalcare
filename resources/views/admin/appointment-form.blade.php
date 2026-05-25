@extends('layouts.admin')
@section('title', ($appointment ? 'Edit' : 'New').' Appointment — Admin')
@php $activePage = 'appointments'; @endphp

@section('css')
<style>
  .btn-back{background:#f0f5fa;color:#7a9ab5;border:1.5px solid #dce8f2;border-radius:8px;padding:10px 20px;font-size:0.85rem;font-weight:600;text-decoration:none;display:inline-flex;align-items:center;gap:7px;}
  .btn-back:hover{background:#dce8f2;color:#033C67;}
</style>
@endsection

@section('content')

<div class="topbar">
  <h1>{{ $appointment ? 'Edit Appointment' : 'New Appointment' }}</h1>
  <a href="{{ route('admin.appointments') }}" class="btn-back">
    <i class="fas fa-arrow-left"></i> Back
  </a>
</div>

@if($errors->any())
  <div class="alert-error-custom">
    <i class="fas fa-exclamation-circle me-2"></i>{{ $errors->first() }}
  </div>
@endif

<div class="page-card">
  <div class="page-card-header">
    <h5>
      <i class="fas fa-{{ $appointment ? 'pen' : 'plus' }} me-2" style="color:#1D84B5"></i>
      {{ $appointment ? 'Update Patient Details' : 'Add New Appointment' }}
    </h5>
  </div>
  <div class="page-card-body">
    <form action="{{ $appointment
          ? route('admin.appointments.update', $appointment->id)
          : route('admin.appointments.store') }}"
          method="POST">
      @csrf
      @if($appointment) @method('PUT') @endif

      <div class="row g-3">
        <div class="col-md-4">
          <label class="form-label-custom">Full Name *</label>
          <input type="text" name="name" class="form-control-custom"
                 placeholder="Patient full name" required
                 value="{{ old('name', $appointment->name ?? '') }}"/>
        </div>
        <div class="col-md-4">
          <label class="form-label-custom">Phone *</label>
          <input type="text" name="phone" class="form-control-custom"
                 placeholder="Phone number" required
                 value="{{ old('phone', $appointment->phone ?? '') }}"/>
        </div>
        <div class="col-md-4">
          <label class="form-label-custom">Email</label>
          <input type="email" name="email" class="form-control-custom"
                 placeholder="Email address"
                 value="{{ old('email', $appointment->email ?? '') }}"/>
        </div>
        <div class="col-md-8">
          <label class="form-label-custom">Address</label>
          <input type="text" name="address" class="form-control-custom"
                 placeholder="Patient address"
                 value="{{ old('address', $appointment->address ?? '') }}"/>
        </div>
        <div class="col-md-4">
          <label class="form-label-custom">Service</label>
          <select name="service" class="form-control-custom" style="cursor:pointer;">
            <option value="">— Select Service —</option>
            @foreach(['General Checkup','Teeth Cleaning','Tooth Extraction','Root Canal','Dental Implants','Teeth Whitening','Braces / Orthodontics','Other'] as $svc)
              <option value="{{ $svc }}"
                {{ old('service', $appointment->service ?? '') === $svc ? 'selected' : '' }}>
                {{ $svc }}
              </option>
            @endforeach
          </select>
        </div>
        <div class="col-md-3">
          <label class="form-label-custom">Date</label>
          <input type="date" name="date" class="form-control-custom"
                 value="{{ old('date', $appointment->date ?? '') }}"/>
        </div>
        <div class="col-md-3">
          <label class="form-label-custom">Time</label>
          <input type="time" name="time" class="form-control-custom"
                 value="{{ old('time', $appointment->time ?? '') }}"/>
        </div>
        <div class="col-md-3">
          <label class="form-label-custom">Status</label>
          <select name="status" class="form-control-custom" style="cursor:pointer;">
            <option value="pending"   {{ old('status', $appointment->status ?? 'pending') === 'pending'   ? 'selected':'' }}>Pending</option>
            <option value="confirmed" {{ old('status', $appointment->status ?? '') === 'confirmed' ? 'selected':'' }}>Confirmed</option>
            <option value="cancelled" {{ old('status', $appointment->status ?? '') === 'cancelled' ? 'selected':'' }}>Cancelled</option>
          </select>
        </div>
        <div class="col-12">
          <label class="form-label-custom">Patient Problem / Notes</label>
          <textarea name="notes" class="form-control-custom" rows="4"
                    placeholder="Describe the patient's problem...">{{ old('notes', $appointment->notes ?? '') }}</textarea>
        </div>
      </div>

      <div class="mt-4 d-flex gap-3">
        <button type="submit" class="btn-primary-custom">
          <i class="fas fa-save me-2"></i>
          {{ $appointment ? 'Update Appointment' : 'Create Appointment' }}
        </button>
        <a href="{{ route('admin.appointments') }}" class="btn-back">Cancel</a>
      </div>
    </form>
  </div>
</div>

@endsection