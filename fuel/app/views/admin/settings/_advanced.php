<?php echo Form::open(); ?>

<button type="submit" class="btn-warning btn pull-right">
    <i class="fa fa-save"></i> Save settings
</button>

<div role="tabpanel">        
    <!-- Nav tabs -->
    <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active"><a href="#pages" aria-controls="pages" role="tab" data-toggle="tab">Pages</a></li>
        <li role="presentation" class=""><a href="#users" aria-controls="users" role="tab" data-toggle="tab">Users</a></li>
        <li role="presentation" class=""><a href="#default" aria-controls="default" role="tab" data-toggle="tab">Default</a></li>
        <li role="presentation" class=""><a href="#search" aria-controls="search" role="tab" data-toggle="tab">Search</a></li>
        <li role="presentation" class=""><a href="#server" aria-controls="server" role="tab" data-toggle="tab">Server</a></li>
        <li role="presentation" class=""><a href="#mail" aria-controls="mail" role="tab" data-toggle="tab">Mail</a></li>
    </ul>
            
    <!-- Tab panes -->
    <div class="tab-content">
        <input class="form-control" name="id" value="1" type="hidden" id="form_id" />
    	<h3></h3>   

        <?php echo render('admin/settings/_pages'); ?>
        <?php echo render('admin/settings/_users'); ?>
        <?php echo render('admin/settings/_default'); ?>
        <?php echo render('admin/settings/_search'); ?>
        <?php echo render('admin/settings/_server'); ?>
        <?php echo render('admin/settings/_mail'); ?>     
    </div>
</div>

<?php echo Form::close(); ?>
