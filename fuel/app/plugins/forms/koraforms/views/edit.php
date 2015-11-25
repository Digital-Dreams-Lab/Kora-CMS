<?php
	if ((bool) $edit_by_section_only===true):
	
		$collaspe_in = 'in';
		$csrf_token = Security::fetch_token();
		
		$control_label = array('class'=>'control-label'); 
		$form_control = array('class'=>'form-control'); 
		$form_control_disabled = array('class'=>'form-control', 'disabled'=>'disabled'); 
		$form_control_8 = array('class' => 'col-md-8 form-control', 'rows' => 8); 
		$form_control_16 = array('class' => 'col-md-8 form-control', 'rows' => 16);
			
			
		if (Input::get('form_id')):
			$data = Plugin\Forms\Koraforms::process_get(Input::get()); 	
			$get = (object) $data['get'];
		endif;
	endif;
		
	$s = $section;
	$s_id = $s->section_id->value; 
	
?>          

        <?php if ((bool) $edit_by_section_only===true): ?> 
            <div class="btn-toolbar" role="toolbar">
                <div class="btn-group">	
                    <button type="button" class="btn btn-default btn-sm toolselect" value="input">
                        <span class="fa fa-minus-square-o" aria-hidden="true"></span> Short text
                    </button>
                    <button type="button" class="btn btn-default btn-sm toolselect" value="textarea">
                        <span class="fa fa-plus-square-o" aria-hidden="true"></span> Long text
                    </button>
                </div>
                <div class="btn-group">	
                    <button type="button" class="btn btn-default btn-sm toolselect" value="checkbox">
                        <span class="fa fa-check-square-o" aria-hidden="true"></span> Check
                    </button>
                    <button type="button" class="btn btn-default btn-sm toolselect" value="radio">
                        <span class="fa fa-check-circle-o" aria-hidden="true"></span> Radio
                    </button>
                    <button type="button" class="btn btn-default btn-sm toolselect" value="select">
                        <span class="fa fa-list-ul" aria-hidden="true"></span> List
                    </button>
                </div>
                <div class="btn-group">
                    <button type="button" class="btn btn-default btn-sm toolselect" value="password">
                        <span class="fa fa-unlock" aria-hidden="true"></span> Password
                    </button>
                    <button type="button" class="btn btn-default btn-sm toolselect" value="email">
                        <span class="fa fa-envelope-o" aria-hidden="true"></span> Email
                    </button>
                    <button type="button" class="btn btn-default btn-sm toolselect" value="hidden">
                        <span class="fa fa-user-secret" aria-hidden="true"></span> Hidden
                    </button>
                </div>
                <div class="btn-group">
                    <button type="button" class="btn btn-default btn-sm toolselect" value="file">
                        <span class="fa fa-upload" aria-hidden="true"></span> File
                    </button>
                </div>
            </div>
                
            <div class="">
                <div class="view_input view_group">
                    <h3></h3>
                    <?php echo Form::open(array('class'=>'formsubmit_create_form')); ?> 
                     
                    <?php echo Form::hidden('page_id', 		$s->page_id->value, array()); ?>
                    <?php echo Form::hidden('plugin_id', 	$s->plugin_id->value, array()); ?>
                    <?php echo Form::hidden('section_id', 	$s->section_id->value, array()); ?>
                    <?php echo Form::hidden('user_id', 		$s->user_id->value, array()); ?>
                                                          
                    <!--------------INPUT ------------->
                    <?php echo Form::hidden('type', 'input', array()); ?>
                    <div class="form-group">
                        <?php echo Form::label('Enter name of field', 'label', $control_label); ?>
                        <?php echo Form::input('label', isset($get) ? $get->label: '', array('class'=>'form-control label-input', 'required'=>'required')); ?>  
                        <?php echo Form::hidden('field', '', array('class'=>'form-control label-format')); ?>            
                    </div>            
                    <div class="form-group">
                        <?php echo Form::label('Is this field required?', 'required', $control_label); ?>
                        <?php echo Form::select('required', isset($get) ? $get->required: '', array("No","Yes"), $form_control); ?>            
                    </div>                    
                    
                    <div class="form-group view_placeholder">
                        <?php echo Form::label('Add placeholder', 'placeholder', $control_label); ?>
                        <?php echo Form::input('placeholder', isset($get) ? $get->placeholder: '', $form_control); ?>            
                    </div> 
                                      
                    <div class="form-group view_class">
                        <?php echo Form::label('Add class', 'class', $control_label); ?>
                        <?php echo Form::input('class', isset($get) ? $get->class: '', $form_control); ?>            
                    </div>
                    
                    <div class="form-group">
                        <?php echo Form::submit('submit', 'Add input', array('class' => 'formsubmit_create_btn pull-right btn btn-primary')); ?>
                    </div>
                    <?php echo Form::close(); ?>

                    <div class="btn-toolbar" role="toolbar">                            
                        <div class="btn-group">
                            <button type="button" class="btn btn-default btn-sm attr_placeholder">
                                <span class="fa fa-thumb-tack" aria-hidden="true"></span> Add placeholder
                            </button>
                            <button type="button" class="btn btn-default btn-sm attr_class">
                                <span class="fa fa-css3" aria-hidden="true"></span> Add class
                            </button>
                        </div>
                    </div> 
                </div> 

                <div class="view_textarea view_group">
                    <h3></h3>
                    <?php echo Form::open(array('class'=>'formsubmit_create_form')); ?> 
                     
                    <?php echo Form::hidden('page_id', 		$s->page_id->value, array()); ?>
                    <?php echo Form::hidden('plugin_id', 	$s->plugin_id->value, array()); ?>
                    <?php echo Form::hidden('section_id', 	$s->section_id->value, array()); ?>
                    <?php echo Form::hidden('user_id', 		$s->user_id->value, array()); ?>
                                   
                    <!--------------TEXTAREA ------------->
                    <?php echo Form::hidden('type', 'textarea', array()); ?>
                    <div class="form-group">
                        <?php echo Form::label('Enter name of field', 'label', $control_label); ?>
                        <?php echo Form::input('label', isset($get) ? $get->label: '', array('class'=>'form-control label-input', 'required'=>'required')); ?>  
                        <?php echo Form::hidden('field', isset($get) ? $get->field: '', array('class'=>'form-control label-format')); ?>            
                    </div>            
                    <div class="form-group">
                        <?php echo Form::label('Is this field required?', 'required', $control_label); ?>
                        <?php echo Form::select('required', isset($get) ? $get->required: '', array("No","Yes"), $form_control); ?>            
                    </div>                  
                    
                    <div class="form-group view_placeholder">
                        <?php echo Form::label('Add placeholder', 'placeholder', $control_label); ?>
                        <?php echo Form::input('placeholder', isset($get) ? $get->placeholder: '', $form_control); ?>            
                    </div> 
                                                  
                    <div class="form-group view_class">
                        <?php echo Form::label('Add class', 'class', $control_label); ?>
                        <?php echo Form::input('class', isset($get) ? $get->class: '', $form_control); ?>            
                    </div>
                    
                    <div class="form-group">
                        <?php echo Form::submit('submit', 'Add input', array('class' => 'formsubmit_create_btn pull-right btn btn-primary')); ?>
                    </div>
                    <?php echo Form::close(); ?>

                    <div class="btn-toolbar" role="toolbar">                            
                        <div class="btn-group">
                            <button type="button" class="btn btn-default btn-sm attr_placeholder">
                                <span class="fa fa-thumb-tack" aria-hidden="true"></span> Add placeholder
                            </button>
                            <button type="button" class="btn btn-default btn-sm attr_class">
                                <span class="fa fa-css3" aria-hidden="true"></span> Add class
                            </button>
                        </div>
                    </div> 
                </div>
                

                <div class="view_file view_group">
                    <h3></h3>
                    <?php echo Form::open(array('class'=>'formsubmit_create_form')); ?> 
                     
                    <?php echo Form::hidden('page_id', 		$s->page_id->value, array()); ?>
                    <?php echo Form::hidden('plugin_id', 	$s->plugin_id->value, array()); ?>
                    <?php echo Form::hidden('section_id', 	$s->section_id->value, array()); ?>
                    <?php echo Form::hidden('user_id', 		$s->user_id->value, array()); ?>
                          
                    <!--------------File ------------->
                    <?php echo Form::hidden('type', 'file', array()); ?>
                    <div class="form-group">
                        <?php echo Form::label('Enter name of field', 'label', $control_label); ?>
                        <?php echo Form::input('label', isset($get) ? $get->label: '', array('class'=>'form-control label-input', 'required'=>'required')); ?>  
                        <?php echo Form::hidden('field', isset($get) ? $get->field: '', array('class'=>'form-control label-format')); ?>           
                    </div>            
                    <div class="form-group">
                        <?php echo Form::label('Is this field required?', 'required', $control_label); ?>
                        <?php echo Form::select('required', isset($get) ? $get->required: '', array("No","Yes"), $form_control); ?>          
                    </div> 
                                                  
                    <div class="form-group view_class">
                        <?php echo Form::label('Add class', 'class', $control_label); ?>
                        <?php echo Form::input('class', isset($get) ? $get->class: '', $form_control); ?>    
                    </div>
                    
                    <div class="form-group">
                        <?php echo Form::submit('submit', 'Add input', array('class' => 'formsubmit_create_btn pull-right btn btn-primary')); ?>
                    </div>
                    <?php echo Form::close(); ?>

                    <div class="btn-toolbar" role="toolbar">                            
                        <div class="btn-group">
                            <button type="button" class="btn btn-default btn-sm attr_class">
                                <span class="fa fa-css3" aria-hidden="true"></span> Add class
                            </button>
                        </div>
                    </div> 
                </div>
                
                <div class="view_email view_group">
                    <h3></h3>
                    <?php echo Form::open(array('class'=>'formsubmit_create_form')); ?> 
                     
                    <?php echo Form::hidden('page_id', 		$s->page_id->value, array()); ?>
                    <?php echo Form::hidden('plugin_id', 	$s->plugin_id->value, array()); ?>
                    <?php echo Form::hidden('section_id', 	$s->section_id->value, array()); ?>
                    <?php echo Form::hidden('user_id', 		$s->user_id->value, array()); ?>
                                       
                    <!--------------EMAIL ------------->
                    <?php echo Form::hidden('type', 'email', array()); ?>
                    <div class="form-group">
                        <?php echo Form::label('Enter name of field', 'label', $control_label); ?>
                        <?php echo Form::input('label', isset($get) ? $get->label: '', array('class'=>'form-control label-input', 'required'=>'required')); ?>  
                        <?php echo Form::hidden('field', isset($get) ? $get->field: '', array('class'=>'form-control label-format')); ?>         
                    </div>            
                    <div class="form-group">
                        <?php echo Form::label('Is this field required?', 'required', $control_label); ?>
                        <?php echo Form::select('required', isset($get) ? $get->required: '', array("No","Yes"), $form_control); ?>              
                    </div>
                    
                    <div class="form-group view_placeholder">
                        <?php echo Form::label('Add placeholder', 'placeholder', $control_label); ?>
                        <?php echo Form::input('placeholder', isset($get) ? $get->placeholder: '', $form_control); ?>  
                    </div>   
                                                  
                    <div class="form-group view_class">
                        <?php echo Form::label('Add class', 'class', $control_label); ?>
                        <?php echo Form::input('class', isset($get) ? $get->class: '', $form_control); ?>     
                    </div>
                    
                    <div class="form-group">
                        <?php echo Form::submit('submit', 'Add input', array('class' => 'formsubmit_create_btn pull-right btn btn-primary')); ?>
                    </div>
                    <?php echo Form::close(); ?> 

                    <div class="btn-toolbar" role="toolbar">                            
                        <div class="btn-group">
                            <button type="button" class="btn btn-default btn-sm attr_placeholder">
                                <span class="fa fa-thumb-tack" aria-hidden="true"></span> Add placeholder
                            </button>
                            <button type="button" class="btn btn-default btn-sm attr_class">
                                <span class="fa fa-css3" aria-hidden="true"></span> Add class
                            </button>
                        </div>
                    </div> 
                </div>

                <div class="view_password view_group">
                    <h3></h3>
                    <?php echo Form::open(array('class'=>'formsubmit_create_form')); ?> 
                     
                    <?php echo Form::hidden('page_id', 		$s->page_id->value, array()); ?>
                    <?php echo Form::hidden('plugin_id', 	$s->plugin_id->value, array()); ?>
                    <?php echo Form::hidden('section_id', 	$s->section_id->value, array()); ?>
                    <?php echo Form::hidden('user_id', 		$s->user_id->value, array()); ?>
                                  
                    <!--------------PASSWORD ------------->
                    <?php echo Form::hidden('type', 'password', array()); ?>
                    <div class="form-group">
                        <?php echo Form::label('Enter name of field', 'label', $control_label); ?>
                        <?php echo Form::input('label', isset($get) ? $get->label: '', array('class'=>'form-control label-input', 'required'=>'required')); ?>  
                        <?php echo Form::hidden('field', isset($get) ? $get->field: '', array('class'=>'form-control label-format')); ?>               
                    </div>            
                    <div class="form-group">
                        <?php echo Form::label('Is this field required?', 'required', $control_label); ?>
                        <?php echo Form::select('required', isset($get) ? $get->required: '', array("No","Yes"), $form_control); ?>            
                    </div>
                                                  
                    <div class="form-group view_class">
                        <?php echo Form::label('Add class', 'class', $control_label); ?>
                        <?php echo Form::input('class', isset($get) ? $get->class: '', $form_control); ?>            
                    </div>
                    
                    <div class="form-group">
                        <?php echo Form::submit('submit', 'Add input', array('class' => 'formsubmit_create_btn pull-right btn btn-primary')); ?>
                    </div>
                    <?php echo Form::close(); ?>  

                    <div class="btn-toolbar" role="toolbar">                            
                        <div class="btn-group">
                            <button type="button" class="btn btn-default btn-sm attr_class">
                                <span class="fa fa-css3" aria-hidden="true"></span> Add class
                            </button>
                        </div>
                    </div> 
                </div>

                <div class="view_select view_group"> 
                    <h3></h3>
                    <?php echo Form::open(array('class'=>'formsubmit_create_form')); ?> 
                     
                    <?php echo Form::hidden('page_id', 		$s->page_id->value, array()); ?>
                    <?php echo Form::hidden('plugin_id', 	$s->plugin_id->value, array()); ?>
                    <?php echo Form::hidden('section_id', 	$s->section_id->value, array()); ?>
                    <?php echo Form::hidden('user_id', 		$s->user_id->value, array()); ?>
                                    
                    <!--------------SELECT -------------> 
                    <?php echo Form::hidden('type', 'select', array()); ?>
                    <div class="form-group">
                        <?php echo Form::label('Enter name of field', 'label', $control_label); ?>
                        <?php echo Form::input('label', isset($get) ? $get->label: '', array('class'=>'form-control label-input', 'required'=>'required')); ?>  
                        <?php echo Form::hidden('field', isset($get) ? $get->field: '', array('class'=>'form-control label-format')); ?>                  
                    </div>                
                    <div class="form-group">                        	
                        <?php echo Form::label('Add lists to your form', '', $control_label); ?>
                        <div>
                            <a class='add_option btn-sm btn btn-primary'>Add option</a>
                            <a class='remove_option btn-sm btn btn-warning'>Remove option</a>
                        </div>
                    </div>
                    
                    <div class="view_option">
                        <?php if (isset($get->options)) : ?>
                        <?php $options = unserialize($get->options); ?>
                        <?php foreach ($options as $option) : ?>
                            <div class="form-group"><?php echo Form::input('options[]', $option, array('class'=>'form-control')); ?></div>
                        <?php endforeach; ?>
                        <?php endif; ?>
                        <div class="form-group"><?php echo Form::input('options[]', '', array('class'=>'form-control')); ?></div>
                    </div>
                                        
                    <div class="form-group view_class">
                        <?php echo Form::label('Add class', 'class', $control_label); ?>
                        <?php echo Form::input('class', isset($get) ? $get->class: '', $form_control); ?>            
                    </div>
                    
                    <div class="form-group">
                        <?php echo Form::submit('submit', 'Add input', array('class' => 'formsubmit_create_btn pull-right btn btn-primary')); ?>
                    </div>
                    <?php echo Form::close(); ?>

                    <div class="btn-toolbar" role="toolbar">                            
                        <div class="btn-group">
                            <button type="button" class="btn btn-default btn-sm attr_class">
                                <span class="fa fa-css3" aria-hidden="true"></span> Add class
                            </button>
                        </div>
                    </div> 
                </div>

                <div class="view_checkbox view_group">
                    <h3></h3>
                    <?php echo Form::open(array('class'=>'formsubmit_create_form')); ?>
                     
                    <?php echo Form::hidden('page_id', 		$s->page_id->value, array()); ?>
                    <?php echo Form::hidden('plugin_id', 	$s->plugin_id->value, array()); ?>
                    <?php echo Form::hidden('section_id', 	$s->section_id->value, array()); ?>
                    <?php echo Form::hidden('user_id', 		$s->user_id->value, array()); ?>
                                    
                    <!--------------CHECKBOX -------------> 
                    <?php echo Form::hidden('type', 'checkbox', array()); ?>
                    <div class="form-group">
                        <?php echo Form::label('Enter name of field', 'label', $control_label); ?>
                        <?php echo Form::input('label', isset($get) ? $get->label: '', array('class'=>'form-control label-input', 'required'=>'required')); ?>  
                        <?php echo Form::hidden('field', isset($get) ? $get->field: '', array('class'=>'form-control label-format')); ?>                  
                    </div>                
                    <div class="form-group">                        	
                        <?php echo Form::label('Add check boxes to your form', '', $control_label); ?>
                        <div>
                            <a class='add_option btn-sm btn btn-primary'>Add option</a>
                            <a class='remove_option btn-sm btn btn-warning'>Remove option</a>
                        </div>
                    </div>
                    
                    <div class="view_option">
                        <?php if (isset($get->options)) : ?>
                        <?php $options = unserialize($get->options); ?>
                        <?php foreach ($options as $option) : ?>
                            <div class="form-group"><?php echo Form::input('options[]', $option, array('class'=>'form-control')); ?></div>
                        <?php endforeach; ?>
                        <?php endif; ?>
                        <div class="form-group"><?php echo Form::input('options[]', '', array('class'=>'form-control')); ?></div>
                    </div> 
                                                  
                    <div class="form-group view_class">
                        <?php echo Form::label('Add class', 'class', $control_label); ?>
                        <?php echo Form::input('class', isset($get) ? $get->value: '', $form_control); ?>            
                    </div>
                    
                    <div class="form-group">
                        <?php echo Form::submit('submit', 'Add input', array('class' => 'formsubmit_create_btn pull-right btn btn-primary')); ?>
                    </div>
                    <?php echo Form::close(); ?>

                    <div class="btn-toolbar" role="toolbar">                            
                        <div class="btn-group">
                            <button type="button" class="btn btn-default btn-sm attr_class">
                                <span class="fa fa-css3" aria-hidden="true"></span> Add class
                            </button>
                        </div>
                    </div> 
                </div>

                <div class="view_group view_radio">
                    <h3></h3>
                    <?php echo Form::open(array('class'=>'formsubmit_create_form')); ?> 
                     
                    <?php echo Form::hidden('page_id', 		$s->page_id->value, array()); ?>
                    <?php echo Form::hidden('plugin_id', 	$s->plugin_id->value, array()); ?>
                    <?php echo Form::hidden('section_id', 	$s->section_id->value, array()); ?>
                    <?php echo Form::hidden('user_id', 		$s->user_id->value, array()); ?>
                                   
                    <!--------------RADIO -------------> 
                    <?php echo Form::hidden('type', 'radio', array()); ?>
                    <div class="form-group">
                        <?php echo Form::label('Enter name of field', 'label', $control_label); ?>
                        <?php echo Form::input('label', isset($get) ? $get->label: '', array('class'=>'form-control label-input', 'required'=>'required')); ?>  
                        <?php echo Form::hidden('field', isset($get) ? $get->field: '', array('class'=>'form-control label-format')); ?>                
                    </div>                
                    <div class="form-group">                        	
                        <?php echo Form::label('Add radio buttons to your form', '', $control_label); ?>
                        <div>
                            <a class='add_option btn-sm btn btn-primary'>Add option</a>
                            <a class='remove_option btn-sm btn btn-warning'>Remove option</a>
                        </div>
                    </div>
                    
                    <div class="view_option">
                        <?php if (isset($get->options)) : ?>
                        <?php $options = unserialize($get->options); ?>
                        <?php foreach ($options as $option) : ?>
                            <div class="form-group"><?php echo Form::input('options[]', $option, array('class'=>'form-control')); ?></div>
                        <?php endforeach; ?>
                        <?php endif; ?>
                        <div class="form-group"><?php echo Form::input('options[]', '', array('class'=>'form-control')); ?></div>
                    </div> 
                                                  
                    <div class="form-group view_class">
                        <?php echo Form::label('Add class', 'class', $control_label); ?>
                        <?php echo Form::input('class', isset($get) ? $get->class: '', $form_control); ?>            
                    </div>
                    
                    <div class="form-group">
                        <?php echo Form::submit('submit', 'Add input', array('class' => 'formsubmit_create_btn pull-right btn btn-primary')); ?>
                    </div>
                    <?php echo Form::close(); ?>

                <div class="btn-toolbar" role="toolbar">                            
                    <div class="btn-group">
                        <button type="button" class="btn btn-default btn-sm attr_class">
                            <span class="fa fa-css3" aria-hidden="true"></span> Add class
                        </button>
                    </div>
                </div> 
                </div>

                <div class="view_group view_hidden">
                    <h3></h3>
                    <?php echo Form::open(array('class'=>'formsubmit_create_form')); ?>
                     
                    <?php echo Form::hidden('page_id', 		$s->page_id->value, array()); ?>
                    <?php echo Form::hidden('plugin_id', 	$s->plugin_id->value, array()); ?>
                    <?php echo Form::hidden('section_id', 	$s->section_id->value, array()); ?>
                    <?php echo Form::hidden('user_id', 		$s->user_id->value, array()); ?>
                                     
                    <!--------------HIDDEN -------------> 
                    <?php echo Form::hidden('type', 'hidden', array()); ?>
                    <div class="form-group">
                        <?php echo Form::label('Enter name of field', 'label', $control_label); ?>
                        <?php echo Form::input('label', isset($get) ? $get->label: '', array('class'=>'form-control label-input', 'required'=>'required')); ?>  
                        <?php echo Form::hidden('field', isset($get) ? $get->field: '', array('class'=>'form-control label-format')); ?>                
                    </div>
                    <div class="form-group">
                        <?php echo Form::label('Enter hidden value', 'value', $control_label); ?>
                        <?php echo Form::input('value', isset($get) ? $get->value: '', array('class'=>'form-control')); ?>          
                    </div> 
                    
                    <div class="form-group">
                        <?php echo Form::submit('submit', 'Add input', array('class' => 'formsubmit_create_btn pull-right btn btn-primary')); ?>
                    </div>
                    <?php echo Form::close(); ?>
                </div>
            </div> 
                   
    		<div class="panel-heading" role="tab" id="heading">  
                 <p class="panel-title">
                 	<i class="fa fa-list-alt"></i>
                	<a role="button" data-toggle="collapse" data-parent="" href="#formlist_table_<?=$s_id?>" aria-expanded="true" aria-controls="formlist_table_<?=$s_id?>">View form items</a>
                </p>
            </div>    
			
            <div id="formlist_table_<?=$s_id?>" class="panel-collapse collapse <?=$collaspe_in?>" role="tabpanel" aria-labelledby="heading">
                <div class="panel-body">
	                <h5></h5>
    	            <div id="formsubmit_list"></div>
                </div>
            </div> 
        <?php else: ?> 
                <!-- Button trigger form section -->
                <a class="btn btn-default btn-block" href="<?php echo Uri::base(false).'admin/pages/edit/'.$s->page_id->value.'/'.$s->section_id->value; ?>"><i class="fa fa-edit"></i> Edit form</a>   
        <?php endif; ?>
  
