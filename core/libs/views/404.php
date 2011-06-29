<?php $url = "http://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];	?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <?php head('Erro 404 - P&aacute;gina n&atilde;o encontrada')?>
</head>

<body>

<div class="container">
    <?php menu()?>
    <div class="span-24 last">
		<h2>Erro 404 - P&aacute;gina n&atilde;o encontrada</h2>
	</div>
	<div class="span-24 last">
		<h3>O endere&ccedil;o que voc&ecirc; procura n&atilde;o foi encontrado neste servidor. Por favor, verifique o endere&ccedil;o e tente novamente:</h3>
		<h3><?php __($url)?></h3>
    	<h3>Tente <a href="<?php echo $url?>">recarregar a p&aacute;gina</a> ou <a href="<?php echo WWWROOT?>">volte para o come&ccedil;o</a></h3>
	</div>
</div>

</body>
</html>


