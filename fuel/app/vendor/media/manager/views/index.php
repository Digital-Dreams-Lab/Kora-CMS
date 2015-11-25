
<?php $csrf_token = Security::fetch_token(); ?>

<!-- Row -->
<div class="row">
    
	<?php if(\Kora\Permissions::check('edit')): ?>   
    <!-- Left col -->
    <div class="col-xs-12 col-sm-2">
		<?php if(\Kora\Permissions::check('folders')): ?>
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
                <div id="create_media_folder_alert"></div>
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
    	<?php endif; ?>
    </div>
    <!-- Left col end -->
    <?php endif; ?>
    <!-- Center col -->
    <div id="media-gallery-display" class="col-xs-12 col-sm-7">           
        <!-- Container -->
        <div>
            <!-- Breadcrumb -->   
            <ul class="breadcrumb call_folder_manager" id="folder_list">
            </ul>
            <div class="clearfix"></div>
        </div>
        <!-- Media list --> 
        <div id="media_list"></div> 
    </div>
    <!-- Center col end --> 
    
	<?php if(\Kora\Permissions::check('edit')): ?>                       
    <!-- Right col -->                        
    <div class="col-xs-12 col-sm-3">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
			<?php if(\Kora\Permissions::check('actions')): ?> 
            <li role="presentation" class="active"><a href="#actions" aria-controls="actions" role="tab" data-toggle="tab">Actions</a></li>
			<?php endif; ?>            

			<?php if(\Kora\Permissions::check('upload')): ?>
            <li role="presentation"><a href="#upload" aria-controls="upload" role="tab" data-toggle="tab">Upload</a></li>
			<?php endif; ?>            
        </ul>                        
        <!-- Tab content -->
        <div class="tab-content"> 
			<?php if(\Kora\Permissions::check('actions')): ?> 
            <!-- Tab panels -->
            <div role="tabpanel" class="tab-pane active" id="actions">
                <h4></h4>
                <div id="batch_media_action_alert"></div>
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
                    </div>
        
                    <span id="toggle_move_folder">
                    <div class="form-group">
                        <label class="control-label">Folder</label> 
                        <select class="form-control input-sm" name="move_folder_id" id="folders_list">
                        </select>
                    </div>
                    </span>  

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary pull-right">
                            <i id="spinner_action" class="fa fa-play"></i> Action
                        </button>
                    </div>
                </form>
                
                <hr />
                <label class="control-label">Media item preview</label> 
                <div id="preview_media_details"></div> 
            </div>
            <!-- Tab panels end -->  
            <?php endif; ?>
            
			<?php if(\Kora\Permissions::check('upload')): ?>                           
            <!-- Tab panels -->
            <div role="tabpanel" class="tab-pane" id="upload">                              	
                    <!-- Spacer -->
                <h4></h4>
                <div id="upload_media_object_alert"></div>
                <form id="form_upload_media_object" enctype="multipart/form-data" accept-charset="utf-8" method="post">
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
                        <input class="form-control input-sm clear_input" placeholder="Name" required="required" name="name" type="text" />
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
            <!-- Tab panels end -->
            <?php endif; ?>
        </div>                        
        <!-- Tab content end -->
        <?php endif; ?>

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
    <input type="hidden" name="list_style" value="" />
</form>

<div class="row">
	<div class="col-md-12">
    	<div id="pagination" class="text-center"></div>
	</div>
</div>            
<div class="row media-footer">  
    <div class="col-sm-2 text-center"><strong>Selected media</strong></div>
    <div id="preview_media" class="col-sm-7"></div>
</div>
<style>
.call_folder_actions > i {
    opacity: 0;
}
.call_folder_actions:hover > i {
    opacity: 1;
	cursor: pointer;
}

.list-unstyled {
	padding: 5px 0px;
}
  
.check {	
  width:30px;
  height:30px;
  position: absolute !important;
  top: 0px !important;
  right: 0px !important;
}

.check:hover + img {  
  box-shadow: 0px 0px 10px rgba(0,0,0,0.8);
}

.modal-dialog {
  width: 98%;  
  padding: 0;
  padding-top: 20px;
}
.modal-content {
}

ul.folder_tree {
	margin-left: 0px !important;
	padding-left: 0px !important;
}
ul.folder_tree ul,
ul.folder_tree > ul {
	margin-left: 10px !important;
	padding-left: 10px !important;
}
.border-right {
	border-right: solid 1px #ddd;
}
.border-left {
	border-left: solid 1px #ddd;
}
.thumbnail {
    position: relative;
	padding: 10px;
}

#preview_media .thumbnail {
    position: relative;
	padding: 3px !important;
	margin-right: 3px !important;
}
.thumbnail:hover {
	background-color: #efefef;
}

.caption {
    position: absolute;
    bottom: 0px;
    left: 0px;  
    width: 100%;  
	
    background-color: #000;  
    opacity: 0.4;
    filter: alpha(opacity=40);
	border-bottom-left-radius: 3px;
	border-bottom-right-radius: 3px;
}

