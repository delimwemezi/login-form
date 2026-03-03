<?php 
  session_start();
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@300;400;600&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
  </head>
<body>

  <div class="bg-orbs">
    <div class="orb orb-1"></div>
    <div class="orb orb-2"></div>
    <div class="orb orb-3"></div>
  </div>

  <div class="wrapper">
    <div class="brand">
      <span class="brand-icon">⬡</span>
      <span class="brand-name">NEXUS</span>
    </div>

    <div class="heading">
      <h2>Welcome back</h2>
      <p>Sign in to continue your session</p>
    </div>

    <form action="#" method="POST" class="login-form">

      <div class="input-group">
        <label for="txtuser">Username</label>
        <div class="input-wrap">
          <svg class="input-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
            <circle cx="12" cy="7" r="4"/>
          </svg>
          <input type="text" id="txtuser" name="txtuser" placeholder="Enter your username" required autocomplete="off">
        </div>
      </div>

      <div class="input-group">
        <label for="txtpass">Password</label>
        <div class="input-wrap">
          <svg class="input-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
            <rect x="3" y="11" width="18" height="11" rx="2" ry="2"/>
            <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
          </svg>
          <input type="password" id="txtpass" name="txtpass" placeholder="Enter your password" required>
          <button type="button" class="toggle-pass" onclick="togglePassword()" tabindex="-1">
            <svg id="eye-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
              <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
              <circle cx="12" cy="12" r="3"/>
            </svg>
          </button>
        </div>
      </div>

      <div class="form-options">
        <label class="remember">
          <input type="checkbox" name="remember">
          <span class="checkmark"></span>
          Remember me
        </label>
        <a href="ChangePassword.php" class="forgot-link">Forgot password?</a>
      </div>

      <button type="submit" name="btnsub" class="btn-login">
        <span>Sign In</span>
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <path d="M5 12h14M12 5l7 7-7 7"/>
        </svg>
      </button>

      <div class="divider"><span>or</span></div>

      <div class="register-link">
        Don't have an account? <a href="Registration.php">Create one</a>
      </div>

    </form>
  </div>

  <script>
    function togglePassword() {
      const input = document.getElementById('txtpass');
      const icon = document.getElementById('eye-icon');
      if (input.type === 'password') {
        input.type = 'text';
        icon.innerHTML = `<path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"/><line x1="1" y1="1" x2="23" y2="23"/>`;
      } else {
        input.type = 'password';
        icon.innerHTML = `<path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/>`;
      }
    }

    // Input focus animation
    document.querySelectorAll('.input-wrap input').forEach(input => {
      input.addEventListener('focus', () => input.closest('.input-group').classList.add('focused'));
      input.addEventListener('blur', () => input.closest('.input-group').classList.remove('focused'));
    });
  </script>

</body>
</html>
<?php 
  include ('Control.php');

  $getdata = new Data();

  if (isset($_POST['btnsub'])){
    $login = $getdata->Login($_POST['txtuser'], $_POST['txtpass']);

    if (!$getdata->check_username($_POST['txtuser'])){
      echo "<script>alert('Username only text and number')</script>";
    }
    else if (!$getdata->check_length($_POST['txtuser']) || !$getdata->check_length($_POST['txtpass'])){
      echo "<script>alert('Username or Password is less than 8 characters')</script>";
    }
    else{
      if ($login == 1){
        $_SESSION['user'] = $_POST['txtuser'];
        echo "<script>alert('Login Complete'); window.location = 'Mainpage.php';</script>";
      }
      else {
        echo "<script>alert('Login not Complete. Username does not exist or Password incorrect')</script>";
      }
    }
  }
?>
