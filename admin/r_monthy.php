<div class="container">
    <div class="row">
        <div class="col-md-12">
            <?php
            // ตั้งค่าเพื่อให้เวลาและวันที่แสดงผลเป็นภาษาไทย
            setlocale(LC_TIME, 'th_TH.utf8');
            $formatter = new IntlDateFormatter('th_TH', IntlDateFormatter::LONG, IntlDateFormatter::NONE);
            
            // ส่วนนี้เป็นการสร้างคิวรี่เพื่อเรียกดูข้อมูลสำหรับรายงานรายเดือน
            $query = "
            SELECT price,qty, SUM(price * qty) AS totol, DATE_FORMAT(created_at, '%M-%Y') AS created_at
            FROM order_items
            GROUP BY DATE_FORMAT(created_at, '%m%')
            ORDER BY DATE_FORMAT(created_at, '%Y-%m-%d') 
            ";

            $result = mysqli_query($connection, $query);
            $resultchart = mysqli_query($connection, $query);

            // สำหรับสร้างข้อมูลกราฟ
            $datesave = array();
            $totol = array();
            while ($rs = mysqli_fetch_array($resultchart)) {
                $datesave[] = "\"" . $rs['created_at'] . "\"";
                $totol[] = "\"" . $rs['totol'] . "\"";
            }
            $datesave = implode(",", $datesave);
            $totol = implode(",", $totol);

            ?>
            <h3 align="center">รายงานในแบบรายเดือน</h3>

            <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.bundle.js"></script>
            <hr>
            <p align="center">
                <!--devbanban.com-->
                <canvas id="myChart" width="800px" height="300px"></canvas>
                <script>
                    var ctx = document.getElementById("myChart").getContext('2d');
                    var myChart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: [<?php echo $datesave; ?>

                            ],
                            datasets: [{
                                label: 'รายงานรายได้ แยกตามเดือน (บาท)',
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

            <div class="col-sm-7">
                <h3>รายการ</h3>
                <table class="table table-striped" border="1" cellpadding="0" cellspacing="0" align="center">
                    <thead>
                        <tr class="table-primary">
                            <th width="30%">ว/ด/ป</th>
                            <th width="70%">
                                <center>รายได้</center>
                            </th>
                        </tr>
                    </thead>

                    <?php
                    $amount_total = 0; // กำหนดค่าเริ่มต้นให้ $amount_total เป็น 0
                    while ($row = mysqli_fetch_array($result)) {
                        $date = new DateTime($row['created_at']); // สร้างวัตถุ DateTime จากวันที่

                        // แปลงเดือนให้เป็นภาษาไทย
                            $thaiMonths = array(
                                'January' => 'มกราคม',
                                'February' => 'กุมภาพันธ์',
                                'March' => 'มีนาคม',
                                'April' => 'เมษายน',
                                'May' => 'พฤษภาคม',
                                'June' => 'มิถุนายน',
                                'July' => 'กรกฎาคม',
                                'August' => 'สิงหาคม',
                                'September' => 'กันยายน',
                                'October' => 'ตุลาคม',
                                'November' => 'พฤศจิกายน',
                                'December' => 'ธันวาคม'
                            );

                             // แปลงเป็นปีพุทธศักราช (พ.ศ.) โดยเพิ่ม 543 ปี
                            $yearBuddhistEra = $date->format('Y') + 543;
                            $formattedDate = $date->format('F Y');
                            $formattedDateThai = strtr($formattedDate, $thaiMonths);

                            // แสดงผลวันที่ในรูปแบบ "เดือน ปี พ.ศ."
                            $formattedDateThai = "{$thaiMonths[$date->format('F')]} {$yearBuddhistEra}";
                    ?>
                        <tr>
                            <td><?php echo $formattedDateThai; ?></td>
                            <td align="right"><?php echo number_format($row['totol'], 2); ?></td>
                        </tr>
                    <?php
                        @$amount_total += $row['totol'];
                    }
                    if (mysqli_num_rows($result) > 0) {
                    ?>
                        <tr class="table-danger">
                            <td align="center">รวม</td>
                            <td align="right"><b><?php echo number_format($amount_total, 2); ?></b></td>
                            </td>
                        </tr>
                    <?php
                    } else {
                    ?>
                        <tr>
                            <td colspan="2" align="center">ไม่มีข้อมูลรายเดือน</td>
                        </tr>
                    <?php
                    }
                    ?>
                </table>
            </div>
            <?php mysqli_close($connection); ?>
        </div>
    </div>
</div>