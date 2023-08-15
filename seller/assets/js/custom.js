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
                { // หากการร้องขอสำเร็จ
                  // แสดง SweetAlert แจ้งเตือนสำเร็จและรีโหลดส่วนของหน้าเว็บที่เกี่ยวข้อง
                    swal("สำเร็จ", "ลบสินค้ารียบร้อยแล้ว!", "success");
                    $("#products_table").load(location.href + " #products_table");
                }
                else if(responce == 500)
                { // หากการร้องขอผิดพลาด
                  // แสดง SweetAlert แจ้งเตือนผิดพลาด
                    swal("ผิดพลาด!", "มีบางอย่างผิดพลาด!", "ผิดพลาด");
                }
            }
          });
        }
      });

});

});