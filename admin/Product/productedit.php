<?php
include("../route/header.php");  
include("../route/slider.php");
include("../class/product_class.php");
?>
 <!-- Lấy id  -->
<?php
 $product = new product;
 if(!isset($_GET['product_id']) || $_GET['product_id'] == NULL )
 {
    echo "<script> window.location = 'product.php' </script>";
 }
 else{
    $product_id = $_GET['product_id'];
    $get_product = $product -> get_product_id($product_id);
    if($get_product)
    {
        $result = $get_product -> fetch_assoc();
        // if($result)
        // {
        //   $product_img = $result['product_img'];
        //   unlink('uploads/'.$product_img); 
        // }
    }
}
?>
<!-- Sửa name -->
 <?php
 if($_SERVER['REQUEST_METHOD'] === 'POST'){
     $update_product = $product -> update_product();
 }
 ?>
 </script>
 <div class="admin-content-right">
            <div class="admin-content-right-cartegory-add">
                <h1>Sửa sản phẩm</h1>
                <div class="admin-content-right">
                    <div class="admin-content-right-product-add ">
                    <form action="" method="post" enctype="multipart/form-data">
                            <div class="admin-content-right-product-add-content">
                                <label for="">Nhập tên sản phẩm </label>
                                <p style="color: red;">*</p>
                            </div>
                            <input name="product_name" required type="text" 
                            value="<?php echo $result['product_name']?>">
                          
                          <!-- Cartegory id  -->
                            <div class="admin-content-right-product-add-content">
                            <label for="">Chọn danh mục</label>
                            <p style="color: red;">*</p>
                            </div>
                        <select  required name="cartegory_id" id="cartegory_id">
                            <?php
                            $show_cartegory = $product -> show_cartegory();
                            if($show_cartegory)
                            {    
                                while($result_select = $show_cartegory->fetch_assoc())
                                {
                                    if($result_select['cartegory_id'] == 
                                     $result['cartegory_id'])
                                    {
                             ?>
                              <option selected value="<?php echo $result['cartegory_id']?>"> 
                                 <?php echo $result_select['cartegory_name']?>
                            </option>
                             <?php
                                    }
                             else{
                            ?>
                             <option  value="<?php echo $result_select['cartegory_id']?>"> 
                                 <?php echo $result_select['cartegory_name']?>
                            </option>
                            <?php
                                    }
                                 }
                            }
                            ?>
                        </select>
                        <!-- Brand id  -->
                        <div class="admin-content-right-product-add-content">
                        <label for="">Chọn loại sản phẩm </label>
                        <p style="color: red;">*</p>
                        </div>
                        <select required name="brand_id" id="brand_id">
                        </select>
                        <div class="admin-content-right-product-add-content">
                                <label for="">Giá sản phẩm </label>
                                <p style="color: red;">*</p>
                        </div>
                            <input required name="product_price" type="number" value="<?php echo $result['product_price']?>">
                        <div class="admin-content-right-product-add-content">
                                <label for="">Giá khuyến mãi</label>
                                <p style="color: red;">*</p>
                        </div>
                            <input required name="product_sale" type="number" value = "<?php echo $result['product_sale'] ?>">

                        <div class="admin-content-right-product-add-content">
                            <label  for="">Màu sắc</label>
                            <p style="color: red;">*</p>
                        </div>
                        <input  required name="product_color" value="<?php echo $result['product_color']?>">

                        <div class="admin-content-right-product-add-content">
                                <label for="">Mô tả sản phẩm </label>
                                <p style="color: red;">*</p>
                        </div>

                        <div class="admin-content-right-product-add-conten-textarea">
                                <textarea id="content" name="product_desc">
                                    <?php echo $result['product_desc'] ?>
                                </textarea>
                        </div>

                        <div class="admin-content-right-product-add-content">
                                <label for="">Ảnh sản phẩm </label>
                                <p style="color: red;">*</p>
                        </div>
                            <input name="product_img" type="file" id="imgInp">
                            <img id="blah" src="../uploads/<?php echo $result["product_img"]; ?>" style="display:block ; width: 100px; height: auto;"/>
                            <button type="submit">Sửa</button>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
</html>
<script>
    // gửi qua ajax 
    $(document).ready(function(){
        $('#cartegory_id').change(function()
        {
            // alert($(this).val())
            var x = $(this).val();  
            $.get("productadd_ajax.php",{cartegory_id:x},function(data){
                $("#brand_id").html(data)
            })
        })
    })
    // 
        ClassicEditor
        .create( document.querySelector('#content'),{
            filebrowserBrowseUrl:'ckfinder/ckfinder.html',
            filebrowserUploadUrl:'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files'
        })
        .catch(error => {
            console.log(error);
        });

        // preview img b4 uploading
        const show = document.querySelector("#imgInp")
        show.addEventListener("click",function()
        {
            document.querySelector("#blah").style.display = "block"
        })
        imgInp.onchange = evt => 
        {
            const [file] = imgInp.files
            if (file) {
                blah.src = URL.createObjectURL(file)
            }
        }
</script>