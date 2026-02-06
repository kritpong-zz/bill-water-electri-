<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เพิ่มบิลใหม่</title>
    <style>
        body { font-family: 'Kanit', sans-serif; background: #f8f9fa; padding: 20px; display: flex; justify-content: center; }
        .card { background: white; padding: 25px; border-radius: 15px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); width: 100%; max-width: 400px; }
        h2 { text-align: center; color: #333; margin-bottom: 20px; }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; color: #666; font-size: 14px; }
        select, input { width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 8px; box-sizing: border-box; font-size: 16px; }
        .btn-submit { width: 100%; padding: 12px; background: #007bff; color: white; border: none; border-radius: 8px; font-size: 16px; cursor: pointer; margin-top: 10px; }
        .btn-submit:hover { background: #0056b3; }
        .back-link { display: block; text-align: center; margin-top: 15px; color: #888; text-decoration: none; font-size: 14px; }
    </style>
</head>
<body>

<div class="card">
    <h2>➕ เพิ่มบิลใหม่</h2>
    <form action="save_bill.php" method="POST">
        <div class="form-group">
            <label>ประเภทบิล</label>
            <select name="type" required>
                <option value="Water">💧 ค่าน้ำ</option>
                <option value="Electricity">⚡ ค่าไฟ</option>
            </select>
        </div>

        <div class="form-group">
            <label>จำนวนเงิน (บาท)</label>
            <input type="number" name="amount" step="0.01" placeholder="เช่น 450.50" required>
        </div>

        <div class="form-group">
            <label>วันครบกำหนดชำระ</label>
            <input type="date" name="due_date" value="<?php echo date('Y-m-d'); ?>" required>
        </div>

        <button type="submit" name="submit" class="btn-submit">บันทึกข้อมูล</button>
        <a href="index.php" class="back-link">← กลับหน้าหลัก</a>
    </form>
</div>

</body>
</html>