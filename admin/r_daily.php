<div class="container">
    <div class="row">
        <div class="col-md-12">
            <?php
            $query = "
            SELECT prod_id,	price, SUM(	price) AS totol, DATE_FORMAT(created_at, '%d-%M-%Y') AS created_at
            FROM order_items
            GROUP BY DATE_FORMAT(created_at, '%d%')
            ORDER BY DATE_FORMAT(created_at, '%Y-%m-%d')  
            ";
            $result = mysqli_query($connection, $query);
            $resultchart = mysqli_query($connection, $query);
            //for chart
            $datesave = array();
            $totol = array();
            while($rs = mysqli_fetch_array($resultchart)){
            $datesave[] = "\"".$rs['created_at']."\"";
            $totol[] = "\"".$rs['totol']."\"";
            }
            $datesave = implode(",", $datesave);
            $totol = implode(",", $totol);
            
            ?>
            <h3 align="center">รายงานในแบบรายวัน</h3>
            
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
                labels: [<?php echo $datesave;?>
                
                ],
                datasets: [{
                label: 'รายงานรายได้ แยกตามวัน (บาท)',
                data: [<?php echo $totol;?>
                ],
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
                beginAtZero:true
                }
                }]
                }
                }
                });
                </script>
            </p>
            <div class="col-sm-12">
                <h3>List</h3>
                <table  class="table table-striped" border="1" cellpadding="0"  cellspacing="0" align="center">
                    <thead>
                        <tr class="table-primary">
                            <th width="20%">ว/ด/ป</th>
                            <th width="50%">รายละเอียด</th>
                            <th width="10%"><center>รายได้</center></th>
                        </tr>
                    </thead>
                    
                    
                    <?php 
					
		   $sql = "
           SELECT 
           oi.*, 
           p.`name` AS product_name
       FROM 
           `order_items` AS oi
       JOIN 
           `products` AS p ON oi.`prod_id` = p.`id`
       ORDER BY 
           oi.`id`;
       
            ";
            $result2 = mysqli_query($connection, $sql);
					while($row2 = mysqli_fetch_array($result2)) { 
					
					?>
                    <tr>
                        <td><?php echo $row2['created_at'];?></td>
                        <td><?php echo $row2['product_name'];?></td>
                        <td align="right"><?php echo number_format($row2['price'],2);?></td>
                    </tr>
                    <?php
                    @$amount_total += $row2['price'];
                    }
                    ?>
                    <tr class="table-danger">
                         <td align="center"></td>
                        <td align="center">รวม</td>
                        <td align="right"><b>
                        <?php echo number_format($amount_total,2);?></b></td></td>
                    </tr>
                </table>
            </div>
            <?php mysqli_close($connection);?>
        </div>
    </div>
</div>