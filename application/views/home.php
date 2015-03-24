<div id="content">
  <div id="content-left"> 

<?php

	function getExcerpt($str, $startPos=0, $maxLength=100) {
	if(strlen($str) > $maxLength) {
		$excerpt   = substr($str, $startPos, $maxLength-3);
		$lastSpace = strrpos($excerpt, ' ');
		$excerpt   = substr($excerpt, 0, $lastSpace);
		$excerpt  .= '...';
	} else {
		$excerpt = $str;
	}
	
	return $excerpt;
}


	
	//echo titleToURL("Learning PHP Programming, Part 1");
	
	
	
	for($p=0;$p<count($posts);$p++)
	{
		
?>
    <!-- Post Block Start -->
    <div class="post-block">
      <h3><a href="<?=site_url()?>/posts/index/<?=$posts[$p]['url']?>"><?=$posts[$p]['title']?></a></h3>
      <div class="post-info"> <span class="post-author"><b>Author:</b> <?=$posts[$p]['name']?></span> <span class="post-datetime"> <b>Posted on:</b> <?=$posts[$p]['timestamp']?></span> <span class="post-datetime"> <b>Category:</b> <?=$posts[$p]['c_name']?></span></div>
      <div class="post-content">
      	<?=getExcerpt($posts[$p]['content'],0,500)?>
      </div>
      <div class="read-more-block" align="right"> <a href="<?=site_url()?>/posts/index/<?=$posts[$p]['url']?>" class="read-more">Read More ></a> </div>
    </div>
    <!-- Post Block End --> 
 <?php
	}
 ?>   
  </div>
  <div id="sidebar">
    <div class="sidebar-box">
      <h4> Categories </h4>
      <div class="sidebar-links">
       <ul>
       <?php
			for($i=0; $i<count($categories);$i++)
			{
		?>
          <li><a href="categories/index/<?= $categories[$i]['cid'] ?> "><?= $categories[$i]['c_name'] ?> </a> </li>
        <?php
			}
		?>
        </ul>
      </div>
    </div>
  </div>
</div>
<div class="clearfix"></div>
<div id="paging">
<div id="paging-inner">
  <ul class="pagination">
    <li><a href="#">&laquo;</a></li>
    	<?php
		
			$total_pages = ($post_count['post_count'] / POSTS_PER_PAGE);
			$total_pages = ceil($total_pages);
			for($i=1;$i<=$total_pages;$i++)
			{
				echo "<li> <a href='".site_url()."/home/index/$i'> $i </a> </li>";
			}
		?>
    <li><a href="#">&raquo;</a></li>
  </ul>
  </div>
</div>
