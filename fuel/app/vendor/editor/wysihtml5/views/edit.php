<?php $s = $section; $s_id = $s->section_id->value; ?>

<form class="form_page_edit" method="post">
    <input type="hidden" name="<?php echo $s->section_id->name; ?>" value="<?php echo $s->section_id->value; ?>"  />
    <input type="hidden" name="<?php echo $s->user_id->name; ?>" value="<?php echo $s->user_id->value; ?>"  />
    <textarea id="editor_wysihtml5_<?=$s_id?>" name="<?php echo $s->content->name; ?>" class="editor_wysihtml5 form-control"><?php echo $s->content->value; ?></textarea>
</form>

<?php Plugin\Registry::set_scripts('editor_wysihtml5_'.$s_id, "$('#editor_wysihtml5_".$s_id."').wysihtml5({'stylesheets':['".Uri::base(false)."assets/css/bootstrap3-wysiwyg5-color.css'],'html':true});"); ?>
