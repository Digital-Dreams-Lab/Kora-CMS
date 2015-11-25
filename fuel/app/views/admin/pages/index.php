	
    <!-- pages index.php -->    
    <?php echo \Kora\Components::get('admin/listings/head-title', $listings_title); ?>
    <!-- /.row -->
    <div class="row">
        <div class="col-md-9">
            <!-- .panel-group -->            
        	<?php echo \Kora\Components::get('bootstrap/accordian/panel-group', $listings_panel_group); ?>
            <!-- /.panel-group -->
        </div>
        <!-- /.col-lg-9 -->
        
        <?php if (\Kora\Permissions::check('create')): ?>
        <div class="col-md-3">
            <!-- .panel-group -->  
        	<?php echo \Kora\Components::get('bootstrap/accordian/panel-group', $create_panel_group); ?>
            <!-- /.panel-group -->
        </div>
        <!-- /.col-md-3 -->
        <?php endif; ?>
    </div>
    <!-- /.row -->
    