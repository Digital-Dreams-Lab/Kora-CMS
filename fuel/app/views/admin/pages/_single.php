<form class="form_page_edit" method="post">
	<div class="col-sm-9">
		<?php echo $print_blocks; ?>
    </div>
	<div class="col-sm-3">                    
        <div class="form-group">
            <?php echo 	Form::label('Single page layout', 'single_layout', array('class'=>'control-label')); ?>
            <?php echo	Form::input('page[single_layout]', 
                        Input::post('page[single_layout]', 
                        isset($page) ? $page->single_layout : ''),
                        array('class' => 'form-control', 'id'=>'single_layout')); ?>
        </div>
        
        <div class="form-group">
            <?php echo 	Form::label('Single page id', 'single_id', array('class'=>'control-label')); ?>
            <?php echo	Form::input('page[single_id]', 
                        Input::post('page[single_id]', 
                        isset($page) ? $page->single_id : ''),
                        array('class' => 'form-control', 'id'=>'single_id')); ?>
        </div>
    
        <div class="form-group">
            <?php echo 	Form::label('Single page class', 'single_class', array('class'=>'control-label')); ?>
            <?php echo	Form::input('page[single_class]', 
                        Input::post('page[single_class]', 
                        isset($page) ? $page->single_class : ''),
                        array('class' => 'form-control', 'id'=>'single_class')); ?>
        </div>
        
        <div class="form-group">
            <button class="btn btn-warning btn-block" type="submit">
                <i id="spinner_page" class="fa fa-floppy-o"></i> Update page
            </button>
        </div>
    </div>
</form>

<script>
	$('.layout_single_check').click(function() {
		var checktitle = $(this).data('title');
		$('.layout_single_check').removeClass('btn-success');
		$('.layout_single_check').find('i').removeClass('fa-check-square-o');
		$('.layout_single_check').find('i').addClass('fa-square-o');
		$(this).addClass('btn-success');
		$(this).html('<i class="fa fa-check-square-o"></i> ' + checktitle);
		
		$('#single_id').val($(this).data('id'));
		$('#single_layout').val($(this).data('html'));
		$('#single_class').val($(this).data('class'));
		
		$(this).parent('.block_layout_example').addClass('bg-success');
	});

</script>