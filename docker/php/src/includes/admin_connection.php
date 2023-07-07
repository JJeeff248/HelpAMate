<?php
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    $dbc = mysqli_connect("db", "admin", "change-me1", "fundraiser", 3306);
    if ($dbc == null) {
        echo "<h1>Sorry, you could not connect to the database</h1>";
        exit();
    }
