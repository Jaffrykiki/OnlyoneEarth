<div class="container">
    <div class="row">
        <div class="col-md-12">
            <?php

            // ดึงข้อมูลผู้ขายที่เข้าสู่ระบบ เพื่อใช้เป็นเงื่อนไขในการดึงรายการออเดอร์
            $sellerId = $_SESSION['auth_user']['id']; // ต้องปรับตามโครงสร้างของ session ที่ใช้ในระบบ
            //กำหนดให้คำนวณราคารวมของรายได้ในแต่ละวัน โดยใช้ DATE_FORMAT เพื่อกำหนดรูปแบบวันที่และ GROUP BY เพื่อกลุ่มข้อมูลตามวันที่ และ ORDER BY เพื่อให้ข้อมูลเรียงลำดับตามวันที่
            $query = "
            SELECT prod_id,	price,qty, SUM(price * qty) AS totol, DATE_FORMAT(created_at, '%d-%M-%Y') AS created_at
            FROM order_items
            WHERE user_id = $sellerId
            GROUP BY DATE_FORMAT(created_at, '%d%')
            ORDER BY DATE_FORMAT(created_at, '%Y-%m-%d')  
            ";
            $result = mysqli_query($connection, $query);
            $resultchart = mysqli_query($connection, $query);
            //for chart
            $datesave = array();
            $totol = array();
            while ($rs = mysqli_fetch_array($resultchart)) {
                $datesave[] = "\"" . $rs['created_at'] . "\"";
                $totol[] = "\"" . $rs['totol'] . "\"";
            }
            $datesave = implode(",", $datesave);
            $totol = implode(",", $totol);


            ?>
            <!-- โค้ดส่วนแสดงกราฟ -->
            <h3 align="center">รายงานในแบบรายวัน</h3>

            <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.bundle.js"></script>
            <hr>
            <p align="center">
                <canvas id="myChart" width="800px" height="300px"></canvas>
                
                <script>
                    // โค้ดส่วนการเขียนกราฟด้วย Chart.js
                    var ctx = document.getElementById("myChart").getContext('2d');
                    var myChart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: [<?php echo $datesave; ?>

                            ],
                            datasets: [{
                                label: 'รายงานรายได้ แยกตามวัน (บาท)',
                                data: [<?php echo $totol; ?>],
                                backgroundColor: [
                                    'rgba(255, 99, 132, 0.2)',
                                    'rgba(54, 162, 235, 0.2)',
                                    'rgba(255, 206, 86, 0.2)',
                                    'rgba(75, 192, 192, 0.2)',
                                    'rgba(153, 102, 255, 0.2)',
                                    'rgba(255, 159, 64, 0.2)'
                                ],
                                borderColor: [
                                    'rgba(255,99,132,1)',
                                    'rgba(54, 162, 235, 1)',
                                    'rgba(255, 206, 86, 1)',
                                    'rgba(75, 192, 192, 1)',
                                    'rgba(153, 102, 255, 1)',
                                    'rgba(255, 159, 64, 1)'
                                ],
                                borderWidth: 1
                            }]
                        },
                        options: {
                            scales: {
                                yAxes: [{
                                    ticks: {
                                        beginAtZero: true
                                    }
                                }]
                            }
                        }
                    });
                </script>
            </p>
            <!-- โค้ดส่วนแสดงตารางข้อมูล -->
            <div id="og" class="col-sm-12">
                <h3>รายการ</h3>
                <table class="table table-striped" border="1" cellpadding="0" cellspacing="0" align="center">
                    <thead>
                          <!-- ส่วนหัวตาราง -->
                        <tr class="table-primary">
                            <th width="20%">ว/ด/ป</th>
                            <th width="50%">รายละเอียด</th>
                            <th width="10%">
                                <center>รายได้</center>
                            </th>
                        </tr>
                    </thead>
                    <?php
                    // โค้ดส่วนคำนวณหน้าทั้งหมดและแบ่งหน้า
                    //query
                    $query = mysqli_query($connection, "SELECT COUNT(id) FROM `order_items` WHERE user_id = $sellerId");
                    $row = mysqli_fetch_row($query);

                    $rows = $row[0];

                    $page_rows = 5; // ตั้งค่าเพื่อให้แสดงข้อมูล 5 แถวต่อหน้า

                    $last = ceil($rows / $page_rows);

                    if ($last < 1) {
                        $last = 1;
                    }

                    // ตรวจสอบหน้าปัจจุบัน
                    $pagenum = 1;

                    if (isset($_GET['pn'])) {
                        $pagenum = preg_replace('#[^0-9]#', '', $_GET['pn']);
                    }

                    if ($pagenum < 1) {
                        $pagenum = 1;
                    } else if ($pagenum > $last) {
                        $pagenum = $last;
                    }

                    $limit = 'LIMIT ' . ($pagenum - 1) * $page_rows . ',' . $page_rows;

                    $nquery = mysqli_query($connection, "SELECT oi.*, p.`name` AS product_name, (oi.`price` * oi.`qty`) AS total_price
                    FROM `order_items` AS oi
                    JOIN `products` AS p ON oi.`prod_id` = p.`id`
                    WHERE oi.`user_id` = $sellerId
                    ORDER BY oi.`id`
                     $limit ");

                    $paginationCtrls = '';

                    // คำนวณจำนวนหน้าทั้งหมด
                    if ($last != 1) {

                        if ($pagenum > 1) {
                            $previous = $pagenum - 1;
                            $paginationCtrls .= '<a href="' . $_SERVER['PHP_SELF'] . '?pn=' . $previous . '#og" class="btn btn-info">Previous</a> &nbsp; &nbsp; ';

                            for ($i = $pagenum - 4; $i < $pagenum; $i++) {
                                if ($i > 0) {
                                    $paginationCtrls .= '<a href="' . $_SERVER['PHP_SELF'] . '?pn=' . $i . '#og" class="btn btn-primary">' . $i . '</a> &nbsp; ';
                                    // $paginationCtrls .= '<a href="#og" class="btn btn-primary">'.$i.'</a> &nbsp; ';
                                }
                            }
                        }

                        $paginationCtrls .= '' . $pagenum . ' &nbsp; ';

                        for ($i = $pagenum + 1; $i <= $last; $i++) {
                            $paginationCtrls .= '<a href="' . $_SERVER['PHP_SELF'] . '?pn=' . $i . '#og" class="btn btn-primary">' . $i . '</a> &nbsp; ';
                            if ($i >= $pagenum + 4) {
                                break;
                            }
                        }

                        if ($pagenum != $last) {
                            $next = $pagenum + 1;
                            $paginationCtrls .= ' &nbsp; &nbsp; <a href="' . $_SERVER['PHP_SELF'] . '?pn=' . $next . '#og" class="btn btn-info">Next</a> ';
                        }
                    }


                    $sql = "SELECT oi.*, p.`name` AS product_name FROM `order_items` AS oi JOIN 
           `products` AS p ON oi.`prod_id` = p.`id`ORDER BY oi.`id` $limit ";

                    // โค้ดส่วนแสดงรายละเอียดข้อมูลในตาราง
                    if ($nquery && mysqli_num_rows($nquery) > 0) {
                        while ($row2 = mysqli_fetch_array($nquery)) {
                    ?>
                            <tr>
                                <td><?php echo $row2['created_at']; ?></td>
                                <td><?php echo $row2['product_name']; ?></td>
                                <td align="right"><?php echo number_format($row2['total_price'], 2); ?></td>
                            </tr>
                        <?php
                            @$amount_total += $row2['total_price'];
                        }
                        ?>
                        <tr class="table-danger">
                            <td align="center"></td>
                            <td align="center">รวม</td>
                            <td align="right"><b>
                                    <?php echo number_format($amount_total, 2); ?></b></td>
                            </td>
                        </tr>
                    <?php
                    } else {
                        echo '<tr><td colspan="3" align="center">ไม่มีข้อมูล</td></tr>';
                    }
                    ?>
                </table>
            </div>
            <!-- โค้ดส่วนแสดงหน้าเพจแบ่งหน้า -->
            <div id="pagination_controls"><?php echo $paginationCtrls; ?></div>
            <?php mysqli_close($connection); ?>
        </div>
    </div>
</div>