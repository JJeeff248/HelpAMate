<?php
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    $host = getenv("MYSQL_HOST") ?: "db";
    $user = getenv("MYSQL_ADMIN_USER") ?: "admin";
    $pass = getenv("MYSQL_ADMIN_PASSWORD");
    $database = getenv("MYSQL_DATABASE") ?: "fundraiser";
    if ($pass === false || $pass === "") {
        http_response_code(500);
        echo "<h1>Sorry, you could not connect to the database</h1>";
        exit();
    }
    $dbc = mysqli_connect($host, $user, $pass, $database, 3306);
