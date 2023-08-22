    <!-- เรียกใช้ไลบรารี jQuery -->
    <script src="assets/js/jquery-3.7.0.min.js"></script>

    <!-- เรียกใช้ไลบรารี jQuery -->
    <script src="assets/js/bootstrap.bundle.min.js"></script>

    <!-- เรียกใช้ไฟล์ JavaScript ที่กำหนดเอง -->
    <script src="assets/js/custom.js"></script>

    <!-- CDN สำหรับ SweetAlert -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


    <!-- เรียกใช้ไลบรารี Owl Carousel -->
    <script src="assets/js/owl.carousel.min.js"></script>

    
    <!-- เรียกใช้ไฟล์ JavaScript สำหรับ Alertify js แสดงแจ้งเตือน -->
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

    <script>
        // กำหนดตำแหน่งแจ้งเตือน Alertify js เป็นด้านบน-ขวา
        alertify.set('notifier', 'position', 'top-right');
        <?php
        // ตรวจสอบว่ามีข้อความแจ้งเตือนใน session หรือไม่
        if (isset($_SESSION['message'])) 
        { 
            ?>
            // แสดงแจ้งเตือนเมื่อมีข้อความใน session แล้วลบ session ทิ้ง
            alertify.success('<?= $_SESSION['message']; ?>');
        <?php
            // ลบข้อความแจ้งเตือนที่ถูกแสดงแล้วออกจาก session
            unset($_SESSION['message']);
        }
        ?>
    </script>

<!-- เริ่มส่วนท้ายเว็บ -->
<div class="py-5 bg-dark">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <!-- เมนูด้านซ้ายของ footer -->
                <h4 class="text-white">Only One Earth</h4>
                <div class="underline mb-2"></div>
                <a href="index.php" class="text-white"> <i class="fa fa-angle-right"></i> หน้าแรก </a> <br>
                <a href="index.php#about-me" class="text-white"> <i class="fa fa-angle-right"></i> เกี่ยวกับฉัน </a><br>
                <a href="cart.php" class="text-white"> <i class="fa fa-angle-right"></i> ตระกร้าสินค้าของฉัน </a><br>
                <a href="categories.php" class="text-white"> <i class="fa fa-angle-right"></i> หมวดหมู่สินค้า </a><br>
                <a href="help_center.php" class="text-white"> <i class="fa fa-angle-right"></i> ศูนย์ช่วยเหลือ </a>
            </div>
            <div class="col-md-3">
                <!-- ข้อมูลการติดต่อของ footer -->
                <h4 class="text-white">ที่ตั้งของเรา</h4>
                <p class="text-white">
                    41 ตำบล ขามเรียง อำเภอกันทรวิชัย มหาสารคาม 44150
                </p>
                <a href="tel:0642130133" target="_blank"><i class="fa fa-phone"></i> 0642130133</a> <br>
                <a href="mailto:63011211056@msu.ac.th" target="_blank"><i class="fa fa-envelope"></i> 63011211056@msu.ac.th</a> <br>
                <a href="https://www.facebook.com/autsadawut.plaglamyong/" target="_blank"><i class="fa fa-facebook"></i> Autsadawut Plaglamyong</a> <br>
                <a href="https://www.instagram.com/jaffrykiki/" target="_blank"><i class="fa fa-instagram"></i> Jaffrykiki</a>

            </div>
            <div class="col-md-6">
                <!-- ข้อมูลการติดต่อของ footer -->
                <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15322.165702905559!2d103.2490469!3d16.2439983!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3122a6a4f3069f8b%3A0xf02b541f28931c0!2z4Lih4Lir4Liy4Lin4Li04LiX4Lii4Liy4Lil4Lix4Lii4Lih4Lir4Liy4Liq4Liy4Lij4LiE4Liy4Lih!5e0!3m2!1sth!2sth!4v1691395131352!5m2!1sth!2sth" class="w-100" height="250" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </div>
</div>

    </body>

    </html>