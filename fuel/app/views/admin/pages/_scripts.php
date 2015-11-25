<?php $csrf_token = Security::fetch_token(); ?>
<script>
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
		$("form.form_page_edit").submit(function( event ) {
			event.preventDefault();	
			var obj = $(".form_page_edit").getFormValues();
			console.log(obj);
			pagesAjaxPOST(obj);
		});
	    var current_token = '<?php echo $csrf_token; ?>';
		var csrftoken = '&fuel_csrf_token=' + current_token;
		var base_url = "<?php echo Uri::base(false); ?>" + "admin/rest/pages/";
		var obid = <?php echo Input::post('id', isset($page) ? $page->id : ''); ?>;
		$('#response_page').hide();
		// Output response
		function pagesResponder(response, alert_class) {		
			console.log(response);
			$('#response_page').html('<div id="alert_fadeout" class="alert alert-dismissible alert-' + alert_class + '" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' + response + '<div>').show();
			$("#alert_fadeout").fadeTo(2000, 500).slideUp(500, function(){
				$("#alert_fadeout").alert('close');
			});
		}
		// Console log	
		function pagesDebugger(data) {	
			console.log(data);
		}
		// Console log	
		function pagesTitlePropagator(data) {					
			$('#page_title').html(data.page_title);
		}
		$.ajax({
			type: "GET",
			dataType: "json",
			url: base_url + 'title.json?id=' + obid,			
			beforeSend: function(){
				console.log("sending");
			},									   
			success: function(data){
				pagesTitlePropagator(data);
				pagesDebugger(data);
			},				
			error: function(response) {
				pagesResponder(response, 'danger');					
			}						   
		});
		function pagesAjaxPOST(obj) {
			$.ajax({
				type: "POST",
				dataType: "json",
				url: base_url + 'page.json',
				data: obj,			
				beforeSend: function(){
					console.log("sending");	
					$('#spinner_page').removeClass('fa-floppy-o');
					$('#spinner_page').addClass('fa-refresh fa-spin');	
				},									   
				success: function(data){
					pagesDebugger(data);
					pagesResponder(data.message, 'success');	
					$('#spinner_page').removeClass('fa-refresh fa-spin');	
					$('#spinner_page').addClass('fa-floppy-o');
				},				
				error: function(response) {
					pagesResponder(response, 'danger');					
				}						   
			});
		}
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
		/******************************************************/
		/* Call rename folder action show_rename_folder_action
		/******************************************************/		
		$(document).on("click", "span#rename_page_action", function( event ) {
			// Stop form submiting 
			event.preventDefault();	
			
			var obj = [];
			
			obj['title'] = $(this).data('page-title');
			obj['id'] = $(this).data('page-id');
			
			console.log("You clicked the icon to rename a folder id: " + obj.id);
			// replace a with input form to change folder name
			var formtmpl = '<form method="post" id="form_page_rename">' +
							'<input type="hidden" name="id" value="'+obj.id+'" />' +
							'<input class="form-control page_rename_input" type="text" name="title" value="'+obj.title+'" />' +
						 '</form>';
			
			var editlink = replacelink = $(this);
			var editicon = replaceicon = $(this).prev();
			var editinput = $("input.page_rename_input");
			
			editlink.replaceWith(formtmpl);
			editicon.replaceWith("");
			$("input.page_rename_input").focus();
			
			$("input.page_rename_input").blur(function() {
				var newreplacelink = replacelink; 
				$(this).replaceWith(newreplacelink);
				newreplacelink.after(replaceicon).after(" ");
			});
			
		});
		$(document).on("keypress", "#form_page_rename", function( event ) {
			// Stop form submiting .keypress(function(event) {
			if (event.which == 13) {
				event.preventDefault();	
				
				var obj = $(this).getFormValues();
				// ajax call
				
				var temp = obj.title.toLowerCase().replace(/ +/g,'-').replace(/[^a-z0-9-_]/g,'').trim();
				$('#slug').val(temp);
				obj.slug = temp;
				
				console.log(obj);
				
				$.ajax({
					type: "POST",
					dataType: "json",
					url: base_url + 'title.json',
					data: obj,			
					beforeSend: function(){
						console.log("sending");
					},									   
					success: function(data){
						pagesTitlePropagator(data);
						pagesResponder(data.message, 'success');
						pagesDebugger(data);
					},				
					error: function(response) {
						pagesResponder(response, 'danger');					
					}						   
				});
			}
		});	
						   
	});
</script>