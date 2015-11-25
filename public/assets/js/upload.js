	$(document).on("ready", function() {

		var footerTemplate = '<div class="file-thumbnail-footer">\n' +
			'   <div style="margin:5px 0">\n' +
			'       <input class="kv-input form-control input-sm" value="{caption}" name="name" placeholder="Enter image name...">\n' +
			'       <input class="kv-input form-control input-sm" value="Description" name="description" placeholder="Enter description...">\n' +
			'   </div>\n' +
			'   {actions}\n' +
			'</div>'; 		
		$(".image_upload").fileinput({
			layoutTemplates: {footer: footerTemplate},
			dropZoneEnabled: false,
			uploadAsync: true,
			uploadUrl: 'http://isiaha-samsung/cms/public/uploads/media/imgs/',
			uploadExtraData: function() {
				var obj = {};
				$('form').find('input').each(function() {
				var id = $(this).attr('id'), val = $(this).val();
				obj[id] = val;
				});
				return obj;
			}
		});
		
		var noFooterTemplate = '<div class="file-thumbnail-footer">\n' +
			'</div>'; 		
		$(".image_upload_no_footer").fileinput({
			layoutTemplates: {footer: noFooterTemplate},
			dropZoneEnabled: false,
			showUpload: true,
			uploadAsync: true,
			uploadUrl: 'http://isiaha-samsung/cms/public/uploads/media/imgs/',
			uploadExtraData: function() {
				var obj = {};
				$('form').find('input').each(function() {
					var id = $(this).attr('id'), val = $(this).val();
					obj[id] = val;
				});
				return obj;
			}
		});
		
	});