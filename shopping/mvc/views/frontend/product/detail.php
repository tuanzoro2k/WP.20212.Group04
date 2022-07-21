<link rel="stylesheet" href="public/build/css/detail.css">
<section class="detail__product">
    <div class="container">
        <div class="block__product">
            <div class="left">
                <h3><?= $product['name'] ?></h3>
                <div class="price">
                    <p><?= number_format($product['price']) ?> vnđ</p>
                    <!-- <p><s>23,000,000 vnđ</s></p> -->
                </div>
                <div class="block__product_detail">
                    <div class="block">
                        <div class="image__box">
                            <img src="<?= $product['image'] ?>" alt="">
                        </div>
                        <?php if (isset($list_images) && $list_images != NULL) { ?>
                            <div class="list_images">
                                <?php foreach ($list_images as $key => $val) { ?>
                                    <div>
                                        <img src="<?= $val['image'] ?>" alt="">
                                    </div>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="button__buy">
                        <form action="cart/addToCart" method="post">
                            <input type="hidden" name="slug" value="<?= $product['slug'] ?>">
                            <div class="button"><button type="submit">Thêm vào giỏ hàng</button></div>
                        </form>
                        <!-- <div class="button"><button>Thêm vào giỏ hàng</button></div> -->
                    </div>
                </div>
            </div>
            <div class="right">
                <h3><?= $product['name'] ?></h3>
                <?php if (isset($product['contents']) && $product['contents'] != '') { ?>
                    <div>
                        <?= $product['contents'] ?>
                    </div>
                <?php } ?>
            </div>
        </div>

        <!-- <div class="product__same">
            <h3>Sản phẩm liên quan</h3>
            <div class="list__product">
                <div class="card">
                    <div class="before box">
                        <div class="images">
                            <a href="#"><img src="iphone-13-pro-max-silver-600x600.jpg" alt=""></a>
                        </div>
                        <div class="contents">
                            <a href="">
                                <p class="title">sách văn học</p>
                                <p class="price">
                                    <s>200.000 đ</s>
                                    <span>180.000 đ</span>
                                </p>
                                <div class="info">
                                    <p><strong>RAM:</strong> 64GB</p>
                                    <p><strong>Camera:</strong> trước 16 MP , Sau 32MP</p>
                                    <p><strong>SIM:</strong>Hổ trợ NANO SIM</p>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div> -->
    </div>
</section>
<div class="overlay"></div>
<div class="views_list_product">
    <button id="closeModal">Đóng</button>
    <div class="images__box">
        <img src="617ec2b666bba-x3WzhCVQKYei4od1NDSyJwk6P5OlG8E90bXqMgnsDurBATULc72mjfZRvtHFa.png" id="preview__images" alt="">
    </div>
    <?php if (isset($list_images) && $list_images != NULL) { ?>
        <div class="list__image">
            <?php foreach ($list_images as $key => $val) { ?>
                <div class="box">
                    <img src="<?= $val['image'] ?>" alt="">
                </div>
            <?php } ?>
        </div>
    <?php } ?>
</div>
<script>
    // Click +,- qty product
    const plus = document.querySelector('.plus');
    const minus = document.querySelector('.minus');
    const input = document.querySelector('#qty__product');
    plus.addEventListener('click', (e) => {
        input.value = Number(input.value) + 1
    });
    minus.addEventListener('click', (e) => {
        if (Number(input.value) <= 0)
            return input.value = 0;
        input.value = Number(input.value) - 1
    });
    // list images
    const preview__images = document.querySelector('#preview__images');
    const list__boxs = document.querySelectorAll('.box');
    const list = document.querySelector('.list_images').children;
    Array.from(list).forEach((v) => {
        v.addEventListener('click', (e) => {
            document.querySelector('.overlay').style.display = "unset";
            document.querySelector('.views_list_product').style.display = "unset";
            const images = e.target.getAttribute('src');
            preview__images.setAttribute('src', images);

        })
    });

    list__boxs.forEach((v, k) => {
        v.addEventListener('click', (e) => {
            const images = e.target.getAttribute('src');
            preview__images.setAttribute('src', images);
        });
    });
    document.querySelector('#closeModal').addEventListener('click', () => {
        document.querySelector('.overlay').style.display = "none";
        document.querySelector('.views_list_product').style.display = "none";
    });
</script>