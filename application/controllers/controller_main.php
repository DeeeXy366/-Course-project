<?php
class Controller_Main extends Controller{
	function __construct(){
		$this->model = new Model_Main();
		$this->view = new View();
	}
	// Главная страница
	function action_index(){
		$data = $this->model->get_products();
		$this->view->generate('main_view.php', 'template_view.php', $data);
	}
	// Главная страница

	// Страница продуктов
	function action_product(){
		$data = $this->model->get_product();
		$this->view->generate('product_view.php', 'template_view.php', $data);
	}
	// Страница продуктов

	// Страница корзины
	function action_basket(){
		$data = $this->model->get_basket();
		$this->view->generate('basket_view.php', 'template_view.php', $data);
	}
	// Страница корзины

	// Шапка(регистрация, авторизация)
	function action_user(){
		$data = $this->model->get_user();
		$this->view->generate('template_view.php', $data);
	}
	// Шапка(регистрация, авторизация)

	// Шапка(регистрация, авторизация)
	function action_reg(){
		$this->model->user_register($_POST['login'], $_POST['password']);
		header('Location:'.$_POST['page']);
	}

	function action_newname(){
		$this->model->user_newname($_POST['login'], $_POST['log']);
		header('Location:'.$_POST['page']);
	}

	function action_newpass(){
		$this->model->user_newpass($_POST['log'], $_POST['passnew'], $_POST['passold']);
		header('Location:'.$_POST['page']);
	}

	function action_exit(){
		$_SESSION = array();
		$_SESSION['is_auth'] = '0';
		$_SESSION['status'] = '0';
		$_SESSION['login'] = '';
		$_SESSION['accept'] = '0';
		$_SESSION['warringempty'] = '0';
		$_SESSION['warringps'] = '0';
		$_SESSION['warringlog'] = '0';
		$_SESSION['warring'] = '0';
		$_SESSION['accept'] = '0';
		$_SESSION['warringpas'] = '0';
		$this->model->exit();
		header('Location:/main');
	}

	function action_go(){
		$this->model->user_($_POST['login'], $_POST['password']);
		header('Location:'.$_POST['page']);
	}
	// Шапка(регистрация, авторизация)

	// Главная страница
	function action_show(){
		$_SESSION['warringempty'] = '0';
		$_SESSION['warringps'] = '0';
		$_SESSION['warringlog'] = '0';
		$_SESSION['warring'] = '0';
		$_SESSION['accept'] = '0';
		$_SESSION['accept'] = '0';
		$_SESSION['warringpas'] = '0';
		$_SESSION['label'] = $_POST['label'];
		$_SESSION['idproducts']  = $_POST['id'];
		header('Location:/main/product');
	}

	function action_addp(){
		$this->model->add_ps($_POST['logo'], $_POST['label'], $_POST['info'], $_POST['price']);
		header('Location:/main');
	}

	function action_delps(){
		$this->model->dell_ps($_POST['drop'], $_POST['img']);
		header('Location:/main');
	}

	function action_change(){
		$this->model->change_ps($_POST['id'], $_POST['img'], $_POST['logo'], $_POST['label'], $_POST['info'], $_POST['price']);
		header('Location:/main');
	}
	// Главная страница

	// Страница продуктов
	function action_back(){
		$_SESSION['warringempty'] = '0';
		$_SESSION['warringps'] = '0';
		$_SESSION['warringlog'] = '0';
		$_SESSION['warring'] = '0';
		$_SESSION['accept'] = '0';
		$_SESSION['warringpas'] = '0';
		header('Location:/main');
	}

	function action_add(){
		$this->model->add_p($_POST['id_p'], $_POST['logo_p'], $_POST['label_p'], $_POST['info_p'], $_POST['price_p']);
		header('Location:/main/product');
	}

	function action_delp(){
		$this->model->dell_p($_POST['drop'], $_POST['img']);
		header('Location:/main/product');
	}

	function action_changep(){
		$this->model->change_p($_POST['id_p'], $_POST['img_p'], $_POST['logo_p'], $_POST['label_p'], $_POST['info_p'], $_POST['price_p']);
		header('Location:/main/product');
	}

	function action_baskadd(){
		$this->model->bask_add($_POST['b_add']);
		header('Location:/main/product');
	}
	// Страница продуктов

	// Страница корзины
	function action_baskdel(){
		$this->model->bask_del($_POST['b_del']);
		header('Location:/main/basket');
	}

	function action_baskplus(){
		$this->model->bask_plus($_POST['b_plus']);
		header('Location:/main/basket');
	}

	function action_baskminus(){
		$this->model->bask_minus($_POST['b_minus'], $_POST['num']);
		header('Location:/main/basket');
	}

	function action_accept(){
		$_SESSION['order'] = '0';
		$_SESSION['accept'] = '1';
		$this->model->accept();
		header('Location:/main');
	}
	// Страница корзины
}
?>
