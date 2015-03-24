<script language="javascript" src="<?=base_url()?>assets/ckeditor/ckeditor.js"></script>
<script language="javascript" src="<?=base_url()?>assets/ckeditor/adapters/jquery.js"></script>

<script language="javascript">
	$( document ).ready( function() {
		$( 'textarea#editor' ).ckeditor();
	} );
</script>
<form method="post">
<div class="form-group">
          <label>Post Title: </label>
          <br />
          <input type="text" name="title" placeholder="" class="form-control" />
        </div>
        
        <div class="form-group">
          <label>Author</label>
          <br />
          <input type="text" name="author" placeholder="" class="form-control" />
        </div>

		 <div class="form-group">
          <label>Category</label>
          <br />
          <input type="text" name="category" placeholder="" class="form-control" />
        </div>

<div class="form-group">
	<textarea id="editor" name="content"></textarea>
</div>
<div class="form-group">
	<input type="submit"> 
</div>
</form>