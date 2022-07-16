<?php
    session_start();

    if (isset($_SESSION["login_flag"])) {
        if ($_SESSION["login_flag"]) {
            header('location: main.php');
        }
    }
?>