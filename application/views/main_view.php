<div class="container indentation" id="app">
  <h1>СТРОЙМАТЕРИАЛЫ:</h1>
  <div class="card-columns">
  <?php
    if (isset($_SESSION['status'])){
      if ($_SESSION['status'] == '2' || $_SESSION['status'] == '3'){ ?>
      <div class="card product-list-add text-center">
        <div class="card-body bg-dark text-white">
          <form action="/main/addp" method="post" class="was-validated" enctype="multipart/form-data">
            <label for="input-01" style="margin-top: 10px;">Картинка</label>
            <input type="file" class="form-control-file" accept="image/*" id="input-01" name="logo" required>
            <label for="input-02" style="margin-top: 20px;">Наименование</label>
            <input type="text" class="form-control" id="input-02" name="label" maxlength="50" placeholder="Название категории товаров" required>
            <hr style="background-color: white;">
            <label for="input-03">Информация</label>
            <textarea type="text" class="form-control" id="input-03" name="info" maxlength="300" placeholder="Информация о категории товаров" required></textarea>
            <label for="input-04" style="margin-top: 20px;">Цена</label>
            <input type="text" class="form-control" id="input-04" name="price" maxlength="10" pattern="[0-9]{1,8}-[0-9]{1,8}" placeholder="50-100" required>
            <button class="btn btn-info" style="margin-top: 40px;">Добавить категорию товаров</button>
          </form>
        </div>
      </div>
      <?php }
        }
      foreach($data as $row){ ?>
      <div class="product-list card text-center">
        <?php if (isset($_SESSION['status'])){
        if ($_SESSION['status'] == '2' || $_SESSION['status'] == '3'){ ?>
        <button v-show='dell' type="button" class="delp close" @click="delp(); id =<?php echo $row['Id_ps'] ?>">&times;</button>
        <button v-show='change' type="button" class="change close" @click="cha(); id_cha =<?php echo $row['Id_ps'] ?>">&#9881;</button>
        <div v-if="id_cha == <?php echo $row['Id_ps'] ?>">
          <h5>Вы точно хотите изменить эту категорию?</h5>
          <form action="/main/change" method="post" enctype="multipart/form-data">
            <input type="hidden" name="img" value="<?php echo $row['LogoPath'] ?>">
            <input type="hidden" name="id" value="<?php echo $row['Id_ps'] ?>">
            <button class="btn btn-outline-danger">Изменить</button>
            <button class="btn btn-outline-primary" @click="cha_click">Отмена</button>
            <div style="margin: 20px;">
              <label for="input-01" style="margin-top: 10px;">Картинка</label>
              <input type="file" class="form-control-file"  id="input-01" name="logo" accept="image/*">
              <label for="input-02" style="margin-top: 20px;">Наименование</label>
              <input type="text" class="form-control" id="input-02" name="label" maxlength="50" placeholder="Название категории товаров" value="<?php echo $row['Label'] ?>" required>
              <hr style="background-color: white;">
              <label for="input-03">Информация</label>
              <textarea type="text" class="form-control" id="input-03" name="info" maxlength="300" placeholder="Информация о категории товаров" required><?php echo $row['Info'] ?></textarea>
              <label for="input-04" style="margin-top: 20px;">Цена</label>
              <input type="text" class="form-control" id="input-04" name="price" maxlength="10" pattern="[0-9]{1,8}-[0-9]{1,8}" placeholder="50-100" value="<?php echo $row['Price'] ?>" required>
            </div>
          </form>
        </div>
        <div v-if="id == <?php echo $row['Id_ps'] ?>">
          <h5>Вы точно хотите удалить эту категорию?</h5>
          <form action="/main/delps" method="post">
            <input type="hidden" name="img" value="<?php echo $row['LogoPath'] ?>">
            <input type="hidden" name="drop" value="<?php echo $row['Id_ps'] ?>">
            <button class="btn btn-outline-danger">Удалить</button>
            <button class="btn btn-outline-primary" @click="delp_click">Отмена</button>
          </form>
        </div>
        <?php }
        } ?>
        <div class="card-body" v-if="id_cha != <?php echo $row['Id_ps'] ?>">
          <?php  echo "<img class='img-fluid' src='" . $row['LogoPath'] . "' style='width: 300px;' />" ?>
          <h4 class="card-title" style="margin-top: 10px;"><?php echo $row['Label'] ?></h4>
          <hr>
          <p class="card-text"><?php echo $row['Info'] ?></p>
          <p class="price"><?php echo $row['Price'] ?>₽/шт. </p>
          <form action="/main/show" method="post">
            <input type="hidden" name="label" value="<?php echo $row['Label'] ?>">
            <input type="hidden" name="id" value="<?php echo $row['Id_ps'] ?>">
            <button class="btn btn-outline-primary">Посмотреть каталог</button>
          </form>
        </div>
      </div>
    <?php } ?>
  </div>
</div>
