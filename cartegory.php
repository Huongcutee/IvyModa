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
    // hien thi thong tin cua muc luc 
    $show_brand_cartegory = $product -> show_brand_id($brand_id);
    $resultt = $show_brand_cartegory -> fetch_array();

    // duogn dan trang cartegory
    $currentURL = 'http://localhost/ivyhtml/cartegory.php'.'?brand_id='.$brand_id;
    if(!isset($_GET['filter']))
    {
        // hien thi san pham 
        $show_product = $product -> show_product_ofbrand($brand_id);
    }
    else{
        $filter = $_GET['filter'];
        if($filter == 'CaoDenThap'){
            $show_product = $product -> filter_product($brand_id,1);
        }
        if($filter == 'ThapDenCao')
        {
            $show_product = $product -> filter_product($brand_id,2);
        }
        if($filter == 'A_Z')
        {
            $show_product = $product -> filter_product($brand_id,3);
        }
        if($filter == 'Z_A')
        {
            $show_product = $product -> filter_product($brand_id,4);
        }
    }
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
                    <div class="cartegory-right-top-select">
                        <p><b>HÀNG MỚI VỀ</b></p>
                    </div>
                    <div class="cartegory-right-top-select">
                        <button><span>Bộ lọc</span><i class="fa-solid fa-sort-down"></i></button>
                    </div>
                    <div class="cartegory-right-top-select">
                        <button id="btn_sapxep"><span>Sắp xếp</span><i class="fa-solid fa-sort-down"></i></button>
                            <div class="cartegory-right-top-select-item">
                                <div class="cartegory-right-top-item-filter">
                                    <a href="<?php echo $currentURL . '&filter=CaoDenThap'; ?>">Giá cao đến thấp</a>
                                </div>
                                <div class="cartegory-right-top-item-filter">
                                    <a href="<?php echo $currentURL . '&filter=ThapDenCao'; ?>">Giá thấp đến cao</a>
                                </div>
                                <div class="cartegory-right-top-item-filter">
                                    <a href="<?php echo $currentURL . '&filter=A_Z'; ?>">Từ A đến Z</a>
                                </div>
                                <div class="cartegory-right-top-item-filter">
                                    <a href="<?php echo $currentURL . '&filter=Z_A'; ?>">Từ Z đến A</a>
                                </div>
                            </div>
                    </div>
                   
             
                </div>
                <div class="cartegory-right-content row">
                    <?php
                    $i =0;
                    while($result = $show_product-> fetch_assoc())
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
      //click vao hien thi se hien thi
    const show = document.querySelector("#btn_sapxep")
    const icon = show.querySelector('i');
    show.addEventListener("click", function () {
        document.querySelector(".cartegory-right-top-select-item").classList.toggle("activeA");
        icon.classList.toggle('flip');
        setTimeout(() => {
        // Sau 0.3 giây thì bỏ class xoay đi
        icon.classList.remove('rotated');  
  }, 300);
    })
    // sort 
</script>

</html>