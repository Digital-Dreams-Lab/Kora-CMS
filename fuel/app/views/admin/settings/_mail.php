    <div role="tabpanel" class="tab-pane " id="mail">
        <div class="col-md-12">        
                                 
            <div class="form-group">
                <label class="control-label" for="form_mail_default_from">Mail default from</label>
                                     
                <input class="form-control" name="mail_default_from" value="<?php echo Input::post('mail_default_from', isset($settings) ? $settings['mail_default_from'] : ''); ?>" type="text" id="form_mail_default_from" />
            </div>                                                   
                                 
            <div class="form-group">
                <label class="control-label" for="form_mail_default_name">Mail default name</label>  
                                      
                <input class="form-control" name="mail_default_name" value="<?php echo Input::post('mail_default_name', isset($settings) ? $settings['mail_default_name'] : ''); ?>" type="text" id="form_mail_default_name" />
            </div>                                                   
                                 
            <div class="form-group">
                <label class="control-label" for="form_mail_default_company">Mail default company</label>
                                       
                <input class="form-control" name="mail_default_company" value="<?php echo Input::post('mail_default_company', isset($settings) ? $settings['mail_default_company'] : ''); ?>" type="text" id="form_mail_default_company" />
            </div>                                                   
                                 
            <div class="form-group">
                <label class="control-label" for="form_mail_default_website">Mail default website</label> 
                                       
                <input class="form-control" name="mail_default_website" value="<?php echo Input::post('mail_default_website', isset($settings) ? $settings['mail_default_website'] : ''); ?>" type="text" id="form_mail_default_website" />
            </div>                                                   
                                                                        
            <div class="form-group">
                <label class="control-label" for="form_mail_default_routine">Mail default routine</label>
                
				<?php $yes_no = array('No', 'Yes'); ?>
                <?php echo Form::select('mail_default_routine', Input::post('mail_default_routine', isset($settings) ? $settings['mail_default_routine'] : ''), $yes_no, array('class'=>'form-control')); ?>
            </div>                                                 
                        
        </div>
    </div>
