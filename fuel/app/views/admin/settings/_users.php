    <div role="tabpanel" class="tab-pane " id="users">
        <div class="col-md-12">
			<?php $yes_no = array('No', 'Yes'); ?>
			                                                                   
            <div class="form-group">
                <label class="control-label" for="form_user_media_folders">User media folders</label>
                <?php echo Form::select('user_media_folders', Input::post('user_media_folders', isset($settings) ? $settings['user_media_folders'] : ''), $yes_no, array('class'=>'form-control')); ?>
            </div>                   
                                
                                           
                                                                        
            <div class="form-group">
                <label class="control-label" for="form_user_manage_sections">User manage sections</label>
                <?php echo Form::select('user_manage_sections', Input::post('user_manage_sections', isset($settings) ? $settings['user_manage_sections'] : ''), $yes_no, array('class'=>'form-control')); ?>
            </div>                   
                                
                                           
                                                                        
            <div class="form-group">
                <label class="control-label" for="form_user_section_blocks">User section blocks</label>
                <?php echo Form::select('user_section_blocks', Input::post('user_section_blocks', isset($settings) ? $settings['user_section_blocks'] : ''), $yes_no, array('class'=>'form-control')); ?>
            </div>                   
                                
                                           
                                                                        
            <div class="form-group">
                <label class="control-label" for="form_user_login">User login</label>
                <?php echo Form::select('user_login', Input::post('user_login', isset($settings) ? $settings['user_login'] : ''), $yes_no, array('class'=>'form-control')); ?>
            </div>                   
                                
                                           
                                                                        
            <div class="form-group">
                <label class="control-label" for="form_user_signup">User signup</label>
                <?php echo Form::select('user_signup', Input::post('user_signup', isset($settings) ? $settings['user_signup'] : ''), $yes_no, array('class'=>'form-control')); ?>
            </div>                   
                                
                                           
                        
        </div>
    </div>
