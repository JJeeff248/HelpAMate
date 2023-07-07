<?php
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    $dbc = mysqli_connect("db", "public", "change-me", "fundraiser", 3306); // change to public
    if ($dbc == null) {
        echo "<h1>Sorry, you could not connect to the database</h1>";
        exit();
    }