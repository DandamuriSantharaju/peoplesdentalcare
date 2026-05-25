@extends('layouts.admin')
@section('title', 'Change Password — Admin')
@php $activePage = 'password'; @endphp

@section('css')
<style>
  .pwd-card{background:#fff;border-radius:16px;box-shadow:0 4px 16px rgba(3,60,103,0.07);max-width:540px;}
  .pwd-card-header{padding:24px 32px;border-bottom:1px solid #edf3f8;}
  .pwd-card-header h5{font-family:'Playfair Display',serif;font-size:1.2rem;font-weight:800;color:#033C67;margin:0;}
  .pwd-card-body{padding:32px;}
  .input-wrap{position:relative;}
  .eye-btn{position:absolute;right:12px;top:50%;transform:translateY(-50%);border:none;background:transparent;color:#7a9ab5;cursor:pointer;font-size:0.88rem;transition:color 0.2s;}
  .eye-btn:hover{color:#1D84B5;}
  .btn-submit{background:linear-gradient(135deg,#033C67,#1D84B5);color:#fff;border:none;border-radius:8px;padding:13px 36px;font-size:0.88rem;font-weight:700;cursor:pointer;transition:all 0.3s ease;margin-top:8px;font-family:'DM Sans',sans-serif;}
  .btn-submit:hover{transform:translateY(-1px);box-shadow:0 8px 20px rgba(29,132,181,0.30);}
</style>
@endsection

@section('content')

<div class="topbar"><h1>Change Password</h1></div>

@if(session('success'))
  <div class="alert-success-custom" style="max-width:540px;">
    <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
  </div>
@endif
@if($errors->any())
  <div class="alert-error-custom" style="max-width:540px;">
    <i class="fas fa-exclamation-circle me-2"></i>{{ $errors->first() }}
  </div>
@endif

<div class="pwd-card">
  <div class="pwd-card-header">
    <h5><i class="fas fa-key me-2" style="color:#1D84B5;"></i>Update Your Password</h5>
  </div>
  <div class="pwd-card-body">
    <form action="{{ route('admin.change.password.post') }}" method="POST">
      @csrf
      <div class="mb-4">
        <label class="form-label-custom">Current Password</label>
        <div class="input-wrap">
          <input type="password" name="current_password" id="currentPwd"
                 class="form-control-custom" placeholder="Enter current password" required/>
          <button type="button" class="eye-btn" onclick="toggleField('currentPwd','eye1')">
            <i class="fas fa-eye" id="eye1"></i>
          </button>
        </div>
      </div>
      <div class="mb-4">
        <label class="form-label-custom">New Password</label>
        <div class="input-wrap">
          <input type="password" name="password" id="newPwd"
                 class="form-control-custom" placeholder="Min 6 characters"
                 required oninput="checkStrength(this.value)"/>
          <button type="button" class="eye-btn" onclick="toggleField('newPwd','eye2')">
            <i class="fas fa-eye" id="eye2"></i>
          </button>
        </div>
        <div class="pwd-strength" id="pwdStrength"></div>
        <p class="pwd-hint" id="pwdHint">Enter a new password</p>
      </div>
      <div class="mb-4">
        <label class="form-label-custom">Confirm New Password</label>
        <div class="input-wrap">
          <input type="password" name="password_confirmation" id="confirmPwd"
                 class="form-control-custom" placeholder="Repeat new password" required/>
          <button type="button" class="eye-btn" onclick="toggleField('confirmPwd','eye3')">
            <i class="fas fa-eye" id="eye3"></i>
          </button>
        </div>
      </div>
      <button type="submit" class="btn-submit">
        <i class="fas fa-save me-2"></i> Update Password
      </button>
    </form>
  </div>
</div>

@endsection