@extends('layouts.admin')
@section('title', 'Admin Users — Peoples Dental Care')
@php $activePage = 'users'; @endphp

@section('content')

<div class="topbar"><h1>Admin Users</h1></div>

@if(session('success'))
  <div class="alert-success-custom"><i class="fas fa-check-circle me-2"></i>{{ session('success') }}</div>
@endif
@if($errors->any())
  <div class="alert-error-custom"><i class="fas fa-exclamation-circle me-2"></i>{{ $errors->first() }}</div>
@endif

<div class="page-card">
  <div class="page-card-header">
    <h5><i class="fas fa-user-plus me-2" style="color:#1D84B5"></i>Add New Admin User</h5>
  </div>
  <div class="page-card-body">
    <form action="{{ route('admin.users.store') }}" method="POST">
      @csrf
      <div class="row g-3">
        <div class="col-md-3"><label class="form-label-custom">Full Name</label><input type="text" name="name" class="form-control-custom" placeholder="Enter name" required value="{{ old('name') }}"/></div>
        <div class="col-md-3"><label class="form-label-custom">Email Address</label><input type="email" name="email" class="form-control-custom" placeholder="Enter email" required value="{{ old('email') }}"/></div>
        <div class="col-md-2"><label class="form-label-custom">Role</label><select name="role" class="form-control-custom" style="cursor:pointer;"><option value="admin">Admin</option><option value="superadmin">Super Admin</option></select></div>
        <div class="col-md-2"><label class="form-label-custom">Password</label><input type="password" name="password" class="form-control-custom" placeholder="Min 6 chars" required/></div>
        <div class="col-md-2"><label class="form-label-custom">Confirm Password</label><input type="password" name="password_confirmation" class="form-control-custom" placeholder="Repeat password" required/></div>
      </div>
      <div class="mt-3"><button type="submit" class="btn-primary-custom"><i class="fas fa-plus me-2"></i> Add Admin User</button></div>
    </form>
  </div>
</div>

<div class="page-card">
  <div class="page-card-header">
    <h5><i class="fas fa-users me-2" style="color:#1D84B5"></i>All Admin Users</h5>
    <span style="font-size:0.82rem;color:#7a9ab5;">{{ $admins->count() }} total users</span>
  </div>
  <div class="table-responsive">
    <table class="table">
      <thead><tr><th>#</th><th>Name</th><th>Email</th><th>Role</th><th>Status</th><th>Created</th><th>Actions</th></tr></thead>
      <tbody>
        @foreach($admins as $adminUser)
        <tr>
          <td style="color:#7a9ab5;font-size:0.80rem;">{{ $adminUser->id }}</td>
          <td>
            <div style="font-weight:600;color:#033C67;">{{ $adminUser->name }}</div>
            @if($adminUser->id === Auth::guard('admin')->id())
              <small style="color:#1D84B5;font-size:0.72rem;">● You</small>
            @endif
          </td>
          <td style="color:#555;">{{ $adminUser->email }}</td>
          <td><span class="role-badge {{ $adminUser->role === 'superadmin' ? 'role-super' : 'role-admin' }}">{{ $adminUser->role === 'superadmin' ? 'Super Admin' : 'Admin' }}</span></td>
          <td><span class="status-badge {{ $adminUser->is_active ? 'status-active' : 'status-inactive' }}">{{ $adminUser->is_active ? 'Active' : 'Inactive' }}</span></td>
          <td style="color:#7a9ab5;font-size:0.80rem;">{{ $adminUser->created_at->format('d M Y') }}</td>
          <td>
            <div class="d-flex gap-1">
              <button class="btn-action btn-edit"
                      onclick="openUserEdit({{ $adminUser->id }},'{{ $adminUser->name }}','{{ $adminUser->email }}','{{ $adminUser->role }}')"
                      title="Edit"><i class="fas fa-pen"></i></button>
              @if($adminUser->id !== Auth::guard('admin')->id())
                <a href="{{ route('admin.users.toggle', $adminUser->id) }}" class="btn-action {{ $adminUser->is_active ? 'btn-toggle-on' : 'btn-toggle-off' }}"><i class="fas {{ $adminUser->is_active ? 'fa-toggle-on' : 'fa-toggle-off' }}"></i></a>
                <form action="{{ route('admin.users.destroy', $adminUser->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Delete this admin user?')">
                  @csrf @method('DELETE')
                  <button type="submit" class="btn-action btn-del"><i class="fas fa-trash"></i></button>
                </form>
              @endif
            </div>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>

{{-- EDIT MODAL --}}
<div class="modal-overlay" id="editModalOverlay">
  <div class="modal-box" style="max-width:500px;">
    <button class="modal-close" onclick="closeModal('editModalOverlay')"><i class="fas fa-times"></i></button>
    <h5 class="modal-title"><i class="fas fa-pen me-2" style="color:#1D84B5;"></i>Edit Admin User</h5>
    <form id="editForm" method="POST">
      @csrf @method('PUT')
      <div class="mb-3"><label class="form-label-custom">Full Name</label><input type="text" name="name" id="editName" class="form-control-custom" required/></div>
      <div class="mb-3"><label class="form-label-custom">Email Address</label><input type="email" name="email" id="editEmail" class="form-control-custom" required/></div>
      <div class="mb-3"><label class="form-label-custom">Role</label><select name="role" id="editRole" class="form-control-custom" style="cursor:pointer;"><option value="admin">Admin</option><option value="superadmin">Super Admin</option></select></div>
      <div class="mb-3"><label class="form-label-custom">New Password <span style="color:#7a9ab5;font-weight:400;text-transform:none;">(leave blank to keep current)</span></label><input type="password" name="password" id="editPassword" class="form-control-custom" placeholder="Min 6 chars"/></div>
      <div class="mb-4"><label class="form-label-custom">Confirm New Password</label><input type="password" name="password_confirmation" id="editPasswordConfirm" class="form-control-custom" placeholder="Repeat new password"/></div>
      <button type="submit" class="btn-primary-custom w-100"><i class="fas fa-save me-2"></i> Save Changes</button>
    </form>
  </div>
</div>

@endsection

@section('js')
<script>
function openUserEdit(id, name, email, role) {
  document.getElementById('editName').value            = name;
  document.getElementById('editEmail').value           = email;
  document.getElementById('editRole').value            = role;
  document.getElementById('editPassword').value        = '';
  document.getElementById('editPasswordConfirm').value = '';
  document.getElementById('editForm').action           = '/admin/users/' + id;
  openModal('editModalOverlay');
}
</script>
@endsection