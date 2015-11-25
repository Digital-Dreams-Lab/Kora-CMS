
<table class="table">
	<thead>
    	<tr>
        	<th>Column</th>
        	<th>Data</th>
        </tr>
    </thead>
	<tbody>
    	<?php Config::load('pages'); $view_page = Config::get('form.view'); ?>
    	<?php foreach ($view_page as $item) : ?>
        <tr>
            <td><em><?php echo Inflector::humanize($item); ?>:</em></td>
            <td><?php echo isset($page->$item)?$page->$item:'';?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
