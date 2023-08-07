<?php

include('funtion/userfunction.php');
include('includes/header.php');
include('includes/slider.php');

?>

<div class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h4>สินค้าที่กำลังมาแรง</h4>
                <div class="underline mb-2"></div>

                <div class="owl-carousel">
                    <?php
                    $trendingProducts = getAllTrending();
                    if (mysqli_num_rows($trendingProducts) > 0) {
                        foreach ($trendingProducts as $item) {
                    ?>
                            <div class="item">
                                <a href="product-view.php?product=<?= $item['name']; ?>">
                                    <div class="card shadow">
                                        <div class="card-body">
                                            <div class="shadow">
                                                <img src="uploads/<?= $item['image']; ?>" width="300" height="300" alt="Product image" class="w-100">
                                                <h5 class="text-center"><?= $item['name']; ?></h5>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                    <?php
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="py-5 bg-f2f2f2">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h4>เกี่ยวกับฉัน</h4>
                <div class="underline mb-2"></div>
                <p>
                ในขณะที่อาศัยอยู่ต่างประเทศ Mr.Jaf ซีอีโอของเราเริ่มตระหนักถึงผลกระทบของการบริโภคแบบไฮเปอร์ที่มีต่อสภาพแวดล้อมทางธรรมชาติมากขึ้นภูมิทัศน์ที่ดูเหมือนจะเปลี่ยนเป็นทะเลพลาสติก ต้องการเปลี่ยนแปลงอย่างมีผลกระทบในวิธีที่เราบริโภค Ryan จินตนาการถึงตลาดที่สนับสนุนการบริโภคอย่างมีความรับผิดชอบโดยนําเสนอสินค้าที่ยั่งยืนเท่านั้น ในปี 2023 Only One Earth ได้เปิดประตูเสมือนจริงด้วยผลิตภัณฑ์เพียงไม่กี่ร้อยรายการเพื่อนําเสนอทางเลือกที่ยั่งยืนสําหรับผู้บริโภคทุกประเภททําให้การช็อปปิ้งที่ยั่งยืนเข้าถึงได้ง่ายและง่ายสําหรับทุกคน
                </p>
                <p>
                เราเริ่มต้น Only One Earth ด้วยเป้าหมายสูงสุดในการช่วยสร้างโลกที่ยั่งยืนยิ่งขึ้นโดยอนุญาตให้ผู้บริโภคเลือกซื้อผลิตภัณฑ์ที่ยั่งยืน แม้ว่าแนวทางนี้จะเป็นพื้นที่ที่เราสามารถเติบโตได้อย่างสะดวกสบาย แต่เราไม่สนใจที่จะสะดวกสบาย แต่เราอยากที่จะดีขึ้น ก้าวไปข้างหน้าเรามุ่งมั่นที่จะเพิ่มเนื้อหาการศึกษาด้านสิ่งแวดล้อมและความยั่งยืนของเราใช้แพลตฟอร์มของเราเพื่อยกระดับการซื้อของออนไลน์และเรียนรู้จากผู้เชี่ยวชาญด้านความรู้แบบดั้งเดิมและสนับสนุนสาเหตุด้านสิ่งแวดล้อมและกฎหมายต่อสาธารณะ ความยั่งยืนไม่ควรเข้าถึงได้เฉพาะผู้ที่มีทรัพยากร แต่ควรทําให้ทุกคนสามารถเข้าถึงทรัพยากรได้
            </div>
        </div>
    </div>
</div>

<div class="py-5 bg-dark">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <h4 class="text-white">Only One Earth</h4>
                <div class="underline mb-2"></div>
                <a href="index.php" class="text-white"> <i class="fa fa-angle-right"></i> หน้าแรก </a> <br>
                <a href="#" class="text-white"> <i class="fa fa-angle-right"></i> เกี่ยวกับฉัน </a><br>
                <a href="cart.php" class="text-white"> <i class="fa fa-angle-right"></i> ตระกร้าสินค้าของฉัน </a><br>
                <a href="categories.php" class="text-white"> <i class="fa fa-angle-right"></i> หมวดหมู่ </a>
            </div>
            <div class="col-md-3">
                <h4 class="text-white">ที่ตั้งของเรา</h4>
                <p class="text-white">
                    41 ตำบล ขามเรียง อำเภอกันทรวิชัย มหาสารคาม 44150
                </p>
                <a href="tel:0642130133" target="_blank" ><i class="fa fa-phone"></i> 0642130133</a> <br>
                <a href="mailto:63011211056@msu.ac.th" target="_blank"><i class="fa fa-envelope"></i> 63011211056@msu.ac.th</a> <br>
                <a href="https://www.facebook.com/autsadawut.plaglamyong/" target="_blank"><i class="fa fa-facebook"></i> Autsadawut Plaglamyong</a> <br>
                <a href="https://www.instagram.com/jaffrykiki/" target="_blank" ><i class="fa fa-instagram"></i> Jaffrykiki</a>

            </div>
            <div class="col-md-6">
            <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15322.165702905559!2d103.2490469!3d16.2439983!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3122a6a4f3069f8b%3A0xf02b541f28931c0!2z4Lih4Lir4Liy4Lin4Li04LiX4Lii4Liy4Lil4Lix4Lii4Lih4Lir4Liy4Liq4Liy4Lij4LiE4Liy4Lih!5e0!3m2!1sth!2sth!4v1691395131352!5m2!1sth!2sth" class="w-100" height="250" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </div>
</div>
<div class="py-2 bg-danger">
    <div class="text-center">
        <div class="p-md-0 text-white">All rights reserved. Copyright @ <a href="https://www.facebook.com/autsadawut.plaglamyong/" target="_blank" class="text-white">Jaffry zavier</a> <?= date('Y') ?></div>
    </div>
</div>



<?php include('includes/footer.php'); ?>

<script>
    $(document).ready(function() {
        $('.owl-carousel').owlCarousel({
            loop: true,
            margin: 10,
            nav: true,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 3
                },
                1000: {
                    items: 4
                }
            }
        })
    });
</script>