<!-- To view the blog details -->
<h2><?php echo $post['title']; ?></h2>
<small class="post-date">Posted On: <?php echo $post['created_at']; ?></small><br>
<img src="<?php echo site_url();?>assets/images/posts/<?php echo $post['post_image']; ?> " style="width:500px;height:600px" >
<div class="post-body">
	<?php echo $post['body']; ?>
</div>
<div class="form-inline my-2 my-rg-0">
<?php if($this->session->userdata('user_id') == $post['user_id']): ?>
	<a class="btn btn-info mb-auto" href="<?php echo base_url(); ?>posts/edit/<?php echo $post['slug'] ?>">Edit</a>
	<?php echo form_open('posts/delete/'.$post['id']); ?>
		<input type="submit" value="delete" class="btn btn-danger">
	</form>
<?php endif; ?>

</div>
<!-- To view the comment of the blog -->


<!-- to post the comment on particular blog -->
