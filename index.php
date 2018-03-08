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

    <!-- blend4web -->
    <?php $b4w = WB_URL.MEDIA_DIRECTORY."/b4w/"; ?>
	<link id="b4w_css" type="text/css" rel="stylesheet" href="<?php echo $b4w; ?>office001/office001.min.css?v=04032018190718">
	<script id="b4w_script_b4w" type="text/javascript" src="<?php echo $b4w; ?>office001/b4w.min.js?v=0403201819071"></script>
	<script id="b4w_script" type="text/javascript" src="<?php echo $b4w; ?>office001/office001.min.js?v=04032018190718"></script>    
    <!-- -->

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

<div id="content2" class="main-content-top">
	<div id="main_canvas_container"></div>
	<?php /*echo $page_content_2;*/ ?>
</div> 

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

<div class="main-content swimming_block">
	<div id="content1" class="content">
		<?php echo $page_content_1; ?>
	</div>
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
    let link = e.target;//.closest('a');

    if (link.dataset.toggle === 'dropdown') return;
    
    let page_link = link.href.slice(WB_URL.length + <?php echo strlen(PAGES_DIRECTORY); ?>, -4);
    let c = link.dataset.c ? link.dataset.c : 'both';
    
    if (c === 'both') {
        content_by_api('load_content', document.getElementById('content1'), {url:'/vsekurortru/templates/wbs_t_3d/api.php', data:{c:1, page_link:page_link}})
        content_by_api('load_content', document.getElementById('content2'), {url:'/vsekurortru/templates/wbs_t_3d/api.php', data:{c:2, page_link:page_link, not_insert_empty:true}})
    } else {
        content_by_api('load_content', document.getElementById('content'+c), {url:'/vsekurortru/templates/wbs_t_3d/api.php', data:{c:c, page_link:page_link}})
    }
    history.pushState({}, "", link.href);
}

document.body.addEventListener('click', function(e) {
	if (e.target.tagName === 'A') {
		if (e.target.hostname === location.hostname) go_link(e);
	}
});

$('.bottom_info').click(function(e) {
	if (e.target.dataset.is_closed == '0') {
		e.target.dataset.is_closed = '1';
	    $(e.target.parentElement).animate({height:'30px'}, 250);
       	e.target.previousElementSibling.style.display = 'none';
	} else {
		e.target.dataset.is_closed = '0';
	    $(e.target.parentElement).animate({height:'95%'}, 250);
       	e.target.previousElementSibling.style.display = 'block';
	}
});

var b4w_path = '<?php echo $b4w; ?>';

class scene_switcher {
	
	constructor(b4w) {
		this.b4w = b4w;
		this.data_ids = [];
	}
	
	unload(data_id=null) {
		if (this.data_ids.length === 0) return;

		if (data_id === null) data_id = this.data_ids.splice(-1, 1)[0];
		this.b4w.data.unload(data_id);
	}
	
	load(scene_name) {
		let data_id = this.b4w.data.load(scene_name);
		this.data_ids.push(data_id);
		return data_id;
	}
	
	replace_last(scene_name) {
		this.unload();
		return this.load(scene_name);
	}
	
}

var sw = new scene_switcher(b4w);
</script>

	</body>
</html>