<?php
session_start();

if (isset($_SESSION["username"])) {
    $_SESSION["last_activity"] = time();
    http_response_code(200);
} else {
    http_response_code(403);
}
?>
