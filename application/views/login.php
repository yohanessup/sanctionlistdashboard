<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Sanction List: Please Log In to Use System</title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="<?php echo base_url('assets/css/signin.css'); ?>" rel="stylesheet">
  </head>

  <body>
  <?php
  echo "<div class='error_msg' style='margin-left: 110px; color: #aa0000'>";
      if (isset($error_message)) {
      echo $error_message;
      }
      echo "</div>";
  ?>
  <?php
  if (isset($message_display)) {
      echo "<div class='message' style='margin-left: 110px; color: #204d74'>";
      echo $message_display;
      echo "</div>";
  }
  ?>

  <div class="container">

      <?php echo form_open('sanction'); ?>
      <form class="form-signin">
          <h2 class="form-signin-heading">Please sign in</h2>
          <label for="inputUserId" class="sr-only">User ID/E-mail address</label>
          <input type="email" name="user_id" id="inputUserId" class="form-control" placeholder="User ID/Email address" required autofocus>
          <label for="inputPassword" class="sr-only">Password</label>
          <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required>
          <div class="checkbox">
              <label>
                  <input type="checkbox" value="remember-me"> Remember me
              </label>
          </div>
          <button class="btn btn-lg btn-primary btn-block" name="submit" type="submit">Sign in</button>
      </form>
      <?php echo form_close(); ?>

  </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="<?php echo base_url('assets/js/ie10-viewport-bug-workaround.js'); ?>"></script>
  </body>
</html>