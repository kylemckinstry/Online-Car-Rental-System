<?php
session_start();
$id = $_POST["id"];
unset($_SESSION["cart"][$id]);
header("Location: reservation.php");
?>