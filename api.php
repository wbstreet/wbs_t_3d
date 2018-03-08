<?php

$path_core = dirname(dirname(dirname(__FILE__))).'/modules/wbs_core/include_all.php';
if (file_exists($path_core )) include($path_core );
else echo "<script>console.log('Модуль минимаркета требует модуль wbs_core')</script>";
//if (!defined('FUNCTIONS_FILE_LOADED')) require_once(WB_PATH.'/framework/functions.php');

include(WB_PATH.'/framework/frontend.functions.php');

if (!isset($_POST['action'])) {print_error('API name is incorrect');}

$action = $_POST['action'];

if ($action == 'load_content') {
    if (!class_exists('frontend')) { require(WB_PATH.'/framework/class.frontend.php');  }
    if (!isset($wb) || !($wb instanceof frontend)) { $wb = new frontend(); }
    $wb->page_select() or die();

    $page_link = $clsFilter->f('page_link', [['1', 'Неверный id страницы']], 'default', $wb->default_link);
    $c = $clsFilter->f('c', [['integer', 'Неверный id контента']], 'default', '1');
    $r = $database->query("SELECT * FROM `".TABLE_PREFIX."pages` WHERE `link`=\"".$database->escapeString($page_link)."\"");
    if ($database->is_error()) print_error($database->get_error());
    if ($r->numRows() == 0) print_error('Страница не найдена');
    $page_id = $r->fetchRow()['page_id'];

    $wb->page_select() or die();    
    $wb->get_page_details();
    $wb->get_website_settings();

	ob_start();		
    	page_content($c);
        if ($c == '1') show_breadcrumbs($sep = ' - ',$level = 1, $links = true, $depth = -1, $title = '<a href="'.WB_URL.'">Главная</a> - ');
	$page_content = ob_get_contents();
	ob_end_clean();

    /*if(file_exists(WB_PATH .'/modules/output_filter/index.php')) {
        include_once(WB_PATH .'/modules/output_filter/index.php');
        if(function_exists('executeFrontendOutputFilter')) {
            $page_content = executeFrontendOutputFilter($page_content);
        }
    }*/
    
    print_success(str_replace(['{SYSVAR:MEDIA_REL}', '{WB_URL}'], ['media', WB_URL], $page_content));
    //print_success($page_content);

	
} else {
    print_error('API name is incorrect');
}

?>