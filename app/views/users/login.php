<?php
$user = new Users_Controller();
$user->login();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <?php head('Login')?>
    <?php auth('no')?>
    <script>
    $(document).ready(function(){
        $('#User_User_email').focus();
    });
    </script>
    <style type="text/css">
    ul.bottom_links, ul.bottom_links li{padding: 0;margin: 0; list-style-type: none;}
    ul.bottom_links{margin: 8px 0;}
    ul.bottom_links li a{}
    </style>
</head>

<body>
<div class="container">
	<?php menu()?>
    <div class="span-24">
        <h2 id="page-heading">Login</h2>
    </div>
    <div class="span-24"><?php default_messages()?></div>
    <?php $form = new Form(array('name'=>'users_login','action'=>ACTION))?>
    <?php $form->Start()?>
    <div class="span-24">
        <div class="span-12 last">
            <div class="span-8 last">
                <label for="Address_Addr">Email:</label>
                <?php $form->Input(array('type'=>'text', 'class'=>'text'), 'User', 'user_email')?>
            </div>
            <div class="clear"></div>
            <div class="span-8 last">
                <label for="User_Pass">Password:</label>
                <?php $form->Input(array('type'=>'password', 'class'=>'text'), 'User', 'user_pass')?>
            </div>
            <div class="clear"></div>
            <div class="span-12 last">
                <?php $form->Input(array('type'=>'submit','value'=>'Log me in!','class'=>'button'))?>
            </div>
            <div class="clear"></div>
            <ul class="bottom_links">
                <li><a href="<?php __(WWWROOT)?>/retrieve_password">Retreive your password</a></li>
                <li><a href="<?php __(WWWROOT)?>/join">Create a free account</a></li>
            </ul>
        </div>
    </div>
    <div class="clear"></div>
    <?php $form->End()?>
    <?php footer()?>
</div>
</body>
</html>
