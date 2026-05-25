@extends('layouts.admin')
@section('title', 'Patients — Peoples Dental Care Admin')
@php $activePage = 'patients'; @endphp

@section('content')

<div class="topbar"><h1>Patients</h1></div>

@if(session('success'))
  <div class="alert-success-custom"><i class="fas fa-check-circle me-2"></i>{{ session('success') }}</div>
@endif
@if($errors->any())
  <div class="alert-error-custom"><i class="fas fa-exclamation-circle me-2"></i>{{ $errors->first() }}</div>
@endif

<div class="stat-cards">
  <div class="stat-card"><div class="stat-icon blue"><i class="fas fa-users"></i></div><div class="stat-info"><strong>{{ $total }}</strong><span>Total Patients</span></div></div>
  <div class="stat-card"><div class="stat-icon green"><i class="fas fa-check-circle"></i></div><div class="stat-info"><strong>{{ $active }}</strong><span>Active</span></div></div>
  <div class="stat-card"><div class="stat-icon red"><i class="fas fa-times-circle"></i></div><div class="stat-info"><strong>{{ $inactive }}</strong><span>Inactive</span></div></div>
  <div class="stat-card"><div class="stat-icon purple"><i class="fas fa-user-plus"></i></div><div class="stat-info"><strong>{{ $newThisMonth }}</strong><span>New This Month</span></div></div>
</div>

{{-- ADD PATIENT --}}
<div class="page-card">
  <div class="page-card-header">
    <h5><i class="fas fa-user-plus me-2" style="color:#1D84B5"></i>Add New Patient</h5>
  </div>
  <div class="page-card-body">
    <form action="{{ route('admin.patients.store') }}" method="POST">
      @csrf
      <div class="row g-3">
        <div class="col-md-4"><label class="form-label-custom">Full Name *</label><input type="text" name="name" class="form-control-custom" placeholder="Patient full name" required value="{{ old('name') }}"/></div>
        <div class="col-md-3"><label class="form-label-custom">Phone</label><input type="text" name="phone" class="form-control-custom" placeholder="Phone number" value="{{ old('phone') }}"/></div>
        <div class="col-md-3"><label class="form-label-custom">Email</label><input type="email" name="email" class="form-control-custom" placeholder="Email address" value="{{ old('email') }}"/></div>
        <div class="col-md-2"><label class="form-label-custom">Gender</label>
          <select name="gender" class="form-control-custom" style="cursor:pointer;">
            <option value="">— Select —</option>
            <option value="male"   {{ old('gender')==='male'   ? 'selected':'' }}>Male</option>
            <option value="female" {{ old('gender')==='female' ? 'selected':'' }}>Female</option>
            <option value="other"  {{ old('gender')==='other'  ? 'selected':'' }}>Other</option>
          </select>
        </div>
        <div class="col-md-2"><label class="form-label-custom">Date of Birth</label><input type="date" name="date_of_birth" class="form-control-custom" value="{{ old('date_of_birth') }}"/></div>
        <div class="col-md-2"><label class="form-label-custom">Blood Group</label>
          <select name="blood_group" class="form-control-custom" style="cursor:pointer;">
            <option value="">— Select —</option>
            @foreach(['A+','A-','B+','B-','O+','O-','AB+','AB-'] as $bg)
              <option value="{{ $bg }}" {{ old('blood_group')===$bg ? 'selected':'' }}>{{ $bg }}</option>
            @endforeach
          </select>
        </div>
        <div class="col-md-2"><label class="form-label-custom">Status</label>
          <select name="status" class="form-control-custom" style="cursor:pointer;">
            <option value="active">Active</option><option value="inactive">Inactive</option>
          </select>
        </div>
        <div class="col-md-6"><label class="form-label-custom">Address</label><input type="text" name="address" class="form-control-custom" placeholder="Address" value="{{ old('address') }}"/></div>
        <div class="col-12"><label class="form-label-custom">Medical Notes</label><textarea name="medical_notes" class="form-control-custom" placeholder="Allergies, conditions, observations...">{{ old('medical_notes') }}</textarea></div>
      </div>
      <div class="mt-3"><button type="submit" class="btn-primary-custom"><i class="fas fa-plus me-2"></i> Add Patient</button></div>
    </form>
  </div>
</div>

