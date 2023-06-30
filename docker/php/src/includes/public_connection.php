<?php
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    // $dbc = mysqli_connect("db", "root", "example", "fundraiser", 3306); // change to public
    $dbc = mysqli_connect("localhost", "root", "", "fundraiser", 3306);
    if ($dbc == null) {
        echo "<h1>Sorry, you could not connect to the database</h1>";
        exit();
    }