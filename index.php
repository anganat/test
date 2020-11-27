<?php
session_start();

$error = '';
include_once('Register.php');

if ('POST' === $_SERVER['REQUEST_METHOD']) {

    $obj = new Register();
    if (isset($_POST['email']) && isset($_POST['password'])) {
        if ($obj->checkValidLogin($_POST['email'], $_POST['password'])) {
            $_SESSION['email'] = $_POST['email'];
            header('location:dashboard.php');
        } else {
            $error = 'Invalid Login Credentials';
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Welcome User</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="http://netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
    <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="http://netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
</head>
<body>


    <div id="login-overlay" class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
              <h4 class="modal-title" id="myModalLabel">Welcome</h4>
          </div>
          <div class="modal-body">
              <div class="row">
                  <div class="col-xs-6">
                      <div class="well">
                          <form id="loginForm" method="post">
                              <?php if('' != $error): ?>
                                  <div><?php echo $error; ?></div>
                              <?php endif; ?>
                              <div class="form-group">
                                  <label for="username" class="control-label">Email</label>
                                  <input type="text" class="form-control" id="email" name="email"  required="" title="Please enter you username or Email-id" placeholder="email" >
                                  <span class="help-block"></span>
                              </div>
                              <div class="form-group">
                                  <label for="password" class="control-label">Password</label>
                                  <input type="password" class="form-control" id="password" name="password" placeholder="Password" value="" required="" title="Please enter your password">
                                  <span class="help-block"></span>
                              </div>

                              <button type="submit" class="btn btn-success btn-block" name="login">Login</button>
                          </form>
                      </div>
                  </div>
                  <div class="col-xs-6">
                      <p class="lead">Register now to continue</p>
                      <p><a href="signup.php" class="btn btn-info btn-block">Register Now</a></p>
                  </div>
              </div>
          </div>
      </div>
  </div>
<script type="text/javascript">

</script>
</body>
</html>
