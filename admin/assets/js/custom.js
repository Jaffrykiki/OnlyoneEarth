$(document).ready(function () {


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
                        swal("สำเร็จแล้ว!", "ลบสินค้ารียบร้อยแล้ว!", "success");
                        $("#products_table").load(location.href + " #products_table");
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
                        swal("สำเร็จแล้ว!", "ลบสินค้ารียบร้อยแล้ว!", "success");
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

});