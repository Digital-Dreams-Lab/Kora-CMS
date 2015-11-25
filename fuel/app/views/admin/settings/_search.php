	<div role="tabpanel" class="tab-pane " id="search">
        <div class="col-md-12">    
            <?php $yes_no = array('No', 'Yes'); ?>                                                            
            <div class="form-group">
                <label class="control-label" for="form_search_visibility">Search visibility</label>				
                
                <?php echo Form::select('search_visibility', Input::post('search_visibility', isset($settings) ? $settings['search_visibility'] : ''), $yes_no, array('class'=>'form-control')); ?>
            </div>                
                                                                        
            <div class="form-group">
                <label class="control-label" for="form_search_theme">Search theme</label>
                
                <?php echo Form::select('search_theme', Input::post('mail_default_routine', isset($settings) ? $settings['search_theme'] : ''), $yes_no, array('class'=>'form-control')); ?>
            </div>                       
                                 
            <div class="form-group">
                <label class="control-label" for="form_search_header">Search header</label>
                
                <textarea class="form-control" name="search_header" id="form_search_header"><?php echo Input::post('search_header', isset($settings) ? $settings['search_header'] : ''); ?></textarea>
            </div>                                           
                                 
            <div class="form-group">
                <label class="control-label" for="form_search_footer">Search footer</label>
                
                <textarea class="form-control" name="search_footer" id="form_search_footer"><?php echo Input::post('search_footer', isset($settings) ? $settings['search_footer'] : ''); ?></textarea>
            </div>                                           
                                 
            <div class="form-group">
                <label class="control-label" for="form_search_results_none">Search results none</label>
                
                <textarea class="form-control" name="search_results_none" id="form_search_results_none"><?php echo Input::post('search_results_none', isset($settings) ? $settings['search_results_none'] : ''); ?></textarea>
            </div>                                           
                                 
            <div class="form-group">
                <label class="control-label" for="form_search_results_header">Search results header</label>
                
                <textarea class="form-control" name="search_results_header" id="form_search_results_header"><?php echo Input::post('search_results_header', isset($settings) ? $settings['search_results_header'] : ''); ?></textarea>
            </div>                                           
                                 
            <div class="form-group">
                <label class="control-label" for="form_search_results_loop">Search results loop</label>
                
                <textarea class="form-control" name="search_results_loop" id="form_search_results_loop"><?php echo Input::post('search_results_loop', isset($settings) ? $settings['search_results_loop'] : ''); ?></textarea>
            </div>                                           
                                 
            <div class="form-group">
                <label class="control-label" for="form_search_results_footer">Search results footer</label>
                
                <textarea class="form-control" name="search_results_footer" id="form_search_results_footer"><?php echo Input::post('search_results_footer', isset($settings) ? $settings['search_results_footer'] : ''); ?></textarea>
            </div>                                           
                                 
            <div class="form-group">
                <label class="control-label" for="form_search_results_max">Search results max</label>
                
                <input class="form-control" name="search_results_max" value="<?php echo Input::post('search_results_max', isset($settings) ? $settings['search_results_max'] : ''); ?>" type="text" id="form_search_results_max" />
            </div>                                           
                                 
            <div class="form-group">
                <label class="control-label" for="form_search_results_min">Search results min</label>
                
                <input class="form-control" name="search_results_min" value="<?php echo Input::post('search_results_min', isset($settings) ? $settings['search_results_min'] : ''); ?>" type="text" id="form_search_results_min" />
            </div>                                           
                        
        </div>
    </div>