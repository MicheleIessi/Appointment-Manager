<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN""http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
    <head>
        <link href='View/css/prova.css' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Lato&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
        <title>Home - Appointment Manager</title>
    </head>
    <body>
        <div id='topbar'><h1 id='titolo'>Appointment Manager</h1> </div>
        <div id='elements'>
        <div id='primo' class='foo'><p>Primo</p> </div>
        <div id='mezzo' class='foo'><p>Secondo</p> </div>
        <div id='mezzo' class='foo'><p>Terzo</p> </div>
        <div id='mezzo' class='foo'><p>Quarto</p> </div>
        <div id='mezzo' class='foo'><p>Quinto</p> </div>
        <div id='mezzo' class='foo'><p>Sesto</p> </div>
        <div id='ultimo' class='foo'><p>Settimo</p> </div></div>
        
  <section class="container">
    <div class="login">
      <h1>Login</h1>
      <form method="post" action="Control/CLogin.php">
        <p><input type="text" name="email" value="" placeholder="Email"></p>
        <p><input type="password" name="password" value="" placeholder="Password"></p>
        <p class="remember_me">
          <label>
            <input type="checkbox" name="remember_me" id="remember_me">
            Ricordami su questo computer
          </label>
        </p>
        <p class="submit"><input type="submit" name="btnLogin" value="Login"></p>
      </form>
    </div>

    <div class="login-help">
      <p>Forgot your password? <a href="index.php" >Click here to reset it</a>.</p>
    </div>
  </section>

    </body>
</html>