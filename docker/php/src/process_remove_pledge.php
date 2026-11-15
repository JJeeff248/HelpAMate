<?php
    session_start();
    include_once 'includes/admin_connection.php';

    $pledgeId = $_POST['pledgeId'] ?? '';
    $remove_pledge = $dbc->prepare("DELETE FROM Pledges WHERE DonationId = ?");
    $remove_pledge->bind_param("i", $pledgeId);
    $remove_pledge->execute();
    $remove_pledge->close();
    header("Location: ".($_SESSION['page'] ?? 'index.php'));
    exit;
