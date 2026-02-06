<?php
$host = "localhost";
$user = "root"; // ตามค่าของเครื่องคุณ
$pass = "";     // ตามค่าของเครื่องคุณ
$dbname = "utility_bill";

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>