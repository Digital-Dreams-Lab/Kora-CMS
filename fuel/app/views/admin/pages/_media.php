
	<?php
        if ($loader->getmedia() !== 'null'):
            $media_manager = new Plugin\Media_Manager; 
            $media_manager->forge($page->user_id, $loader->getmedia());
        endif;
    ?>