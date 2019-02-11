<!DOCTYPE html>
<html lang="en" >

<head>
  <meta charset="UTF-8">
  <title>Login Form</title>
  <link rel="stylesheet" href="{{ asset('weblogin/css/style.css') }}">
</head>

<body>

  <div class="login-container">
    <section class="login" id="login">
      <header>
        <center><h2>APOTEK KIM FARMA</h2></center>
      </header>
      <form class="login-form" action="{{ route('login') }}" method="post">
        {{ csrf_field() }}
        <input type="email" name="email" id="email" class="login-input" placeholder="Email" required autofocus/>
        <input type="password" name="password" id="password" class="login-input" placeholder="Password" required/>
        <div class="submit-container">
          <button type="submit" class="login-button">Login</button>
        </div>
      </form>
    </section>
  </div>

  
  

  <script src="{{ asset('weblogin/js/index.js') }}"></script>

</body>
</html>