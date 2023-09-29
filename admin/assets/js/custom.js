$(document).ready(function () {

    //ลบสินค้า
    $(document).on('click', '.delete_product_btn', function (e) {

        e.preventDefault();

        var id = $(this).val();
        // alert(id);

        swal({
            title: "คุณแน่ใจใช่ไหม?",
            text: "เมื่อลบแล้ว คุณจะไม่สามารถกู้คืนได้!!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
          })
          .then((willDelete) => {
            if (willDelete) {
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
                          location.reload();
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
  //ลบหมวดหมู่สินค้า
    $(document).on('click', '.delete_category_btn', function (e) {

        e.preventDefault();

        var id = $(this).val();
        // alert(id);

        swal({
            title: "คุณแน่ใจใช่ไหม?",
            text: "เมื่อลบแล้ว คุณจะไม่สามารถกู้คืนได้!!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
          })
          .then((willDelete) => {
            if (willDelete) {
              $.ajax({
                method: "POST",
                url: "code.php",
                data: {
                    'category_id':id,
                    'delete_category_btn': true
                },
                success: function (responce) {
                    if(responce == 200)
                    {
                        swal("สำเร็จแล้ว!", "ลบหมวดหมู่สินค้าเรียบร้อยแล้ว!", "success");
                        $("#category_table").load(location.href + " #category_table");
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

  //ลบผู้ใช้
    $(document).on('click', '.delete_users_btn', function (e) {

          e.preventDefault();
  
          var id = $(this).val();
  
          swal({
              title: "คุณแน่ใจใช่ไหม?",
              text: "เมื่อลบแล้ว คุณจะไม่สามารถกู้คืนได้!!",
              icon: "warning",
              buttons: true,
              dangerMode: true,
            })
            .then((willDelete) => {
              if (willDelete) {
                $.ajax({
                  method: "POST",
                  url: "code.php",
                  data: {
                      'users_id':id,
                      'delete_users_btn': true
                  },
                  success: function (responce) {
                      if(responce == 200)
                      {
                          swal("สำเร็จแล้ว!", "ลบช้อมูลผู้ใช้เรียบร้อยแล้ว!", "success");
                          $("#users_table").load(location.href + " #users_table");
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

      //ยืนยันการถอนเงิน
    $(document).on('click', '.accept_withdraw_btn', function (e) {

   
      e.preventDefault();

      var id = $(this).val();
      
      console.log("Button clicked!"); // เพิ่มคำสั่งนี้เพื่อตรวจสอบว่าคลิกปุ่ม

      console.log("ID:", id); // เพิ่มคำสั่งนี้เพื่อตรวจสอบค่า id
      

      swal({
          title: "คุณแน่ใจใช่ไหม?",
          text: "เมื่อยืนยันแล้ว คุณจะไม่สามารถกู้คืนได้!!",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {
            $.ajax({
              method: "POST",
              url: "code.php",
              data: {
                  'id':id,
                  'accept_withdraw_btn': true
              },
              success: function (responce) {
                console.log("Response:", responce); // เพิ่มคำสั่งนี้เพื่อตรวจสอบค่า responce
                  if(responce == 200)
                  {
                      swal("สำเร็จแล้ว!", "ยืนยันเรียบร้อยแล้ว!", "success").then(function() {
                        location.reload();
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