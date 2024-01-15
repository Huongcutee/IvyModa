<?php
include "header.php";
include "class/product_class.php";
?>
<?php
$product = new product;
 if(!isset($_GET['brand_id']) || $_GET['brand_id'] == NULL )
 {
    echo "<script> window.location = 'product.php' </script>";
 }
 else{
    $brand_id = $_GET['brand_id'];
    $list_product_ofbrand = $product -> show_product_ofbrand($brand_id);
    $show_brand_cartegory = $product -> show_brand_id($brand_id);
    $resultt = $show_brand_cartegory -> fetch_array();
}
?>
    <!--*****************Cartegory*****************-->
    <section class="cartegory">
        <div class="container">
            <!--***************cartegory-top ***************-->
            <div class="cartegory-top row">
                <a href="index.php">
                    <p>Trang chủ </p>
                </a>
                <i class="fa-solid fa-arrow-right"></i>
                <a href="">
                    <p>
                    <?php  echo $resultt['cartegory_name']?>
                    </p>
                </a>
                <i class="fa-solid fa-arrow-right"></i>
                <a href="">
                    <p>
                    <?php echo $resultt['brand_name']?>
                    </p>
                </a>
            </div>
        </div>
        <div class="container row">
            <!--****************cartegory-right ****************-->
            <div class="cartegory-right">
                <div class="row">
                    <div class="cartegory-right-top-item">
                        <p><b>HÀNG MỚI VỀ</b></p>
                    </div>
                    <div class="cartegory-right-top-item">
                        <button><span>Bộ lọc</span><i class="fa-solid fa-sort-down"></i></button>
                    </div>
                    <div class="cartegory-right-top-item">
                        <select name="" id="">
                            <option value="">Sắp xếp</option>
                            <option value="">Giá cao đến thấp</option>
                            <option value="">Giá thấp đến cao</option>
                        </select>
                    </div>
                </div>
                <div class="cartegory-right-content row ">
                    <?php
                    while( $result = $list_product_ofbrand -> fetch_assoc())
                    {
                    ?>
                    <div class="cartegory-right-content-item">
                        <div class="img_product">
                           <img  src="admin/uploads/<?php echo $result['product_img'] ?>" alt="" class="card0-img">
                            <?php $show_product_img_desc = $product -> show_product_img_desc($result['product_id']);
                            $result1 = $show_product_img_desc -> fetch_assoc();
                            ?>
                            <a href="product.php?product_id=<?php echo $result['product_id']?>"> <img src="admin/uploads/<?php echo $result1['product_img_desc'] ?>" alt="" class="card1-img"></a>
                       </div>
                       <div class="cartegory-right-content-item-color-hear">
                            <div class="color-heart1">
                                <img src="images/circle_hoa_tiet1.png" class="color-img" />
                                <img src="images/heart.png" class="heart-img" />
                            </div>
                       </div>
                        <div class="cartegory-right-content-item-price">
                             <?php echo $result['product_name']?>
                        </div>
                        <div class="bottom_swiper_product">
                            <div class="bottom_swiper_product_price">
                             <div class=" format-price product-sale"><?php echo $result['product_sale'] ?></div>
                            <sup class="format-price sub-price"><?php echo $result['product_price'] ?></sup>
                            </div>
                            <img src="images/shopping-bag.png" />
                        </div>
                    </div>
                   <?php
                    }
                   ?>
                    <div class="cartegory-right-bottom row">
                        <div class="cartegory-right-bottom-items1">
                            <p>Hiện tại <b>2</b> <span>|</span> <b>4</b> sản phẩm</p>
                        </div>
                        <div class="cartegory-right-bottom-items2">
                            <p><span>&#171;</span> 1 2 3 4 5 <span>&#187;</span> Trang cuối
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php
    include "footer.php";
    ?>
<script>
       // format money
    $('.format-price').simpleMoneyFormat();
    // click vao se show ra block 
    const itemsliderbar = document.querySelectorAll(".cartegory-left-li")
    itemsliderbar.forEach(function (menu, index) {
        menu.addEventListener("click", function () {
            menu.classList.toggle("block")
        })
    })
</script>

</html>