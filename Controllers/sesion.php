<?php
session_start();

if (isset($_SESSION['email'])) {
    echo "success";
}
else{
    echo "no session";
}

?>