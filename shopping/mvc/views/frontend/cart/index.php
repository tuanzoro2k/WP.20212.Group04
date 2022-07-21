   <link rel="stylesheet" href="public/build/css/cart.css">

   <!-- sản phẩm -->
   <section class="cart__container">
       <div class="container">
           <div class="cart">
               <h3>Giỏ hàng</h3>
               <div class="list__items">
                   <table>
                       <thead>
                           <th>Tên sản phẩm</th>
                           <th>Hình ảnh</th>
                           <th>Đơn giá</th>
                           <th>Số lượng</th>
                           <th>Tổng giá</th>
                           <th>Thao tác</th>
                       </thead>
                       <tbody>
                           <?php $totalPrice = 0; ?>
                           <?php if (isset($cart)) { ?>
                               <?php foreach ($cart as $value) { ?>
                                   <form action="cart/update?id=<?= $value['id'] ?>" method="post">
                                       <tr>
                                           <td><?php echo $value['name'] ?></td>
                                           <td><img src="<?= $value['image'] ?>" alt=""></td>
                                           <td><?= number_format($value['price']) ?> đ </td>
                                           <td>
                                               <div class="quantity">
                                                   <div class="minus" onclick="this.parentNode.querySelector('input[type=number]').stepDown()"><i class=" fa-solid fa-minus"></i></div>
                                                   <input type="number" value="<?= $value['qty'] ?>" id="qty__product" name="qty">
                                                   <div class="plus" onclick="this.parentNode.querySelector('input[type=number]').stepUp()"><i class="fa-solid fa-plus"></i></div>
                                               </div>
                                           </td>
                                           <td>
                                               <?= number_format($value['price'] * $value['qty']) ?> đ
                                           </td>
                                           <td>
                                               <a href="cart/delete?id=<?= $value['id'] ?>" class="btn btn-delete"><i class="fa-solid fa-trash-can"></i></a>
                                               <button type="submit"> <i class="fa-solid fa-edit"></i></button>
                                           </td>
                                       </tr>
                                   </form>
                                   <?php $totalPrice += $value['price'] * $value['qty'] ?>
                               <?php } ?>
                           <?php } ?>

                       </tbody>
                   </table>
               </div>
           </div>
           <div class="payment">
               <div class="box">
                   <p><strong>Tổng giá:</strong><span><?= number_format($totalPrice) ?> đ</span></p>
                   <a href="cart/checkout">
                       <button class="payment__btn">
                           <span></span>
                           <span></span>
                           <span></span>
                           <span></span>
                           Tiến hành thanh toán
                       </button>
                   </a>
               </div>
           </div>
       </div>
   </section>