    <form class="form_page_edit" method="post">
        
        <?php echo 	Form::hidden('page[id]', 
                    Input::post('page[id]', isset($page) ? $page->id : '')); ?>  
        <?php echo 	Form::hidden('page[slug]', 
                    Input::post('page[slug]', isset($page) ? $page->slug : ''), 
                    array('id'=>'slug')); ?>  
        
        <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="heading_page">
            
                <h4 class="panel-title">
                	<i class="fa fa-file-text-o"></i>   
                    <a role="button" data-toggle="collapse" data-parent="#accordion_page" href="#collapse_page" aria-expanded="true" aria-controls="collapse_page">Page details</a>
                    <small>Page ID #<?php echo isset($page) ? $page->id : ''; ?></small>  
                    <!--<a href="<?php echo Uri::base(false).'admin/pages/settings/'.$page->id; ?>" class="pull-right" data-toggle="tooltip" data-placement="top" title="" data-original-title="Click here to edit page settings."><i class="fa fa-cog fa-fw"></i></a>-->
                </h4> 
                                   
            </div>
            
            <div class="panel-body">

                <button class="btn btn-warning btn-block" type="submit">
                    <i id="spinner_page" class="fa fa-floppy-o"></i> Update page
                </button>
                <br />
                <small class="text-muted text-center">
                    Lasted updated: <?php echo date("d/m/Y g:ia",$page->updated_at); ?><br />
                    By <?php echo $current_user->username; ?> <a role="button" data-toggle="collapse" data-parent="#accordion_page" href="#collapse_page" aria-expanded="true" aria-controls="collapse_page">Edit page details</a>
                </small>
                
                <div id="collapse_page" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading_page">
                    <hr />


                    <div class="form-group">
                        <?php echo 	Form::label('Menu title', 'menu_title', array('class'=>'control-label')); ?>
                        <?php echo	Form::input('page[menu_title]', 
                                    Input::post('page[menu_title]', 
                                    isset($page) ? $page->menu_title : ''),
                                    array('class' => 'form-control')); ?>
                    </div>
              
                    <div class="form-group">
                        <?php echo 	Form::label('Menu', 'menu_id', array('class'=>'control-label')); ?>
                        <?php echo	Form::select('page[menu_id]', 
                                    Input::post('page[menu_id]', 
                                    isset($page) ? $page->menu_id : ''),
                                    $menus,	array('class' => 'form-control')); ?>
                    </div>
              
                    <div class="form-group">
                        <?php echo 	Form::label('Parent', 'parent_id', array('class'=>'control-label')); ?>
                        <?php echo	Form::select('page[parent_id]', 
                                    Input::post('page[parent_id]', 
                                    isset($page) ? $page->parent_id : ''), 
                                    $parents, array('class' => 'form-control')); ?>
                    </div>
                                   
                    <div class="form-group">
                        <?php echo 	Form::label('Status', 'status', array('class'=>'control-label')); ?>
                        <?php echo 	Form::select('page[status]', 
                                    Input::post('page[status]', isset($page) ? $page->status : ''), 
                                    $select_options['status'], array('class' => 'form-control toggle_datepicker', 'placeholder'=>'Status')); ?>
                    </div> 

                    <div id="show_calendar_start" class="form-group show_datepicker">
                        <div class='input-group date' id='datetimepicker_start_at'>
                            <input 	type='text' 
                            		name="page[start_at]"
                                    class="form-control" />
                                    
                            <span class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </span>
                        </div>
                    </div>
            
                    <div id="show_calendar_end" class="form-group show_datepicker">
                        <div class='input-group date' id='datetimepicker_end_at'>
                            <input type='text' name="page[end_at]" class="form-control" />
                            <span class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </span>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <?php echo 	Form::label('Visibility', 'visibility', array('class'=>'control-label')); ?>
                        <?php echo 	Form::select('page[visibility]', 
                                    Input::post('page[visibility]', isset($page) ? $page->visibility : ''), 
                                    $select_options['visibility'], array('class' => 'form-control', 'placeholder'=>'Status', 'id'=>'visibility')); ?>
                    </div>
					<?php  echo Form::hidden('page[groups][]', '1'); ?> 
                    <div id="show_groups">
                        <label>Groups</label>
                        <?php foreach ($groups as $key => $value): ?>
                        <div class="checkbox">
                            <label>
                            	<input name="page[groups][]" type="checkbox" value="<?php echo $key ?>"<?php echo (isset($saved_groups[$key])) ? ' checked': ''; ?><?php echo ($key=='1') ? ' disabled': ' class="clear_groups"'; ?> /><?php echo $value ?>
                            </label>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <?php  echo Form::hidden('page[users][]', '1'); ?> 
                    <div id="show_users">
                    <?php foreach ($user_groups as $group_id => $user) : ?>
                        <label><a href="javascript:void(0)" data-user-group="<?=$group_id?>" class="toggle_user_group"><?php echo $groups[$group_id]; ?></a></label><br />
                
                        <?php foreach ($user as $key => $value): ?>
                        <div class="checkbox show_user_group show_user_group_<?=$group_id?>">
                            <label>
                            	<input name="page[users][]" type="checkbox" value="<?php echo $key ?>"<?php echo (isset($saved_users[$key])) ? ' checked': ''; ?><?php echo ($key=='1') ? '  disabled': ' class="clear_users"'; ?> /><?php echo $value ?>
                            </label>
                        </div>
                        <?php endforeach; ?>
                   <?php endforeach; ?>
                    </div>
                    
                    <div class="form-group">
                        <?php echo 	Form::label('Order', 'order', array('class'=>'control-label')); ?>
                        <?php echo 	Form::input('page[order]', 
                                    Input::post('page[order]', isset($page) ? $page->order : ''), 
                                    array( 'class' => 'form-control input-sm pull-right', 'style'=>'width:60px', 'placeholder'=>'Order')); ?>
                    </div>
                    
                    <div class="form-group">
                        <?php echo Form::label('Active', 'cative', array('class'=>'control-label')); ?>
                        <div class="btn-group pull-right btn-toggle" data-toggle="buttons">
                            <label class="btn btn-sm btn-default btn-no<?php echo ($page->active==='0') ? ' active': ''; ?>">
                                <input type="radio" name="page[active]" id="active_no" value="0"<?php echo ($page->active==='0') ? ' checked': ''; ?>>
                            No </label>
                            <label class="btn btn-sm btn-default btn-yes<?php echo ($page->active==='1') ? ' active': ''; ?>">
                                <input type="radio" name="page[active]" id="active_yes" value="1"<?php echo ($page->active==='1') ? ' checked': ''; ?>>
                            Yes </label>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <?php echo Form::label('Home page', 'home_page', array('class'=>'control-label')); ?>
                        <div class="btn-group pull-right btn-toggle" data-toggle="buttons">
                            <label class="btn btn-sm btn-default btn-no<?php echo ($page->home_page==='0') ? ' active': ''; ?>">
                            <input type="radio" name="page[home_page]" id="home_page_no" value="0"<?php echo ($page->home_page==='0') ? ' checked': ''; ?>>
                            No </label>
                            <label class="btn btn-sm btn-default btn-yes<?php echo ($page->home_page==='1') ? ' active': ''; ?>">
                            <input type="radio" name="page[home_page]" id="home_page_yes" value="1"<?php echo ($page->home_page==='1') ? ' checked': ''; ?>>
                            Yes </label>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <?php echo Form::label('Single page', 'single_page', array('class'=>'control-label')); ?>
                        <div class="btn-group pull-right btn-toggle" data-toggle="buttons">
                            <label class="btn btn-sm btn-default btn-no<?php echo ($page->home_page==='0') ? ' active': ''; ?>">
                            <input type="radio" name="page[single_page]" id="single_page_no" value="0"<?php echo ($page->single_page==='0') ? ' checked': ''; ?>>
                            No </label>
                            <label class="btn btn-sm btn-default btn-yes<?php echo ($page->home_page==='1') ? ' active': ''; ?>">
                            <input type="radio" name="page[single_page]" id="single_page_yes" value="1"<?php echo ($page->single_page==='1') ? ' checked': ''; ?>>
                            Yes </label>
                        </div>
                    </div>
        
                    <div class="form-group">
                        <?php echo 	Form::label('Page title', 'meta_title', array('class'=>'control-label')); ?>
                        <?php echo 	Form::input('page[meta_title]', 
                                    Input::post('page[meta_title]', isset($page) ? $page->meta_title : ''), 
                                    array('class' => 'form-control', 'placeholder'=>'Meta title')); ?>
                    </div>
        
                    <div class="form-group">
                        <?php echo 	Form::label('Page description', 'meta_description', array('class'=>'control-label')); ?>
                        <?php echo 	Form::textarea('page[meta_description]', 
                                    Input::post('page[meta_description]', isset($page) ? $page->meta_description : ''), 
                                    array('class' => 'form-control', 'rows' => 4, 'placeholder'=>'Meta description')); ?>
                    </div>
                </div>
            </div>
        </div>
    </form> 
 
    <br />

	<script type="text/javascript">
        $(function () {
            $('#datetimepicker_start_at').datetimepicker({
            	<?php echo Input::post('page[start_at]', !empty($page->start_at) ? 'defaultDate: "'.date("m/d/Y h:i A", $page->start_at).'"': ''); ?>
			});
            $('#datetimepicker_end_at').datetimepicker({
            	<?php echo Input::post('page[end_at]', !empty($page->end_at) ? 'defaultDate: "'.date("m/d/Y h:i A", $page->end_at).'",': ''); ?>
                useCurrent: false //Important! See issue #1075
            });
            $("#datetimepicker_start_at").on("dp.change", function (e) {
                $('#datetimepicker_end_at').data("DateTimePicker").minDate(e.date);
            });
            $("#datetimepicker_end_at").on("dp.change", function (e) {
                $('#datetimepicker_start_at').data("DateTimePicker").maxDate(e.date);
            });
        });
		
		$("#toggle_full_col").on('click', function (){
						
			if ($(".col_toggle_details").hasClass('col-md-3')==true) {
				$(".col_toggle_sections").addClass('col-md-12').removeClass('col-md-9');
				$(".col_toggle_details").addClass('col-md-12').removeClass('col-md-3');
			} else {
				$(".col_toggle_sections").addClass('col-md-9').removeClass('col-md-12');
				$(".col_toggle_details").addClass('col-md-3').removeClass('col-md-12');	
			}
			
		});

		
		$('.show_datepicker').hide();
		$(".toggle_datepicker").change(function() {
    		var val = $(this).val();
		    if(val === '2') {
				$('.show_datepicker').show();	
			}
			else {
				$('.show_datepicker').hide();
			}	
		});		
  
		$('#show_groups').hide();
		$('#show_users').hide();
		$('.show_user_group').hide();

		$('.toggle_user_group').click(function() {
			var user_id = $(this).data('user-group');
			console.log(user_id);
			$('.show_user_group_'+user_id).toggle();		
		});
		
		$('#visibility').on('change', function() {
			var vid = $(this).find("option:selected").val();
			
			if (vid==='1') {
				$('#show_groups').show();
			} else {
				$('#show_groups').hide();
			}
			if (vid==='2') {
				$('#show_users').show();
			} else {
				$('#show_users').hide();
			}
			if (vid==='2') {
				$('#show_users').show();
			} else {
				$('#show_users').hide();
			}
		});
		
	</script>