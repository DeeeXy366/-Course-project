<?php
class Model
{
	public function __construct()
	{
		mysqli_set_charset($this->link = new mysqli($GLOBALS['site'], $GLOBALS['login'], $GLOBALS['password'], $GLOBALS['lib']), 'utf8');
	}
	public function get_data()
	{
	}
}

?>
