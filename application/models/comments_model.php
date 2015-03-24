<?php
	
	class comments_model extends CI_Model
	{
		var $conn;
		
		function  __construct()
		{
			$this->conn = new MySQLi(DB_HOST,DB_USER,DB_PASS,DB_NAME);
		}
		
		function getPostComments($post_id)
		{
			$results = $this->conn->query("SELECT  `id`, `name`,`comment`,`timestamp` FROM `comments` WHERE `post_id` = '$post_id' ORDER BY `timestamp` DESC");
			
			$output = array();
			while($data = $results->fetch_assoc())
			{
				$output[] = $data;
			}
			return $output;
		}
		
		
		function getLatestComments($post_id,$last_comment_id = 0)
		{
			$results = $this->conn->query("SELECT `id`, `name`,`comment`,`timestamp` FROM `comments` WHERE `post_id` = '$post_id' AND `id` > '$last_comment_id' ORDER BY `timestamp` DESC");
			
			$output = array();
			while($data = $results->fetch_assoc())
			{
				$output[] = $data;
			}
			return $output;
		}
		
		
		function addComment($post_id,$name,$email,$comment)
		{
			$this->conn->query("INSERT INTO `comments` VALUES(NULL,'$post_id','$comment','$name','$email',NOW())");
			
			if($this->conn->error)
			{
				return 0;
			}else
			{
				return 1;
			}
		}
		
	}
	
?>