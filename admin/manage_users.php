<?php
include('../middleware/adminMiddleware.php');
include('includes/header.php');

?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card" style="width: 70rem;">
                <div class="card-header">
                    <h4>Users</h4>
                </div>
                <div class="card-body" id="users_table">
                    <table class="table table-dark table-striped">
                        <thead>
                            <tr>
                                <th>ไอดีผู้ใช้</th>
                                <th>ไอดีบทบาท</th>
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
                            $users = getAll("users");
                            if (mysqli_num_rows($users) > 0) {
                                foreach ($users as $item) {
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
                                echo "ไม่พบบันทึก";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>




<?php include('includes/footer.php') ?>