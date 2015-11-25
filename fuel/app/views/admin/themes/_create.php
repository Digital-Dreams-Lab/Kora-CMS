<?php echo Form::open(); ?>

<div class="form-group">
    <?php echo Form::label('Object', 'object', array('class'=>'control-label')); ?>
    <?php echo Form::input('object', 
				Input::post('object', isset($object) ? $object->name : ''), 
				array('class' => 'form-control', 'placeholder'=>'Object', 'required'=>'required')); ?>
</div>

<div class="form-group">
    <label class='control-label'>&nbsp;</label>
    <?php echo Form::submit('submit', 'Save', array('class' => 'btn btn-primary')); ?>
</div>

<?php echo Form::close(); ?>