<?php
class Model_Main extends Model{
	// Страница корзины
	public function get_basket(){
			$object = 'SELECT * FROM product';
			$rese = mysqli_query($this->link, $object);
			return $rese;
	}
	// Страница корзины

	// Шапка(регистрация, авторизация)
	public function get_user(){
			$object = 'SELECT * FROM users';
			$rese = mysqli_query($this->link, $object);
			return $rese;
	}

	public function user_newname($login, $log){
		if($_SESSION['status'] != '0'){
			$objectid = "SELECT * FROM users WHERE Login = '$login'";
			$resultid = mysqli_query($this->link, $objectid)->fetch_array();
			if (isset($resultid)){
				$_SESSION['warringlog'] = '1';
				$_SESSION['warring'] = '0';
				$_SESSION['warringempty'] = '0';
				$_SESSION['warringps'] = '0';
				$_SESSION['accept'] = '0';
				$_SESSION['warringpas'] = '0';
			}else if (empty($login)){
				$_SESSION['warringempty'] = '1';
				$_SESSION['warring'] = '0';
				$_SESSION['warringlog'] = '0';
				$_SESSION['warringps'] = '0';
				$_SESSION['accept'] = '0';
				$_SESSION['warringpas'] = '0';
			}else{
				$object = "SELECT * FROM users WHERE Login = '$log'";
				$result = mysqli_query($this->link, $object)->fetch_array();
				if ($_SESSION["login"] == $result["Login"]){
					$_SESSION['warringlog'] = '0';
					$_SESSION['warringempty'] = '0';
					$_SESSION['accept'] = '1';
					$sql = "UPDATE users SET Login = '$login' WHERE Login = '$log'";
					$result = mysqli_query($this->link, $sql);
					$_SESSION["login"] = $login;
					return $result;
				}
			}
		}
	}

	public function user_newpass($log, $new, $old){
		if($_SESSION['status'] != '0'){
			if (empty($new) || empty($old)){
				$_SESSION['warringempty'] = '1';
				$_SESSION['warring'] = '0';
				$_SESSION['warringlog'] = '0';
				$_SESSION['warringps'] = '0';
				$_SESSION['accept'] = '0';
				$_SESSION['warringpas'] = '0';
			}else{
				$object = "SELECT * FROM users WHERE Login = '$log'";
				$result = mysqli_query($this->link, $object)->fetch_array();
				if ($_SESSION["login"] == $result["Login"]){
					$old = md5($old);
					$pass = md5($new);
					if ($old == $result["Password"]){
						$_SESSION['warringempty'] = '0';
						$_SESSION['warringpas'] = '0';
						$_SESSION['accept'] = '1';
						$sql = "UPDATE users SET Password = '$pass' WHERE Login = '$log'";
						$result = mysqli_query($this->link, $sql);
						return $result;
					}else{
						$_SESSION['warringpas'] = '1';
					}
				}
			}
		}
	}

	public function user_register($login, $password){
		$objectid = "SELECT * FROM users WHERE Login = '$login'";
		$resultid = mysqli_query($this->link, $objectid)->fetch_array();
		if (isset($resultid)){
			$_SESSION['warringlog'] = '1';
			$_SESSION['warring'] = '0';
			$_SESSION['warringempty'] = '0';
			$_SESSION['warringps'] = '0';
			$_SESSION['warringpas'] = '0';
		}else if (empty($login) || empty($password)){
			$_SESSION['warringempty'] = '1';
			$_SESSION['warring'] = '0';
			$_SESSION['warringlog'] = '0';
			$_SESSION['warringps'] = '0';
			$_SESSION['warringpas'] = '0';
		}else{
			$_SESSION['warringlog'] = '0';
			$_SESSION['warringempty'] = '0';
			$_SESSION['accept'] = '1';
			$password = md5($password);
			$sql = "INSERT INTO users (Login, Password, Status) VALUES ('$login', '$password', '1')";
			$result = mysqli_query($this->link, $sql);
			return $result;
		}
	}

