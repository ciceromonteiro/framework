<?php 
$user = new Users_Controller();
$user->add();
if (@$_GET['activate_error'])
    $MSG->error[] = "This account is not valid.";
if (@$_GET['auth'])
    $user->auth($_GET['auth']);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <?php head('Add User')?>
    <?php auth('no')?>
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
            <label for="User_Full_name">Full Name:</label>
            <?php $form->Input(array('type'=>'text', 'class'=>'text required', 'maxlength'=>'255'), 'User','user_full_name')?>
        </div>
        <div class="span-12 last">
            <label for="User_Pass">Password (more than 6 chars):</label>
            <?php $form->Input(array('type'=>'password','class'=>'text required', 'maxlength'=>'32'), 'User', 'user_pass')?>
        </div>
        <div class="clear"></div>
        <div class="grid_8">
            <label for="User_Email">Confirm password:</label>
            <?php $form->Input(array('type'=>'password','class'=>'text required', 'maxlength'=>'32'), 'User', 'user_pass_confirm')?>
        </div>
        <div class="clear"></div>
        <div class="grid_8">
            <label for="User_Email">E-mail:</label>
            <?php $form->Input(array('type'=>'text','class'=>'text required', 'maxlength'=>'220'), 'User', 'user_email')?>
        </div>
        <div class="clear"></div>
        <div class="grid_8">
            <label for="User_Email">I am from:</label>
            <?php $countries = $dao->Retrieve('Countries', 'all')?>
            <?php $form->Select($countries, array('class'=>'full'), 'User', 'country_id', 'name')?>
        </div>
        <div class="clear"></div>
        <div class="grid_16" style="margin-top: 10px;">
            <p><?php $form->Input(array('type'=>'submit','value'=>'Join This Awesome App!','class'=>'button'))?></p>
        </div>
        <div class="clear"></div>
    </div>
    <?php $form->End()?>
    <?php //status()?>
</div>

</body>
</html>
