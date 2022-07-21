<section class="footer">
    <div class="container">
        <div class="list_items">
            <div class="item">
                <h3>SHOPPING</h3>
                <div class="info__company">
                    <p><strong>Website:</strong><a href="#">website.com</a></p>
                    <p><strong>Địa chỉ:</strong>Hà Nội</p>
                    <p><strong>Số điện thoại:</strong><a href="tel:0912345678">0912345678</a></p>
                </div>
            </div>
            <div class="item">
                <h3>Danh mục sản phẩm</h3>
                <ul>
                    <li><a href="">Sách Văn học</a></li>
                    <li><a href="">Manga-comic</a></li>
                </ul>
            </div>
            <div class="item">
                <h3>Thông tin</h3>
                <ul>
                    <li><a href="">Trang chủ</a></li>
                    <li><a href="">Liên hệ</a></li>
                    <li><a href="">Về chúng tôi</a></li>
                </ul>
            </div>
        </div>
    </div>
</section>
<footer>
    <div class="container">
        <p>@Design by </p>
    </div>
</footer>
<div class="rings__phone">
    <div class="b1 box__phone"></div>
    <div class="b2 box__phone"></div>
    <div class="box__phone phone">
        <a href="tel:0982824398" title="0982824398"><i class="fas fa-phone-alt"></i></a>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
<script>
    $('.slick_slide').slick({
        arrows: false,
        fade: true,
        centerMode: true,
        focusOnSelect: true,
        cssEase: 'linear',
        autoplay: true,
        autoplaySpeed: 2000,
    });
    window.addEventListener('scroll', (e) => {
        if (document.documentElement.scrollTop > 120) {
            document.querySelector('.nagivation').classList.add('active');
        } else {
            document.querySelector('.nagivation').classList.remove('active');
        }
    });
</script>
</body>

</html>