  public function user_($login, $password){
		if (!empty($login) && !empty($password)){
			$_SESSION['warringempty'] = '0';
			$password = md5($password);
	    $objectid = "SELECT * FROM users WHERE Login = '$login' AND Password = '$password'";
	    $resultid = mysqli_query($this->link, $objectid)->fetch_array();
	    if ($resultid == NULL){
				$_SESSION['warring'] = '1';
				$_SESSION['is_auth'] = '0';
				$_SESSION['warringlog'] = '0';
				$_SESSION['warringempty'] = '0';
				$_SESSION['warringps'] = '0';
				$_SESSION['warringpas'] = '0';
				$_SESSION['accept'] = '0';
	    }else{
				$_SESSION['is_auth'] = '1';
				$_SESSION['login'] = $login;
				$_SESSION['warring'] = '0';
				$_SESSION['accept'] = '0';
				$_SESSION['warringempty'] = '0';
				$_SESSION['warringlog'] = '0';
				$_SESSION['warringps'] = '0';
				$_SESSION['warringpas'] = '0';
	      $object = "SELECT Status FROM users WHERE Login = '$login' AND Password = '$password'";
	      $result = mysqli_query($this->link, $object)->fetch_array();
	      $_SESSION['status'] = $result['Status'];
	    }
		}else{
			$_SESSION['warringempty'] = '1';
			$_SESSION['warring'] = '0';
			$_SESSION['warringlog'] = '0';
			$_SESSION['warringps'] = '0';
			$_SESSION['accept'] = '0';
			$_SESSION['accept'] = '0';
			$_SESSION['warringpas'] = '0';
		}
  }

	public function exit(){
		$_SESSION['warringone'] = '0';
		$sql = "UPDATE product SET basket = '0'";
		$result = mysqli_query($this->link, $sql);
		$sq = "UPDATE product SET num = '1'";
		$res = mysqli_query($this->link, $sq);
		return $res;
		return $result;
	}
	// Шапка(регистрация, авторизация)

	// Главная страница
	public function get_products(){
			$object = 'SELECT * FROM products';
			$rese = mysqli_query($this->link, $object);
			return $rese;
	}

	public function add_ps($logo, $label, $info, $price){
		if($_SESSION['status'] == '2' || $_SESSION['status'] == '3'){
			$objectw = "SELECT * FROM products WHERE Label = '$label'";
			$resultw = mysqli_query($this->link, $objectw)->fetch_array();
			if (isset($resultw)){
				$_SESSION['warringps'] = '1';
				$_SESSION['warringempty'] = '0';
				$_SESSION['warringlog'] = '0';
				$_SESSION['warring'] = '0';
				$_SESSION['accept'] = '0';
				$_SESSION['warringpas'] = '0';
			}else if (empty($label) || empty($info) || empty($price)){
				$_SESSION['warringempty'] = '1';
				$_SESSION['warringps'] = '0';
				$_SESSION['warringlog'] = '0';
				$_SESSION['warring'] = '0';
				$_SESSION['accept'] = '0';
				$_SESSION['warringpas'] = '0';
			}else{
				$_SESSION['warringps'] = '0';
				$_SESSION['warringempty'] = '0';
				$filename = $_FILES['logo']['name'];
				$extension = 'webp';
				$filename = uniqid() . '.' . $extension;
				move_uploaded_file($_FILES['logo']['tmp_name'], "images/".$filename);
				$tmp_name = "images/".$filename;
				$sql = "INSERT INTO products (LogoPath, Label, Info, Price) VALUES ('$tmp_name', '$label', '$info', '$price')";
				$result = mysqli_query($this->link, $sql);
				return $result;
			}
		}
	}

