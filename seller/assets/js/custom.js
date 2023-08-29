$(document).ready(function () {

  // เมื่อคลิกที่ elements ที่มี class "delete_product_btn"
  $(document).on('click', '.delete_product_btn', function (e) {

    e.preventDefault(); //// ป้องกันการทำงานเดี๋ยวก่อนจากการคลิกลิงก์หรือปุ่ม

    var id = $(this).val(); // ป้องกันการทำงานเดี๋ยวก่อนจากการคลิกลิงก์หรือปุ่ม
    
    // แสดงหน้าต่างแจ้งเตือนสำหรับการยืนยันการลบสินค้า
    swal({
        title: "คุณแน่ใจใช่ไหม?",
        text: "เมื่อลบแล้ว คุณจะไม่สามารถกู้คืนได้!!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) { // ถ้าผู้ใช้กดปุ่ม "ตกลง"

          // ส่งคำร้องขอไปยังไฟล์ "code.php" เพื่อลบสินค้า
          $.ajax({
            method: "POST",
            url: "code.php",
            data: {
                'product_id':id,
                'delete_product_btn': true
            },
            success: function (responce) {
                    if(responce == 200)
                    {
                        swal("สำเร็จแล้ว!", "ลบสินค้ารียบร้อยแล้ว!", "success").then(function() {
                          location.reload(); // รีเฟรชหน้า
                        });
                    }
                    else if(responce == 500)
                    {
                        swal("ผิดพลาด!", "มีบางอย่างผิดพลาด!", "warning");
                    }
                }
          });
        }
      });

});

});