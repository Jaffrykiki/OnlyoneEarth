<?php

include('funtion/userfunction.php');

include('includes/header.php');
include('includes/navbar.php'); 
include('includes/slider.php');
include('connection/dbcon.php');

//query
$query=mysqli_query($connection,"SELECT COUNT(id) FROM `products`");
	$row = mysqli_fetch_row($query);

	$rows = $row[0];

	$page_rows = 8;  //จำนวนข้อมูลที่ต้องการให้แสดงใน 1 หน้า  ตย. 5 record / หน้า 

	$last = ceil($rows/$page_rows);

	if($last < 1){
		$last = 1;
	}

	$pagenum = 1;

	if(isset($_GET['pn'])){
		$pagenum = preg_replace('#[^0-9]#', '', $_GET['pn']);
	}

	if ($pagenum < 1) {
		$pagenum = 1;
	}
	else if ($pagenum > $last) {
		$pagenum = $last;
	}

	$limit = 'LIMIT ' .($pagenum - 1) * $page_rows .',' .$page_rows;

	$nquery=mysqli_query($connection,"SELECT * from  products $limit");

	$paginationCtrls = '';

	if($last != 1){

	if ($pagenum > 1) {
$previous = $pagenum - 1;
		$paginationCtrls .= '<a href="'.$_SERVER['PHP_SELF'].'?pn='.$previous.'#og" class="btn btn-info">Previous</a> &nbsp; &nbsp; ';

		for($i = $pagenum-4; $i < $pagenum; $i++){
			if($i > 0){
		$paginationCtrls .= '<a href="'.$_SERVER['PHP_SELF'].'?pn='.$i.'#og" class="btn btn-primary">'.$i.'</a> &nbsp; ';
        // $paginationCtrls .= '<a href="#og" class="btn btn-primary">'.$i.'</a> &nbsp; ';
			}
	}
}

	$paginationCtrls .= ''.$pagenum.' &nbsp; ';

	for($i = $pagenum+1; $i <= $last; $i++){
		$paginationCtrls .= '<a href="'.$_SERVER['PHP_SELF'].'?pn='.$i.'#og" class="btn btn-primary">'.$i.'</a> &nbsp; ';
		if($i >= $pagenum+4){
			break;
		}
	}

if ($pagenum != $last) {
$next = $pagenum + 1;
$paginationCtrls .= ' &nbsp; &nbsp; <a href="'.$_SERVER['PHP_SELF'].'?pn='.$next.'#og" class="btn btn-info">Next</a> ';
}
	}
?>
<!-- เริ่มต้นส่วนของการแสดงสินค้าที่กำลังมาแรง -->

<div class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>สินค้าที่กำลังมาแรง</h1>
                <div class="underline mb-2"></div>
                <div class="owl-carousel">
                    <?php
                    $trendingProducts = getAllTrending(); // เรียกใช้ฟังก์ชันที่ดึงข้อมูลสินค้าที่กำลังมาแรงทั้งหมด
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

<!-- ส่วนของการแสดงสินค้าทั่วไป -->
<div  id="og" class="py-5">
    <div class="container">
        <div class="row">
            <div class="d-flex justify-content-between align-items-center"> <!-- ใช้ flexbox เพื่อจัดตำแหน่งทางซ้ายและขวา -->
                <h1  class="m-0">สินค้าทั่วไป</h1> <!-- ใช้ margin 0 เพื่อลบระยะห่างด้านบนและล่างของหัวเรื่อง -->
                <form class="d-flex m-0" role="search" style="max-width: 300px;">
                    <input class="form-control me-2" type="search" name="searchTerm" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
            <div  class="row row-cols-1 row-cols-md-4 ">
                <?php
                $Products = getAllProducts(); // เรียกใช้ฟังก์ชันที่ดึงข้อมูลสินค้าทั้งหมด
                if (mysqli_num_rows($Products) > 0)
                    foreach ($Products as $item)
                ?>
                <?php
        $Products = getAllProducts("products");
        if (isset($_GET['searchTerm']) && !empty($_GET['searchTerm'])) {
            $searchTerm = $_GET['searchTerm'];
            // <!-- ดึงข้อมูลสินค้าจากคำค้นหา -->
            $products = searchProducts($searchTerm);
            if (!empty($products)) {
                foreach ($products as $product) {
                ?>
                            <div class="col">
                                <div class="item">
                                    <a href="product-view.php?product=<?= $product['name']; ?>">
                                        <div class="card shadow">
                                            <img src="uploads/<?= $product['image']; ?>" width="300" height="300" alt="Product image" class="w-100">
                                            <div class="card-body">
                                                <h5 class="card-title"><?= $product['name']; ?></h5>
                                            </div>
                                        </div>
                                </div>
                                </a>
                            </div>
                        <?php
                    }
                } else if (empty($products)) {
                    echo "ค้นหาสินค้าไม่เจอ";
                }
            } else  if ($nquery && mysqli_num_rows($nquery) > 0) {
                while ($item = mysqli_fetch_assoc($nquery)) {
                        ?>
                        <div class="col">
                            <div class="item">
                                <a href="product-view.php?product=<?= $item['name']; ?>">
                                    <div class="card shadow">
                                        <img src="uploads/<?= $item['image']; ?>" width="300" height="300" alt="Product image" class="w-100">
                                        <div class="card-body">
                                            <h5 class="card-title"><?= $item['name']; ?></h5>
                                        </div>
                                    </div>
                            </div>
                            </a>
                        </div>
                <?php
                }
            } else {
                echo "ยังไม่มีสินค้า";
            }
                ?>
                <br>    
            </div>
            <div id="about-me" id="pagination_controls"><?php echo $paginationCtrls; ?></div>		
        </div>
    </div>
</div>

<!-- ส่วนของเกี่ยวกับฉัน -->
<div  class="py-5 bg-f2f2f2">
    <div  class="container">
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

<!-- ส่วนท้ายเว็บ -->
<div class="py-2 bg-danger">
    <div class="text-center">
        <div class="p-md-0 text-white">All rights reserved. Copyright @ <a href="https://www.facebook.com/autsadawut.plaglamyong/" target="_blank" class="text-white">Jaffry zavier</a> <?= date('Y') ?></div>
    </div>
</div>



<?php include('includes/footer.php'); ?>

<!-- สคริปต์และการใช้งาน Owl Carousel -->
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