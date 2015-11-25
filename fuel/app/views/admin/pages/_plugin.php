
<?php echo Form::open(array('id'=>'form_insert_new_section')); ?>

    <?php echo Form::hidden('user_id', $current_user->id); ?> 
    <?php echo Form::hidden('page_id', $page->id); ?>    

    <!-- Select Basic -->
    <div class="form-group">
        <label class=" control-label" for="plugin_id">Select plugin</label>
        <?php echo Form::select('plugin_id', '', $plugins, array('class' => 'form-control')); ?>  
    </div>

    <!-- Button -->
    <div class="form-group">
        <label class=" control-label" for="submit"></label>
        <div class="">
            <button id="submit" name="submit" class="btn btn-success btn-block"><i class="fa fa-indent"></i> Insert new section</button>
        </div>
    </div>
<?php echo Form::close(); ?>
