<?php 
$post = new Posts_Controller();
$post->add();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <?php head('Add Post')?>
    <?php auth('yes')?>
    <script type="text/javascript">
    $(document).ready(function(){
    	$("#Post_Post_title").focus();
    });
    </script>
</head>

<body>

<div class="container">
	<?php menu()?>
    <h2 class="page-heading">New User</h2>
    <div class="span-24"><?php default_messages()?></div>
    <?php $form = new Form(array('name'=>'users_new','action'=>ACTION))?>
    <?php $form->Start()?>
    <div class="span-12 last">
        <div class="span-12 last">
            <label for="User_Full_name">Title:</label>
            <?php $form->Input(array('type'=>'text', 'class'=>'text big required', 'maxlength'=>'255'), 'Post','post_title')?>
        </div>
        <div class="clear"></div>
        <div class="grid_8">
            <label for="User_Email">Category:</label>
            <?php $categories = $dao->Retrieve('Categories', 'all')?>
            <?php $form->Select($categories, array('class'=>'full'), 'Post', 'category_id', 'category_name')?>
        </div>
        <div class="clear"></div>
        <div class="span-12 last">
            <label for="User_Full_name">Content:</label>
            <?php $form->Textarea(array('style'=>'height: 300px;'), 'Post','post_content')?>
        </div>
        <div class="grid_16" style="margin-top: 10px;">
            <p><?php $form->Input(array('type'=>'submit','value'=>'Create Post!','class'=>'button'))?></p>
        </div>
        <div class="clear"></div>
    </div>
    <?php $form->End()?>
    <?php //status()?>
</div>

</body>
</html>