<?php if ((bool) $edit_by_section_only===true): ?> 

<script>
$(document).ready(function(){

	$('.label-input').on('keyup focus change blur', function() {
		var label_format = $(this).val();
		label_format = label_format.toLowerCase().replace(/ /g, '_');
		$('.label-format').val(label_format);
	});
	$(".view_group").hide();
	$(".view_table").hide();
	
	<?php if (Input::get('form_id')): echo $data['script']; endif; ?>
	
	$(".hideall").click(function(){
		$(".view_group").hide();
		$(".toolselect").removeClass("active");		
	});	
	
	$('.toolselect').click(function(){
		var var_type = $(this).val();
		$(".view_group").hide();
		$(".toolselect").removeClass("active btn-primary");					
		$(this).addClass("active btn-primary");
		$('.view_'+var_type).show();
	});
	
	var option_input = '<div class="form-group"><input name="options[]" class="form-control added-option"></div>';
	
	$(".add_option").click(function(){
		$(".view_option").append(option_input);			
	});
	$(".remove_option").click(function(){
		$(".view_option div:last-child").remove();
	});
	$(".view_placeholder").hide();
	$(".view_class").hide();
	
	$('.attr_placeholder').click(function(){
		$(".view_placeholder").toggle();
	});
	
	$('.attr_class').click(function(){
		$(".view_class").toggle();
	});
	
	$(".success_fade").fadeOut("slow", function() {
		$(this).removeClass("success");
	});
});							
</script>


