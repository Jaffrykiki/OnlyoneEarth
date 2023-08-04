$(document).ready(function ()  {

    //เพิ่มจำนวนสินค้า
    $(document).on('click','.increment-btn', function (e) {

        e.preventDefault();

        var qty = $(this).closest('.product_data').find('.input-qty').val();
        
        var value = parseInt(qty, 10);
        value = isNaN(value) ? 0 : value;
        if(value < 10)
        {
            value++;
            $(this).closest('.product_data').find('.input-qty').val(value);
        }
    });

    //ลดจำนวนสินค้า
        $(document).on('click','.decrement-btn', function (e) {   
        e.preventDefault();

        var qty = $(this).closest('.product_data').find('.input-qty').val();
        
        var value = parseInt(qty, 10);
        value = isNaN(value) ? 0 : value;
        if(value > 1)
        {
            value--;
            $(this).closest('.product_data').find('.input-qty').val(value);
        }
    });

    //เพิ่มสินค้าลงตระกร้า
        $(document).on('click','.addToCartBtn', function (e) {   
        
        e.preventDefault();

        var qty = $(this).closest('.product_data').find('.input-qty').val();
        var prod_id = $(this).val();
        
        $.ajax({
            method: "POST",
            url: "funtion/handlecart.php",
            data: {
                "prod_id": prod_id,
                "prod_qty": qty,
                "scope": "add"
            },
            success: function (response)  {
                
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

    //เพิ่ม ลด จำนวนสินค้าในตระกร้า
    $(document).on('click','.updateQty', function () {

        var qty = $(this).closest('.product_data').find('.input-qty').val();
        var prod_id = $(this).closest('.product_data').find('.prodId').val();

        $.ajax({
            method: "POST",
            url: "funtion/handlecart.php",
            data: {
                "prod_id": prod_id,
                "prod_qty": qty,
                "scope": "update"
            },
            success: function (response) {
                // alert(response);
            }
        });
    });

    //ลบสินค้าในตระกร้า
    $(document).on('click','.deleteItem' , function () {
        var cart_id = $(this).val();
        // alert(cart_id);

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
                    $('#mycart').load(location.href + " #mycart");
                }else{
                    alertify.success(response);
                }
            }
        });
        
    });

});