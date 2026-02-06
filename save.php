<?php
include 'db.php';

if (isset($_POST['submit'])) {
    $type = $_POST['type'];
    $amount = $_POST['amount'];
    $due_date = $_POST['due_date'];

    $sql = "INSERT INTO bills (type, amount, due_date) VALUES ('$type', '$amount', '$due_date')";

    if ($conn->query($sql) === TRUE) {
        header("Location: index.php"); // บันทึกเสร็จให้กลับไปหน้าแรก
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>