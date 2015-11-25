<form class="form_page_edit" method="post">
    <input type="hidden" name="<?php echo $section->section_id->name; ?>" value="<?php echo $section->section_id->value; ?>"  />
    <input type="hidden" name="<?php echo $section->user_id->name; ?>" value="<?php echo $section->user_id->value; ?>"  />
    <textarea id="<?=$plugin['ele_id']?>" name="<?php echo $section->content->name; ?>" class="editor_wysihtml5 form-control"><?php echo $section->content->value; ?></textarea>
	<input type="hidden" data-attach-id="<?=$plugin['ele_id']?>" id="attach_id_<?=$plugin['ele_id']?>" />
</form>

<?php Plugin\Registry::set_scripts($plugin['ele_id'], "$('#".$plugin['ele_id']."').wysihtml5({'stylesheets':['".Uri::base(false)."assets/css/bootstrap3-wysiwyg5-color.css'],'html':true});"); ?>
