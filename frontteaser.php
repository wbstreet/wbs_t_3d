<?php
//echo '|||'.PARENT.'|||';
    if (PARENT != 0) {
        $theq = "SELECT * FROM `".TABLE_PREFIX."pages` WHERE parent IN (".$page_id.") ORDER BY menu_title LIMIT 100;";
        $query_pages = $database->query($theq);
        echo '<!-- top-grids --><div class="top-grids text-center"><div class="container">';
        while ($page = $query_pages->fetchRow()) {
            $image_path = '/media/grids/pic'.$page['page_id'].'.jpg';
            if (!file_exists(WB_PATH.$image_path)) $image_path = '/media/grids/nofoto.jpg';

            if ($page['page_id'] == PAGE_ID) {$active='style="color: green;"';} else {$active="";}
            //echo "<div class='menu_teaser'><img src='".WB_URL."/media/grids/pic".$page['page_id'].".jpg'><br><a ".$active." href='/pages".$page['link'].".php'>".$page['menu_title']."</a></div>";

     		$ahref= 'href="'.WB_URL.PAGES_DIRECTORY.$page['link'].PAGE_EXTENSION.'">';
            echo '<div class="col-md-3"><div class="top-grid">';
    		echo '<a '.$ahref.'<img class="img-responsive" src="'.WB_URL.$image_path.'" alt="'.$page['page_title'].'"></a>';
    		echo '<h3><a '.$ahref.$page['page_title'].'</a></h3>'; 
    		echo '<p><a '.$ahref.$page['description'].'</a></p>';
    		echo '<a class="teaser-claim-btn" '.$ahref.'ПОДРОБНЕЕ</a>';
    	//	echo $ahref.'<img style="width: 75%;" class="img-responsive" src="'.WB_URL.'/media/button.png" alt="'.$page['page_title'].'"></a>';
		//$l .= '<a class="caption-btn" href="'.WB_URL.PAGES_DIRECTORY.$page['link'].PAGE_EXTENSION.'">'.$TEXT['READ_MORE'].'</a>';
	        echo '</div></div>';
        }
        echo '<div class="clearfix"> </div></div></div><!-- end top-grids -->';
} ?>