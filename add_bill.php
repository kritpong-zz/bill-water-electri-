<?php
include 'db.php';

if (isset($_POST['submit'])) {
    // รับค่าจากฟอร์ม
    $type = $_POST['type'];
    $amount = $_POST['amount'];
    $due_date = $_POST['due_date'];

    // ป้องกัน SQL Injection เบื้องต้น
    $type = $conn->real_escape_string($type);
    $amount = $conn->real_escape_string($amount);
    $due_date = $conn->real_escape_string($due_date);

    $sql = "INSERT INTO bills (type, amount, due_date, status) VALUES ('$type', '$amount', '$due_date', 'Pending')";

    if ($conn->query($sql) === TRUE) {
        // บันทึกสำเร็จ ให้เด้งกลับไปหน้าหลัก
        header("Location: index.php");
        exit();
    } else {
        echo "เกิดข้อผิดพลาด: " . $conn->error;
    }
}
?>