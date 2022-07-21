<?php if (isset($product) && $product != NULL) { ?>
    <section class="product">
        <div class="container">
            <div class="title__product">
                <h3>Sản phẩm</h3>
            </div>
            <div class="list__product">
                <?php foreach ($product as $value) { ?>
                    <div class="card">
                        <div class="before box">
                            <div class="images">
                                <a href="<?= $value['slug'] ?>"><img src="<?= $value['image'] ?>" alt=""></a>
                            </div>
                            <div class="contents">
                                <a href="<?= $value['slug'] ?>">
                                    <p class="title"><?= $value['name'] ?></p>
                                    <p class="price">
                                        <!-- <s>200.000 đ</s> -->
                                        <span><?= number_format($value['price']); ?>đ</span>
                                    </p>
                                    <div class="info">
                                        <?php $contents = json_decode($value['properties'], true); ?>
                                        <?php if (isset($contents) && $contents != NULL) { ?>
                                            <?php foreach ($contents as $val) { ?>
                                                <p><strong><?= $val['name'] ?>:</strong> <?= $val['value'] ?></p>
                                            <?php } ?>
                                        <?php } ?>
                                    </div>
                                </a>
                            </div>
                            <form action="cart/addToCart" method="post">
                                <input type="hidden" name="slug" value="<?= $value['slug'] ?>">
                                <button class="btn btn-danger" type="submit">Add to cart</button>
                            </form>
                            <!-- <span class="discout">10%</span> -->
                        </div>
                        <div class="after box">
                            <p class="title"><?= $value['name'] ?></p>
                            <div class="btn">
                                <button class="buy"><i class="fas fa-cart-plus"></i></button>
                                <a class="detail" href="javascript:void(0)"><i class="fas fa-info-circle"></i></a>
                            </div>

                        </div>

                    </div>
                <?php } ?>
            </div>
        </div>
    </section>
<?php } ?>