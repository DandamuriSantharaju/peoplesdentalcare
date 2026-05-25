@extends('layouts.admin')
@section('title', 'Doctors — Peoples Dental Care Admin')
@php $activePage = 'doctors'; @endphp

@section('content')

<div class="topbar"><h1>Doctors / Staff</h1></div>

@if(session('success'))
  <div class="alert-success-custom"><i class="fas fa-check-circle me-2"></i>{{ session('success') }}</div>
@endif
@if($errors->any())
  <div class="alert-error-custom"><i class="fas fa-exclamation-circle me-2"></i>{{ $errors->first() }}</div>
@endif

<div class="stat-cards" style="grid-template-columns:repeat(3,1fr);">
  <div class="stat-card"><div class="stat-icon blue"><i class="fas fa-user-md"></i></div><div class="stat-info"><strong>{{ $total }}</strong><span>Total Staff</span></div></div>
  <div class="stat-card"><div class="stat-icon green"><i class="fas fa-check-circle"></i></div><div class="stat-info"><strong>{{ $active }}</strong><span>Active</span></div></div>
  <div class="stat-card"><div class="stat-icon red"><i class="fas fa-times-circle"></i></div><div class="stat-info"><strong>{{ $inactive }}</strong><span>Inactive</span></div></div>
</div>

<div class="page-card">
  <div class="page-card-header">
    <h5><i class="fas fa-user-plus me-2" style="color:#1D84B5"></i>Add New Doctor / Staff</h5>
  </div>
  <div class="page-card-body">
    <form action="{{ route('admin.doctors.store') }}" method="POST" enctype="multipart/form-data">
      @csrf
      <div class="row g-3">
        <div class="col-md-3"><label class="form-label-custom">Full Name *</label><input type="text" name="name" class="form-control-custom" placeholder="Dr. Full Name" required value="{{ old('name') }}"/></div>
        <div class="col-md-3"><label class="form-label-custom">Specialization</label>
          <select name="specialization" class="form-control-custom" style="cursor:pointer;">
            <option value="">— Select —</option>
            @foreach(['General Dentist','Orthodontist','Periodontist','Endodontist','Oral Surgeon','Pediatric Dentist','Prosthodontist','Dental Hygienist','Receptionist','Assistant'] as $spec)
              <option value="{{ $spec }}" {{ old('specialization')===$spec?'selected':'' }}>{{ $spec }}</option>
            @endforeach
          </select>
        </div>
        <div class="col-md-3"><label class="form-label-custom">Phone</label><input type="text" name="phone" class="form-control-custom" placeholder="Phone number" value="{{ old('phone') }}"/></div>
        <div class="col-md-3"><label class="form-label-custom">Email</label><input type="email" name="email" class="form-control-custom" placeholder="Email address" value="{{ old('email') }}"/></div>
        <div class="col-md-4"><label class="form-label-custom">Qualification</label><input type="text" name="qualification" class="form-control-custom" placeholder="e.g. BDS, MDS" value="{{ old('qualification') }}"/></div>
        <div class="col-md-2"><label class="form-label-custom">Experience (Yrs)</label><input type="number" name="experience_years" class="form-control-custom" placeholder="0" min="0" max="60" value="{{ old('experience_years') }}"/></div>
        <div class="col-md-3"><label class="form-label-custom">Status</label><select name="status" class="form-control-custom" style="cursor:pointer;"><option value="active">Active</option><option value="inactive">Inactive</option></select></div>
        <div class="col-md-3"><label class="form-label-custom">Photo</label><input type="file" name="photo" class="form-control-custom" accept="image/*" style="padding:7px 13px;"/></div>
        <div class="col-md-6"><label class="form-label-custom">Address</label><input type="text" name="address" class="form-control-custom" placeholder="Address" value="{{ old('address') }}"/></div>
        <div class="col-md-6"><label class="form-label-custom">Bio / About</label><textarea name="bio" class="form-control-custom" placeholder="Short bio..." style="min-height:42px;">{{ old('bio') }}</textarea></div>
      </div>
      <div class="mt-3"><button type="submit" class="btn-primary-custom"><i class="fas fa-plus me-2"></i> Add Doctor</button></div>
    </form>
  </div>
