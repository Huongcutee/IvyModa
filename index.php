<?php
include("header.php");
include("php_sup/slider.php");
include("class/product_class.php");
?>
<?php
$product = new product;
$show_product = $product->show_product();
    

?>
<section class="slide-title">
    <h1>
        NEW ARRIVAL
    </h1>
    <div class="slide-title-selection">
        <ul>
            <li class="slide-title-selection-moda">IVY moda</li>
            <li class="slide-title-selection-moda">IVY men</li>
            <li class="slide-title-selection-moda">IVY kids</li>
        </ul>
    </div>
</section>
<div class="slide-container swiper">
    <div class="slide-content">
        <div class="card-wrapper swiper-wrapper">
            <?php
            while ($result = $show_product->fetch_assoc()) {
            ?>
                <div class="card swiper-slide">
                    <div class="card-image">
                      <img src="admin/uploads/<?php echo $result['product_img'] ?>" alt="" class="card0-img">
                        <?php $show_product_img_desc = $product -> show_product_img_desc($result['product_id']);
                        $result1 = $show_product_img_desc -> fetch_assoc();
                        ?>
                       <a href="product.php?product_id=<?php echo $result['product_id']?>">  <img src="admin/uploads/<?php echo $result1['product_img_desc'] ?>" alt="" class="card1-img">
                        </a>
                    </div>
                    <div class="card-content">
                        <div class="color-heart">
                            <img src="images/circle_hoa_tiet1.png" class="color-img" />
                            <img src="images/heart.png" class="heart-img" />
                        </div>
                        <h2 class="name"><?php echo $result['product_name'] ?></h2>
                        <div class="bottom_swiper_product">
                            <div class="bottom_swiper_product_price">
                             <div class=" format-price product-sale"><?php echo $result['product_sale'] ?></div>
                            <sup class="format-price sub-price"><?php echo $result['product_price'] ?></sup>
                            </div>
                            <img src="images/shopping-bag.png" />
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>
         <div class="swiper-button-next" id="icon-button-swiper-right"></div>
    <div class="swiper-button-prev icon-button-swiper" id="icon-button-swiper-left"></div>
    </div>
</div>




<script>
    // 
    var swiper = new Swiper(".slide-content", {
        slidesPerView: 5,
        spaceBetween: 25,
        centerSlides: true, // 'centerSlide' nên là 'centerSlides'
        fade: true,
        grabCursor: true, // 'gragCursor' nên là 'grabCursor'
        loop: true,
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
            dynamicBullets: true,
        },
        navigation: {
            nextEl: ".swiper-button-next", // 'nextE1' nên là 'nextEl'
            prevEl: ".swiper-button-prev", // 'prevE1' nên là 'prevEl'
        },
        breakpoints: {
            0: {
                slidesPerView: 1, // 'slidesView' nên là 'slidesPerView'
            },
            520: {
                slidesPerView: 3, // 'slidesView' nên là 'slidesPerView'
            },
            950: {
                slidesPerView: 5, // 'slidesView' nên là 'slidesPerView'
            },
        },
    });
    // format money
    $('.format-price').simpleMoneyFormat();
</script>

<?php
include("footer.php");
?>