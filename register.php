<?php
require_once __DIR__ . '/config/database.php';
require_once __DIR__ . '/classes/Database.php';
require_once __DIR__ . '/classes/Event.php';
require_once __DIR__ . '/includes/functions.php';

$eventId = (int)($_GET['event_id'] ?? 0);
$eventModel = new Event();
$event = $eventModel->getById($eventId);

if (!$event) {
    header("Location: " . base_url('index.php'));
    exit();
}

$success = false;
$regNum = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $firstname = cleanInput($_POST['firstname'] ?? '');
    $lastname  = cleanInput($_POST['lastname'] ?? '');
    $idCard    = cleanInput($_POST['id_card'] ?? '');
    $email     = cleanInput($_POST['email'] ?? '');
    $phone     = cleanInput($_POST['phone'] ?? '');
    $shirtSize = cleanInput($_POST['shirt_size'] ?? '');

    if ($firstname && $lastname && $email && $phone) {
        $pdo = Database::getInstance()->getConnection();
        $regNum = 'ITRUN-' . date('Ymd') . '-' . rand(1000, 9999);
        $stmt = $pdo->prepare("INSERT INTO registrations (reg_number, event_id, runner_firstname, runner_lastname, id_card_passport, email, phone, shirt_size) VALUES (:rn, :eid, :fn, :ln, :id, :email, :phone, :ss)");
        $ok = $stmt->execute([
            ':rn' => $regNum, ':eid' => $eventId, ':fn' => $firstname,
            ':ln' => $lastname, ':id' => $idCard, ':email' => $email,
            ':phone' => $phone, ':ss' => $shirtSize
        ]);
        if ($ok) {
            $success = true;
        }
    }
}

$pageTitle = 'สมัครวิ่ง — ' . $event['event_name'];
require_once __DIR__ . '/includes/header.php';
?>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card p-4">
                <?php if ($success): ?>
                    <div class="text-center py-4">
                        <i class="fas fa-check-circle fa-4x text-yellow mb-3"></i>
                        <h3 class="text-yellow">ลงทะเบียนสำเร็จ!</h3>
                        <p class="text-muted">หมายเลขประจำตัวนักวิ่งของคุณคือ</p>
                        <div class="fs-3 fw-bold text-yellow p-3 my-3 border border-warning rounded d-inline-block bg-dark">
                            <?= htmlspecialchars($regNum) ?>
                        </div>
                        <p class="small text-muted">กรุณาบันทึกรหัสนี้เพื่อใช้ตรวจสอบสถานะการสมัครและการรับ BIB</p>
                        <a href="<?= base_url('index.php') ?>" class="btn btn-yellow mt-3"><i class="fas fa-home me-1"></i> กลับหน้าแรก</a>
                    </div>
                <?php else: ?>
                    <h4 class="text-yellow mb-3"><i class="fas fa-pen-nib me-2"></i>แบบฟอร์มสมัครงานวิ่ง</h4>
                    <div class="alert alert-dark border-warning text-light mb-4">
                        <strong><?= htmlspecialchars($event['event_name']) ?></strong><br>
                        <small><i class="fas fa-map-marker-alt text-yellow me-1"></i> <?= htmlspecialchars($event['location_venue']) ?> (<?= formatDateThai($event['event_date']) ?>)</small><br>
                        <small><i class="fas fa-tag text-yellow me-1"></i> ค่าสมัคร: ฿<?= number_format($event['price'], 2) ?></small>
                    </div>

                    <form method="POST" action="">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label text-yellow">ชื่อจริง</label>
                                <input type="text" name="firstname" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label text-yellow">นามสกุล</label>
                                <input type="text" name="lastname" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label text-yellow">เลขบัตรประชาชน / Passport</label>
                                <input type="text" name="id_card" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label text-yellow">ไซส์เสื้อ</label>
                                <select name="shirt_size" class="form-select" required>
                                    <option value="S">S (รอบอก 36")</option>
                                    <option value="M" selected>M (รอบอก 38")</option>
                                    <option value="L">L (รอบอก 40")</option>
                                    <option value="XL">XL (รอบอก 42")</option>
                                    <option value="2XL">2XL (รอบอก 44")</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label text-yellow">อีเมล</label>
                                <input type="email" name="email" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label text-yellow">เบอร์โทรศัพท์</label>
                                <input type="tel" name="phone" class="form-control" required>
                            </div>
                            <div class="col-12 text-center pt-3">
                                <button type="submit" class="btn btn-yellow btn-lg px-5"><i class="fas fa-paper-plane me-1"></i> ยืนยันการสมัคร</button>
                            </div>
                        </div>
                    </form>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