.caption p {
	color: #fff;
    opacity: 1;
    filter: alpha(opacity=100);
}
#media-gallery-display {
	overflow: scroll;
	height: 450px;
}
</style>
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
		var base_url = "<?php echo Uri::base(false); ?>" + "admin/media/manageralt/list.json";

		// Set spinner class
		$('#spinner').removeClass('fa-spin');
		$('#response').hide();			
		$('#preview_media_alert').hide();
		$("#media_gallery_display").scroll();
		/******************************************************/
		/* Media Manager functions
		/******************************************************/
		// Output response
		function mediaManagerAlerter(elementid, response, alert_class) {		
			console.log(response);
			$(elementid).html('<div id="alert_fadeout" class="alert alert-dismissible alert-' + alert_class + '" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' + response + '<div>').show();
			$("#alert_fadeout").fadeTo(2000, 500).slideUp(500, function(){
				$("#alert_fadeout").alert('close');
			});
		}		
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
			if (action === true) {			
				$(obj_id).addClass('fa-spin');
			} else {
				$(obj_id).removeClass('fa-spin');
			}
		}
		// Set spinner
		function mediaManagerSerializer(obj) {			
			var retstr, data;
      		if ($.isArray(obj)) {
				data = $("#form_default_media_data").getFormValues();
				var newArray = $.extend(data, obj);
				retstr = '?' + $.param(newArray) + csrftoken;
			} else {
				data = $("#form_default_media_data").serialize();
				var newstr = data + obj;
				retstr = newstr + csrftoken;			
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
					mediaManagerAlerter("#create_media_folder_alert","New folder created!",'success');
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
			console.log($(this)[0]);
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
					mediaManagerAlerter("#upload_media_object_alert","New file uploaded!",'success');
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

				checkArray = [];
				previewArray = [];
				attachObj = {};
				tmpl = [];
				
				$(".call_image_check").prop( "checked", false );
				$("#media_ids").val("");
				$("#preview_media_details").empty();
				$("#preview_media").empty();
				
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
						mediaManagerAlerter("#batch_media_action_alert","Media " + action + "d!",'success');	
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
		/* Select a section to attach media to
		/******************************************************/		
		$("#form_attach_media_item").submit(function( event ) {
			// Stop form submiting 
			event.preventDefault();

			console.log(event);

			mediaManagerAttacher();
			
			checkArray = [];
			previewArray = [];
			attachObj = {};
			tmpl = [];
			
			$(".call_image_check").prop( "checked", false );
			$("#media_ids").val("");
			$("#preview_media_details").empty();
			$("#preview_media").empty();
		});				
		/******************************************************/
		/* Create a new media folder
		/******************************************************/		
		$("#form_create_media_folder").submit(function( event ) {
			// Stop form submiting 
			event.preventDefault();
			
			console.log(event);
			mediaManagerFolderCreator($(this));
		});
		// Hide folder select
		$("#toggle_move_folder").hide();			
		
		$("#select_batch_action").change(function( event ) {
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
		var attachObj = {};
		
		Array.observe(previewArray, function(changes){
			changes.forEach(function(change) {
				console.log(change.type, change.name, change.oldValue);
			});
		});
		
		$(document).on("change", ".call_image_check", function( event ) {	
				
			$("#media_ids").val("");
			
			var val = $(this).val();
			var data = $(this).data();
			var elements = '';
			var tmpl = [];

			
			if ($(this).prop("checked")) {
				checkArray[val] = val;
				previewArray[val] = data.previewMedia;
				attachObj[val] = {'msrc':data.attachMedia,'ext':data.attachExt};
				tmpl[val] =	'<div class="col-sm-4">' +
								'<a href="#">' +
									 ((data.fileType == 'img')?'<img class="img-responsive" src="' + data.fileSrc + '" alt="' + data.fileName + '">':'<i class="fa fa-file-text-o fa-3x media-size-50"></i>') +
								'</a>' +
							'</div>' +
							'<div class="col-sm-8">' +
								'<span class="text-muted"><strong>' + data.fileName + '</strong></span><br />' +
								'<small class="text-muted"><strong>Size:</strong> ' + data.fileSize + '</small><br />' +
								'<small class="text-muted"><strong>Dimensions:</strong> ' + data.fileHeight + 'x' + data.fileWidth + ' px</small><br />' +
								'<small class="text-muted"><strong>Date created:</strong> ' + data.fileCreatedAt + '</small><br />' +
							'</div>';
			} else {
				if (checkArray[val]) {
					delete checkArray[val];
					delete previewArray[val];
					delete attachObj[val];
					delete tmpl[val];
				}
			}
			
			previewArray.forEach(function(entry) {
				if (entry.indexOf("http") >= 0) {
					elements += '<div class="col-xs-1 text-center thumbnail"><img src="' + entry + '"></div>';
				} else {
					elements += '<div class="col-xs-1 text-center thumbnail"><i class="' + entry + '"></i></div>';				
				}
			});
			
			$("#preview_media_details").html(tmpl[val]);
			$("#media_ids").val(checkArray);
			$("#preview_media").html(elements);
		});
		/******************************************************/
		/* Call media manager - Return folder list / update media lib
		/******************************************************/		
		$(document).on("click", "a.call_get_folder", function( event ) {
			// Stop form submiting 
			event.preventDefault();	
			
			var obj = [];
			
			obj.action = 'folder_default';
			obj.folder_id = $(this).data('folder-id');
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
			
			obj.action = 'folder_default';
			obj.per_page = $(this).data('per-page');
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
			
			obj.action = 'folder_delete';
			obj.folder_id = $(this).data('folder-id');	
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
			
			obj.folder_id = $(this).data('folder-id');
			obj.parent_id = $(this).data('folder-parent-id');
			obj.name = $(this).data('folder-name');
			
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
			if (hash !== '') {
				var hashstr = hash.substr(1);
				var hashArray = hashstr.split('/');
				var obj = [];
				
				obj.action = 'folder_default';
				obj.page_num = hashArray[2];
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
				if (formvals[obj.name] === undefined)
					formvals[obj.name] = obj.value;
				else if (typeof formvals[obj.name] == Array) 
					formvals[obj.name].push(obj.value);
				else formvals[obj.name] = [formvals[obj.name],obj.value];
			});	
			return formvals;
		};	
	});
</script>