<?php
if(!defined('WB_URL')) {
	header('Location: ../index.php');
	exit(0);
}	

?><!DOCTYPE html>
<html>
<head>
    <title><?php page_title(); ?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=<?php if(defined('DEFAULT_CHARSET')) { echo DEFAULT_CHARSET; } else { echo 'utf-8'; }?>" />
    <meta name="description" content="<?php page_description(); ?>" />
    <meta name="keywords" content="<?php page_keywords(); ?>" />
    <?php
     if(function_exists('register_frontend_modfiles')) {
	    register_frontend_modfiles('css');
	    register_frontend_modfiles('jquery');
	    register_frontend_modfiles('js');
    } ?>

    <script src="<?php echo TEMPLATE_DIR; ?>/js/jquery.min.js"></script>
    <link href="<?php echo TEMPLATE_DIR; ?>/bootstrap.css" rel='stylesheet' type='text/css' />
    <link href="<?php echo TEMPLATE_DIR; ?>/editor.css" rel="stylesheet" type="text/css" media="screen" />
    <link href="<?php echo TEMPLATE_DIR; ?>/template.css" rel="stylesheet" type="text/css" media="screen" />
    <link href="<?php echo TEMPLATE_DIR; ?>/mobile.css" rel="stylesheet" type="text/css" media="screen" />


    <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>


    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="HandheldFriendly" content="true" />
    <meta name="MobileOptimized" content="320" />

    <?php if(function_exists('wbs_core_include')) wbs_core_include(['functions.js', 'windows.js', 'windows.css']); ?>
    <?php require_once(WB_PATH.'/include/captcha/captcha.php'); ?>
</head>

<?php 
	ob_start();		
	page_content(1);
	$page_content_1 = ''.ob_get_contents();
	ob_end_clean();
	
	if(defined('TOPIC_BLOCK2') AND TOPIC_BLOCK2 != '') { 
		 	$page_content_2 = TOPIC_BLOCK2; 
	} else {
		ob_start();
		page_content(2);
		$page_content_2 = ''.ob_get_contents();
		ob_end_clean();
	}
	
	ob_start(); 
	//show_menu2(1, SM2_ROOT, SM2_ALL, SM2_ALL, '<li class="[class]"><a href="[url]">[menu_title]</a>', "</li>", '<ul>', '</ul>', true, '<ul class="dropdown-menu" role="menu">');
//	show_menu2(1, SM2_ROOT, SM2_START, SM2_TRIM, '<li class="[class]"><a href="[url]">[menu_title]</a>', "</li>", '<ul>', '</ul>', true, '<ul>');
//	$topnav = ob_get_contents();
//	$topnav = str_replace('menu-current','active',$topnav);
	ob_end_clean();
	
?>
<body>

<!-- header -->
<div class="logo" id="logo">
	<a href="<?php echo WB_URL; ?>"><img height="100px" src="<?php echo WB_URL; ?>/media/common_img/logo.png" title="<?php echo WEBSITE_TITLE; ?>" alt="" /></a>
</div>

<?php include('snippets/nav.php'); ?>
<!-- top-nav -->
<!-- script-for-nav -->
<script>
	$(document).ready(function(){
		$("span.menu").click(function(){
			$("header ul").slideToggle(300);
		});
	});
</script>

<div id="content2" class="main-content-top"><?php echo $page_content_2; ?></div> 

<div class="main-content">
	<div id="content1" class="content"><?php echo $page_content_1; ?></div>
	<div class="bottom_info">закрыть</div>
</div>

<div class='windowBody' id='feedback' data-text_title='Написать нам'>
    <?php include(__DIR__.'/snippets/form.php'); ?>
</div>
		
<script src="<?php echo TEMPLATE_DIR; ?>/js/bootstrap.min.js"></script>

<script>
let g = new Gallery(document.querySelectorAll('.fm'));

function go_link(e) {
    e.preventDefault();
    let link = e.target.closest('a');

    if (link.dataset.toggle === 'dropdown') return;
    
    let page_link = link.href.slice(WB_URL.length + <?php echo strlen(PAGES_DIRECTORY); ?>, -4);
    let c = link.dataset.c ? link.dataset.c : 'both';
    
    if (c === 'both') {
        content_by_api('load_content', document.getElementById('content1'), {url:'/vsekurortru/templates/wbs_t_3d/api.php', data:{c:1, page_link:page_link}})
        content_by_api('load_content', document.getElementById('content2'), {url:'/vsekurortru/templates/wbs_t_3d/api.php', data:{c:2, page_link:page_link, not_insert_empty:true}})
    } else {
        content_by_api('load_content', document.getElementById('content'+c), {url:'/vsekurortru/templates/wbs_t_3d/api.php', data:{c:c, page_link:page_link}})    	
    }
}

$('a').click(go_link);

$('.bottom_info').click(function(e) {
	if (e.target.previousElementSibling.style.display !== 'none') {

	    e.target.dataset.height = e.target.parentElement.style.height;

    	e.target.previousElementSibling.style.display = 'none';
	    $(e.target.parentElement).animate({height:'0'}, 250);
	} else {
	    $(e.target.parentElement).animate({height:'95%'}, 250);
    	e.target.previousElementSibling.style.display = '';
	}
});
</script>
	</body>
</html>