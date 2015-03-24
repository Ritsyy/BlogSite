<script language="javascript">
	$(document).ready(function(e) {
        $('#addCommentBtn').click(function(){
			$.ajax({
				url:'<?=site_url();?>/comments/addPostComment/',
				type:'POST',
				data:{'name':$('#c_name').val(),'email':$('#c_email').val(),'comment':$('#c_comment').val(),'post_id':$('#c_post_id').val(),'last_comment_id':$('#c_last_comment_id').val()},
				success: function(data)
				{
					if(data == "error")
					{
						alert('error posting comment');
					}else
					{
						
						$('#c_comment').val('');
						$('#c_name').val('');
						$('#c_email').val('');
						
					//$('#comment-area').prepend('comment posted');
						
						var c_data = $.parseJSON(data);
						var c_str = new String();
						console.log(c_data);
						for(var i=0;i<c_data.length;i++)
						{
							if(i == 0)
							{
								$('#c_last_comment_id').val(c_data[i].id);
							}
							
							c_str += '<div class="comment-block"><div class="comment-author"> <span><strong>'+c_data[i].name+'</strong></span> <span class="comment-time">'+c_data[i].timestamp+'</span></div><div class="comment-content"> '+c_data[i].comment+' </div></div>';
						}
						
						$('#comment_start_point').after(c_str);
						console.log(c_str);
					}
				}
				
			});
		})
    });
</script>

<div id="content">
  <div id="content-left"> 
    <!-- Post Block Start -->
    <div class="post-block">
      <h3>
        <?=$post['title']?>
      </h3>
      <div class="post-info"> <span class="post-author"><b>Author:</b>
        <?=$post['name']?>
        </span> <span class="post-datetime"> <b>Posted on:</b>
        <?=$post['timestamp']?>
        </span> <span class="post-datetime"> <b>Category:</b>
        <?=$post['c_name']?>
        </span></div>
      <div class="post-content">
        <?=$post['content']?>
      </div>
    </div>
    <!-- Post Block End -->
    
    <div id="comment-area">
    	
      <h3> Comments</h3>
      <br />
      <form>
        <div class="form-group">
          <label>Name: </label>
          <br />
          <input type="text" id="c_name" placeholder="" class="form-control" />
        </div>
        <div class="form-group">
          <label>Email: </label>
          <br />
          <input type="text" id="c_email" placeholder="" class="form-control " />
        </div>
        <div class="form-group">
          <label>Comment: </label>
          <br />
          <textarea class="form-control" id="c_comment" rows="5"></textarea>
        </div>
        <input type="hidden" id="c_post_id" value=" <?=$post['id']?>" />
        <input type="button" id="addCommentBtn" value="Add Comment" class="btn btn-primary" />
     
      <br />
      <br />
      
      <div id="comment_start_point"> </div>
      
      <?php for($c = 0; $c<count($comments); $c++) { ?>
      <?php
	  	if($c == 0) {
	  ?>
      <input type="hidden" name="c_last_comment_id" id="c_last_comment_id" value="<?=$comments[$c]['id']?>" />
	  <?php
      	}
	  ?>
      <!-- comment-block start -->
      <div class="comment-block">
        <div class="comment-author"> <span><strong><?=$comments[$c]['name'] ?></strong></span> <span class="comment-time"> <?=$comments[$c]['timestamp'] ?></span> </div>
        <div class="comment-content"> <?=$comments[$c]['comment'] ?> </div>
      </div>
	<!-- comment-block start -->
    <?php } ?>
     </form>
    </div>
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
          <li><a href="categories/index/<?= $categories[$i]['cid'] ?> ">
            <?= $categories[$i]['c_name'] ?>
            </a> </li>
          <?php
			}
		?>
        </ul>
      </div>
    </div>
  </div>
</div>
<div class="clearfix"></div>
