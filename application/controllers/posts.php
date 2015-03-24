<?php

class posts extends CI_Controller
{
	function index($id)
	{
		$this->load->model('posts_model');
		$this->load->model('category_model');
		$this->load->model('comments_model');
		$data['post'] = $this->posts_model->getSinglePost($id);
		$data['categories'] = $this->category_model->getAllCategories();
		$data['comments'] = $this->comments_model->getPostComments($data['post']['id']);
		$data['title'] = "My Test Blog";
		$this->load->view('common/header',$data);
		$this->load->view('posts/single',$data);
		$this->load->view('common/footer');
	}
	
	function add()
	{
		$this->load->library('session');
		if($this->input->post('title'))
		{
			echo "fdsfsdfs";
			$title = $this->input->post('title');
			$author = $this->input->post('author');
			$category = $this->input->post('category');
			$content = addslashes($this->input->post('content'));
			$this->load->model('posts_model');
			$result = $this->posts_model->addPost($title,$author,$category,$content);
			echo $result;
			if($result)
			{
				$this->session->set_flashdata('success','Post Successfull!');echo "success";
			}else
			{
				$this->session->set_flashdata('error','Error!');
				echo $result;
			}
		}
		$data['title'] = "My Test Blog";
		$this->load->view('common/header',$data);
		$this->load->view('posts/addPost',$data);
		$this->load->view('common/footer');
	}
}

?>