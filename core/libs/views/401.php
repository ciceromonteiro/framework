<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <?php head('Erro 401 - N&atilde;o autorizado')?>
    <?php auth('yes');?>
</head>

<body>

<div class="container_16">
    <?php menu()?>
    <div class="grid_16">
		<h2 id="page-heading">Erro 401 - N&atilde;o autorizado</h2>
	</div>
	<div class="grid_16">
		<h3>Desculpe, mas voc&ecirc; n&atilde;o tem autoriza&ccedil;&atilde;o para acessar esta &aacute;rea.</h3>
		<h3><?php __($_SESSION['denied'])?></h3>
    	<h3>Em caso de d&uacute;vida entre em contato com o administrador do sistema.</h3>
	</div>
	<?php status()?>
</div>




</body>
</html>