	public function dell_ps($id, $img){
		if($_SESSION['status'] == '2' || $_SESSION['status'] == '3'){
			$count = "SELECT COUNT(*) FROM product WHERE Id_p = '$id'";
			$result = mysqli_query($this->link, $count)->fetch_array();
			for($i = 0; $i < $result['COUNT(*)']; $i++){
				$image = "SELECT Logo_p FROM product WHERE Id_p = '$id' AND Logo_p != ''";
				$img_p = mysqli_query($this->link, $image)->fetch_array();
				unlink($img_p['Logo_p']);
				$empty = $img_p['Logo_p'];
				$sq = "UPDATE product SET Logo_p = '' WHERE Logo_p = '$empty'";
				mysqli_query($this->link, $sq);
			}
			unlink($img);
			$sql = "DELETE FROM products WHERE Id_ps = '$id'";
			$result = mysqli_query($this->link, $sql);
			$sql_drop = "DELETE FROM product WHERE Id_p = '$id'";
			$result_drop = mysqli_query($this->link, $sql_drop);
			return $result_drop;
			return $result;
		}
	}

	public function change_ps($id, $img, $logo, $label, $info, $price){
		if($_SESSION['status'] == '2' || $_SESSION['status'] == '3'){
			$objectw = "SELECT * FROM products WHERE Label = '$label' AND Id_ps != '$id'";
			$resultw = mysqli_query($this->link, $objectw)->fetch_array();
			if (isset($resultw)){
				$_SESSION['warringps'] = '1';
				$_SESSION['warringempty'] = '0';
				$_SESSION['warringlog'] = '0';
				$_SESSION['warring'] = '0';
				$_SESSION['accept'] = '0';
				$_SESSION['warringpas'] = '0';
			}else if (empty($label) || empty($info) || empty($price)){
				$_SESSION['warringempty'] = '1';
				$_SESSION['warringps'] = '0';
				$_SESSION['warringlog'] = '0';
				$_SESSION['warring'] = '0';
				$_SESSION['accept'] = '0';
				$_SESSION['warringpas'] = '0';
			}else{
				$_SESSION['warringps'] = '0';
				$_SESSION['warringempty'] = '0';
				$filename = $_FILES['logo']['name'];
				if (empty($filename)){
					$tmp_name = $img;
				}else{
					unlink($img);
					$extension = 'webp';
					$filename = uniqid() . '.' . $extension;
					move_uploaded_file($_FILES['logo']['tmp_name'], "images/".$filename);
					$tmp_name = "images/".$filename;
				}
				$sql = "UPDATE products SET LogoPath = '$tmp_name', Label = '$label', Info = '$info', Price = '$price' WHERE Id_ps = '$id'";
				$result = mysqli_query($this->link, $sql);
				return $result;
			}
		}
	}
	// Главная страница

	// Страница продуктов
	public function get_product(){
			$object = 'SELECT * FROM product';
			$rese = mysqli_query($this->link, $object);
			return $rese;
	}

	public function dell_p($id, $img){
		if($_SESSION['status'] == '2' || $_SESSION['status'] == '3'){
			unlink($img);
			$sql = "DELETE FROM product WHERE id_pdel = '$id'";
			$res = mysqli_query($this->link, $sql);
			return $res;
		}
	}

	public function add_p($id, $logo, $label, $info, $price){
		if($_SESSION['status'] == '2' || $_SESSION['status'] == '3'){
			$objectw = "SELECT * FROM product WHERE Label_p = '$label'";
			$resultw = mysqli_query($this->link, $objectw)->fetch_array();
			if (isset($resultw)){
				$_SESSION['warringps'] = '1';
				$_SESSION['warringempty'] = '0';
				$_SESSION['warringlog'] = '0';
				$_SESSION['warring'] = '0';
				$_SESSION['accept'] = '0';
				$_SESSION['warringpas'] = '0';
			}else if (empty($label) || empty($info) || empty($price)){
				$_SESSION['warringempty'] = '1';
				$_SESSION['warringps'] = '0';
				$_SESSION['warringlog'] = '0';
				$_SESSION['warring'] = '0';
				$_SESSION['accept'] = '0';
				$_SESSION['warringpas'] = '0';
			}else{
				$_SESSION['warringps'] = '0';
				$_SESSION['warringempty'] = '0';
				$filename = $_FILES['logo_p']['name'];
				$extension = 'webp';
				$filename = uniqid() . '.' . $extension;
				move_uploaded_file($_FILES['logo_p']['tmp_name'], "images/".$filename);
				$tmp_name = "images/" . $filename;
				$sql = "INSERT INTO product (Id_p, num, Logo_p, Label_p, Info_p, Price_p, basket) VALUES ('$id', '1', '$tmp_name', '$label', '$info', '$price', '0')";
				$result = mysqli_query($this->link, $sql);
				return $result;
			}
		}
	}

