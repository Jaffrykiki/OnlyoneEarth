<div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3000">
   <!-- ปุ่มตัวชี้วิ่งข้างล่างสำหรับการนำทางรูปภาพใน Carousel -->
  <div class="carousel-indicators">
    <!-- ปุ่มตัวชี้วิ่งสำหรับสไลด์ 1 (เริ่มต้นที่ 0) -->
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <!-- ปุ่มตัวชี้วิ่งสำหรับสไลด์ 2 -->
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <!-- ... ทำซ้ำสำหรับสไลด์ที่เหลือ -->
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="3" aria-label="Slide 4"></button>
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="4" aria-label="Slide 5"></button>
  </div>
  <!-- ตำแหน่งแสดงรูปภาพใน Carousel -->
  <div class="carousel-inner">
    <!-- สไลด์แรกที่มีคลาส active เพื่อแสดงในขณะเริ่มต้น -->
    <div class="carousel-item active">
      <!-- รูปภาพสไลด์ที่ 1 -->
      <img src="assets/images/slider-1.jpg" height="500px" class="d-block w-100" alt="slider images">
    </div>
    <div class="carousel-item">
      <!-- รูปภาพสไลด์ที่ 2 -->
      <img src="assets/images/slider-2.jpg" height="500px" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <!-- รูปภาพสไลด์ที่ 3 -->
      <img src="assets/images/slider-3.jpg" height="500px" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <!-- รูปภาพสไลด์ที่ 4 -->
      <img src="assets/images/slider-4.jpg" height="500px" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <!-- รูปภาพสไลด์ที่ 5 -->
      <img src="assets/images/slider-5.jpg" height="500px" class="d-block w-100" alt="...">
    </div>
  </div>
  <!-- ปุ่มเลื่อนสไลด์ก่อนหน้าและถัดไป -->
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>