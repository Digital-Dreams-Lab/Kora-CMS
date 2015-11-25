<?php Config::load('plugins'); $select_options = Config::get('forms.select_options'); ?>
<table class="table">
	<thead>
    	<tr>
        	<th>Column</th>
        	<th>Data</th>
        </tr>
    </thead>
	<tbody>
        <tr>
            <td><em>Active:</em></td>
            <td><span class="label label-<?php echo ($plugin->active==1)? 'success': 'danger'; ?>"><?php echo ($plugin->active==1)? 'Yes': 'no'; ?></span></td>
        </tr>
        <tr>
            <td><em>Status:</em></td>
            <td><?php echo $select_options['status'][$plugin->status]; ?></td>
        </tr>
        <tr>
            <td><em>Type:</em></td>
            <td><?php echo $select_options['type'][$plugin->type]; ?></td>
        </tr>
        <tr>
            <td><em>Version:</em></td>
            <td><?php echo $plugin->version; ?></td>
        </tr>
        <tr>
            <td><em>Name:</em></td>
            <td><?php echo $plugin->name; ?></td>
        </tr>
        <tr>
            <td><em>Namespace:</em></td>
            <td><?php echo $plugin->namespace; ?></td>
        </tr>
        <tr>
            <td><em>Path:</em></td>
            <td><?php echo $plugin->path; ?></td>
        </tr>
        <tr>
            <td><em>Description:</em></td>
            <td><?php echo $plugin->description; ?></td>
        </tr>
    </tbody>
</table>