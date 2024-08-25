<?php

function redirect($url, $message) {
    $_SESSION['message'] = $message;
    // header("Location: $url"); // Corrected: Using double quotes
    header('Location: ' . $url);

    exit();
}
?>