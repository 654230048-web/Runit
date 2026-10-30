<?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../classes/Database.php';
require_once __DIR__ . '/../includes/functions.php';

$pdo = Database::getInstance()->getConnection();
$totalEvents = $pdo->query("SELECT COUNT(*) FROM events")->fetchColumn();
$totalRunners = $pdo->query("SELECT COUNT(*) FROM registrations")->fetchColumn();
$recentRegs = $pdo->query("SELECT r.*, e.event_name FROM registrations r JOIN events e ON r.event_id = e.event_id ORDER BY r.registered_at DESC LIMIT 10")->fetchAll();

$pageTitle = 'IT RUNNER — Admin Dashboard';
require_once __DIR__ . '/../includes/header.php';
?>

<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="text-yellow"><i class="fas fa-tachometer-alt me-2"></i>ระบบหลังบ้านผู้ดูแลระบบ</h3>
        <a href="<?= base_url('index.php') ?>" class="btn btn-outline-yellow btn-sm"><i class="fas fa-eye me-1"></i> ดูหน้าเว็บ</a>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-md-6">
            <div class="card p-3 border-warning">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="text-muted small">งานวิ่งทั้งหมด</div>
                        <div class="fs-2 fw-bold text-yellow"><?= $totalEvents ?></div>
                    </div>
                    <i class="fas fa-calendar-check fa-3x text-yellow"></i>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card p-3 border-warning">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="text-muted small">ผู้สมัครวิ่งทั้งหมด</div>
                        <div class="fs-2 fw-bold text-yellow"><?= $totalRunners ?></div>
                    </div>
                    <i class="fas fa-users fa-3x text-yellow"></i>
                </div>
            </div>
        </div>
    </div>

    <h4 class="text-yellow mb-3"><i class="fas fa-list me-2"></i>รายการสมัครล่าสุด</h4>
    <div class="table-responsive">
        <table class="table table-dark table-hover align-middle">
            <thead>
                <tr class="text-yellow">
                    <th>รหัสสมัคร</th>
                    <th>ชื่อ - นามสกุล</th>
                    <th>งานวิ่ง</th>
                    <th>ไซส์เสื้อ</th>
                    <th>วันที่สมัคร</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($recentRegs)): ?>
                    <tr><td colspan="5" class="text-center text-muted">ยังไม่มีข้อมูลการสมัคร</td></tr>
                <?php else: ?>
                    <?php foreach ($recentRegs as $r): ?>
                        <tr>
                            <td class="fw-bold text-yellow"><?= htmlspecialchars($r['reg_number']) ?></td>
                            <td><?= htmlspecialchars($r['runner_firstname'] . ' ' . $r['runner_lastname']) ?></td>
                            <td><?= htmlspecialchars($r['event_name']) ?></td>
                            <td><span class="badge badge-yellow"><?= htmlspecialchars($r['shirt_size']) ?></span></td>
                            <td><?= formatDateThai($r['registered_at']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
