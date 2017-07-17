<!DOCTYPE html>
<html>
  <head>
    <title>Redirecting</title>
  </head>
  <body>
    <h1>Redirecting....</h1>
    <?php
      require 'secret_key.php';
      $url = "/shibbolethLogin";
      
      $eppn = $_SERVER['eppn'];
      
      $user->eppn = $eppn;
      $user->code = $secret_key;
      $user->time = time();
      $data = $user->eppn . ';' . $user->time . ';' . $user->code;
      $data_hash = hash("sha256", $data);
    ?>
    <form id="user_data" action="/shibbolethLogin" method="post">
      <input type="hidden" name="user" value='<?php echo $user->eppn; ?>'>
      <input type="hidden" name="time" value='<?php echo $user->time; ?>'>
      <input type="hidden" name="hash" value="<?php echo $data_hash; ?>">
    </form>

    <script type="text/javascript">
      function submitForm() {
        document.getElementById('user_data').submit();
      }
      window.onload = submitForm;
    </script>
  </body>
</html>