{{-- TABLE --}}
<div class="page-card">
  <div class="page-card-header">
    <h5><i class="fas fa-users me-2" style="color:#1D84B5"></i>All Patients</h5>
    <form method="GET" action="{{ route('admin.patients') }}">
      <div class="filters-bar">
        <input type="text" name="search" class="filter-input" placeholder="Search name / phone / email..." value="{{ request('search') }}" style="width:200px;"/>
        <select name="gender" class="filter-input">
          <option value="all">All Gender</option>
          <option value="male"   {{ request('gender')==='male'   ? 'selected':'' }}>Male</option>
          <option value="female" {{ request('gender')==='female' ? 'selected':'' }}>Female</option>
          <option value="other"  {{ request('gender')==='other'  ? 'selected':'' }}>Other</option>
        </select>
        <select name="status" class="filter-input">
          <option value="all">All Status</option>
          <option value="active"   {{ request('status')==='active'   ? 'selected':'' }}>Active</option>
          <option value="inactive" {{ request('status')==='inactive' ? 'selected':'' }}>Inactive</option>
        </select>
        <input type="hidden" name="per_page" value="{{ $perPage }}"/>
        <button type="submit" class="btn-filter"><i class="fas fa-search me-1"></i>Filter</button>
        <a href="{{ route('admin.patients') }}" class="btn-reset">Reset</a>
      </div>
    </form>
  </div>
  <div class="table-responsive">
    <table class="table">
      <thead><tr><th>#</th><th>Patient</th><th>Gender</th><th>Age</th><th>Blood</th><th>Contact</th><th>Appointments</th><th>Status</th><th>Actions</th></tr></thead>
      <tbody>
        @forelse($patients as $patient)
        <tr>
          <td style="color:#7a9ab5;font-size:0.78rem;">{{ $patient->id }}</td>
          <td>
            <div class="d-flex align-items-center gap-3">
              <div class="user-avatar avatar-{{ $patient->gender === 'female' ? 'pink' : ($patient->gender === 'male' ? 'blue' : 'purple') }}">{{ $patient->initial }}</div>
              <div><div class="user-name">{{ $patient->name }}</div>@if($patient->address)<div class="user-sub">{{ $patient->address }}</div>@endif</div>
            </div>
          </td>
          <td>@if($patient->gender)<span class="badge-status badge-{{ $patient->gender === 'female' ? 'cancelled' : ($patient->gender === 'male' ? 'confirmed' : 'pending') }}" style="background:{{ $patient->gender === 'female' ? '#fce7f3' : ($patient->gender === 'male' ? '#dbeafe' : '#ede9fe') }};color:{{ $patient->gender === 'female' ? '#db2777' : ($patient->gender === 'male' ? '#1D84B5' : '#7c3aed') }}">{{ ucfirst($patient->gender) }}</span>@else <span style="color:#7a9ab5;">—</span>@endif</td>
          <td style="font-size:0.84rem;">{{ $patient->age !== null ? $patient->age.' yrs' : '—' }}</td>
          <td>@if($patient->blood_group)<span style="font-size:0.82rem;font-weight:700;color:#dc2626;">{{ $patient->blood_group }}</span>@else <span style="color:#7a9ab5;">—</span>@endif</td>
          <td>
            @if($patient->phone)<div style="font-size:0.82rem;color:#033C67;font-weight:600;"><i class="fas fa-phone" style="font-size:0.68rem;color:#7a9ab5;margin-right:4px;"></i>{{ $patient->phone }}</div>@endif
            @if($patient->email)<div style="font-size:0.76rem;color:#7a9ab5;"><i class="fas fa-envelope" style="font-size:0.66rem;margin-right:4px;"></i>{{ $patient->email }}</div>@endif
            @if(!$patient->phone && !$patient->email)<span style="color:#7a9ab5;">—</span>@endif
          </td>
          <td><span style="font-size:0.84rem;font-weight:700;color:#033C67;">{{ $patient->appointments_count }}</span> <span style="font-size:0.74rem;color:#7a9ab5;">visits</span></td>
          <td><span class="badge-{{ $patient->status }}">{{ ucfirst($patient->status) }}</span></td>
          <td>
            <div class="d-flex gap-1">
              <a href="{{ route('admin.patients.show', $patient->id) }}" class="btn-action btn-view" title="View"><i class="fas fa-eye"></i></a>
              <button class="btn-action btn-edit" title="Edit"
                      onclick="openEditModal({{ $patient->id }},'{{ addslashes($patient->name) }}','{{ addslashes($patient->phone) }}','{{ addslashes($patient->email) }}','{{ addslashes($patient->address) }}','{{ $patient->gender }}','{{ $patient->date_of_birth ? $patient->date_of_birth->format("Y-m-d") : "" }}','{{ addslashes($patient->blood_group) }}','{{ addslashes($patient->medical_notes) }}','{{ $patient->status }}')">
                <i class="fas fa-pen"></i>
              </button>
              <a href="{{ route('admin.patients.toggle', $patient->id) }}" class="btn-action {{ $patient->status==='active' ? 'btn-toggle-on' : 'btn-toggle-off' }}"><i class="fas {{ $patient->status==='active' ? 'fa-toggle-on' : 'fa-toggle-off' }}"></i></a>
              <form action="{{ route('admin.patients.destroy', $patient->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Delete this patient?')">
                @csrf @method('DELETE')
                <button type="submit" class="btn-action btn-del"><i class="fas fa-trash"></i></button>
              </form>
            </div>
          </td>
        </tr>
        @empty
        <tr><td colspan="9" class="text-center py-5" style="color:#7a9ab5;"><i class="fas fa-users fa-2x mb-3 d-block"></i>No patients found.</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
  <div class="pagination-bar">
    <div class="d-flex align-items-center gap-3">
      <span class="pagination-info">Showing {{ $patients->firstItem() ?? 0 }} to {{ $patients->lastItem() ?? 0 }} of {{ $patients->total() }} patients</span>
      <form method="GET" action="{{ route('admin.patients') }}" id="perPageForm">
        <input type="hidden" name="search" value="{{ request('search') }}"/>
        <input type="hidden" name="gender" value="{{ request('gender') }}"/>
        <input type="hidden" name="status" value="{{ request('status') }}"/>
        <select name="per_page" class="per-page-select" onchange="document.getElementById('perPageForm').submit()">
          <option value="10" {{ $perPage==10 ? 'selected':'' }}>10 rows</option>
          <option value="20" {{ $perPage==20 ? 'selected':'' }}>20 rows</option>
          <option value="50" {{ $perPage==50 ? 'selected':'' }}>50 rows</option>
          <option value="100" {{ $perPage==100 ? 'selected':'' }}>100 rows</option>
        </select>
      </form>
    </div>
    {{ $patients->links() }}
  </div>
