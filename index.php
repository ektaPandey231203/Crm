<?php
session_start();

// get + clear flash error
$error = $_SESSION['error'] ?? '';
unset($_SESSION['error']);

// CSRF token
if (empty($_SESSION['csrf'])) {
    $_SESSION['csrf'] = bin2hex(random_bytes(16));
}
$csrf = $_SESSION['csrf'];
?>
<!DOCTYPE html>
<html lang="en">
<<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>LJ University - Sign In</title>
  <style>
    :root{
      --brand:#1976d2;
      --brandDark:#135da7;
      --text:#2c3e50;
      --muted:#6b7280;
      --ring:rgba(25,118,210,.35);
    }
    *{box-sizing:border-box}
    body{
      margin:0; min-height:100vh; display:flex; align-items:center; justify-content:center;
      background: radial-gradient(1200px 600px at 80% -10%, #e0f2fe, transparent 60%),
                  linear-gradient(135deg,#1e3a8a,#60a5fa 55%,#ffffff);
      font-family: system-ui, -apple-system, Segoe UI, Roboto, Arial, "Noto Sans", "Helvetica Neue", sans-serif;
    }
    .card{
      width:min(92vw, 420px);
      background:#fff; padding:28px; border-radius:18px;
      box-shadow:0 15px 45px rgba(0,0,0,.18);
    }
    .brand{
      display:flex; align-items:center; gap:12px; margin-bottom:10px;
    }
    .brand img{ width:56px; height:56px; object-fit:contain; }
    .brand h1{ margin:0; font-size:24px; color:var(--text); letter-spacing:.3px; }
    .sub{ margin:0; color:var(--muted); font-size:14px; }
    form{ margin-top:18px; }
    .field{ position:relative; margin:12px 0; }
    .label{ font-size:13px; color:var(--muted); margin-bottom:6px; display:block; }
    .input{
      width:100%; padding:12px 42px 12px 14px; border:1px solid #e5e7eb; border-radius:12px;
      font-size:15px; outline:none; transition:.18s;
      background:#fff;
    }
    .input:focus{ border-color:var(--brand); box-shadow:0 0 0 4px var(--ring); }
    .icon{
      position:absolute; right:12px; top:36px; cursor:pointer; user-select:none; font-size:13px; color:#6b7280;
    }
    .actions{ display:flex; align-items:center; justify-content:space-between; margin-top:6px; }
    .link{ font-size:13px; color:var(--brand); text-decoration:none; }
    .btn{
      width:100%; margin-top:16px; padding:12px 16px; border:0; border-radius:12px;
      background:var(--brand); color:#fff; font-weight:700; font-size:15px; cursor:pointer; transition:.18s;
    }
    .btn:hover{ background:var(--brandDark); transform:translateY(-1px); }
    .error{
      background:#fee2e2; color:#991b1b; border:1px solid #fecaca; padding:10px 12px; border-radius:10px; font-size:14px; margin-top:12px;
    }
    .foot{
      margin-top:16px; font-size:12px; color:#6b7280; text-align:center;
    }
    .foot a{ color:var(--brand); text-decoration:none; }
  </style>
</head>>
<body>
  <div class="card">
    <div class="brand">
      <!-- replace with your logo path -->
      <img src="logo.png" alt="LJ University">
      <div>
        <h1>Sign In</h1>
        <p class="sub">LJ student</p>
      </div>
    </div>

    <?php if ($error): ?>
      <div class="error"><?= htmlspecialchars($error, ENT_QUOTES) ?></div>
    <?php endif; ?>

    <form action="login.php" method="POST" autocomplete="off" novalidate>
      <input type="hidden" name="csrf" value="<?= htmlspecialchars($csrf, ENT_QUOTES) ?>">

      <div class="field">
        <label class="label" for="user">Username or Email</label>
        <input class="input" id="user" name="user" type="text" placeholder="e.g. jdoe or jdoe@lju.edu" required />
      </div>

      <div class="field">
        <label class="label" for="pass">Password</label>
        <input class="input" id="pass" name="pass" type="password" placeholder="Enter your password" required />
        <span class="icon" id="toggle">Show</span>
      </div>

      <div class="actions">
        <a class="link" href="#">Forgot password?</a>
      </div>

      <button class="btn" type="submit">Secured Sign In</button>
    </form>

    <div class="foot">
      Developed by <a href="#" rel="noopener">Mihir Vaghela</a> •
      Don’t have an account? <a href="signup.php">Sign up</a>
    </div>
  </div>

  <script>
    // show/hide password
    const pass = document.getElementById('pass');
    const toggle = document.getElementById('toggle');
    toggle.addEventListener('click', () => {
      if (pass.type === 'password') { pass.type = 'text'; toggle.textContent = 'Hide'; }
      else { pass.type = 'password'; toggle.textContent = 'Show'; }
    });
  </script>
</body>
</html>>
