<?php 
	$s = $section;
	$s_id = $s->section_id->value; 
	$s_url = URI::base(false).'admin/pages/edit/'.$s->page_id->value.'/'.$s_id;
	$settings_url = URI::base(false).'admin/pages/settings/'.$s->page_id->value.'/'.$s_id;
?>

<form class="form_page_settings" method="post">
<input type="hidden" name="<?php echo $s->section_id->name; ?>" value="<?php echo $s->section_id->value; ?>"  />
<input type="hidden" name="<?php echo $s->user_id->name; ?>" value="<?php echo $s->user_id->value; ?>"  />

<div class="panel panel-default">
    <div class="panel-heading" role="tab" id="heading<?=$s_id?>">
        <h4 class="panel-title">
	        <a href="<?=$s_url?>" data-toggle="tooltip" data-placement="top" title="Click here to edit this section only."><i class="fa fa-edit"></i></a>

            <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse<?=$s_id?>" aria-expanded="true" aria-controls="collapse<?=$s_id?>">Editor</a>
            <small>Section ID #<?=$s_id?></small>
                        
            <a class="pull-right" href="<?=$settings_url?>" data-toggle="tooltip" data-placement="top" title="Click here to edit section settings."><i class="fa fa-cog"></i></a>
        </h4>        
    </div>
    <div id="collapse<?=$s_id?>" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="heading<?=$s_id?>">
        <div class="panel-body">
        	<h3>Editor settings</h3>
        	<hr />
            <textarea id="editor_settings_<?=$s_id?>" name="<?php echo $s->settings->name; ?>" class="form-control"><?php echo $s->settings->value; ?></textarea>
        </div>
    </div>
</div>
</form>
<br />
