<form class="form_page_edit" method="post">
	<?php echo	Form::hidden('section['.$section->id.'][section_id]', 
                Input::post('section['.$section->id.'][section_id]', 
                isset($section) ? $section->id : '')); ?>
	<div class="col-sm-9">
		<?php echo $print_blocks; ?>
    </div>
	<div class="col-sm-3">                    
        <div class="form-group">
            <?php echo 	Form::label('Blocks page layout', 'blocks_layout', array('class'=>'control-label')); ?>
            <?php echo	Form::input('section['.$section->id.'][blocks_layout]', 
                        Input::post('section['.$section->id.'][blocks_layout]', 
                        isset($section) ? $section->blocks_layout : ''),
                        array('class' => 'form-control', 'id'=>'blocks_layout')); ?>
        </div>
        
        <div class="form-group">
            <?php echo 	Form::label('Blocks page id', 'blocks_id', array('class'=>'control-label')); ?>
            <?php echo	Form::input('section['.$section->id.'][blocks_id]', 
                        Input::post('section['.$section->id.'][blocks_id]', 
                        isset($section) ? $section->blocks_id : ''),
                        array('class' => 'form-control', 'id'=>'blocks_id')); ?>
        </div>
    
        <div class="form-group">
            <?php echo 	Form::label('Blocks page class', 'blocks_class', array('class'=>'control-label')); ?>
            <?php echo	Form::input('section['.$section->id.'][blocks_class]', 
                        Input::post('section['.$section->id.'][blocks_class]', 
                        isset($section) ? $section->blocks_class : ''),
                        array('class' => 'form-control', 'id'=>'blocks_class')); ?>
        </div>
        
        <div class="form-group">
            <button class="btn btn-warning btn-block" type="submit">
                <i id="spinner_page" class="fa fa-floppy-o"></i> Update section
            </button>
        </div>
	</div>
</form>

<script>
	$('.layout_blocks_check').click(function() {
		var checktitle = $(this).data('title');
		$('.layout_blocks_check').removeClass('btn-success');
		$('.layout_blocks_check').find('i').removeClass('fa-check-square-o');
		$('.layout_blocks_check').find('i').addClass('fa-square-o');
		$(this).addClass('btn-success');
		$(this).html('<i class="fa fa-check-square-o"></i> ' + checktitle);
		
		$('#blocks_id').val($(this).data('id'));
		$('#blocks_layout').val($(this).data('html'));
		$('#blocks_class').val($(this).data('class'));
		
		$(this).parent('.block_layout_example').addClass('bg-success');
	});

</script>