	
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
        <div class="col-md-3 col_toggle_details">
        	<?php if (\Kora\Permissions::check('edit')): ?>
            <!-- .panel-group -->
        	<?php echo \Kora\Components::get('bootstrap/accordian/panel-group', $create_panel_group); ?>
            <!-- /.panel-group -->
       		<?php endif; ?>
            <br />
			<?php if (\Kora\Permissions::check('view')): ?>
            <!-- .panel-group -->
            <?php echo \Kora\Components::get('bootstrap/accordian/panel-group', $details_panel_group); ?>
            <!-- /.panel-group -->
            <?php endif; ?>
        </div>
        <!-- /.col-md-3 -->
    </div>
    <!-- /.row -->
    