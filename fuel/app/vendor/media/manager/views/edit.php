
<?php $csrf_token = Security::fetch_token(); ?>
<?php 
	$sid = $section['section_id']; 
	$section_url = URI::base(false).'admin/pages/edit/'.$section['page_id'].'/'.$sid;
	$settings_url = URI::base(false).'admin/pages/settings/'.$section['page_id'].'/'.$sid;
?>
<div class="panel panel-default">
    <div class="panel-heading" role="tab" id="heading<?=$sid?>">
        <h4 class="panel-title">
	        <a href="<?=$section_url?>"><i class="fa fa-files-o"></i></a>

            <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse<?=$sid?>" aria-expanded="true" aria-controls="collapse<?=$sid?>">Media</a>
            <small>Section ID #<?=$sid?></small>
                        
            <a class="pull-right" href="<?=$settings_url?>"><i class="fa fa-cog"></i></a>
        </h4>
        
    </div>
    <div id="collapse<?=$sid?>" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="heading<?=$sid?>">
        <div class="panel-body">
            <!-- Button trigger modal -->
            <button class="btn btn-default btn-block" data-toggle="modal" data-target="#media-modal">
            	<i class="fa fa-search"></i> View media library
            </button>
        </div>
    </div>
</div>
<br />



<!-- Modal -->
<div class="modal fade" id="media-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Media gallery</h4>
            </div>
            <div class="modal-body">
                <!-- Row -->
                <div class="row">
                	<!-- Left col -->
                    <div class="col-xs-12 col-sm-2 col-md-2 col-lg-2">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active"><a href="#tree" aria-controls="tree" role="tab" data-toggle="tab">Folders</a></li>
                            <li role="presentation"><a href="#folder" aria-controls="folder" role="tab" data-toggle="tab">Add</a></li>
                        </ul>
                        <!-- Tab content -->
                        <div class="tab-content">
                            <!-- Tab panels -->
                            <div role="tabpanel" class="tab-pane active" id="tree">
                            	<!-- Spacer --> 
                                <h4></h4>                                  
                                <div class="form-group">
                                    <label class="control-label">Folder tree</label>
                                </div>
                                <!-- Tree -->                                    
                                <ul class="folder_tree list-group" id="folder_tree_home">
                                	<li class="list-unstyled">
                                    	<a href="#" class="call_get_folder" data-folder-id="0">
                                        	<i class="fa fa-folder-open"></i> Home
                                        </a>
                                    </li>
	                                <!-- Dynamic list -->                                    
                                    <ul class="call_folder_manager folder_tree" id="folder_tree">
                                    </ul>
                                </ul>
                                <!-- Tree end -->                                    
                            </div>           
                            <!-- Tab panels end -->
                            <!-- Tab panels -->
                            <div role="tabpanel" class="tab-pane" id="folder"> 
                                <h4></h4>
                                <form id="form_create_media_folder" method="post">      
                                    <input type="hidden" name="action" value="folder_create" /> 
                                    <input type="hidden" name="user_id" value="<?php echo $section['user_id']; ?>" />
                                    <input type="hidden" name="plugin_id" value="<?php echo $section['plugin_id']; ?>" />
                                    <!-- Print out folder_id input -->
                                    <span class="insert_hidden_inputs"></span>
                                    
                                    <div class="form-group">
                                        <label class="control-label" for="form_description">Folder name</label>  
                                        <input class="form-control input-sm  clear_input" id="folder_name" required="required" name="name" type="text" placeholder="Add folder" />
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label" for="form_description">Folder description</label>            
                                        <textarea class="form-control input-sm  clear_input" placeholder="Description" required="required" name="description" id="form_description" /></textarea>
                                     </div>
                        
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary pull-right">
                                        	<i id="spinner_folder" class="fa fa-folder"></i> Create                                         
                                        </button>
                                    </div>
                                </form>
                            </div>
                            <!-- Tab panels end -->
                        </div>
                    </div>
                    <!-- Left col end -->
                	<!-- Center col -->
                    <div id="media-gallery-display" class="col-xs-12 col-sm-7 col-md-7 col-lg-7">           
						<!-- Container -->
                        <div>
                            <!-- Breadcrumb -->   
                            <ul class="breadcrumb call_folder_manager" id="folder_list">
                            </ul>
                			<!-- Per page -->                        
                            <div class="pull-right">
                                <span class="label"><a href="#" class="call_per_page" data-per-page="3">3</a></span>
                                <span class="label"><a href="#" class="call_per_page" data-per-page="5">5</a></span>
                                <span class="label"><a href="#" class="call_per_page" data-per-page="10">10</a></span>
                                <span class="label"><a href="#" class="call_per_page" data-per-page="15">15</a></span>
                                <span class="label"><a href="#" class="call_per_page" data-per-page="20">20</a></span> 
                            </div>
                			<!-- Info alert -->                            
                            <div class="alert alert-info" id="response"></div>
                            <div class="clearfix"></div>
                        </div>
                		<!-- Media list --> 
                        <div id="media_list"></div> 
                        <div>
                            <div class="clearfix"></div>
                            <div id="pagination" class="text-center"></div>
						</div>
                    </div>
                	<!-- Center col end -->                        
                	<!-- Right col -->                        
                    <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active"><a href="#actions" aria-controls="actions" role="tab" data-toggle="tab">Actions</a></li>
                            <li role="presentation"><a href="#upload" aria-controls="upload" role="tab" data-toggle="tab">Upload</a></li>                        </ul>                        
                        <!-- Tab content -->
                        <div class="tab-content"> 
                            <!-- Tab panels -->
                            <div role="tabpanel" class="tab-pane active" id="actions">
                                <h4></h4>
                                <form id="form_batch_media_action" method="post"> 
                                    <input type="hidden" name="user_id" value="<?php echo $section['user_id']; ?>" />
                                    <input type="hidden" name="plugin_id" value="<?php echo $section['plugin_id']; ?>" />
                                    <input type="hidden" id="media_ids" name="media_ids" />
                                    <!-- Print out folder_id input -->
                                    <span class="insert_hidden_inputs"></span>
                            
                                    <div class="form-group">
                                        <label class="control-label">Batch actions</label> 
                                        <select id="select_batch_action" class="form-control input-sm required" name="action">
                                            <option value="">Select an action</option>
                                            <option value="files_batch_move">Move selected media to</option>
                                            <option value="files_batch_delete">Delete selected media</option>
                                        </select>
                                        <span id="toggle_move_folder">
                                            <label class="control-label">Folder</label> 
                                            <select class="form-control input-sm" name="move_folder_id" id="folders_list">
                                            </select>
                                        </span>                                        
                                    </div>
                                    
                        
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary pull-right">
                                        	<i id="spinner_action" class="fa fa-play"></i> Action
                                        </button>
                                    </div>
                                </form>
                				<div class="clearfix"></div>
                                <div id="preview_media_details"></div> 
                            </div>
                            <!-- Tab panels end -->                             
                            <!-- Tab panels -->
                            <div role="tabpanel" class="tab-pane" id="upload">
                            	<!-- Format inputs -->
                				<div class="col-md-12">                                	
                                    <!-- Spacer -->
                                    <h4></h4>   
                                    <form id="form_upload_media_object" enctype="multipart/form-data" class="form-horizontal" accept-charset="utf-8" method="post">
                                        <input type="hidden" name="action" value="file_create" /> 
                                        <input type="hidden" name="user_id" value="<?php echo $section['user_id']; ?>" />
                                        <input type="hidden" name="plugin_id" value="<?php echo $section['plugin_id']; ?>" />
                                        <input type="hidden" name="section_id" value="1" />
                                        <input type="hidden" name="custom_width" value="" />
                                        <input type="hidden" name="custom_height" value="" />
                                        <input type="hidden" name="fuel_csrf_token" value="<?php echo $csrf_token; ?>" />        
                                        <!-- Print out hidden inputs -->
                                        <span class="insert_hidden_inputs"></span>
                                        
                                        <!-- Form inputs -->
                                        <div class="form-group">
                                            <label class="control-label">Media name</label>
                                            <input class="form-control col-md-3 input-sm clear_input" placeholder="Name" required="required" name="name" type="text" />
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Caption</label>            
                                            <input class="form-control input-sm clear_input" placeholder="Caption" required="required" name="caption" type="text" />
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Description</label>            
                                            <textarea class="form-control input-sm clear_input" placeholder="Description" required="required" name="description" /></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Upload file</label> 
                                            <input class="form-control input-sm clear_input" type="file" required="required" name="filetoupload" id="form_filetoupload" />
                                        </div>
                                        <!-- Form submit -->                        
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary pull-right">
                                                <i id="spinner_upload" class="fa fa-upload"></i> Upload
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!-- Tab panels end -->
                        </div>                        
                        <!-- Tab content end -->

                    </div>
                    <!-- Right col end -->
                	<div class="clearfix"></div>
                </div>
                <!-- Row end -->
                <form id="form_default_media_data" method="post"> 
                    <input type="hidden" name="user_id" value="<?php echo $section['user_id']; ?>" />
                    <input type="hidden" name="plugin_id" value="<?php echo $section['plugin_id']; ?>" />
                    <!-- Print out hidden inputs -->
                    <span class="insert_hidden_inputs"></span>
                </form>
                <form id="form_init_media_data" method="post"> 
                    <input type="hidden" name="user_id" value="<?php echo $section['user_id']; ?>" />
                    <input type="hidden" name="plugin_id" value="<?php echo $section['plugin_id']; ?>" />
                    
                    <input type="hidden" name="folder_id" value="0" />
                    <input type="hidden" name="per_page" value="5" />
                    <input type="hidden" name="page_num" value="1" />
                </form>
            </div>
            
            <div class="modal-footer">  
            	<div class="col-sm-2 text-center"><strong>Selected media</strong></div>
            	<div id="preview_media" class="col-sm-7"></div>
                <div id="buttons" class="col-sm-3">
	            	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    			</div>
            </div>
    	</div>
    </div>
