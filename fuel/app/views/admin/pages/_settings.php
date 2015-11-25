<?php /*
<div class="col-md-8">
    <div class="panel panel-default">
        <div class="panel-heading"><i class="fa fa-paint-brush"></i> Page layout</div>
        <div class="panel-body">		
			<?php echo $print_blocks; ?>
        </div>
    </div>
</div>
*/ ?>

<input type="hidden" data-page-id="<?=$page->id?>" value="<?=$page->id?>" name="page_id" id="sortsections_page_id" />
<div class="panel panel-default">
    <div class="panel-heading"><i class="fa fa-list-ol"></i> Sort section order</div>
    <div class="panel-body">
        <div id="response"></div>
        <ul id="sortsections_list" class="sortsections list-group">
        </ul>  
    </div>
</div>

<style>
body.dragging, body.dragging * {
  cursor: move !important;
}

.sortsections:hover {
  cursor: move !important;
}
.dragged {
  position: absolute;
  opacity: 0.5;
  z-index: 2000;
}

ol.sortsections li.placeholder {
  position: relative;
  /** More li styles **/
}
ol.sortsections li.placeholder:before {
  position: absolute;
  /** Define arrowhead **/
}
</style>
<script>
$(function  () {
	var base_url = '<?php echo Uri::base(false).'admin/rest/pages/settings/'; ?>';	
	var initObj = {'page_id':<?php echo isset($page->id)?$page->id:'';?>};	
	var group = $("ul[class*='sortsections']").sortable({
		group: 'serialization',
		delay: 500,
		onDrop: function ($item, container, _super) {
			var page_id = $('#sortsections_page_id').data('page-id');
			var obj = {'sortsections':'','page_id':page_id};
			// flatten array
			obj.sortsections = $.map(group.sortable("serialize").get(), function(n){ return n; });
			
			console.log(obj);
			var jsonString = JSON.stringify(obj, null, ' ');
			$('#js_response').text(jsonString);
			pagesSettingsResort(obj);
			_super($item, container);
		}
	});

	// start page
	pagesSettingsInit();
	// Output response
	function pagesSettingsResponder(response, alert_class) {
		$('#response').html('<div class="alert alert-' + alert_class + '" role="alert">' + response + '<div>');
	}
	// Console log	
	function pagesSettingsDebugger(data) {	
		console.log(data);
	}
	// Set spinner
	function pagesSettingsSpinner(obj_id, action) {
		if (action === true) {			
			$(obj_id).addClass('fa-spin');
		} else {
			$(obj_id).removeClass('fa-spin');
		}
	}
	// Propagate the page
	function pagesSettingsPropagator(data) {
		$('#sortsections_list').html(data.sortsections_list);		
	}
	function pagesSettingsInit() {
		$.ajax({
			type: "POST",
			dataType: "json",
			url: base_url + 'sortsections.json',
			data: initObj,			
			beforeSend: function(){
				pagesSettingsSpinner('#spinner',true);
			},									   
			success: function(data){				
				pagesSettingsPropagator(data);
				pagesSettingsSpinner('#spinner',false);	
				pagesSettingsDebugger(data);	
			},				
			error: function(response) {
				pagesSettingsResponder(response, 'error');
				pagesSettingsSpinner('#spinner',false);	
				pagesSettingsDebugger(response);
			}						   
		});
	}
	function pagesSettingsResort(obj) {
		$.ajax({
			type: "POST",
			dataType: "json",
			url: base_url + 'resort.json',
			data: obj,			
			beforeSend: function(){
				pagesSettingsSpinner('#spinner',true);
			},									   
			success: function(data){				
				pagesSettingsPropagator(data);
				pagesSettingsSpinner('#spinner',false);	
				pagesSettingsDebugger(data);	
			},				
			error: function(response) {
				pagesSettingsResponder(response, 'error');
				pagesSettingsSpinner('#spinner',false);	
				pagesSettingsDebugger(response);
			}						   
		});
	}
	/******************************************************/
	/* Create new section plugin select
	/******************************************************/
	$("#form_insert_new_section").submit(function( event ) {
		// Stop form submiting 
		event.preventDefault();	
		// Set form data
		var obj = $(this).getFormValues();
		
		console.log($(this)[0]);
		
		$.ajax({
			type: "POST",
			dataType: "json",
			url: base_url + 'addsection.json',
			data: obj,			
			beforeSend: function(){
				pagesSettingsSpinner('#spinner',true);
			},									   
			success: function(data){				
				pagesSettingsPropagator(data);
				pagesSettingsSpinner('#spinner',false);	
				pagesSettingsDebugger(data);	
			},				
			error: function(response) {
				pagesSettingsResponder(response, 'error');
				pagesSettingsSpinner('#spinner',false);	
				pagesSettingsDebugger(response);
			}						   
		});
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




