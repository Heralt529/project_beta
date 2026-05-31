<?php
// logout.php - обработчик выхода

function logout_post($request) {
    session_start();
    session_destroy();
    return redirect('form');
}
?>