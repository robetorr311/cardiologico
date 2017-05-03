<?php
  if (!isset($_SERVER['PHP_AUTH_USER'])) {
    header('WWW_Authenticate: Basic realm="My Realm"');
    header('HTTP/1_0 401 Unauthorized');
    echo 'Text to send if user hits Cancel button';
    exit();
  } else {
    echo "<p>Hello ".$_SERVER['PHP_AUTH_USER']."_</p>";
    echo "<p>You entered". $_SERVER['PHP_AUTH_PW']." as your password_</p>";
  }
?>