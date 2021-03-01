<?php
class Model_Admin extends Model{
	public function get_data(){
		$object = 'SELECT * FROM users';
		$rese = mysqli_query($this->link, $object);
		return $rese;
	}

	public function del($Id){
		if($_SESSION['status'] == '2'){
			$sql = "DELETE FROM users WHERE Id = '$Id'";
			$result = mysqli_query($this->link, $sql);
			return $result;
		}
	}

	public function edit($Id, $Status){
		if($_SESSION['status'] == '2'){
			$ref = "UPDATE users SET Status = '$Status' WHERE Id = '$Id'";
			$res = mysqli_query($this->link, $ref);
			return $res;
		}
	}
}
?>
