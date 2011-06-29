<?php
$user = Users_Index();
global $CFG;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <?php head('Documenta&ccedil;&atilde;o')?>
    <?php auth();?>
    <style type="text/css">
    #cboxClose{display:none !important;}
    </style>
</head>

<body>

<div class="container_16">
	<?php menu()?>
    <div class="grid_16">
		<h2 id="page-heading">Documenta&ccedil;&atilde;o</h2>
	</div>
	<div class="clear"></div>
	<div class="grid_16">
		<p class="notice" style="font-weight: bold;">Bem vindo &agrave; documenta&ccedil;&atilde;o do Engine CMS. &Uacute;ltima atualiza&ccedil;&atilde;o feita em 19/10/2010</p>
		<p class="alert" style="font-weight: bold;">Esta &eacute; uma &aacute;rea em constru&ccedil;&atilde;o. Pode haver conte&uacute;do falho ou incompleto.</p>
	</div>
	<div class="grid_16">
		<h3>Sum&aacute;rio</h3>
		<a href="javascript:void(0);" onclick="toggle('nav')" class="quiet">Mostrar|Esconder</a>
	</div>
	<div class="clear"></div>
	<div class="grid_16" id="nav">
		<?php
		$menus = $dao->Retrieve('Pages_menus', 'ORDER BY menu_name');
		foreach ($menus as $i=>$pm):
			$aux = 0;
		?>
		<div><?php __($i+1)?>. <a href="#"><?php __($pm->get('menu_name'))?></a> &#9679; <a href="javascript:void(0);" onclick="toggle('menu_<?php __($pm->get('id'))?>')" class="quiet">Mostrar|Esconder</a></div><div class="clear"></div>
		<div id="menu_<?php __($pm->get('id'))?>" style="display: none;">
		<?php
			$modules = $dao->Retrieve('Pages_modules', array('pages_menu_id'=>$pm->get('id')));
			foreach ($modules as $j=>$m):
		?>
			&nbsp;&nbsp;&nbsp;<?php __($m->get('module_name'))?><br />
		<?php
				$pages = $dao->Retrieve('Pages', array('pages_module_id'=>$m->get('id')));
				foreach ($pages as $k=>$p):
					$aux++;
		?>
			&nbsp;&nbsp;&nbsp;<?php __(($i+1).".".($aux))?> <a href="#"><?php __($p->get('page_name'))?></a><br />
		<?php
				endforeach;
			endforeach;
		?>
		</div><div class="clear"></div>
		<?php endforeach;?>
	</div>
	<div class="clear"></div>
	<?php status()?>
</div>




</body>
</html>

