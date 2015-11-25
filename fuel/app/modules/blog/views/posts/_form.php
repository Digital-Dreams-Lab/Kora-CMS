<?php echo Form::open(); ?>

    <div class="form-group">
        <?php echo Form::label('Title', 'title'); ?>
		<?php echo Form::input('title', Input::post('title', isset($post) ? $post->title : ''), array('class' => 'form-control')); ?>
    </div>

    <div class="form-group">
        <?php echo Form::label('Summary', 'summary'); ?>
		<?php echo Form::input('summary', Input::post('summary', isset($post) ? $post->summary : ''), array('class' => 'form-control')); ?>
    </div>

    <div class="form-group">
        <?php echo Form::label('Body', 'body'); ?>
		<?php echo Form::textarea('body', Input::post('body', isset($post) ? $post->body : ''), array('class' => 'form-control', 'rows' => 8)); ?>
    </div>

    <div class="actions">
        <?php echo Form::submit('submit', array('class' => 'btn btn-warning')); ?>
    </div>
 
<?php echo Form::close(); ?>