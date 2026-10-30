# 🏃‍♂️ IT RUNNER — ระบบปฏิทินและลงทะเบียนงานวิ่ง IT (ธีมดำ-เหลือง)

เว็บแอปพลิเคชันสำหรับค้นหาและลงทะเบียนสมัครงานวิ่ง พัฒนาตามโจทย์การดัดแปลงและต่อยอดจากเว็บ Runlah เน้นสไตล์ **Dark & Gold/Yellow Theme** ป้องกันสายตาและดูสปอร์ตพรีเมียม

---

## 🎨 ธีมและโทนสี (Dark & Yellow/Gold Theme)
* **Background:** Dark `#121212` / `#1e1e1e`
* **Accent / Highlight:** Yellow/Gold `#ffcc00`
* **Typography:** White `#f5f5f5` & Light Gray `#b0b0b0`

---

## 🚀 โครงสร้างไฟล์ในโปรเจกต์

```text
it_runner/
├── admin/                 # ส่วนผู้ดูแลระบบ (Dashboard, รายการสมัครล่าสุด)
├── assets/                # ไฟล์สไตล์ดำ-เหลืองและสคริปต์
│   └── css/style.css
├── classes/               # OOP Classes (Database, Event)
├── config/                # ตั้งค่าฐานข้อมูล MySQL (database.php)
├── includes/              # ส่วนร่วมของหน้าเว็บ (header.php, footer.php, functions.php)
├── database_schema.sql    # ตารางฐานข้อมูลและข้อมูลตัวอย่างงานวิ่งนครปฐม
├── index.php              # หน้าหลักปฏิทินงานวิ่ง
└── register.php           # ฟอร์มสมัครงานวิ่ง
```

---

## 🛠️ วิธีการติดตั้งบน XAMPP และขึ้นโฮสจริง

1. แตกไฟล์ `it_runner.zip` ไปวางในโฟลเดอร์ `C:\xampp\htdocs\it_runner\`
2. สร้างฐานข้อมูลใน phpMyAdmin ชื่อ `it_runner_db` แล้ว Import ไฟล์ `database_schema.sql`
3. เข้าชมผ่านเบราว์เซอร์ที่: `http://localhost/it_runner/index.php`
