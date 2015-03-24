<?php

class comments extends CI_Controller
{
	function addPostComment()
	{
		$post_id = $this->input->post('post_id');
		$name = $this->input->post('name');
		$email = $this->input->post('email');
		$comment = $this->input->post('comment');
		$last_comment_id = $this->input->post('last_comment_id');
		
		$this->load->model('comments_model');
		$result = $this->comments_model->addComment($post_id,$name,$email,$comment);
		
		if($result)
		{
			$new_comments = $this->comments_model->getLatestComments($post_id,$last_comment_id);
			//json = javascript object notation
			echo json_encode($new_comments);
		}else
		{
			echo "error";
		}
		
		
	}
}

?>