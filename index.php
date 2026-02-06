<?php 
include 'db.php'; 

// ตรวจสอบว่ามีการกดปุ่ม "ชำระเงินแล้ว" หรือไม่
if (isset($_GET['pay_id'])) {
    $id = $_GET['pay_id'];
    $conn->query("UPDATE bills SET status = 'Paid' WHERE id = $id");
    header("Location: index.php");
}

// ดึงข้อมูลแยกเป็น 2 ชุด
$pending_bills = $conn->query("SELECT * FROM bills WHERE status = 'Pending' ORDER BY due_date ASC");
$paid_bills = $conn->query("SELECT * FROM bills WHERE status = 'Paid' ORDER BY created_at DESC LIMIT 10");
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>สรุปค่าน้ำค่าไฟ</title>
    <style>
        body { font-family: 'Kanit', sans-serif; background: #f8f9fa; padding: 20px; color: #333; }
        .container { max-width: 700px; margin: auto; }
        .section-title { font-size: 1.2rem; font-weight: bold; margin: 20px 0 10px; display: flex; align-items: center; }
        .count-badge { background: #6c757d; color: white; border-radius: 20px; padding: 2px 10px; font-size: 0.8rem; margin-left: 10px; }
        
        /* Card Style */
        .bill-card { background: white; border-radius: 12px; padding: 15px; margin-bottom: 10px; display: flex; justify-content: space-between; align-items: center; box-shadow: 0 2px 5px rgba(0,0,0,0.05); }
        .info h3 { margin: 0; font-size: 1rem; }
        .info p { margin: 3px 0; font-size: 0.85rem; color: #777; }
        
        /* Buttons & Colors */
        .btn-pay { background: #28a745; color: white; border: none; padding: 8px 15px; border-radius: 8px; cursor: pointer; text-decoration: none; font-size: 0.85rem; }
        .pending { border-left: 5px solid #ffc107; }
        .paid { border-left: 5px solid #28a745; opacity: 0.8; }
        .amount { font-weight: bold; color: #333; }
        .add-link { display: block; text-align: center; margin-bottom: 20px; color: #007bff; text-decoration: none; }
    </style>
</head>
<body>

<div class="container">
    <h2 style="text-align: center;">📊 สรุปบิลของฉัน</h2>
    <a href="add_bill.php" class="add-link">+ เพิ่มบิลใหม่</a>

    <div class="section-title">
        🔴 ค้างชำระ 
        <span class="count-badge"><?php echo $pending_bills->num_rows; ?> รายการ</span>
    </div>
    
    <?php if ($pending_bills->num_rows > 0): ?>
        <?php while($row = $pending_bills->fetch_assoc()): ?>
            <div class="bill-card pending">
                <div class="info">
                    <h3><?php echo ($row['type'] == 'Water' ? '💧 ค่าน้ำ' : '⚡ ค่าไฟ'); ?></h3>
                    <p>กำหนดชำระ: <?php echo $row['due_date']; ?></p>
                    <span class="amount">฿<?php echo number_format($row['amount'], 2); ?></span>
                </div>
                <a href="index.php?pay_id=<?php echo $row['id']; ?>" class="btn-pay" onclick="return confirm('ยืนยันการชำระเงิน?')">จ่ายแล้ว</a>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <p style="text-align: center; color: #999;">ไม่มีบิลค้างชำระ</p>
    <?php endif; ?>

    <hr style="margin-top: 30px; border: 0; border-top: 1px solid #ddd;">

    <div class="section-title" style="color: #28a745;">
        ✅ จ่ายแล้ว (ล่าสุด)
    </div>
    
    <?php if ($paid_bills->num_rows > 0): ?>
        <?php while($row = $paid_bills->fetch_assoc()): ?>
            <div class="bill-card paid">
                <div class="info">
                    <h3 style="color: #666;"><?php echo ($row['type'] == 'Water' ? 'ค่าน้ำ' : 'ค่าไฟ'); ?></h3>
                    <p>ชำระแล้วเมื่อ: <?php echo date('d/m/Y', strtotime($row['created_at'])); ?></p>
                </div>
                <div class="amount" style="text-decoration: line-through; color: #999;">
                    ฿<?php echo number_format($row['amount'], 2); ?>
                </div>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <p style="text-align: center; color: #999;">ยังไม่มีประวัติการจ่าย</p>
    <?php endif; ?>

</div>

</body>
</html>