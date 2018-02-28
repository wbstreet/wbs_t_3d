<?php
if(!defined('WB_URL')) { header('Location: ../../../index.php'); exit(0); }

ob_start(); 
show_menu2(1, SM2_ROOT, SM2_START, SM2_TRIM, '<li role="presentation" class="[class]"><a href="[url]">[menu_title]</a>', "</li>", '<ul>', '</ul>', true, '<ul class="nav nav-tabs" role="tablist">');
$topnav = ob_get_contents();
$topnav = str_replace('menu-current','active',$topnav);
ob_end_clean();

ob_start(); 
$open = '<li data-id=[page_id] class="[if(class=menu-current||class=menu-parent){active}] [if(class==menu-expand){dropdown}]">
	[if(class==menu-expand){<a href="[url]" class="dropdown-toggle" data-toggle="dropdown">[menu_title] <b class="caret"></b></a>}else {<a href="[url]">[menu_title]</a>}]';
	show_menu2(
		$aMenu          = 1,
		$aStart         = SM2_ROOT, 
		$aMaxLevel      = SM2_CURR+3,
		$aOptions       = SM2_ALL,
		$aItemOpen      = $open,
		$aItemClose     = "</li>" /*[if(level!=0){<br>}]*/,
		$aMenuOpen      = '<ul class="[if(level==0){nav navbar-nav} else {dropdown-menu}] [if(level==1){teaser-menu}] [if(level==2){teaser-menu2}]">',
		$aMenuClose     = '</ul>',
		$aTopItemOpen   = false,
		$aTopMenuOpen   = false
);

$topnav = ob_get_contents();
ob_end_clean();
	
	
?>
<header>
	<div class="content">
		<a class="mobile-btn-menu" href="#" onclick="$('.navbar-default,.nav').toggle()"><img src="<?=WB_URL?>/media/img/mobile-menu.png"></a>
		<nav class="navbar navbar-default" role="navigation">
			<div class="container-fluid">
				<div class="menu">
					<?php echo $topnav; ?>
				</div>
			</div>			
		</nav>
		<?php 	echo show_breadcrumbs($sep = ' - ',$level = 1, $links = true, $depth = -1, $title = '<a href="'.WB_URL.'">Главная</a> - '); ?>
    </div>
	<div class="bottom_info">закрыть</div>
</header>