	<!-- plugins index.php -->    
    <?php echo \Kora\Components::get('admin/listings/head-title', $listings_title); ?>
    <!-- /.row -->
    <div class="row">
            
        <?php if (\Kora\Permissions::check('create')): ?>
        <div class="col-md-12">
            <!-- .panel-group -->  
        	<?php echo \Kora\Components::get('bootstrap/accordian/panel-group', $create_panel_group); ?>
            <!-- /.panel-group -->
        </div>
        <!-- /.col-md-3 -->
        <?php endif; ?>
    </div>
    <!-- /.row -->