<script>
$(document).ready(function(){			

	var current_token = '<?php echo $csrf_token; ?>';
	var formsubmit_create_url = "<?php echo Uri::base(false); ?>admin/rest/forms/create.json";
	var formsubmit_edit_url = "<?php echo Uri::base(false); ?>admin/rest/forms/edit.json";
	var formsubmit_init_url = "<?php echo Uri::base(false); ?>admin/rest/forms/list.json";
	
	formSubmitAjaxInit();
	// Propagate the page
	function formSubmitPropagator(data) {	
		$('#formsubmit_list').html(data.form_list);		
	}
	// Propagate the page
	function formSubmitResetter() {		
		$(".view_group").hide();
		$(".toolselect").removeClass("active");	
		$(".view_placeholder").hide();
		$(".view_class").hide();
		$(".view_option").html('');	
		$(".label-input").val('');	
		$(".label-value").val('');	
		$("input[name='label']").val('');	
		$("input[name='class']").val('');	
		$("input[name='placeholder']").val('');		
	}

	// Output response
	function formSubmitResponder(response, alert_class) {
		$('#response').html('<div class="alert alert-' + alert_class + '" role="alert">' + response + '<div>');
	}
	// Console log	
	function formSubmitDebugger(data) {	
		console.log(data);
	}
	// Set spinner
	function formSubmitSpinner(obj_id, action) {
		if (action === true) {			
			$(obj_id).addClass('fa-spin');
		} else {
			$(obj_id).removeClass('fa-spin');
		}
	}

	function formSubmitAjaxInit() {
		var obj = {};
		obj.section_id = <?php echo $s_id; ?>;
		console.log(obj);
		$.ajax({
			type: "POST",
			dataType: "json",
			url: formsubmit_init_url,
			data: obj,
			beforeSend: function(){
				formSubmitSpinner('#formsubmit_spinner',true);	
			},									   
			success: function(data){				
				formSubmitPropagator(data);
				formSubmitSpinner('#formsubmit_spinner',false);	
				formSubmitDebugger(data);	
			},				
			error: function(response) {
				formSubmitResponder(response, 'error');
				formSubmitSpinner('#formsubmit_spinner',false);	
				formSubmitDebugger(response);
			}						   
		});
	}

	function formSubmitAjaxPOST(obj, url) {
		$.ajax({
			type: "POST",
			dataType: "json",
			url: url,
			data: obj,			
			beforeSend: function(){
				formSubmitSpinner('#formsubmit_spinner',true);	
			},									   
			success: function(data){				
				formSubmitPropagator(data);
				formSubmitResetter();		
				formSubmitSpinner('#formsubmit_spinner',false);	
				formSubmitDebugger(data);	
			},				
			error: function(response) {
				formSubmitResponder(response, 'error');
				formSubmitSpinner('#formsubmit_spinner',false);	
				formSubmitDebugger(response);
			}						   
		});
	}

	$(".formsubmit_create_btn").click(function( event ) {
		$this = $(this).closest('form.formsubmit_create_form');
		$($this).submit(function( event ) {
			event.preventDefault();
			var obj = $(this).serialize();
			formSubmitAjaxPOST(obj, formsubmit_create_url);
		});
	});

	$(".formsubmit_edit_btn").click(function( event ) {
		$this = $(this).closest('form.formsubmit_edit_form'); 
		$($this).submit(function( event ) {
			event.preventDefault();
			var obj = $(this).serialize();
			formSubmitAjaxPOST(obj, formsubmit_edit_url);
		});
	});
	
	
	
});

</script>
<?php endif; ?> 