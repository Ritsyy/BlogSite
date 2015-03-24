<?php
class home extends CI_Controller
{
	function index($page=1)
	{
		$this->load->model('category_model');
		$this->load->model('posts_model');
		$data['title'] = "My Blog Title";
		$data['categories'] = $this->category_model->getAllCategories();
		$data['posts'] = $this->posts_model->getLatestPosts(POSTS_PER_PAGE,($page-1)*POSTS_PER_PAGE);
		$data['post_count'] = $this->posts_model->countPosts();
		$this->load->view('common/header',$data);
		$this->load->view('home');
		$this->load->view('common/footer');
	}
}
?>