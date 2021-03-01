<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="Стройматериалы с доставкой в томске. Интернет магазин BuildBazar предлагает вам купить стройматериалы по приемлимым ценам с доставкой">
	<meta name="keywords" content="Стройматериалы в Томске, Стройматериалы с доставкой, Доставка стройматериалов, Томские доставки инструментов, Инструменты Томск">
	<title>BuildBazar магазин стройматериалов</title>
	<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<link rel="stylesheet" href="/css/master.css">
	<script src="../../js/vue.js"></script>
	<script defer src="../../js/main.js"></script>
</head>
<body>
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
	<img src="../images/logo.png" class="rounded float-left" onclick="location.href='/main'" style="height:40px; margin-top:-10px; cursor: pointer;" alt="BuildBazar" border="0">
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>
<div class="collapse navbar-collapse" id="navbarSupportedContent">
	<ul class="navbar-nav mr-auto"><li class="nav-item text-white"></li></ul>
	<?php
	if (isset($_SESSION['is_auth'])){
		if ($_SESSION['is_auth'] == '0'){
	?>
	<button type="button" class="btn btn-info" data-toggle="modal" data-target="#exampleModal">Регистрация</button>
	&nbsp; &nbsp;
	<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Регистрация</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
			<form action="/main/reg" method="post" class="was-validated">
	      <div class="modal-body">
	        <input  name="page" type="hidden" value="<?php echo $_SERVER['REQUEST_URI'] ?>">
					<input placeholder="Логин" maxlength="20" type="text" name="login" class="form-control" required>
					<br>
					<input placeholder="Пароль" maxlength="40" type="password" name="password" class="form-control" required>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
	        <input type="submit" method='post' class="btn btn-primary" value="Отправить">
	      </div>
			</form>
    </div>
  </div>
	</div>
	<ul class="navbar-nav justify-content-end">
		<div class="btn-group dropleft">
		  <a class="btn btn-primary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown">Вход</a>
		  <div class="dropdown-menu " aria-labelledby="dropdownMenuLink">
				<form method="post" class="container-fluid" action="/main/go">
						<input name="page" type="hidden" value="<?php echo $_SERVER['REQUEST_URI'] ?>">
						<input placeholder="Логин" maxlength="20" name="login" type="text" class="form-control">
						<input placeholder="Пароль" maxlength="40" name="password" type="password" class="form-control">
						<br><br><br>
						<input type="submit" method='post' value="Войти" class="form-control btn btn-dark" />
				</form>
		  </div>
		<?php }else{ ?>
		<img src="../images/basket.png" class="rounded float-left" onclick="location.href='../main/basket'" style="height:40px; cursor: pointer;" alt="Basket" border="0">
		&nbsp; &nbsp;
		<div class="dropdown">
			<h5 class='text-white dropdown-toggle' style="cursor: pointer;" id="dropdownMenuLink" data-toggle="dropdown"><?php echo $_SESSION["login"] ?></h5>
		  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
				<button type="button" class="btn btn-info dropdown-item" data-toggle="modal" data-target="#exampleModal">Изменить логин</button>
				<button type="button" class="btn btn-info dropdown-item" data-toggle="modal" data-target="#Modal">Изменить пароль</button>
		  </div>
		</div>
		<div class="modal fade" id="Modal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="ModalLabel">Изменение пароля</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<form action="/main/newpass" method="post" class="was-validated">
						<div class="modal-body">
							<input  name="log" type="hidden" value="<?php echo $_SESSION["login"] ?>">
							<input  name="page" type="hidden" value="<?php echo $_SERVER['REQUEST_URI'] ?>">
							<input placeholder="Новый пароль" maxlength="50" type="password" name="passnew" class="form-control" required>
							&nbsp; &nbsp;
							<input placeholder="Старый пароль" maxlength="50" type="password" name="passold" class="form-control" required>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
							<input type="submit" method='post' class="btn btn-primary" value="Отправить">
						</div>
					</form>
				</div>
			</div>
		</div>
		<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Изменение логина: <?php echo $_SESSION["login"] ?></h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<form action="/main/newname" method="post" class="was-validated">
						<div class="modal-body">
							<input  name="log" type="hidden" value="<?php echo $_SESSION["login"] ?>">
							<input  name="page" type="hidden" value="<?php echo $_SERVER['REQUEST_URI'] ?>">
							<input placeholder="Новый Логин" maxlength="20" type="text" name="login" class="form-control" required>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
							<input type="submit" method='post' class="btn btn-primary" value="Отправить">
						</div>
					</form>
				</div>
			</div>
		</div>
		&nbsp; &nbsp;
		<?php	if ($_SESSION['status'] == '2'){ ?>
			<form method="post" class="col-fluid" action="/admin">
				<input type="submit" class="form-control btn btn-info" value="Админ панель">
			</form>
			&nbsp; &nbsp;
		<?php } ?>
			<form method="post" class="col-fluid" action="/main/exit">
				<input type="submit" class="form-control btn btn-danger" value="Выход">
			</form>
		</div>
	</ul>
	<?php }
	}else{ ?>
		<button type="button" class="btn btn-info" data-toggle="modal" data-target="#exampleModal">Регистрация</button>
		&nbsp; &nbsp;
		<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Регистрация</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form action="/main/reg" method="post">
				<div class="modal-body">
					<input  name="page" type="hidden" value="<?php echo $_SERVER['REQUEST_URI'];?>">
					<input type="hidden" value='<?php echo $row['id']+1; ?>' name="id">
					<input  name="status" type="hidden" value="1">
					<input placeholder="Логин" maxlength="20" type="text" name="login" class="form-control" required>
					<br>
					<input placeholder="Пароль" maxlength="40" type="password" name="password" class="form-control" required>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
					<input type="submit" method='post' class="btn btn-primary" value="Отправить">
				</div>
				</form>
			</div>
		</div>
		</div>
		<ul class="navbar-nav justify-content-end">
			<div class="btn-group dropleft">
				<a class="btn btn-primary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown">Вход</a>
				<div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
					<form method="post" class ="container-fluid" action="/main/go">
							<input name="page"  type="hidden" value="<?php echo $_SERVER['REQUEST_URI'] ?>">
							<input placeholder="Логин" maxlength="20" type="text" name="login" class="form-control" required>
							<input placeholder="Пароль" maxlength="40" type="password" name="password" class="form-control" required>
							<br><br><br>
							<input type="submit" method="post" value="Войти" class = "form-control btn btn-dark" />
					</form>
				</div>
			</div>
		</ul>
<?php	} ?>
</div>
</nav>
<?php	if (isset($_SESSION['warringpas'])){
				if ($_SESSION['warringpas'] == '1'){ ?>
				<div class="alert alert-danger text-center" role="alert">
					Старый пароль введен неверно!
				</div>
<?php 	}
			}if (isset($_SESSION['accept'])){
				if ($_SESSION['accept'] == '1'){ ?>
				<div class="alert alert-success text-center" role="alert">
					Действие совершено успешно.
				</div>
<?php 	}
			}if (isset($_SESSION['warringps'])){
				if ($_SESSION['warringps'] == '1'){ ?>
				<div class="alert alert-danger text-center" role="alert">
					Такое название товара уже существует!
				</div>
<?php 	}
			}if (isset($_SESSION['warringlog'])){
				if ($_SESSION['warringlog'] == '1'){ ?>
				<div class="alert alert-danger text-center" role="alert">
					Такой логин уже существует!
				</div>
<?php 	}
			}if (isset($_SESSION['warring'])){
				if ($_SESSION['warring'] == '1'){ ?>
				<div class="alert alert-danger text-center" role="alert">
					Пароль или логин введены неверно!
				</div>
	<?php }
			}if (isset($_SESSION['warringempty'])){
				if ($_SESSION['warringempty'] == '1'){ ?>
				<div class="alert alert-danger text-center" role="alert">
					Вы оставили одно из полей пустым!
				</div>
	<?php }
			} ?>
	<?php include_once 'application/views/'.$content_view ?>
	<br><br>
	<footer>
		<p class="d-inline">Все права зашищены © 2019-2020</p>
		<p class="d-inline tel">Телефон поддержки: 88-88-88</p>
	</footer>
</body>
</html>
