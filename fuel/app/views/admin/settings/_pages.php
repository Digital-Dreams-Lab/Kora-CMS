    <div role="tabpanel" class="tab-pane active" id="pages">
        <div class="col-md-12">
    		                                                            
            <div class="form-group">
                <label class="control-label" for="form_page_level_limit">Page level limit</label>
                    
                <?php $page_level_limit = array(1,2,3,4,5); ?>
                <?php echo Form::select('page_level_limit', Input::post('page_level_limit', isset($settings) ? $settings['page_level_limit'] : ''), $page_level_limit, array('class'=>'form-control')); ?>
                
    			<p class="help-block">Set page parent limit. (How many levels deep your pages can be nested)</p> 
            </div>              
                                           
                                                                        
            <div class="form-group">
                <label class="control-label" for="form_page_trash">Page delete on trash</label>
                                               
	            <div class="input-group">                
                    <div class="btn-group" data-toggle="buttons">
                        <label class="btn btn-default <?php echo isset($settings) && $settings['page_trash'] =='0' ? ' active': ''; ?>"><input type="radio" name="page_trash" value="0">Off</label>
                        <label class="btn btn-default <?php echo isset($settings) && $settings['page_trash'] =='1' ? ' active': ''; ?>"><input type="radio" name="page_trash" value="1">On</label>
                    </div>
                </div>
                
    			<p class="help-block">Set page trash default. If page trash set to "On" pages will be sent to the trash to be reviewed but deleted.</p>  
            </div>              
                                           
                                                                        
            <div class="form-group">
                <label class="control-label" for="form_page_lang">Page language</label>
                                                
	            <div class="input-group">                
                    <div class="btn-group" data-toggle="buttons">
                        <label class="btn btn-default <?php echo isset($settings) && $settings['page_lang'] =='0' ? ' active': ''; ?>"><input type="radio" name="page_lang" value="0">No</label>
                        <label class="btn btn-default <?php echo isset($settings) && $settings['page_lang'] =='1' ? ' active': ''; ?>"><input type="radio" name="page_lang" value="1">Yes</label>
                    </div>
                </div>
                
    			<p class="help-block">Enable page language per page</p>
            </div>              
                                           
                                                                        
            <div class="form-group">
                <label class="control-label" for="form_page_multiple_menus">Page multiple menus</label> 
                                               
	            <div class="input-group">                
                    <div class="btn-group" data-toggle="buttons">
                        <label class="btn btn-default <?php echo isset($settings) && $settings['page_multiple_menus'] =='0' ? ' active': ''; ?>"><input type="radio" name="page_multiple_menus" value="0">No</label>
                        <label class="btn btn-default <?php echo isset($settings) && $settings['page_multiple_menus'] =='1' ? ' active': ''; ?>"><input type="radio" name="page_multiple_menus" value="1">Yes</label>
                    </div>
                </div>
                
    			<p class="help-block">Enable multiple menus</p>
            </div>              
                                           
                                                                        
            <div class="form-group">
                <label class="control-label" for="form_page_home_page">Single page</label>  
                                              
	            <div class="input-group">                
                    <div class="btn-group" data-toggle="buttons">
                        <label class="btn btn-default <?php echo isset($settings) && $settings['page_home_page'] =='0' ? ' active': ''; ?>"><input type="radio" name="page_home_page" value="0">No</label>
                        <label class="btn btn-default <?php echo isset($settings) && $settings['page_home_page'] =='1' ? ' active': ''; ?>"><input type="radio" name="page_home_page" value="1">Yes</label>
                    </div>
                </div>
                
    			<p class="help-block">Ability to set pages to the home page as a simple page.</p>
            </div>
                                     
                        
        </div>
    </div>