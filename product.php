<?php
include "header.php";
include "class/product_class.php";
?>
<?php 
$product = new product();
if(!isset($_GET['product_id']) || $_GET['product_id'] == NULL)
{
     echo "<script> window.location = 'product.php' </script>";
}
 else
{

    $product_id = $_GET['product_id'];
    $show_product = $product -> get_product_id($product_id);
    $result = $show_product -> fetch_assoc();

    $show_product_img_desc = $product -> show_more_product_img_desc($product_id);
    
    $show_product_related = $product -> show_product_ofbrand($result['brand_id']);
}
?>
    <!--************************Product************************-->
    
    <section class="product">
        <div class="container">
            <div class="product-top row">
                <a href>    
                    <p>Trang chủ </p>
                </a>
                <i class="fa-solid fa-arrow-right"></i>
                <a href="">
                    <p>
                        Nữ
                    </p>
                </a>
                <i class="fa-solid fa-arrow-right"></i>
                <a href="">
                    <p>Hàng nữ mới về</p>
                </a>
            </div>
            <div class="product-content row">
                <div class="product-left row">
                    <div class="product-left-content-big-img">
                        <figure class="zoom" style="background-image: url('admin/uploads/<?php echo $result['product_img']?>')" onmousemove="zoom(event)">
                        <img src="admin/uploads/<?php echo $result['product_img']?>" alt="Zoomed Image" class="zoom">
                        </figure>
                    </div>
                    <div class="product-left-content-small-img">

                         <img src="admin/uploads/<?php echo $result['product_img']?>">

                          <?php 
                        while($result1 = $show_product_img_desc -> fetch_assoc())
                        {
                            ?>
                        <img src="admin/uploads/<?php echo $result1['product_img_desc']?>">
                        <?php
                        }
                        ?>
                    </div>
                </div>
                <div class="product-right-content">
                   
                    <div class="product-right-content-product-name">
                            <h1>
                                <?php echo $result['product_name']?>
                            </h1>
                            <p>
                                MSP: <?php echo $result['product_id']?>
                            </p>
                        </div>
                        <div class="product-right-content-product-price">
                            <span class="format-price"><?php echo $result['product_price'] ?></span><sup>đ</sup>
                        </div>
                        <div class="product-right-content-product-color">
                            <p>
                                <span>Màu sắc:</span> <b><?php echo $result['product_color'] ?></b>
                            </p>
                        </div>
                      
                    <form action="cart.php" method="post" onsubmit="return validateSize()">
                        <div class="product-right-content-product-size">
                            <!-- Radio buttons ẩn -->
                            <input type="radio" id="sizeS" name="size" value="S">
                            <label for="sizeS">S</label>
                            <input type="radio" id="sizeM" name="size" value="M">
                                <label for="sizeM">M</label>
                            <input type="radio" id="sizeL" name="size" value="L">
                                <label for="sizeL">L</label>
                            <input type="radio" id="sizeXXL" name="size" value="XXL">
                                <label for="sizeXXL">XXL</label>
                        </div>
                        <input type="hidden" name="product_name" value="<?php echo $result['product_name'] ?>">
                        <input type="hidden" name="product_price" value="<?php echo $result['product_price'] ?>">
                        <input type="hidden" name="product_img" value="<?php echo $result['product_img'] ?>">
                        <input type="hidden" name="product_id" value="<?php echo $result['product_id'] ?>">
                        <input type="hidden" name="product_color" value="<?php echo $result['product_color'] ?>">
                        <div class="quantity">
                            <b>Số Lượng: </b>
                            <input name="quantity" type="number" min="0" value="1">
                        </div>
                        <div class="input-muahang">
                            <input type="submit" value="Thêm vào giỏ hàng" name="addcart" class="input_them_vao_gio_hang">
                            <input type="submit" value="Mua hàng" name="buyproduct" class="input_them_vao_gio_hang">
                        </div>
                    </form>
                    
                        <div class="product-right-content-product-icon">
                            <div class="product-right-content-product-icon-item">
                                <i class="fa-solid fa-phone"></i>
                                <p>
                                    Hotline
                                </p>
                            </div>
                            <div class="product-right-content-product-icon-item">
                                <i class="fa-solid fa-comment"></i>
                                <p>
                                    Chat
                                </p>
                            </div>
                            <div class="product-right-content-product-icon-item">
                                <i class="fa-solid fa-envelope"></i>
                                <p>Email</p>
                            </div>
                        </div>
                        <div class="product-right-content-product-qr">
                            <img src="images/qrcode.jpg">
                        </div>
                    
                    <div class="product-content-right-bottom">
                        <div class="product-content-right-bottom-top">
                            <i class="fa-solid fa-chevron-down"></i>
                        </div>
                        <div class="product-content-right-bottom-content-big">
                            <div class="product-content-right-bottom-content-title row">
                                <div class="product-content-right-bottom-content-title-item chitiet">
                                    <span>Chi tiết</span>
                                </div>
                                <div class="product-content-right-bottom-content-title-item baoquan">
                                    <span>Bảo quản</span>
                                </div>
                                <div class="product-content-right-bottom-content-title-item thamkhaosize">
                                    <span>Tham khảo size</span>
                                </div>
                            </div>
                            <div class="product-content-right-bottom-content">
                                <div class="product-content-right-bottom-content-chitiet">
                                    <?php 
                                    echo $result['product_desc'];
                                    ?>
                                </div>
                                <div class="product-content-right-bottom-content-baoquan ">
                                    Bảo quản nè
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
                 <!-- Product related  -->
  
    </section>
     <div class="product-related ">
        <div class="productrelated-title ">
            <p>
                SẢN PHẨM LIÊN QUAN
            </p>
        </div>
        <div class="slide-container-product swiper">
        <div class="slide-content">
        <div class="card-wrapper swiper-wrapper">
            <?php
            while ($result_related = $show_product_related -> fetch_assoc()) {
            ?>
                <div class="card swiper-slide">
                    <div class="card-image">
                        <img src="admin/uploads/<?php echo $result_related['product_img'] ?>" alt="" class="card0-img">

                        <?php $show_product_img_desc1 = $product -> show_product_img_desc($result_related['product_id']);
                        $result_related_desc = $show_product_img_desc1 -> fetch_assoc();
                        ?>
                        <img src="admin/uploads/<?php echo $result_related_desc['product_img_desc'] ?>" alt="" class="card1-img">
                        
                    </div>
                    <div class="card-content">
                        <div class="color-heart">
                            <img src="images/circle_hoa_tiet1.png" class="color-img" />
                            <img src="images/heart.png" class="heart-img" />
                        </div>
                        <h2 class="name"><?php echo $result_related['product_name'] ?></h2>
                        <div class="bottom_swiper_product">
                            <div class="bottom_swiper_product_price">
                             <div class="product-sale">
                                <span class="format-price"><?php echo $result_related['product_sale'] ?></span>đ</div>
                            <sup class="sub-price"><span class="format-price"><?php echo $result_related['product_price'] ?></span>đ</sup>
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
    </div>
<?php
include "footer.php";
?>
<!-- The dots/circles -->
<!--*********script*********-->
<script>
    // kiểm tra form 
    function validateSize()
    {
         // Lấy giá trị của size
    var selectedSize = document.querySelector('input[name="size"]:checked');
    // Kiểm tra xem có size nào được chọn hay không
    if (!selectedSize) {
        // Nếu không có size nào được chọn, hiển thị cảnh báo và ngăn chặn submit
        alert("Vui lòng chọn size trước khi thêm vào giỏ hàng.");
        return false;
    }
    }
    // swiper
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
    // Product 
    //đổi vị trí ảnh nhỏ với ảnh to 
    const bigimg = document.querySelector(".product-left-content-big-img img");
    const zoomer = document.querySelector(".product-left-content-big-img .zoom");
    const smallimg = document.querySelectorAll(".product-left-content-small-img img");
    smallimg.forEach(function (menu, index) {
    menu.addEventListener("click", function () {
        bigimg.src = menu.src;
        zoomer.style.backgroundImage = `url('${menu.src}')`;
    });
});
    // nhan nut thu gon 
    const min = document.querySelector(".product-content-right-bottom-top")
    min.addEventListener("click", function () {
        document.querySelector(".product-content-right-bottom-content-big").classList.toggle("activeB")
    })
    //click bao quan chi tiet hien mota 
    const baoquan = document.querySelector(".baoquan")
    const chitiet = document.querySelector(".chitiet")
    baoquan.addEventListener("click", function () {
        document.querySelector(".product-content-right-bottom-content-baoquan").style.display = "block"
        document.querySelector(".product-content-right-bottom-content-chitiet").style.display = "none"
    })
    chitiet.addEventListener("click", function () {
        document.querySelector(".product-content-right-bottom-content-baoquan").style.display = "none"
        document.querySelector(".product-content-right-bottom-content-chitiet").style.display = "block"
    })
    // click vao se show ra block 
    const itemsliderbar = document.querySelectorAll(".cartegory-left-li")
    itemsliderbar.forEach(function (menu, index) {
        menu.addEventListener("click", function () {
            menu.classList.toggle("block")
        })
    })
    // ***********zoom img   

function zoom(e) {
  var zoomer = e.currentTarget;
  var offsetX, offsetY;

  e.offsetX ? offsetX = e.offsetX : offsetX = e.touches[0].pageX;
  e.offsetY ? offsetY = e.offsetY : offsetY = e.touches[0].pageY; // Corrected this line

  x = offsetX / zoomer.offsetWidth * 100;
  y = offsetY / zoomer.offsetHeight * 100;
  zoomer.style.backgroundPosition = x + '% ' + y + '%';
//   formart price 

    $('.format-price').simpleMoneyFormat1();
}
</script>

</html>