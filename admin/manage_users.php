<?php
include('../middleware/adminMiddleware.php');
include('includes/header.php');

?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card" style="width: 70rem;">
                <!-- เริ่มต้นของการแสดงผู้ใช้งาน -->
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h4 class="m-0">จัดการผู้ใช้งาน</h4>
                    <!-- แบบฟอร์มสำหรับค้นหาผู้ใช้ -->
                    <form class="d-flex m-0" role="search" style="max-width: 550px; height: 50px;">
                        <input class="form-control me-2" type="search" name="searchTerm" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success" type="submit" style="width: 200px; height: 50px;">Search</button>
                    </form>
                </div>
                <!-- ตารางแสดงผู้ใช้ -->
                <div class="card-body" id="users_table">
                    <table class="table table-dark table-striped">
                        <thead>
                            <tr>
                                <th>ไอดีผู้ใช้</th>
                                <th>บทบาท</th>
                                <th>ชื่อ</th>
                                <th>อีเมล์</th>
                                <th>เบอร์โทรศัพท์</th>
                                <th>รหัสผ่าน</th>
                                <th>รูปภาพ</th>
                                <th>แก้ไข</th>
                                <th>ลบ</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            // ดึงข้อมูลผู้ใช้ทั้งหมดจากฐานข้อมูล
                            $users = getAll("users");
                            // ตรวจสอบการค้นหาผู้ใช้
                            if (isset($_GET['searchTerm']) && !empty($_GET['searchTerm'])) {
                                $searchTerm = $_GET['searchTerm'];
                                // <!-- ดึงข้อมูลสินค้าจากคำค้นหา -->
                                $Users = searchUsers($searchTerm);
                                if (!empty($Users)) {
                                    foreach ($Users as $user) {
                                        // แสดงข้อมูลผู้ใช้ที่ค้นหา
                            ?>
                                        <tr>
                                            <td width="50px" height="50px"><?= $user['id']; ?></td>
                                            <td width="50px" height="50px">
                                                <?php
                                                if ($user['role_as'] == 0) {
                                                    echo "ผู้ซื้อ";
                                                } elseif ($user['role_as'] == 1) {
                                                    echo "แอดมิน";
                                                } elseif ($user['role_as'] == 2) {
                                                    echo "ผู้ขาย";
                                                } else {
                                                    echo "ค่าไม่ตรงกับที่คาดหวัง";
                                                }
                                                ?>
                                            </td>

                                            <td><?= $user['name']; ?></td>
                                            <td><?= $user['email']; ?></td>
                                            <td><?= $user['phone']; ?></td>
                                            <td><?= $user['password']; ?></td>
                                            <td>
                                                <img src="../uploads/<?= $user['img']; ?>" width="120px" height="120px" alt="<?= $user['name']; ?>">
                                            </td>
                                            <td>
                                                <a href="edit-users.php?id=<?= $user['id']; ?>" class="btn btn-primary">แก้ไข</a>

                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-sm btn-danger delete_users_btn" value="<?= $user['id']; ?>">ลบ</button>
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                } else if (empty($Users)) {
                                    echo "ไม่เจอผู้ใช้ที่ค้นหา";
                                }
                            } else  if (mysqli_num_rows($users) > 0) {
                                foreach ($users as $item) {
                                    // แสดงข้อมูลผู้ใช้ทั้งหมด
                                    ?>
                                    <tr>
                                        <td width="50px" height="50px"><?= $item['id']; ?></td>
                                        <td width="50px" height="50px">
                                            <?php
                                            if ($item['role_as'] == 0) {
                                                echo "ผู้ซื้อ";
                                            } elseif ($item['role_as'] == 1) {
                                                echo "แอดมิน";
                                            } elseif ($item['role_as'] == 2) {
                                                echo "ผู้ขาย";
                                            } else {
                                                echo "ค่าไม่ตรงกับที่คาดหวัง";
                                            }
                                            ?>
                                        </td>

                                        <td><?= $item['name']; ?></td>
                                        <td><?= $item['email']; ?></td>
                                        <td><?= $item['phone']; ?></td>
                                        <td><?= $item['password']; ?></td>
                                        <td>
                                            <img src="../uploads/<?= $item['img']; ?>" width="120px" height="120px" alt="<?= $item['name']; ?>">
                                        </td>
                                        <td>
                                            <a href="edit-users.php?id=<?= $item['id']; ?>" class="btn btn-primary">แก้ไข</a>

                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-danger delete_users_btn" value="<?= $item['id']; ?>">ลบ</button>
                                        </td>
                                    </tr>
                            <?php
                                }
                            } else {
                                echo "ไม่มีผู้ใช้งาน";
                            }
                            ?>
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
</div>




<?php include('includes/footer.php'); ?>