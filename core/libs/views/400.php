<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head><?php head('400 error')?></head>

<body>
<div class="container">
	<?php $url = "http://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];	?>
    <h1>400 HTTP Error</h1>
    <h2>Bad Request</h2>
    <h3>The request contains bad syntax or cannot be fulfilled.</h3>
    <h4>Try to <a href="<?php echo $url?>">reload the page</a> or <a href="<?php echo $CFG->wwwroot?>">go back to start</a></h4>
</div>
</body>
</html>
