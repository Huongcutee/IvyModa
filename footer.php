     <!--******************App container******************-->
    <section class="app-container">
        <p>Tải ứng dụng IVY moda</p>
        <div class="app-google">
            <img src="images/taivetrenstore.png">
            <img src="images/taivetrenchplay.png">
        </div>
        <p>Nhận bản tin IVY moda</p>
        <input type="text" placeholder="Nhập email của bạn...">
    </section>
     <!--************************************-->
    
    <!--********************Footer********************-->

    <footer class="footer-top">
        <li><a href=""><img src="images/dathongbao.png"></a></li>
        <li><a href="">Liên hệ </a></li>
        <li><a href="">Tuyển dụng </a></li>
        <li><a href="">Giới thiệu</a></li>
        <li>
            <a href="" class="fab fa-facebook-f icon"></a>
            <a href="" class="fab fa-twitter icon"></a>
            <a href="" class="fab fa-youtube icon"></a>

        </li>
    </footer>
    <footer class="footer-center">
        Công ty Cổ phần Dự Kim với số đăng ký kinh doanh : 0105777650 <br />
        Địa chỉ đăng ký : Tổ dân phố Tháp, P.Đại M, Q.Nam Từ Liêm, TP.Hà Nội, Việt Nam - 0243 205 222<br />
        Đặt hàng online : <b>0246 662 3434</b> .
    </footer>

    <footer class="footer-bottom">
        ©IVYmoda All rights reserved
    </footer>
    
</body>
<!-- The dots/circles -->
<!--*********script*********-->
<script>
    // scroll đổi màu header 
    const header = document.querySelector("header")
    window.addEventListener("scroll", function () {
        x = window.pageYOffset
        if (x > 440) {
            header.classList.add("sticky")

        }
        else {
            header.classList.remove("sticky")
        }
    })
    //
    
</script>

</html>