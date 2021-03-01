<div style="text-align:center;">
  <table class="table table-dark container col-8" style="text-align:center;">
    <tr><td>Id:</td><td>Имя:</td><td>Пароль:</td><td>Статус:</td><td></td><td></td></tr>
      <?php
      foreach($data as $row){ ?>
        <tr>
          <td><?php echo $row['Id']; ?></td>
          <td><?php echo $row['Login']; ?></td>
          <td><?php echo $row['Password']; ?></td>
          <form method="post" class="col-fluid" action="/admin/edit">
            <input type="hidden" class="form-control" value='<?php echo $row['Id']; ?>' name="strdel">
            <td>
              <select class="custom-select" id="inputGroupSelect01" name="Status">
                  <option selected>
                    <?php
                    if($row['Status'] == '2'){
                      echo('Админ');
                    }else if($row['Status'] == '1'){
                      echo('Пользователь');
                    }else{
                      echo('Модератор');
                    }
                    ?>
                  </option>
                  <?php if ($row['Status'] == '2'){ ?>
                    <option value="3">Модератор</option>
                    <option value="1">Пользователь</option>
                  <?php }else if($row['Status'] == '3'){ ?>
                    <option value="2">Админ</option>
                    <option value="1">Пользователь</option>
                  <?php }else{ ?>
                    <option value="2">Админ</option>
                    <option value="3">Модератор</option>
                  <?php } ?>
              </select>
            </td>
            <td><input type="submit" class="form-control btn btn-dark" value="Изменить">
          </form>
          </td>
          <td>
          <form method="post" class="col-fluid" action="/admin/del">
            <input type="hidden" class="form-control" value='<?php echo $row['Id']; ?>' name="strdel">
            <input type="submit" class="form-control btn btn-danger" value="Удалить">
          </form>
          </td>
        </tr>
    <?php } ?>
  </table>
</div>
