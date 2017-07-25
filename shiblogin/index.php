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
      
      $user->eppn = $_SERVER['eppn'];
      $user->code = $secret_key;
      $user->time = time();
      $user->cn = $_SERVER['common-name'];
      $user->id = $_SERVER['unique-code'];
      $user->mail = $_SERVER['mail'];
      $data = $user->eppn . ';' . $user->id . ';' . $user->time . ';' . $user->code;
      $data_hash = hash("sha256", $data);
    ?>
    <form id="user_data" action="/shibbolethLogin" method="post">
      <input type="hidden" name="user" value='<?php echo $user->eppn; ?>'>
      <input type="hidden" name="time" value='<?php echo $user->time; ?>'>
      <input type="hidden" name="personal_code" value='<?php echo $user->id; ?>'>
      <input type="hidden" name="name" value='<?php echo $user->cn; ?>'>
      <input type="hidden" name="mail" value='<?php echo $user->mail; ?>'>
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