</div>

<div class="page-card">
  <div class="page-card-header">
    <h5><i class="fas fa-users me-2" style="color:#1D84B5"></i>All Doctors & Staff</h5>
    <span style="font-size:0.82rem;color:#7a9ab5;">{{ $total }} total</span>
  </div>
  <div class="table-responsive">
    <table class="table">
      <thead><tr><th>#</th><th>Doctor</th><th>Specialization</th><th>Qualification</th><th>Experience</th><th>Contact</th><th>Status</th><th>Actions</th></tr></thead>
      <tbody>
        @forelse($doctors as $doctor)
        <tr>
          <td style="color:#7a9ab5;font-size:0.78rem;">{{ $doctor->id }}</td>
          <td>
            <div class="d-flex align-items-center gap-3">
              @if($doctor->photo)
                <img src="{{ asset('storage/'.$doctor->photo) }}" style="width:44px;height:44px;border-radius:50%;object-fit:cover;border:2px solid #dce8f2;" alt="{{ $doctor->name }}"/>
              @else
                <div class="user-avatar avatar-blue">{{ strtoupper(substr($doctor->name,0,1)) }}</div>
              @endif
              <div><div class="user-name">{{ $doctor->name }}</div>@if($doctor->bio)<div class="user-sub" style="max-width:180px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;">{{ $doctor->bio }}</div>@endif</div>
            </div>
          </td>
          <td style="font-size:0.84rem;">{{ $doctor->specialization ?? '—' }}</td>
          <td style="font-size:0.84rem;">{{ $doctor->qualification ?? '—' }}</td>
          <td style="font-size:0.84rem;">{{ $doctor->experience_years !== null ? $doctor->experience_years.' yrs' : '—' }}</td>
          <td>
            @if($doctor->phone)<div style="font-size:0.82rem;color:#033C67;font-weight:600;"><i class="fas fa-phone" style="font-size:0.70rem;color:#7a9ab5;margin-right:4px;"></i>{{ $doctor->phone }}</div>@endif
            @if($doctor->email)<div style="font-size:0.78rem;color:#7a9ab5;"><i class="fas fa-envelope" style="font-size:0.68rem;margin-right:4px;"></i>{{ $doctor->email }}</div>@endif
            @if(!$doctor->phone && !$doctor->email) — @endif
          </td>
          <td><span class="badge-{{ $doctor->status }}">{{ ucfirst($doctor->status) }}</span></td>
          <td>
            <div class="d-flex gap-1">
              <button class="btn-action btn-edit" title="Edit"
                      onclick="openDoctorEdit({{ $doctor->id }},'{{ addslashes($doctor->name) }}','{{ addslashes($doctor->specialization) }}','{{ addslashes($doctor->phone) }}','{{ addslashes($doctor->email) }}','{{ addslashes($doctor->qualification) }}','{{ $doctor->experience_years }}','{{ addslashes($doctor->address) }}','{{ addslashes($doctor->bio) }}','{{ $doctor->status }}','{{ $doctor->photo ? asset("storage/".$doctor->photo) : "" }}')">
                <i class="fas fa-pen"></i>
              </button>
              <a href="{{ route('admin.doctors.toggle', $doctor->id) }}" class="btn-action {{ $doctor->status==='active' ? 'btn-toggle-on' : 'btn-toggle-off' }}"><i class="fas {{ $doctor->status==='active' ? 'fa-toggle-on' : 'fa-toggle-off' }}"></i></a>
              <form action="{{ route('admin.doctors.destroy', $doctor->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Delete this doctor?')">
                @csrf @method('DELETE')
                <button type="submit" class="btn-action btn-del"><i class="fas fa-trash"></i></button>
              </form>
            </div>
          </td>
        </tr>
        @empty
        <tr><td colspan="8" class="text-center py-5" style="color:#7a9ab5;"><i class="fas fa-user-md fa-2x mb-3 d-block"></i>No doctors added yet.</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>

