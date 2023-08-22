<!-- ส่วนของ Footer ที่แสดงข้อมูลท้ายหน้าเว็บ -->
<footer class="footer pt-5">
    <div class="container-fluid">
        <div class="row align-items-center justify-content-lg-between">
            <div class="col-lg-12">
                <!-- รายการนำทางใน Footer -->
                <ul class="nav nav-footer justify-content-center justify-content-lg-end">
                    <!-- รายการที่ 1: เกี่ยวกับเรา -->
                    <li class="nav-item">
                        <a href="https://www.facebook.com/autsadawut.plaglamyong/" class="nav-link pe-0 text-muted" target="_blank">เกี่ยวกับเรา</a>
                    </li>
                    <!-- รายการที่ 2: บริการ -->
                    <li class="nav-item">
                        <a href="https://www.facebook.com/autsadawut.plaglamyong/" class="nav-link pe-0 text-muted" target="_blank">บริการ</a>
                    </li>
                    <!-- รายการที่ 3: ติดต่อ -->
                    <li class="nav-item">
                        <a href="https://www.facebook.com/messages/t/100036370098825" class="nav-link pe-0 text-muted" target="_blank">ติดต่อ</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</footer>
<!-- รายการที่ 4: เกี่ยวกับ -->
</main>

<!-- ส่วนของ Script สำหรับการโหลดและใช้งานไฟล์ JavaScript -->
<script src="assets/js/jquery-3.7.0.min.js"></script>
<script src="assets/js/bootstrap.bundle.min.js"></script>
<!-- เป็นไลบรารี Perfect Scrollbar ที่ช่วยในการเพิ่มการเลื่อนแบบ custom เพื่อปรับแต่งการเลื่อนบนเว็บไซต์ของคุณ คุณสามารถกำหนดสไตล์เลื่อนได้ตามต้องการ -->
<script src="assets/js/perfect-scrollbar.min.js"></script>

<!-- เป็นไลบรารี Perfect Scrollbar ที่ช่วยในการเพิ่มการเลื่อนแบบ custom เพื่อปรับแต่งการเลื่อนบนเว็บไซต์ของคุณ คุณสามารถกำหนดสไตล์เลื่อนได้ตามต้องการ -->
<script src="assets/js/smooth-scrollbar.min.js"></script>

<!-- CDN สำหรับ SweetAlert -->
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<!-- ไฟล์ JavaScript ที่กำหนดเองสำหรับเว็บไซต์ -->
<script src="assets/js/custom.js"></script>





<!-- ALERTIFY JS -->
<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

<!-- ส่วนของ Script สำหรับแสดงการแจ้งเตือน -->
<script>
    <?php
    if (isset($_SESSION['message'])) { ?>
        // ตั้งค่าตำแหน่งแจ้งเตือนและแสดงข้อความแจ้งเตือน
        alertify.set('notifier', 'position', 'top-right');
        alertify.success('<?= $_SESSION['message']; ?>');
        // ลบข้อมูลใน session 'message' เพื่อไม่ให้แสดงซ้ำ
    <?php
        unset($_SESSION['message']);
    }
    ?>
</script>
<!-- จบส่วนของ Script -->
</body>

</html>