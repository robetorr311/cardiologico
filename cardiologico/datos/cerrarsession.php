<?php
function LogOut() {
    session_destroy();
    session_unset($_SESSION['login']);
    session_unset($_SESSION['password']);
    session_unset($_SESSION['activa']);	
    header("Location: /auth/", TRUE, 301);   
}
?>