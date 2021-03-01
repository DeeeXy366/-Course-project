<div class="container indentation" id="app">
  <h3><?php echo ($_SESSION['label']); ?>:</h3>
  <form action="/main/back" method="post">
    <button class="btn btn-primary">Вернуться</button>
  </form>
  <?php
    if (isset($_SESSION['status'])){
      if ($_SESSION['status'] == '2' || $_SESSION['status'] == '3'){ ?>
      <div class="product-add text-center bg-dark text-white">
        <div class="block">
          <form action="/main/add" method="post" class="was-validated" enctype="multipart/form-data">
            <input type="hidden" name="id_p" value="<?php echo $_SESSION['idproducts'] ?>">
            <label for="input-01" style="margin-top: 10px;">Картинка</label>
            <input type="file" class="form-control-file" accept="image/*" id="input-01" name="logo_p" required>
            <label for="input02" style="margin-top: 20px;">Наименование</label>
            <input type="text" class="form-control" id="input02" name="label_p" maxlength="50" placeholder="Название товара" required>
            <hr style="background-color: white;">
            <label for="input-03">Информация</label>
            <textarea type="text" class="form-control" id="input-03" name="info_p" maxlength="400" placeholder="Информация о товаре" required></textarea>
            <label for="input-04" style="margin-top: 20px;">Цена</label>
            <input type="text" class="form-control" id="input-04" name="price_p" maxlength="10" pattern="[0-9]{1,8}" placeholder="100" required>
            <button class="btn btn-info" style="margin-top: 40px;">Добавить товар</button>
          </form>
        </div>
      </div>
    <?php }
      }
  foreach($data as $row){
  if ($_SESSION['idproducts'] == $row['Id_p']){ ?>
  <div class="task">
    <h3 class="text-center">
      <div class="block">
        <?php if (isset($_SESSION['status'])){
        if ($_SESSION['status'] == '2' || $_SESSION['status'] == '3'){ ?>
        <button v-show='dell' type="button" class="delp close" @click="delp(); id =<?php echo $row['id_pdel'] ?>">&times;</button>
        <button v-show='change' type="button" class="change close" @click="cha(); id_cha =<?php echo $row['id_pdel'] ?>">&#9881;</button>
        <div v-if="id_cha == <?php echo $row['id_pdel'] ?>">
          <h5>Вы точно хотите изменить эту категорию?</h5>
          <form action="/main/changep" method="post" enctype="multipart/form-data">
            <h5>
              <input type="hidden" name="img_p" value="<?php echo $row['Logo_p'] ?>">
              <input type="hidden" name="id_p" value="<?php echo $row['id_pdel'] ?>">
              <button class="btn btn-outline-danger">Изменить</button>
              <button class="btn btn-outline-primary" @click="cha_click">Отмена</button>
              <div style="margin: 20px;">
                <label for="input-01" style="margin-top: 10px;">Картинка</label>
                <input type="file" class="form-control-file"  id="input-01" name="logo_p" accept="image/*">
                <label for="input-02" style="margin-top: 20px;">Наименование</label>
                <input type="text" class="form-control" id="input-02" name="label_p" maxlength="50" placeholder="Название категории товаров" value="<?php echo $row['Label_p'] ?>" required>
                <hr style="background-color: white;">
                <label for="input-03">Информация</label>
                <textarea type="text" class="form-control" id="input-03" name="info_p" maxlength="300" placeholder="Информация о категории товаров" required><?php echo $row['Info_p'] ?></textarea>
                <label for="input-04" style="margin-top: 20px;">Цена</label>
                <input type="text" class="form-control" id="input-04" name="price_p" maxlength="10" pattern="[0-9]{1,8}" placeholder="50-100" value="<?php echo $row['Price_p'] ?>" required>
              </div>
            </h5>
          </form>
        </div>
        <div v-if="id == <?php echo $row['id_pdel'] ?>">
          <h5>Вы точно хотите удалить этот товар?</h5>
          <form action="/main/delp" method="post">
            <input type="hidden" name="img" value="<?php echo $row['Logo_p'] ?>">
            <input type="hidden" name="drop" value="<?php echo $row['id_pdel'] ?>">
            <button class="btn btn-outline-danger">Удалить</button>
            <button class="btn btn-outline-primary" @click="delp_click">Отмена</button>
          </form>
        </div>
        <?php }
        } ?>
        <div v-if="id_cha != <?php echo $row['id_pdel'] ?>">
          <div class="float-left">
            <?php  echo "<img class='img-fluid' src='/" . $row['Logo_p'] . "' style='width: 180px;' />" ?>
          </div>
          <div class="block-p">
            <p class="card-title"><?php echo $row['Label_p'] ?></p>
            <h5 class="card-text"><?php echo $row['Info_p'] ?></h5>
          </div>
          <p class="price"><?php echo $row['Price_p'] ?> ₽/шт. </p>
        </div>
      </div>
      <?php
      if (isset($_SESSION['is_auth'])){
        if ($_SESSION['is_auth'] == '1'){
      ?>
      <form action="/main/baskadd" method="post" v-if="id_cha != <?php echo $row['id_pdel'] ?>">
        <input type="hidden" name="b_add" value="<?php echo $row['id_pdel'] ?>">
        <button class="btn cha-btn-main btn-outline-primary add-btn col-12">Добавить в корзину</button>
      </form>
      <?php
        }else{
      ?>
      <button class="hidden-btn col-12"></button>
      <?php
        }
      }else{
      ?>
      <button class="hidden-btn col-12"></button>
      <?php
      }
      ?>
    </h3>
  </div>
  <?php }
  } ?>
</div>
