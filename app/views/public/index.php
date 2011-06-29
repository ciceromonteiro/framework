<?php
// default messages
if (@$_SESSION['denied'])
{
	include $CFG->docroot."/app/views/_public/401.php";
	unset($_SESSION['denied']);
	exit();
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <?php head()?>
</head>

<body>

<div class="container">
	<?php menu()?>
	<h2>Hooray!!!</h2>
	<p>If you see this text and no erros, the framework is working properly ( :</p>
    <hr />
    <?php 
    $dao = new DAO();
    if ($posts = $dao->Retrieve("Posts", "ORDER BY created_at DESC")):
    	foreach ($posts as $post):
    ?>
    <h2>
        <?php echo $post->post_title?>
    </h2>
    <p>
        <?php echo $post->post_content?>
    </p>
   	<p>
   	    Category: <a href="#"><?php echo $post->rel["category"]->get("category_name")?></a> | 
   	    Author: <a href="<?php echo WWWROOT."/users/show/".$post->rel["user"]->get("id")?>"><?php echo $post->rel["user"]->get("user_full_name")?></a> | 
   	    Posted at: <?php echo $post->created_at?>
   	</p>
   	<hr />
    <?php 
    	endforeach;
    else:?>
    <h2>No posts were found.</h2>
    <?php endif;?>
</div>




</body>
</html>

