
    <!-- pages index.php -->    
    <?php echo \Kora\Components::get('admin/listings/head-title', $listings_title); ?>
    <div class="row">
        <div class="col-md-12">
    		<h3 id="page_title"></h3>
        </div>
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-md-9 col_toggle_sections">
	    	<div id="response_page"></div>
            <!-- .panel-group -->
			<?php echo \Kora\Components::get('bootstrap/accordian/panel-group', $page_settings); ?>
            <!-- /.panel-group -->
        </div>
        <!-- /.col-lg-9 -->
        
        <?php if (\Kora\Permissions::check('edit')): ?>
        <div class="col-md-3 col_toggle_details">
            <!-- .panel-group -->
            <div class="panel-group" id="" role="tablist" aria-multiselectable="true">

				<?php echo render('admin/pages/_details'); ?>
                
            </div>
            <!-- /.panel-group -->
        </div>
        <!-- /.col-md-3 -->
        <?php endif; ?>
    </div>
    <!-- /.row -->
	<?php
        echo Plugin\Assets::css(Plugin\Registry::$objects);
        echo Plugin\Assets::js(Plugin\Registry::$objects);
		
   		echo render('admin/pages/_scripts');
	?>
