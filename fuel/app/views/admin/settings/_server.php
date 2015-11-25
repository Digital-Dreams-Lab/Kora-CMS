    
    <div role="tabpanel" class="tab-pane " id="server">
        <div class="col-md-12">
                                 
            <div class="form-group">
                <label class="control-label" for="form_server_operating_system">Server operating system</label>
                
                <input class="form-control" name="server_operating_system" value="<?php echo Input::post('server_operating_system', isset($settings) ? $settings['server_operating_system'] : ''); ?>" type="text" id="form_server_operating_system" />
            </div>
                                           
                                 
            <div class="form-group">
                <label class="control-label" for="form_server_file_permissions">Server file permissions</label>
                
                <input class="form-control" name="server_file_permissions" value="<?php echo Input::post('server_file_permissions', isset($settings) ? $settings['server_file_permissions'] : ''); ?>" type="text" id="form_server_file_permissions" />
            </div>
                                           
                                 
            <div class="form-group">
                <label class="control-label" for="form_server_dir_permissions">Server dir permissions</label>
                
                <input class="form-control" name="server_dir_permissions" value="<?php echo Input::post('server_dir_permissions', isset($settings) ? $settings['server_dir_permissions'] : ''); ?>" type="text" id="form_server_dir_permissions" />
            </div>
                                           
                                 
            <div class="form-group">
                <label class="control-label" for="form_server_media_directory">Server media directory</label>
                
                <input class="form-control" name="server_media_directory" value="<?php echo Input::post('server_media_directory', isset($settings) ? $settings['server_media_directory'] : ''); ?>" type="text" id="form_server_media_directory" />
            </div>
                                           
                                 
            <div class="form-group">
                <label class="control-label" for="form_server_page_extension">Server page extension</label>
                
                <input class="form-control" name="server_page_extension" value="<?php echo Input::post('server_page_extension', isset($settings) ? $settings['server_page_extension'] : ''); ?>" type="text" id="form_server_page_extension" />
            </div>
                                           
                                 
            <div class="form-group">
                <label class="control-label" for="form_server_rename_files_on_upload">Server rename files on upload</label>
                
                <input class="form-control" name="server_rename_files_on_upload" value="<?php echo Input::post('server_rename_files_on_upload', isset($settings) ? $settings['server_rename_files_on_upload'] : ''); ?>" type="text" id="form_server_rename_files_on_upload" />
            </div>
                                           
                                 
            <div class="form-group">
                <label class="control-label" for="form_server_session_identifier">Server session identifier</label>
                
                <input class="form-control" name="server_session_identifier" value="<?php echo Input::post('server_session_identifier', isset($settings) ? $settings['server_session_identifier'] : ''); ?>" type="text" id="form_server_session_identifier" />
            </div>
                                           
                        
        </div>
    </div>
