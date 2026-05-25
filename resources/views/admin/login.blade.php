<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Admin Login — Peoples Dental Care</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet"/>
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;800&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet"/>
  <style>
    *{margin:0;padding:0;box-sizing:border-box;}
    body{
      font-family:'DM Sans',sans-serif;
      min-height:100vh;
      background: linear-gradient(135deg,#033C67 0%,#1D81B2 50%,#05426D 100%);
      display:flex;align-items:center;justify-content:center;
      position:relative;overflow:hidden;
    }
    /* Animated circles background */
    body::before,body::after{
      content:'';position:absolute;border-radius:50%;
      background:rgba(255,255,255,0.04);
    }
    body::before{width:600px;height:600px;top:-200px;right:-200px;}
    body::after{width:400px;height:400px;bottom:-150px;left:-150px;}

    .login-card{
      background:#fff;
      border-radius:20px;
      padding:52px 44px;
      width:100%;max-width:440px;
      box-shadow:0 32px 80px rgba(3,30,60,0.35);
      position:relative;z-index:2;
      animation:slideUp 0.6s cubic-bezier(0.22,1,0.36,1);
    }
    @keyframes slideUp{
      from{opacity:0;transform:translateY(40px);}
      to{opacity:1;transform:translateY(0);}
    }
    .brand-mark{
      width:64px;height:64px;border-radius:16px;
      background:linear-gradient(135deg,#033C67,#1D84B5);
      display:flex;align-items:center;justify-content:center;
      margin:0 auto 24px;
      box-shadow:0 8px 24px rgba(29,132,181,0.35);
    }
    .brand-mark i{color:#fff;font-size:1.6rem;}
    .login-title{
      font-family:'Playfair Display',serif;
      font-size:1.85rem;font-weight:800;
      color:#033C67;text-align:center;
      margin-bottom:6px;
    }
    .login-sub{
      text-align:center;color:#7a9ab5;
      font-size:0.88rem;margin-bottom:36px;
    }
    .form-label{
      font-size:0.80rem;font-weight:600;
      color:#033C67;letter-spacing:0.5px;
      text-transform:uppercase;margin-bottom:7px;
    }
    .form-control{
      border:1.5px solid #dce8f2;border-radius:10px;
      padding:13px 16px;font-size:0.90rem;
      transition:all 0.25s ease;background:#f8fbfe;
    }
    .form-control:focus{
      border-color:#1D84B5;background:#fff;
      box-shadow:0 0 0 4px rgba(29,132,181,0.12);
    }
    .input-group .form-control{border-right:none;}
    .input-group .btn-eye{
      border:1.5px solid #dce8f2;border-left:none;
      border-radius:0 10px 10px 0;background:#f8fbfe;
      color:#7a9ab5;padding:0 16px;cursor:pointer;
      transition:all 0.2s ease;
    }
    .input-group .btn-eye:hover{color:#1D84B5;}
    .btn-login{
      width:100%;background:linear-gradient(135deg,#033C67,#1D84B5);
      color:#fff;border:none;border-radius:10px;
      padding:14px;font-size:0.92rem;font-weight:700;
      letter-spacing:0.5px;margin-top:8px;
      transition:all 0.3s ease;
      box-shadow:0 6px 20px rgba(29,132,181,0.35);
    }
    .btn-login:hover{
      transform:translateY(-2px);
      box-shadow:0 12px 32px rgba(29,132,181,0.45);
    }
    .alert-danger{
      background:#fef2f2;border:1.5px solid #fecaca;
      border-radius:10px;color:#b91c1c;
      font-size:0.85rem;padding:12px 16px;
    }
    .back-link{
      display:block;text-align:center;margin-top:24px;
      color:#7a9ab5;font-size:0.82rem;text-decoration:none;
      transition:color 0.2s;
    }
    .back-link:hover{color:#1D84B5;}
    .credentials-hint{
      background:#f0f8ff;border-radius:10px;
      padding:12px 16px;margin-top:20px;
      font-size:0.78rem;color:#5a7a94;
      border-left:3px solid #1D84B5;
    }
  </style>
</head>
<body>
<div class="login-card">
  <div class="brand-mark"><i class="fas fa-tooth"></i></div>
  <h1 class="login-title">Admin Portal</h1>
  <p class="login-sub">Peoples Dental Care — Secure Login</p>

  @if($errors->any())
    <div class="alert-danger mb-3">
      <i class="fas fa-exclamation-circle me-2"></i>{{ $errors->first() }}
    </div>
  @endif

  @if(session('success'))
    <div class="alert alert-success mb-3" style="border-radius:10px;font-size:0.85rem;">
      {{ session('success') }}
    </div>
  @endif

  <form action="{{ route('admin.login.post') }}" method="POST">
    @csrf
    <div class="mb-3">
      <label class="form-label">Email Address</label>
      <input type="email" name="email" class="form-control"
             placeholder="admin@peoplesdental.com"
             value="{{ old('email') }}" required/>
    </div>
    <div class="mb-4">
      <label class="form-label">Password</label>
      <div class="input-group">
        <input type="password" name="password" id="pwdInput"
               class="form-control" placeholder="Enter your password" required/>
        <button type="button" class="btn-eye" onclick="togglePwd()">
          <i class="fas fa-eye" id="eyeIcon"></i>
        </button>
      </div>
    </div>
    <button type="submit" class="btn-login">
      <i class="fas fa-sign-in-alt me-2"></i> Sign In to Dashboard
    </button>
  </form>

  <!-- <div class="credentials-hint">
    <strong>Default credentials:</strong><br>
    Email: admin@peoplesdental.com &nbsp;|&nbsp; Password: admin@123
  </div> -->

  <a href="{{ route('home') }}" class="back-link">
    <i class="fas fa-arrow-left me-1"></i> Back to Website
  </a>
</div>

<script>
function togglePwd(){
  const i = document.getElementById('pwdInput');
  const e = document.getElementById('eyeIcon');
  if(i.type==='password'){i.type='text';e.className='fas fa-eye-slash';}
  else{i.type='password';e.className='fas fa-eye';}
}
</script>
</body>
</html>