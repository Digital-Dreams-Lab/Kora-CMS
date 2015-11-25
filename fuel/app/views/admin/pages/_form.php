<?php echo Form::open(array("class"=>"form-horizontal")); ?>

		<div class="form-group">
			<?php echo Form::label('User id', 'user_id', array('class'=>'control-label')); ?>
			<?php echo Form::input('user_id', Input::post('user_id', isset($page) ? $page->user_id : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'User id')); ?>
		</div>
		<div class="form-group">
			<?php echo Form::label('Parent id', 'parent_id', array('class'=>'control-label')); ?>
			<?php echo Form::input('parent_id', Input::post('parent_id', isset($page) ? $page->parent_id : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Parent id')); ?>
		</div>
		<div class="form-group">
			<?php echo Form::label('Order', 'order', array('class'=>'control-label')); ?>
			<?php echo Form::input('order', Input::post('order', isset($page) ? $page->order : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Order')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('Active', 'active', array('class'=>'control-label')); ?>
			<?php echo Form::input('active', Input::post('active', isset($page) ? $page->active : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Active')); ?>
		</div>
		<div class="form-group">
			<?php echo Form::label('Home page', 'home_page', array('class'=>'control-label')); ?>
			<?php echo Form::input('home_page', Input::post('home_page', isset($page) ? $page->home_page : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Home page')); ?>
		</div>
        
		<div class="form-group">
			<?php echo Form::label('Slug', 'slug', array('class'=>'control-label')); ?>
			<?php echo Form::input('slug', Input::post('slug', isset($page) ? $page->slug : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Slug')); ?>
		</div>
		<div class="form-group">
			<?php echo Form::label('Meta tags', 'meta_tags', array('class'=>'control-label')); ?>
			<?php echo Form::textarea('meta_tags', Input::post('meta_tags', isset($page) ? $page->meta_tags : ''), array('class' => 'col-md-8 form-control', 'rows' => 8, 'placeholder'=>'Meta tags')); ?>
		</div>
		<div class="form-group">
			<label class='control-label'>&nbsp;</label>
			<?php echo Form::submit('submit', 'Save', array('class' => 'btn btn-primary')); ?>
        </div>

<?php echo Form::close(); ?>