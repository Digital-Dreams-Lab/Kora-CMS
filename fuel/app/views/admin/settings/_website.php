                         
    <div class="form-group">
        <label class="control-label" for="form_website_theme">Website theme</label>
        
        <input class="form-control" name="website_theme" value="<?php echo Input::post('website_theme', isset($settings) ? $settings['website_theme'] : ''); ?>" type="text" id="form_website_theme" />
    </div>
                         
    <div class="form-group">
        <label class="control-label" for="form_website_theme">Website layout</label>
        <?php Config::load('settings'); $website_layout = Config::get('form.website_details.website_layout.select'); ?>
        <?php echo Form::select('website_layout', Input::post('website_layout', isset($settings) ? $settings['website_layout'] : ''), $website_layout, array('class'=>'form-control')); ?>
    </div>
                                     
    <div class="form-group">
        <label class="control-label" for="form_website_title">Website title</label>
        
        <input class="form-control" name="website_title" value="<?php echo Input::post('website_title', isset($settings) ? $settings['website_title'] : ''); ?>" type="text" id="form_website_title" />
    </div>
                                   
                         
    <div class="form-group">
        <label class="control-label" for="form_website_description">Website description</label>
        
        <textarea class="form-control" name="website_description" id="form_website_description"><?php echo Input::post('website_description', isset($settings) ? $settings['website_description'] : ''); ?></textarea>
    </div>
                                   
                         
    <div class="form-group">
        <label class="control-label" for="form_website_keywords">Website keywords</label>
        
        <textarea class="form-control" name="website_keywords" id="form_website_keywords"><?php echo Input::post('website_keywords', isset($settings) ? $settings['website_keywords'] : ''); ?></textarea>
    </div>                        
                         
    <div class="form-group">
        <label class="control-label" for="form_website_meta">Website meta</label>
        
        <textarea class="form-control" name="website_meta" id="form_website_meta" rows="6"><?php echo Input::post('website_meta', isset($settings) ? $settings['website_meta'] : ''); ?></textarea>
    </div>                        
                         
    <div class="form-group">
        <label class="control-label" for="form_website_header">Website header</label>
        
        <textarea class="form-control wysihtml5" name="website_header" id="form_website_header" rows="6"><?php echo Input::post('website_header', isset($settings) ? $settings['website_header'] : ''); ?></textarea>
    </div>
                                   
                         
    <div class="form-group">
        <label class="control-label" for="form_website_footer">Website footer</label>
        
        <textarea class="form-control wysihtml5" name="website_footer" id="form_website_footer" rows="6"><?php echo Input::post('website_footer', isset($settings) ? $settings['website_footer'] : ''); ?></textarea>
    </div>
                                   
    <div class="form-group">
        <button type="submit" class="btn-warning btn">
            <i class="fa fa-save"></i> Update basic settings
        </button>                        
    </div>
        
        
    <script>
		$('.wysihtml5').wysihtml5();
	</script>