{{-- EDIT MODAL --}}
<div class="modal-overlay" id="editModalOverlay">
  <div class="modal-box" style="max-width:680px;">
    <button class="modal-close" onclick="closeModal('editModalOverlay')"><i class="fas fa-times"></i></button>
    <h5 class="modal-title"><i class="fas fa-pen me-2" style="color:#1D84B5;"></i>Edit Doctor / Staff</h5>
    <form id="editForm" method="POST" enctype="multipart/form-data">
      @csrf @method('PUT')
      <div class="d-flex align-items-center gap-3 mb-4">
        <div style="width:80px;height:80px;border-radius:50%;background:#dbeafe;display:flex;align-items:center;justify-content:center;color:#1D84B5;font-size:1.8rem;" id="editPhotoPlaceholder"><i class="fas fa-user-md"></i></div>
        <img id="editPhotoPreview" style="width:80px;height:80px;border-radius:50%;object-fit:cover;border:2px solid #dce8f2;display:none;" src="" alt=""/>
        <div>
          <label class="form-label-custom mb-1">Photo</label>
          <input type="file" name="photo" class="form-control-custom" accept="image/*" style="padding:6px 12px;" onchange="previewPhoto(this)"/>
          <small style="color:#7a9ab5;font-size:0.73rem;">Leave blank to keep current</small>
        </div>
      </div>
      <div class="row g-3">
        <div class="col-md-6"><label class="form-label-custom">Full Name *</label><input type="text" name="name" id="editName" class="form-control-custom" required/></div>
        <div class="col-md-6"><label class="form-label-custom">Specialization</label>
          <select name="specialization" id="editSpec" class="form-control-custom" style="cursor:pointer;">
            <option value="">— Select —</option>
            @foreach(['General Dentist','Orthodontist','Periodontist','Endodontist','Oral Surgeon','Pediatric Dentist','Prosthodontist','Dental Hygienist','Receptionist','Assistant'] as $spec)
              <option value="{{ $spec }}">{{ $spec }}</option>
            @endforeach
          </select>
        </div>
        <div class="col-md-6"><label class="form-label-custom">Phone</label><input type="text" name="phone" id="editPhone" class="form-control-custom"/></div>
        <div class="col-md-6"><label class="form-label-custom">Email</label><input type="email" name="email" id="editEmail" class="form-control-custom"/></div>
        <div class="col-md-6"><label class="form-label-custom">Qualification</label><input type="text" name="qualification" id="editQual" class="form-control-custom"/></div>
        <div class="col-md-3"><label class="form-label-custom">Experience (Yrs)</label><input type="number" name="experience_years" id="editExp" class="form-control-custom" min="0" max="60"/></div>
        <div class="col-md-3"><label class="form-label-custom">Status</label><select name="status" id="editStatus" class="form-control-custom" style="cursor:pointer;"><option value="active">Active</option><option value="inactive">Inactive</option></select></div>
        <div class="col-12"><label class="form-label-custom">Address</label><input type="text" name="address" id="editAddress" class="form-control-custom"/></div>
        <div class="col-12"><label class="form-label-custom">Bio / About</label><textarea name="bio" id="editBio" class="form-control-custom"></textarea></div>
      </div>
      <div class="mt-4"><button type="submit" class="btn-primary-custom w-100"><i class="fas fa-save me-2"></i> Save Changes</button></div>
    </form>
  </div>
</div>

@endsection

@section('js')
<script>
function openDoctorEdit(id,name,spec,phone,email,qual,exp,address,bio,status,photoUrl){
  document.getElementById('editName').value    = name;
  document.getElementById('editSpec').value    = spec;
  document.getElementById('editPhone').value   = phone;
  document.getElementById('editEmail').value   = email;
  document.getElementById('editQual').value    = qual;
  document.getElementById('editExp').value     = exp || '';
  document.getElementById('editAddress').value = address;
  document.getElementById('editBio').value     = bio;
  document.getElementById('editStatus').value  = status;
  document.getElementById('editForm').action   = '/admin/doctors/' + id;
  const preview     = document.getElementById('editPhotoPreview');
  const placeholder = document.getElementById('editPhotoPlaceholder');
  if(photoUrl){ preview.src=photoUrl; preview.style.display='block'; placeholder.style.display='none'; }
  else{ preview.style.display='none'; placeholder.style.display='flex'; }
  openModal('editModalOverlay');
}
</script>
@endsection