<table class="table">
	<thead>
    	<tr>
        	<th></th>
        	<th>Data</th>
        </tr>
    </thead>
	<tbody>
        <tr>
            <td>Type</td>
            <td><?php echo $register->type; ?></td>
        </tr>
        
        <tr>
            <td>Route</td>
            <td><?php echo  $register->route; ?></td>
        </tr>
        
        <tr>
            <td>Controller</td>
            <td><?php echo $register->controller; ?></td>
        </tr>
        
        <tr>
            <td>Actions</td>
            <td><?php echo $register->actions; ?></td>
        </tr>
        
        <tr>
            <td>Methods</td>
            <td><?php echo $register->methods; ?></td>
        </tr>
        
        <tr>
            <td>Permissions</td>
            <td><?php echo $register->perms; ?></td>
        </tr>
        
        <tr>
            <td>Rules</td>
            <td><?php echo $register->rules; ?></td>
        </tr>
	</tbody>
</table>
