<div class="form-group">
	<div id="toolbar_<?=$plugin['ele_id']?>" class="wysihtml5-toolbar">
	<!-- Font text format -->
    <div class="btn-group">
        <a class="btn btn-sm btn-default dropdown-toggle" data-toggle="dropdown">
            <i class="fa fa-font"></i> Normal text
            <span class="caret"></span>
        </a>
        <ul class="dropdown-menu" role="menu">
            <li>
            <a data-wysihtml5-command="formatBlock" data-wysihtml5-command-value="" tabindex="-1" href="javascript:void(0);" unselectable="on" class="wysihtml5-command-active">Normal text</a>
            </li>
            <li>
            <a data-wysihtml5-command="formatBlock" data-wysihtml5-command-value="h1" tabindex="-1" href="javascript:void(0);" unselectable="on">Heading 1</a>
            </li>
            <li>
            <a data-wysihtml5-command="formatBlock" data-wysihtml5-command-value="h2" tabindex="-1" href="javascript:void(0);" unselectable="on">Heading 2</a>
            </li>
            <li>
            <a data-wysihtml5-command="formatBlock" data-wysihtml5-command-value="h3" tabindex="-1" href="javascript:void(0);" unselectable="on">Heading 3</a>
            </li>
            <li>
            <a data-wysihtml5-command="formatBlock" data-wysihtml5-command-value="h4" href="javascript:void(0);" unselectable="on">Heading 4</a>
            </li>
            <li>
            <a data-wysihtml5-command="formatBlock" data-wysihtml5-command-value="h5" href="javascript:void(0);" unselectable="on">Heading 5</a>
            </li>
            <li>
            <a data-wysihtml5-command="formatBlock" data-wysihtml5-command-value="h6" href="javascript:void(0);" unselectable="on">Heading 6</a>
            </li>
        </ul>
    </div>
	<div class="btn-group">
            <a class="btn btn- btn-sm btn-default" data-wysihtml5-command="alignObject" data-wysihtml5-command-value="span:wysiwyg-text-align-left" title="Align Left" tabindex="-1" href="javascript:void(0);" unselectable="on"><i class="fa fa-align-left"></i></a>
            <a class="btn btn- btn-sm btn-default" data-wysihtml5-command="alignObject" data-wysihtml5-command-value="span:wysiwyg-text-align-center" title="Algin Center" tabindex="-1" href="javascript:void(0);" unselectable="on"><i class="fa fa-align-center"></i></a>
            <a class="btn btn- btn-sm btn-default" data-wysihtml5-command="alignObject" data-wysihtml5-command-value="span:wysiwyg-text-align-right" title="Align Right" tabindex="-1" href="javascript:void(0);" unselectable="on"><i class="fa fa-align-right"></i></a>
	</div>

    <div class="btn-group">
        <a class="btn btn- btn-sm btn-default" data-wysihtml5-command="bold" title="CTRL+B" tabindex="-1" href="javascript:void(0);" unselectable="on">Bold</a>
        <a class="btn btn- btn-sm btn-default" data-wysihtml5-command="italic" title="CTRL+I" tabindex="-1" href="javascript:void(0);" unselectable="on">Italic</a>
        <a class="btn btn- btn-sm btn-default" data-wysihtml5-command="underline" title="CTRL+U" tabindex="-1" href="javascript:void(0);" unselectable="on">Underline</a>
    </div>

	<div class="btn-group">
        <a class="btn btn- btn-sm btn-default" data-wysihtml5-command="insertUnorderedList" title="Unordered list" tabindex="-1" href="javascript:void(0);" unselectable="on"><i class="fa fa-list"></i></a>
        <a class="btn btn- btn-sm btn-default" data-wysihtml5-command="insertOrderedList" title="Ordered list" tabindex="-1" href="javascript:void(0);" unselectable="on"><i class="fa fa-th-list"></i></a>
        <a class="btn btn- btn-sm btn-default" data-wysihtml5-command="Outdent" title="Outdent" tabindex="-1" href="javascript:void(0);" unselectable="on"><i class="fa fa-outdent"></i></a>
        <a class="btn btn- btn-sm btn-default" data-wysihtml5-command="Indent" title="Indent" tabindex="-1" href="javascript:void(0);" unselectable="on"><i class="fa fa-indent"></i></a>
    </div>

    <div class="btn-group">
    	<a class="btn btn- btn-sm btn-default" data-wysihtml5-action="change_view" title="Edit HTML" tabindex="-1" href="javascript:void(0);" unselectable="on"><i class="fa fa-code"></i></a>
    </div>

    <div class="btn-group">
        <div class="bootstrap-wysihtml5-insert-link-modal modal fade"><div class="modal-dialog"><div class="modal-content"><div class="modal-header">
        <a class="close" data-dismiss="modal">×</a><h4>Insert link</h4></div><div class="modal-body"><input value="http://" class="bootstrap-wysihtml5-insert-link-url form-control"><label class="checkbox"> <input type="checkbox" class="bootstrap-wysihtml5-insert-link-target" checked="">Open link in new window</label></div><div class="modal-footer"><button class="btn btn-default" data-dismiss="modal">Cancel</button><button href="#" class="btn btn-primary" data-dismiss="modal">Insert link</button></div></div></div></div>
    </div>

    <div class="btn-group">
		<a class="btn btn- btn-sm btn-default" data-wysihtml5-command="createLink" title="Insert link" tabindex="-1" href="javascript:void(0);" unselectable="on"><i class="fa fa-link"></i></a>
    </div>

    <div class="btn-group">
		<a class="btn btn- btn-sm btn-default" title="Insert image" tabindex="-1" data-toggle="modal" data-target="#media-modal"><i class="fa fa-picture-o"></i></a>
    </div>

	</div>
</div>

<div class="form-group">
<form class="form_page_edit" method="post">
    <input type="hidden" name="<?php echo $section->section_id->name; ?>" value="<?php echo $section->section_id->value; ?>"  />
    <input type="hidden" name="<?php echo $section->user_id->name; ?>" value="<?php echo $section->user_id->value; ?>"  />
    <textarea id="<?=$plugin['ele_id']?>" name="<?php echo $section->content->name; ?>" class="editor_wysihtml5 form-control"><?php echo $section->content->value; ?></textarea>
</form>
</div>
<?php Plugin\Registry::set_scripts($plugin['ele_id'], "var ".$plugin['ele_id']." = new wysihtml5.Editor('".$plugin['ele_id']."',{toolbar:'toolbar_".$plugin['ele_id']."',parserRules:wysihtml5ParserRules});"); ?>
