
<?php echo Form::open(array("enctype"=>"multipart/form-data")); ?>

    <div class="form-group">
        <?php echo Form::label('Install plugin', 'plugin_upload', array('class'=>'control-label')); ?><br />

        <div class="input-group">
            <span class="input-group-btn">
                <span class="btn btn-primary btn-file">
                    <i class="fa fa-file-archive-o"></i> Browse<?php echo Form::input('plugin_upload', '', array('class' => 'required','type' => 'file')); ?>
                </span>
            </span>
            <input type="text" class="form-control" readonly>
        </div>
    </div>
    
    <div class="form-group">
        <label class='control-label'>&nbsp;</label>
        <button type="submit" class="btn btn-success btn-block">
			<i class="fa fa-upload"></i> Install plugin
        </button>
    </div>
	
<?php echo Form::close(); ?>

<script>
$(document).on('change', '.btn-file :file', function() {
  var input = $(this),
      numFiles = input.get(0).files ? input.get(0).files.length : 1,
      label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
  input.trigger('fileselect', [numFiles, label]);
});

$(document).ready( function() {
    $('.btn-file :file').on('fileselect', function(event, numFiles, label) {
        
        var input = $(this).parents('.input-group').find(':text'),
            log = numFiles > 1 ? numFiles + ' files selected' : label;
        
        if( input.length ) {
            input.val(log);
        } else {
            if( log ) alert(log);
        }
        
    });
});
</script>