</div>

{{-- EDIT MODAL --}}
<div class="modal-overlay" id="editModalOverlay">
  <div class="modal-box">
    <button class="modal-close" onclick="closeModal('editModalOverlay')"><i class="fas fa-times"></i></button>
    <h5 class="modal-title"><i class="fas fa-pen me-2" style="color:#1D84B5;"></i>Edit Patient</h5>
    <form id="editForm" method="POST">
      @csrf @method('PUT')
      <div class="row g-3">
        <div class="col-md-6"><label class="form-label-custom">Full Name *</label><input type="text" name="name" id="editName" class="form-control-custom" required/></div>
        <div class="col-md-3"><label class="form-label-custom">Phone</label><input type="text" name="phone" id="editPhone" class="form-control-custom"/></div>
        <div class="col-md-3"><label class="form-label-custom">Email</label><input type="email" name="email" id="editEmail" class="form-control-custom"/></div>
        <div class="col-md-3"><label class="form-label-custom">Gender</label>
          <select name="gender" id="editGender" class="form-control-custom" style="cursor:pointer;">
            <option value="">— Select —</option><option value="male">Male</option><option value="female">Female</option><option value="other">Other</option>
          </select>
        </div>
        <div class="col-md-3"><label class="form-label-custom">Date of Birth</label><input type="date" name="date_of_birth" id="editDOB" class="form-control-custom"/></div>
        <div class="col-md-3"><label class="form-label-custom">Blood Group</label>
          <select name="blood_group" id="editBlood" class="form-control-custom" style="cursor:pointer;">
            <option value="">— Select —</option>
            @foreach(['A+','A-','B+','B-','O+','O-','AB+','AB-'] as $bg)<option value="{{ $bg }}">{{ $bg }}</option>@endforeach
          </select>
        </div>
        <div class="col-md-3"><label class="form-label-custom">Status</label>
          <select name="status" id="editStatus" class="form-control-custom" style="cursor:pointer;">
            <option value="active">Active</option><option value="inactive">Inactive</option>
          </select>
        </div>
        <div class="col-12"><label class="form-label-custom">Address</label><input type="text" name="address" id="editAddress" class="form-control-custom"/></div>
        <div class="col-12"><label class="form-label-custom">Medical Notes</label><textarea name="medical_notes" id="editNotes" class="form-control-custom"></textarea></div>
      </div>
      <div class="mt-4"><button type="submit" class="btn-primary-custom w-100"><i class="fas fa-save me-2"></i> Save Changes</button></div>
    </form>
  </div>
</div>

@endsection

@section('js')
<script>
function openEditModal(id,name,phone,email,address,gender,dob,blood,notes,status){
  document.getElementById('editName').value    = name;
  document.getElementById('editPhone').value   = phone;
  document.getElementById('editEmail').value   = email;
  document.getElementById('editAddress').value = address;
  document.getElementById('editGender').value  = gender;
  document.getElementById('editDOB').value     = dob;
  document.getElementById('editBlood').value   = blood;
  document.getElementById('editNotes').value   = notes;
  document.getElementById('editStatus').value  = status;
  document.getElementById('editForm').action   = '/admin/patients/' + id;
  openModal('editModalOverlay');
}
</script>
@endsection