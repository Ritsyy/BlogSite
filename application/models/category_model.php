<?php
class category_model extends CI_Model
{
	var $conn;
	
	function __construct()
	{
		$this->conn = new MySQLi(DB_HOST,DB_USER,DB_PASS,DB_NAME);
	}
	
	function getAllCategories()
	{
		$result = $this->conn->query('SELECT * FROM `categories`');
		$output = array();
		while($data = $result->fetch_assoc())
		{
			$output[] = $data;
		}
		return $output;
	}
	
}
?>