</div>

<script type="text/javascript">
	/******************************************************/
	/* HACK THE SHIT OUT OF THE FOLLOWING JS PLEASE
	/******************************************************
	/******************************************************
	
		Please be my guest an tidy/modify or hack the shit out
		of the following js.
		
	/******************************************************
	/******************************************************/
	$("document").ready(function(){
		/******************************************************/
		/* Globals
		/******************************************************/
		
	    var current_token = '<?php echo $csrf_token; ?>';
		var csrftoken = '&fuel_csrf_token=' + current_token;
		var base_url = "<?php echo Uri::base(false); ?>" + "admin/media/manager/list.json";
		// set spinner class
		$('#spinner').removeClass('fa-spin');
		$('#response').hide();
		$("#media_gallery_display").scroll();
		/******************************************************/
		/* Media Manager functions
		/******************************************************/
		// Propagate the page
		function mediaManagerPropagator(data) {
			$('#media_list').html(data.media_list);			
			$('#folder_list').html(data.folder_list);	
			$('#folders_list').html(data.folders_list);		
			$('#folder_tree').html(data.folder_tree);
			$('.insert_hidden_inputs').html(data.folder_hidden);
		}
		// Ouput paginator
		function mediaManagerPaginator(data) {
			$('#pagination').html(data.pagination.replace(/\?=/gi, "#/call_media_page/"));			
		}
		// Output response
		function mediaManagerResponder(response, alert_class) {
			$('#response').html('<div class="alert alert-' + alert_class + '" role="alert">' + response + '<div>');
		}
		// Console log	
		function mediaManagerDebugger(data) {	
			console.log(data);
		}
		// Set spinner
		function mediaManagerSpinner(obj_id, action) {
			if (action == true) {			
				$(obj_id).addClass('fa-spin');
			} else {
				$(obj_id).removeClass('fa-spin');
			}
		}
		// Set spinner
		function mediaManagerPerPage() {
			var per_page = $('.call_per_page').data('per-page');		
		}
		// Set spinner
		function mediaManagerSerializer(obj) {			
			if ($.isArray(obj)) {
				var data = $("#form_default_media_data").getFormValues();
				var newArray = $.extend(data, obj);
				var retstr = '?' + $.param(newArray) + csrftoken;
			} else {
				var data = $("#form_default_media_data").serialize();
				var newstr = data + obj;
				var retstr = newstr + csrftoken;			
			}
			return retstr;
		}
		// Set spinner
		function mediaManagerInitData(obj) {
			var data = $("#form_init_media_data").serialize();
			var newstr = data + obj;
			var retstr = newstr + csrftoken;
			return retstr;
		}
		// Set spinner
		function mediaManagerCustomData(obj) {
			var newstr = $(obj).serialize();
			var retstr = '?' + newstr + csrftoken;
			return retstr;	
		}
		function mediaManagerAjaxGET(obj) {
			$.ajax({
				type: "GET",
				dataType: "json",
				url: base_url + mediaManagerSerializer(obj),			
				beforeSend: function(){
					mediaManagerSpinner('#spinner',true);
				},									   
				success: function(data){				
					mediaManagerPropagator(data);
					mediaManagerPaginator(data);
					mediaManagerSpinner('#spinner',false);	
					mediaManagerDebugger(data);	
				},				
				error: function(response) {
					mediaManagerResponder(response, 'error');
					mediaManagerSpinner('#spinner',false);	
					mediaManagerDebugger(response);
				}						   
			});
		}
		function mediaManagerAjaxPOST(obj) {
			$.ajax({
				type: "POST",
				dataType: "json",
				url: base_url,
				data: obj,			
				beforeSend: function(){
					mediaManagerSpinner('#spinner',true);
				},									   
				success: function(data){				
					mediaManagerPropagator(data);
					mediaManagerPaginator(data);
					mediaManagerSpinner('#spinner',false);	
					mediaManagerDebugger(data);	
				},				
				error: function(response) {
					mediaManagerResponder(response, 'error');
					mediaManagerSpinner('#spinner',false);	
					mediaManagerDebugger(response);
				}						   
			});
		}
		function mediaManagerFolderCreator(obj) {
			// ajax call
			$.ajax({
				type: "POST",
				dataType: "json",
				data: obj.serialize(),
				url: base_url,			
				beforeSend: function(){
					mediaManagerSpinner('#spinner',true);	
					$('#spinner_folder').removeClass('fa-folder');
					$('#spinner_folder').addClass('fa-refresh fa-spin');	
				},									   
				success: function(data){				
					mediaManagerPropagator(data);
					mediaManagerPaginator(data);
					mediaManagerSpinner('#spinner',false);
					$('#spinner_folder').removeClass('fa-refresh fa-spin');		
					$('#spinner_folder').addClass('fa-folder');
					mediaManagerDebugger(data);
					$('.clear_input').val("");	
				},				
				error: function(response) {
					mediaManagerResponder(response, 'error');
					mediaManagerSpinner('#spinner',false);	
					$('#spinner_folder').removeClass('fa-folder');
					$('#spinner_folder').addClass('fa-refresh fa-spin');
					mediaManagerDebugger(response);
				}						   
			});
		}
		/******************************************************/
		/* Media Manager init
		/******************************************************/
		function mediaManagerInit() {	
			$.ajax({
				type: "POST",
				dataType: "json",
				url: base_url,
				data: mediaManagerInitData('&action=folder_default'),				
				beforeSend: function(){
					mediaManagerSpinner('#spinner',true);
				},									   
				success: function(data){				
					mediaManagerPropagator(data);
					mediaManagerPaginator(data);
					mediaManagerSpinner('#spinner',false);	
					mediaManagerDebugger(data);	
				},				
				error: function(response) {
					mediaManagerResponder(response, 'error');
					mediaManagerSpinner('#spinner',false);	
					mediaManagerDebugger(response);
				}						   
			});							
		}
		// Fire off Media Manager
		mediaManagerInit();
		/******************************************************/
		/* Upload media object - IMAGE or FILE
		/******************************************************/
		$("#form_upload_media_object").submit(function( event ) {
			// Stop form submiting 
			event.preventDefault();	
			// Set form data
			var formData = new FormData($(this)[0]);
			console.log($(this)[0])
			// ajax call
			$.ajax({
				type: "POST", 
				cache: false,
				contentType: false,
				processData: false,
				mimeType:"multipart/form-data",
				dataType: "json",
				url: base_url,
  				data: formData,				
				beforeSend: function(){
					mediaManagerSpinner('#spinner',true);
					$('#spinner_upload').removeClass('fa-upload');
					$('#spinner_upload').addClass('fa-refresh fa-spin');
				},									   
				success: function(data){				
					mediaManagerPropagator(data);
					mediaManagerPaginator(data);
					mediaManagerSpinner('#spinner',false);
					$('#spinner_upload').removeClass('fa-refresh fa-spin');
					$('#spinner_upload').addClass('fa-upload');	
					mediaManagerDebugger(data);
					$('.clear_input').val("");
				},				
				error: function(response) {
					mediaManagerResponder(response, 'error');
					mediaManagerSpinner('#spinner',false);	
					$('#spinner_upload').removeClass('fa-refresh fa-spin');
					$('#spinner_upload').addClass('fa-upload');		
					mediaManagerDebugger(response);
				}						   
			});
		});					
		/******************************************************/
		/* Batch media action - Move/Delete IMAGE or FILE
		/******************************************************/
		$("#form_batch_media_action").submit(function( event ) {
			// Stop form submiting 
			event.preventDefault();
			
			var obj = $(this).getFormValues();
			var action = (obj.action=='files_batch_delete') ? 'delete': 'move'; 
			var msg = "You are about to " + action + " media, would you like to proceed?";
			
			if (confirm(msg)) {
	
				$("#media_ids").val("");
				$("#preview_media").html("");
				$("#preview_media_details").html("");
				$(".call_image_check").prop("");
				delete checkArray;
				delete previewArray;
				
				$.ajax({
					type: "POST",
					dataType: "json",
					url: base_url,
					data: obj,				
					beforeSend: function(){
						mediaManagerSpinner('#spinner',true);
					},									   
					success: function(data){				
						mediaManagerPropagator(data);
						mediaManagerPaginator(data);
						mediaManagerSpinner('#spinner',false);	
						mediaManagerDebugger(data);
					},				
					error: function(response) {
						mediaManagerResponder(response, 'error');
						mediaManagerSpinner('#spinner',false);	
						mediaManagerDebugger(response);
					}						   
				});
			}
			return false;
		});							
		/******************************************************/
		/* Create a new media folder
		/******************************************************/		
		$("#form_create_media_folder").submit(function( event ) {
			// Stop form submiting 
			
			console.log(event);
			event.preventDefault();
			mediaManagerFolderCreator($(this));
		});
		// Hide folder select
		$("#toggle_move_folder").hide();			
		
		$(document).on("change", "#select_batch_action", function(e) {		
			if ('files_batch_move' == $(this).val()){
				$("#toggle_move_folder").show();
			} else {
				$("#toggle_move_folder").hide();
			}			
		});							
		/******************************************************/
		/* Select/Deselect IMAGE or FILE Add/Remove in array for batch actions
		/******************************************************/
		var checkArray = [];
		var previewArray = [];
		
		Array.observe(previewArray, function(changes){
			changes.forEach(function(change) {
				console.log(change.type, change.name, change.oldValue);
			});
		});
		
		$(document).on("change", ".call_image_check", function( event ) {	
				
			$("#media_ids").val("");
			
			var val = $(this).val();
			var data = $(this).data();
			var elements = $();
			var tmpl = 	'<div class="col-sm-4">' +
							'<a href="#">' +
								 ((data.fileType == 'img')?'<img class="media-object thumbnail" src="' + data.fileSrc + '" alt="' + data.fileName + '">':'<i class="fa fa-file-text-o fa-3x media-size-50"></i>') +
							'</a>' +
						'</div>' +
						'<div class="col-sm-8">' +
							'<h4 class="media-heading">' + data.fileName + '</h4>' +
							'<span>' + data.fileSize + '<span><br />' +
							'<span>' + data.fileHeight + '<span><br />' +
							'<span>' + data.fileWidth + '<span><br />' +
							'<span>' + data.fileCreatedAt + '<span><br />' +
						'</div>';
			
			if ($(this).prop("checked")) {
				checkArray[val] = val;
				previewArray[val] = data.previewMedia;
			} else {
				if (checkArray[val]) {
					delete checkArray[val];
					delete previewArray[val];
					
					$("#preview_media").html("");
					$("#preview_media_details").html("");
				}
			}

			previewArray.forEach(function(entry) {
				if (entry.indexOf("http") >= 0) {
					elements = elements.add('<div class="col-xs-1 text-center thumbnail"><img src="' + entry + '"></div>');
				} else {
					elements = elements.add('<div class="col-xs-1 text-center thumbnail"><i class="' + entry + '"></i></div>');				
				}
			});
			
			$("#media_ids").val(checkArray);
			$("#preview_media").html(elements);
			$("#preview_media_details").html(tmpl);
		});
		/******************************************************/
		/* Call media manager - Return folder list / update media lib
		/******************************************************/		
		$(document).on("click", "a.call_get_folder", function( event ) {
			// Stop form submiting 
			event.preventDefault();	
			
			var obj = [];
			
			obj['action'] = 'folder_default';
			obj['folder_id'] = $(this).data('folder-id');
			// ajax call
			mediaManagerAjaxGET(obj);
		});
		/******************************************************/
		/* Call media manager - Return items per page / update media lib
		/******************************************************/		
		$(document).on("click", "a.call_per_page", function( event ) {
			// Stop form submiting 
			event.preventDefault();	
			
			var obj = [];
			
			obj['action'] = 'folder_default';
			obj['per_page'] = $(this).data('per-page');
			// ajax call
			mediaManagerAjaxGET(obj);
		});
		
		/******************************************************/
		/* Call delete folder action show_rename_folder_action
		/******************************************************/		
		$(document).on("click", "i.show_delete_folder_action", function( event ) {
			// Stop form submiting 
			event.preventDefault();	
			
			var obj = [];
			
			obj['action'] = 'folder_delete';
			obj['folder_id'] = $(this).data('folder-id');	
			var folder_name = $(this).data('folder-name');	
				
			var data = $("#form_default_media_data").getFormValues();
			var newArray = $.extend(data, obj);
			var msg = "You are about to delete the folder "+folder_name+", would you like to proceed?";
			// ajax call
			if (confirm(msg)) {
				mediaManagerAjaxPOST(newArray);
			}			
		});
		/******************************************************/
		/* Call rename folder action show_rename_folder_action
		/******************************************************/		
		$(document).on("click", "i.show_rename_folder_action", function( event ) {
			// Stop form submiting 
			event.preventDefault();	
			
			var obj = [];
			
			obj['folder_id'] = $(this).data('folder-id');
			obj['parent_id'] = $(this).data('folder-parent-id');
			obj['name'] = $(this).data('folder-name');
			
			console.log("You clicked the icon to rename a folder id: " + obj.folder_id);
			// replace a with input form to change folder name
			var formtmpl = '<form method="post" id="form_folder_rename">' +
								'<input type="hidden" name="action" value="folder_rename" />' +
								'<input type="hidden" name="folder_id" value="'+obj.folder_id+'" />' +
								'<input type="hidden" name="parent_id" value="'+obj.parent_id+'" />' +
								'<input class="form-control input-sm folder_rename_input" type="text" name="name" value="'+obj.name+'" />' +
							 '</form>';
			
			var editlink = replacelink = $(this).prev();
			var editicon = replaceicon = $(this);
			var editinput = $("input.folder_rename_input");
			
			editlink.replaceWith(formtmpl);
			editicon.replaceWith("");
			$("input.folder_rename_input").focus();
			
			$("input.folder_rename_input").blur(function() {
				var newreplacelink = replacelink; 
				$(this).replaceWith(newreplacelink);
				newreplacelink.after(replaceicon).after(" ");
			});
			
		});
		$(document).on("keypress", "#form_folder_rename", function( event ) {
			// Stop form submiting .keypress(function(event) {
			if (event.which == 13) {
				event.preventDefault();	
				
				var obj = $(this).getFormValues();
				var data = $("#form_default_media_data").getFormValues();
				var newArray = $.extend(data, obj);
				// ajax call
				mediaManagerAjaxPOST(newArray);
			}
		});		
		/******************************************************/
		/* Pagination HACK using hash in url
		/******************************************************/			
		$(window).on('hashchange', function() {
			var hash = location.hash;
			console.log(hash);
			if (hash != '') {
				var hashstr = hash.substr(1);
				var hashArray = hashstr.split('/');
				var obj = [];
				
				obj['action'] = 'folder_default';
				obj['page_num'] = hashArray[2];
				// ajax call
				mediaManagerAjaxGET(obj);
			}
		});
		/******************************************************/
		/* Serialize form data hack from google search online 
		/******************************************************/
		$.fn.getFormValues = function(){
			var formvals = {};
			$.each($(':input',this).serializeArray(),function(i,obj){		
				if (formvals[obj.name] == undefined)
					formvals[obj.name] = obj.value;
				else if (typeof formvals[obj.name] == Array) 
					formvals[obj.name].push(obj.value);
				else formvals[obj.name] = [formvals[obj.name],obj.value];
			});	
			return formvals;
		}			
	});
</script>