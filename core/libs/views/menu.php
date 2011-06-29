<?php
global $USR;
global $CFG;
$dao = new DAO();
if ($_SESSION)
	$user = $dao->Retrieve("Users", $_SESSION['user_id']);
?>
<div class="span-24 menu">
    <div class="span-24 last">
    <ul id="nav" class="dropdown dropdown-linear dropdown-columnar">
        <li><a href="<?php __(WWWROOT)?>" class="menulink">Home</a></li>
    	<?php if ($_SESSION):?>
        <li><a href="<?php __(WWWROOT)?>/posts/add" class="menulink">New Post</a></li>
        <li><a href="<?php __(WWWROOT)?>/account" class="menulink">My Account</a></li>
        <li><a href="<?php __(WWWROOT)?>/users/logout" class="menulink">Logout</a></li>
        <?php elseif (!$_SESSION):?>
        <li><a href="<?php __(WWWROOT)?>/users/add" class="menulink">Join</a></li>
        <li><a href="<?php __(WWWROOT)?>/users/login" class="menulink">Login</a></li>
        <?php endif;?>
    </ul>
    </div>
</div>