<?php
    // if the user presses logout
    // start the session, unset the id, destory the session, then lead them back
    // to the home page
    session_start();
    session_unset();
    session_destroy();
    header('Location:index.php');