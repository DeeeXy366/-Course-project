<div class="container indentation">
  <div class="task">
    <h3>
      <?php
      $price = 0;
      foreach($data as $row){
      if ($row['basket'] == '1'){
      ?>
      <div class="block">
        <?php if (isset($_SESSION['status'])){
        if ($_SESSION['status'] != '0'){ ?>
          <form action="/main/baskdel" method="post">
            <input type="hidden" name="b_del" value="<?php echo $row['id_pdel'] ?>">
            <button class="delp close">&times;</button>
          </form>
          <?php }
          } ?>
          <div class="d-flex bd-highlight">
            <div class="p-2 w-100 bd-highlight">
              <?php  echo "<img class='img-fluid d-inline' src='/" . $row['Logo_p'] . "' style='width: 60px;' />" ?>
              <p class="card-title text-left d-inline"><?php echo $row['Label_p'] ?></p>
            </div>
            <div class="p-2 flex-shrink-1 bd-highlight text-center">
              <div class="btn-group" role="group" aria-label="Basic example">
                <form class="btn-num text-white" action="/main/baskminus" method="post">
                  <input type="hidden" name="num" value="<?php echo $row['num'] ?>">
                  <input type="hidden" name="b_minus" value="<?php echo $row['id_pdel'] ?>">
                  <button class="btn btn-num text-white">&laquo;</button>
                </form>
                <button type="button" class="btn btn-num text-white"><?php echo $row['num'] ?></button>
                <form class="btn-num text-white" action="/main/baskplus" method="post">
                  <input type="hidden" name="b_plus" value="<?php echo $row['id_pdel'] ?>">
                  <button class="btn btn-num text-white">&raquo;</button>
                </form>
              </div>
              <div class="text-info"><?php echo ($row['Price_p'] * $row['num']) ?>₽</div>
              <?php $price += ($row['Price_p'] * $row['num']) ?>
            </div>
          </div>
          <hr>
        </div>
        <?php }
        }if (isset($_SESSION['order'])){
          if ($_SESSION['order'] == '1'){
          ?>
          <h1 class="text-info text-center">Итого к оплате: <?php echo $price ?> ₽</h1>
          <button class="btn cha-btn-main btn-outline-primary price-btn col-12" data-toggle="modal" data-target="#exampleMod">Оформить покупку</button>
        <?php }else{ ?>
          <h1 class="text-info text-center">Тут пока что пусто :с</h1>
        <?php }
        }else{ ?>
          <h1 class="text-info text-center">Тут пока что пусто :с</h1>
        <?php } ?>
        <div class="modal fade" id="exampleMod" tabindex="-1" role="dialog" aria-labelledby="exampleModalLab" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLab">Оформление заказа</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form class="was-validated" action="/main/accept" method="post">
                  <input class="form-control d-block" placeholder="Адрес доставки" title="Поле не может быть пустым" required>
                  &nbsp;
                  <input class="form-control d-block" placeholder="email@email.com" type="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" required>
                  &nbsp;
                  <input class="form-control d-block" placeholder="0000 0000 0000 0000" pattern="[0-9\s]{8,30}" required>
                  &nbsp;
                  <input class="form-control d-block" placeholder="MAXIM KOZLOV" pattern="[A-Z]{3,}\s[A-Z]{3,}" title="Не менее 6 букв" required>
                  &nbsp;
                  <input class="form-control d-block" placeholder="MM/YY" maxlength="5" pattern="[0-9]{2}/[0-9]{2}" required>
                  &nbsp;
                  <input class="form-control d-block" placeholder="CVC" maxlength="3" pattern="[0-9]{3}" required>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                <button class="btn btn-primary">Подтвердить</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </h3>
  </div>
</div>
