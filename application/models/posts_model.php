<?php
class posts_model extends CI_Model
{
	var $conn;
	
	function __construct()
	{
		$this->conn = new MySQLi(DB_HOST,DB_USER,DB_PASS,DB_NAME);
	}
	
	function getLatestPosts($count=10,$start=0)
	{
		$results = $this->conn->query("SELECT `posts`.`id`,`posts`.`title`,`posts`.`content`,`posts`.`timestamp`,`user`.`name`,`categories`.`c_name`,`posts`.`url` FROM `posts`,`user`,`categories` WHERE `posts`.`author` = `user`.`id` AND `posts`.`category` = `categories`.`cid` ORDER BY `posts`.`timestamp` DESC LIMIT $start, $count");
		
		$output = array();
		while($data = $results->fetch_assoc())
		{
			$output[] = $data;
		}
		
		return $output;
	}
	
	function getSinglePost($url)
	{
		$result = $this->conn->query("SELECT `posts`.`id`,`posts`.`title`,`posts`.`content`,`posts`.`timestamp`,`user`.`name`,`categories`.`c_name` FROM `posts`,`user`,`categories` WHERE `posts`.`author` = `user`.`id` AND `posts`.`category` = `categories`.`cid` AND `posts`.`url` = '$url'");
		
		return $result->fetch_assoc();
	}
	
	function countPosts()
	{
		$result = $this->conn->query('SELECT COUNT(*) as `post_count` FROM `posts`');
		return $result->fetch_assoc();
	}
	
	
	function titleToURL($title)
	{
		$arr = array(32);
		$arr = array_merge($arr,range(48,57),range(65,91),range(97,122));
		$str = "";
		for($i=0;$i<strlen($title);$i++)
		{
			if(in_array(ord($title[$i]),$arr))
			{
				$str .= $title[$i];
			}
		}
		$str = strtolower($str);
		$str = str_replace(" ","-",$str);
		return $str;
	}
	
	function addPost($title,$author,$category,$content)
	{
		$url = $this->titleToURL($title);
		$this->conn->query("INSERT INTO `posts` VALUES (NULL,'$author','$category','$title','$content','$url',NOW())");
		if($this->conn->error)
		{
			return $this->conn->error;
		}else
		{
			return 1;
		}
	}
}
?>