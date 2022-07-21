<?php require_once("./mvc/core/constant.php") ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping</title>
    <base href="<?= base_url ?>">
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <link rel="stylesheet" href="public/build/css/shopping.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css">
</head>

<body>

    <section class="name__shop">
        <div class="container">
            <div class="row">
                <div class="box">
                    <a href="">
                        <h3>SHOPPING</h3>
                    </a>
                </div>
                <div class="box">
                    <div class="box__search">
                        <input type="search" class="search__input" id="search__input" placeholder="Nhập từ khóa ...">
                        <button id="search"><i class="fas fa-search"></i></button>
                    </div>
                </div>
                <div class="box">
                    <div class="cart">
                        <a href="cart">
                            <i class="fas fa-shopping-cart"></i>
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <!-- nagivation  -->
    <section class="nagivation">
        <div class="container">
            <div class="box menu">
                <nav>
                    <ul>
                        <li><a href="">Trang chủ</a></li>
                        <li><a href="">Liên hệ</a></li>
                        <li><a href="">Về chúng tôi</a></li>
                    </ul>
                </nav>
            </div>
            <div class="box social">
                <ul>
                    <li><a href=""><i class="fab fa-facebook"></i></a></li>
                    <li><a href=""><i class="fab fa-twitter"></i></a></li>
                    <li><a href=""><i class="fab fa-google-plus-g"></i></a></li>
                </ul>
            </div>
        </div>
    </section>