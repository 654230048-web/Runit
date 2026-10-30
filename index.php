<?php
require_once __DIR__ . '/config/database.php';
require_once __DIR__ . '/classes/Database.php';
require_once __DIR__ . '/classes/Event.php';
require_once __DIR__ . '/includes/functions.php';

$province = !empty($_GET['province']) ? cleanInput($_GET['province']) : null;
$category = !empty($_GET['category']) ? cleanInput($_GET['category']) : null;

$eventModel = new Event();
$events = $eventModel->getEvents($province, $category);

$pageTitle = 'IT RUNNER — ปฏิทินงานวิ่งออนไลน์';
require_once __DIR__ . '/includes/header.php';
?>

<div class="hero-banner text-center">
    <div class="container">
        <h1 class="display-5 fw-bold text-yellow"><i class="fas fa-bolt me-2"></i>IT RUNNER CALENDAR</h1>
        <p class="lead text-light">ศูนย์รวมข้อมูลและลงทะเบียนงานวิ่ง สายสุขภาพและไอที จังหวัดนครปฐม</p>
    </div>
</div>

<div class="container py-5">
    <div class="card p-4 mb-4">
        <form method="GET" action="" class="row g-3 align-items-end">
            <div class="col-md-5">
                <label class="form-label text-yellow"><i class="fas fa-map-marker-alt me-1"></i> เลือกจังหวัด</label>
                <select name="province" class="form-select">
                    <option value="">-- ทุกจังหวัด --</option>
                    <option value="นครปฐม" <?= $province === 'นครปฐม' ? 'selected' : '' ?>>นครปฐม</option>
                    <option value="กรุงเทพมหานคร" <?= $province === 'กรุงเทพมหานคร' ? 'selected' : '' ?>>กรุงเทพมหานคร</option>
                    <option value="ราชบุรี" <?= $province === 'ราชบุรี' ? 'selected' : '' ?>>ราชบุรี</option>
                    <option value="นนทบุรี" <?= $province === 'นนทบุรี' ? 'selected' : '' ?>>นนทบุรี</option>
                </select>
            </div>
            <div class="col-md-5">
                <label class="form-label text-yellow"><i class="fas fa-running me-1"></i> ประเภทระยะทาง</label>
                <select name="category" class="form-select">
                    <option value="">-- ทุกประเภท --</option>
                    <option value="Fun Run" <?= $category === 'Fun Run' ? 'selected' : '' ?>>Fun Run (3 - 5 กม.)</option>
                    <option value="Mini Marathon" <?= $category === 'Mini Marathon' ? 'selected' : '' ?>>Mini Marathon (10.5 กม.)</option>
                    <option value="Half Marathon" <?= $category === 'Half Marathon' ? 'selected' : '' ?>>Half Marathon (21 กม.)</option>
                    <option value="Full Marathon" <?= $category === 'Full Marathon' ? 'selected' : '' ?>>Full Marathon (42 กม.)</option>
                </select>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-yellow w-100"><i class="fas fa-search me-1"></i> ค้นหา</button>
            </div>
        </form>
    </div>

    <h4 class="mb-4 text-yellow"><i class="fas fa-flag me-2"></i>รายการงานวิ่งที่เปิดรับสมัคร</h4>

    <div class="row g-4">
        <?php if (empty($events)): ?>
            <div class="col-12 text-center py-5">
                <i class="fas fa-calendar-times fa-3x text-muted mb-3"></i>
                <p class="text-muted">ไม่พบรายการงานวิ่งตามเงื่อนไขที่เลือก</p>
                <a href="<?= base_url('index.php') ?>" class="btn btn-outline-yellow btn-sm">ดูงานวิ่งทั้งหมด</a>
            </div>
        <?php else: ?>
            <?php foreach ($events as $ev): ?>
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100">
                        <div class="card-body d-flex flex-column">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="badge badge-yellow"><?= htmlspecialchars($ev['category']) ?></span>
                                <small class="text-muted"><i class="fas fa-calendar-day me-1 text-yellow"></i> <?= formatDateThai($ev['event_date']) ?></small>
                            </div>
                            <h5 class="card-title text-white mt-2"><?= htmlspecialchars($ev['event_name']) ?></h5>
                            <p class="card-text text-muted small mb-3">
                                <i class="fas fa-map-marker-alt text-yellow me-1"></i> <?= htmlspecialchars($ev['location_venue']) ?>, จ.<?= htmlspecialchars($ev['location_province']) ?>
                            </p>
                            <div class="mt-auto d-flex justify-content-between align-items-center pt-3 border-top border-secondary">
                                <span class="fs-5 fw-bold text-yellow">฿<?= number_format($ev['price'], 2) ?></span>
                                <a href="<?= base_url('register.php?event_id=' . $ev['event_id']) ?>" class="btn btn-yellow btn-sm">
                                    <i class="fas fa-pen me-1"></i> สมัครวิ่ง
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
