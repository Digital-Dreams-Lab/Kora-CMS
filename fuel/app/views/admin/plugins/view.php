
	<!-- plugins edit.php -->    
    <?php echo \Kora\Components::get('admin/listings/head-title', $listings_title); ?>
    <!-- /.row -->
    <div class="row">        
        <?php if (\Kora\Permissions::check('view')): ?>
        <div class="col-md-12">
            <!-- .panel-group -->            
        	<?php echo \Kora\Components::get('bootstrap/accordian/panel-group', $view_panel_group); ?>
            <!-- /.panel-group -->
        </div>
        <!-- /.col-lg-9 -->
        <?php endif; ?>
	</div>