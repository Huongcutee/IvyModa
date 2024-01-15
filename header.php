<?php
include "class/cartegory_class.php";
include "class/brand_class.php";
?>
<?php
 $cartegory = new cartegory;
 $show_cartegory = $cartegory -> show_cartegory();
 $brand = new brand;
 session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;1,100;1,300;1,400;1,500&display=swap" rel="stylesheet">
        <!-- swiper css -->
    <script src="
        https://cdn.jsdelivr.net/npm/swiper@11.0.5/swiper-bundle.min.js
        ">
    </script>
    <link href="
        https://cdn.jsdelivr.net/npm/swiper@11.0.5/swiper-bundle.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <!-- ----- -->
    <!-- Format price  -->
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="simple.money.format.js"></script>
    <title>Ivy-Project</title>
</head>
<header>
        <!--********************Logo********************-->
        <div class="logo">
            <a href="index.php"><img src="images/logo.png" alt="Logo" />
            </a>
        </div>
        <!--********************Menu********************-->
        <div class="menu">
            <?php
            if($show_cartegory)
            {
                while($result = $show_cartegory -> fetch_assoc())
                {
                    $cartegory_id = $result["cartegory_name"];
            ?>
                    <li><a ><?php echo $result["cartegory_name"]?></a>
                        <ul class="sub-menu">
                        <?php
                        $show_brand = $brand -> show_brand_cartegory($cartegory_id);
                        if($show_brand)
                        {
                        while($result_brand = $show_brand -> fetch_assoc())
                        {
                        ?>
                        <li><a href="cartegory.php?brand_id=<?php echo $result_brand['brand_id']?>"><?php echo $result_brand['brand_name']?></a>
                        </li>
                        <?php
                            }
                        }
                        ?>
                        </ul>
                    </li>
            <?php
                }
            }
            ?>
        </div>
        <!--********************Others********************-->
        <div class="others">
            <li style="display: flex;">
                <input placeholder="Tìm kiếm ... ">
                <a href="" style="margin-left:-15px ;" class="fas fa-search"></a>
            </li>
            <li>
                <a href=""><i class="fas fa-paw"></i></a>
            </li>
            <li>
                <a href=""><i class="fas fa-user"></i></a>
            </li>
            <li>
              
                <a   
                <?php
                if ($_SESSION['gio_hang'] == null || !isset($_SESSION['gio_hang']) )
                {
                ?>
                    href=""
                <?php
                } 
                else{
                ?>
                    href="cart.php"
                <?php
                }
                ?> ><i class="fas fa-shopping-bag"></i></a>
            </li>
        </div>
</header>
<body>
    