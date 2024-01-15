<?php
session_start();
?>
<?php
include("../route/header.php");  
include("../route/slider.php");
include("../class/product_class.php");
?>
   
    <?php
    $product = new product;
    if($_SERVER['REQUEST_METHOD'] == 'POST' ){
            $insert_product = $product -> insert_product();
    }
    ?>
     <?php
        if(isset($_POST['submit'])) {
        // Xử lý thêm sản phẩm
        $insert_product = $product->insert_product();
        if($insert_product) {
            // Upload thất bại
            ?>
            <script> 
            Swal.fire({
                icon: "error",
                title: "Oops...", 
                text: "Upload img failed!",
            });
            </script>
            <?php
        } else {
            // Upload thành công 
            ?>
            <script>
            Swal.fire({
                icon: "success",
                title: "Success...",
                text: "Upload img success!", 
            });
            </script>
            <?php
        }
        }
        ?>
        <div class="admin-content-right">
            <div class="admin-content-right-product-add">
                <h1>Thêm sản phẩm</h1>
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="admin-content-right-product-add-content">
                        <label for="">Nhập tên sản phẩm </label>
                        <p style="color: red;">*</p>
                    </div>
                    <input name="product_name" required type="text">
                    <div class="admin-content-right-product-add-content">
                        <label for="">Chọn danh mục</label>
                        <p style="color: red;">*</p>
                    </div>
                    <select  required name="cartegory_id" id="cartegory_id">
                         <?php
                        $show_cartegory = $product -> show_cartegory();
                        if($show_cartegory){    
                            while($result = $show_cartegory->fetch_assoc()){
                      ?>
                        <option value="<?php echo $result['cartegory_id']?>"> 
                        <?php echo $result['cartegory_name']?></option>
                          <?php
                            }
                        }
                         ?>
                    </select>
                    <div class="admin-content-right-product-add-content">
                        <label for="">Chọn loại sản phẩm </label>
                        <p style="color: red;">*</p>
                    </div>
                    <select required name="brand_id" id="brand_id">
                   
                    </select>

                    <div class="admin-content-right-product-add-content">
                        <label  for="">Giá sản phẩm </label>
                        <p style="color: red;">*</p>
                    </div>
                    <input class="format_price" required name="product_price" type="number">
                    <div class="admin-content-right-product-add-content">
                        <label  for="">Giá khuyến mãi</label>
                        <p style="color: red;">*</p>
                    </div>
                    <input class="format_price" required name="product_sale" type="number">
                     <div class="admin-content-right-product-add-content">
                        <label  for="">Màu sắc</label>
                        <p style="color: red;">*</p>
                    </div>
                    <input  required name="product_color">
                    <div class="admin-content-right-product-add-content">
                        <label for="">Mô tả sản phẩm </label>
                        <p style="color: red;">*</p>
                    </div>
                    <div class="admin-content-right-product-add-conten-textarea">
                         <textarea  id="content" name="product_desc" ></textarea>
                    </div>
                   
                    <div class="admin-content-right-product-add-content">
                        <label for="">Ảnh sản phẩm</label>
                        <p style="color: red;">*</p>
                    </div>
                    <input required name="product_img" type="file" id="imgInp">
                    <img id="blah" src="#" alt="???"  />

                    <div class="admin-content-right-product-add-content">
                        <label for="">Ảnh mô tả </label>
                        <p style="color: red;">*</p>
                    </div>
                    <input  required multiple name="product_img_desc[]"  type="file">
                    <button id="xacnhan" type="submit">Thêm</button>
                </form>
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

        const show = document.querySelector("#imgInp")
        show.addEventListener("click",function()
        {
            document.querySelector("#blah").style.display = "block"
        })
        // preview img b4 uploading
        imgInp.onchange = evt => 
        {
            const [file] = imgInp.files
            if (file) {
                blah.src = URL.createObjectURL(file)
            }
        }
    </script>