	public function change_p($id, $img, $logo, $label, $info, $price){
		if($_SESSION['status'] == '2' || $_SESSION['status'] == '3'){
			$objectw = "SELECT * FROM product WHERE Label_p = '$label' AND Id_pdel != '$id'";
			$resultw = mysqli_query($this->link, $objectw)->fetch_array();
			if (isset($resultw)){
				$_SESSION['warringps'] = '1';
				$_SESSION['warringempty'] = '0';
				$_SESSION['warringlog'] = '0';
				$_SESSION['warring'] = '0';
				$_SESSION['accept'] = '0';
				$_SESSION['warringpas'] = '0';
			}else if (empty($label) || empty($info) || empty($price)){
				$_SESSION['warringempty'] = '1';
				$_SESSION['warringps'] = '0';
				$_SESSION['warringlog'] = '0';
				$_SESSION['warring'] = '0';
				$_SESSION['accept'] = '0';
				$_SESSION['warringpas'] = '0';
			}else{
				$_SESSION['warringps'] = '0';
				$_SESSION['warringempty'] = '0';
				$filename = $_FILES['logo_p']['name'];
				if (empty($filename)){
					$tmp_name = $img;
				}else{
					unlink($img);
					$extension = 'webp';
					$filename = uniqid() . '.' . $extension;
					move_uploaded_file($_FILES['logo_p']['tmp_name'], "images/".$filename);
					$tmp_name = "images/".$filename;
				}
				$sql = "UPDATE product SET Logo_p = '$tmp_name', Label_p = '$label', Info_p = '$info', Price_p = '$price' WHERE id_pdel = '$id'";
				$result = mysqli_query($this->link, $sql);
				return $result;
			}
		}
	}

	public function bask_add($bask){
		if($_SESSION['status'] != '0'){
			$_SESSION['order'] = '1';
			$sql = "UPDATE product SET basket = '1' WHERE id_pdel = '$bask'";
			$result = mysqli_query($this->link, $sql);
			return $result;
		}
	}
	// Страница продуктов

	// Страница корзины
	public function bask_del($bask){
		$sql = "UPDATE product SET basket = '0' WHERE id_pdel = '$bask'";
		$result = mysqli_query($this->link, $sql);
		$sq = "UPDATE product SET num = '1' WHERE id_pdel = '$bask'";
		$res = mysqli_query($this->link, $sq);
		return $res;
		return $result;
	}

	public function bask_plus($plus){
		$sql = "UPDATE product SET num = num + 1 WHERE id_pdel = '$plus'";
		$result = mysqli_query($this->link, $sql);
		return $result;
	}

	public function bask_minus($minus, $num){
		if ($num > 1) {
			$sql = "UPDATE product SET num = num - 1 WHERE id_pdel = '$minus'";
			$result = mysqli_query($this->link, $sql);
			return $result;
		}
	}

	public function accept(){
		$_SESSION['order'] = '0';
		$sql = "UPDATE product SET basket = '0'";
		$result = mysqli_query($this->link, $sql);
		$sq = "UPDATE product SET num = '1'";
		$res = mysqli_query($this->link, $sq);
		return $res;
		return $result;
	}
	// Страница корзины
}
?>
