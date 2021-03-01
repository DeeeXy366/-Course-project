<?php
class Controller_Admin extends Controller{
	function __construct(){
		$this->model = new Model_Admin();
		$this->view = new View();
	}

	function action_index(){
		$data = $this->model->get_data();
		$this->view->generate('admin_view.php', 'template_view.php', $data);
	}

	function action_del(){
		$this->model->del($_POST['strdel']);
		header('Location:/admin');
	}

	function action_edit(){
		$this->model->edit($_POST['strdel'], $_POST['Status']);
		header('Location:/admin');
	}
}
?>
