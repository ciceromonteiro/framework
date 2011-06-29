<?php 
$dao = new DAO();
$post = $dao->Retrieve("Posts", $params[0], TRUE, TRUE);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <?php head('Show Post')?>
    <?php auth('yes')?>
</head>

<body>

<div class="container">
	<?php menu()?>
	<div class="span-24"><?php default_messages()?></div>
    <?php if ($post):?>
    <h2><?php echo $post->get("post_title")?></h2>
	<p><?php echo $post->post_content?></p>
	<p>Category: <a href="#"><?php echo $post->rel["category"]->get("category_name")?></a></p>
    <?php else:?>
    <h2>Opps...</h2>
    <p>Post not found.</p>
    <?php endif;?>
</div>

</body>
</html>
