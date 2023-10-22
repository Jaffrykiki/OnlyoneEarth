<?php
include('../middleware/adminMiddleware.php'); // นำเข้าไฟล์ middleware adminMiddleware.php เพื่อตรวจสอบสิทธิ์ผู้ดูแลระบบ
include('includes/header.php');
?>

<!-- เริ่มต้นส่วนของเนื้อหา -->
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>เพิ่มสินค้า</h4>
                </div>
                <div class="card-body" style="margin-top: -40px;">
                    <!-- แบบฟอร์มสำหรับเพิ่มสินค้า -->
                    <form action="code.php" method="POST" enctype="multipart/form-data">
                        <div class="row mb-4">
                            <div class="col-md-5">
                                <label class="mb-0">เลือกหมวดหมู่</label>
                                <!-- เลือกหมวดหมู่สำหรับสินค้า -->
                                <select name="category_id" class="form-select mb-2">
                                    <option selected>เลือกหมวดหมู่</option>
                                    <?php
                                    $categories = getAll_category();

                                    if (mysqli_num_rows($categories) > 0) {
                                        foreach ($categories as $item) {
                                    ?>
                                            <option value="<?= $item['id']; ?>"><?= $item['name']; ?></option>
                                    <?php
                                        }
                                    } else {
                                        echo "ไม่มีหมวดหมู่";
                                    }

                                    ?>
                                </select>
                            </div>
                            <div class="col-md-12">
                                <label class="mb-0">ชื่อ</label>
                                <input type="text" required name="name" placeholder="ป้อนชื่อสินค้า" class="form-control mb-2">
                            </div>
                            <div class="col-md-12">
                                <label class="mb-0">รายละเอียดสินค้า</label>
                                <textarea rows="3" required name="detail" placeholder="ป้อนรายละเอียดสินค้า (ไม่ต่ำกว่า 10 ตัวอักษร)" class="form-control mb-2" minlength="10"></textarea>
                            </div>
                            <div class="col-md-12">
                                <label class="mb-0">อัปโหลดรูปภาพสินค้า</label>
                                <input type="file" required name="images[]" multiple accept="image/*" class="form-control mb-2" id="imageUpload">
                            </div>
                            <div class="col-md-6">
                                <label class="mb-0">ราคา</label>
                                <input type="text" required name="price" placeholder="ป้อนราคาสินค้า" class="form-control mb-2" pattern="[0-9]+(\.[0-9]{2})?" title="กรุณาป้อนราคาสินค้าให้ถูกต้อง (ตัวอย่าง: 100.00)">
                            </div>
                            <div class="col-md-6">
                                <label class="mb-0">จำนวน</label>
                                <input type="number" required name="num" placeholder="ป้อนจำนวนสินค้า" class="form-control mb-2" min="0" step="1">
                            </div>
                            <div class="col-md-3">
                                <label class="mb-0">กำลังมาแรง</label>
                                <input type="checkbox" name="trending">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary" name="add_product_btn">บันทึก</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('includes/footer.php') ?>

<script>
    // เมื่อมีการเลือกไฟล์ใน input
    document.getElementById('imageUpload').addEventListener('change', function(e) {
        // ดึงรายการไฟล์ที่ถูกเลือก
        var files = e.target.files;

        // เรียงลำดับไฟล์โดยใช้ชื่อไฟล์
        var sortedFiles = Array.from(files).sort(function(a, b) {
            return a.name.localeCompare(b.name);
        });

        // สร้าง FormData ใหม่และเพิ่มไฟล์เรียงลำดับลงในนั้น
        var formData = new FormData();
        sortedFiles.forEach(function(file) {
            formData.append('images[]', file);
        });

    });
</script>