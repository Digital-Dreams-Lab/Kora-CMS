<button class="btn btn-primary btn-sm" type="button" data-toggle="collapse" data-target="#view_form_settings_table" aria-expanded="false" aria-controls="view_form_settings_table">
    <span class="fa fa-chevron-down"></span> Form settings
</button>
<div id="view_form_settings_table" class="collapse">
<fieldset>	
    <div class="form-group">
        <?php echo Form::label('Form', 'form_settings', array('class'=>'control-label')); ?>
        <?php echo Form::textarea('form_settings', "", array('class'=>'form-control')); ?>
    </div>
</fieldset>
</div>

					<hr />