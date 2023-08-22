$(document).ready(function ()  {

    // เมื่อคลิกที่ปุ่มเพิ่มจำนวนสินค้า
    $(document).on('click','.increment-btn', function (e) {

        e.preventDefault();

        // ดึงค่าจำนวนสินค้าปัจจุบัน
        var qty = $(this).closest('.product_data').find('.input-qty').val();
        
        // แปลงเป็นตัวเลขและเพิ่มค่า 1
        var value = parseInt(qty, 10);
        value = isNaN(value) ? 0 : value;
        if(value < 10)
        {
            value++;
            $(this).closest('.product_data').find('.input-qty').val(value);
        }
    });

    // เมื่อคลิกที่ปุ่มลดจำนวนสินค้า
        $(document).on('click','.decrement-btn', function (e) {   
        e.preventDefault();

        // ดึงค่าจำนวนสินค้าปัจจุบัน
        var qty = $(this).closest('.product_data').find('.input-qty').val();
        
        // แปลงเป็นตัวเลขและลดค่า 1
        var value = parseInt(qty, 10);
        value = isNaN(value) ? 0 : value;
        if(value > 1)
        {
            value--;
            $(this).closest('.product_data').find('.input-qty').val(value);
        }
    });

    // เมื่อคลิกที่ปุ่มเพิ่มสินค้าลงตระกร้า
        $(document).on('click','.addToCartBtn', function (e) { 
              
        
        e.preventDefault();

        // ดึงค่าจำนวนสินค้าและรหัสสินค้า
        var qty = $(this).closest('.product_data').find('.input-qty').val();
        var prod_id = $(this).val();

        // console.log("Product ID:", prod_id);
        // console.log("Quantity:", qty);

        
        // ส่งข้อมูลผ่าน Ajax เพื่อเพิ่มสินค้าลงตระกร้า
        $.ajax({
            method: "POST",
            url: "funtion/handlecart.php",
           data: {
                "prod_id": prod_id,
                "prod_qty": qty,
                "scope": "add" 
            },
            success: function (response)  {

                
                // แสดงข้อความตามผลการทำงาน
                if(response == 201)
                {
                    alertify.success("สินค้าถูกเพิ่มลงตระกร้าเรียบร้อยแล้ว");
                }
                else if(response == "existing")
                {
                    alertify.success("สินค้าอยู่ในตระกร้าแล้ว");
                }
                else if(response == 401)
                {
                    alertify.success("กรุณาเข้าสู่ระบบเพื่อดำเนินการต่อ");
                }
                else if(response == 500)
                {
                    alertify.success("มีบางอย่างผิดพลาด ติดต่อแอดมินสมถุย");
                }
            },            
        });
    });

    // เมื่อคลิกที่ปุ่มเพื่อเพิ่มหรือลดจำนวนสินค้าในตระกร้า
    $(document).on('click','.updateQty', function () {

        // ดึงค่าจำนวนสินค้าและรหัสสินค้า
        var qty = $(this).closest('.product_data').find('.input-qty').val();
        var prod_id = $(this).closest('.product_data').find('.prodId').val();

        // ส่งข้อมูลผ่าน Ajax เพื่ออัปเดตจำนวนสินค้าในตระกร้า
        $.ajax({
            method: "POST",
            url: "funtion/handlecart.php",
            data: {
                "prod_id": prod_id,
                "prod_qty": qty,
                "scope": "update"
            },
            success: function (response) {
                // ไม่ต้องทำอะไรเพิ่มเนื่องจากเป็นการอัปเดตเพียงค่าจำนวนสินค้าในฐานข้อมูล
            }
        });
    });

    // เมื่อคลิกที่ปุ่มลบสินค้าในตระกร้า
    $(document).on('click','.deleteItem' , function () {
        var cart_id = $(this).val();

        // เมื่อคลิกที่ปุ่มลบสินค้าในตระกร้า
        $.ajax({
            method: "POST",
            url: "funtion/handlecart.php",
            data: {
                "cart_id": cart_id,
                "scope": "delete"
            },
            success: function (response) {
                if(response == 200)
                {
                    alertify.success("ลบสินค้าในตระกร้าเรียบร้อยแล้ว");
                    // โหลดส่วนตระกร้าสินค้าใหม่เพื่อแสดงข้อมูลที่อัปเดตแล้ว
                    $('#mycart').load(location.href + " #mycart");
                }else{
                    alertify.success(response);
                }
            }
        });
        
    });

    //ยกเลิกคำสั่งซื้อ
    $(document).on('click', '.cancel_order', function () {
        console.log("Cancel button clicked.");

        var status = $(this).data('status');
        var trackingNo = $(this).data('tracking');

         // ตรวจสอบค่าที่ได้
        console.log('Status:', status);
        console.log('Tracking No:', trackingNo);
      
        swal({
          title: "คุณแน่ใจใช่ไหม?",
          text: "เมื่อยกเลิกแล้ว คุณจะไม่สามารถแก้ไขอะไรได้!!",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {
            $.ajax({
              method: "POST",
              url: "funtion/placeorder.php",
              data: {
                'tracking_no': trackingNo,
                'cancel_order': true,
                'status': status
              },
              success: function (response) {
                console.log('Response from AJAX:', response);
                if (response == 200) {    
                    swal("สำเร็จแล้ว!", "ยกเลิกคำสั่งซื้อแล้ว!", "success");
                    alertify.success("ยกเลิกคำสั่งซื้อเรียบร้อยแล้ว");

                        // รอสักครู่ก่อนที่จะเปลี่ยนเส้นทางไปยังหน้า view-order.php
                    setTimeout(function() {
                    window.location.href = "view-order.php?t=" + trackingNo;
                }, 4000); // 4000 คือเวลาในหน่วยมิลลิวินาที (คือ 4 วินาที)
                } else {
                    swal("ผิดพลาด!", "มีบางอย่างผิดพลาด!", "warning");
                }
              }
            });
          }
        });
      });
      

});