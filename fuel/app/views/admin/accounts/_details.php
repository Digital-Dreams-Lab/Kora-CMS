    <table class="table table-striped">
		<thead>
			<tr>
				<th><i class="fa fa-info"></i> Details</th>
				<th></th>
				<th><small class="text-muted"><em>Account created: <?php echo date("d/m/y H:i:s", $account_details['created_at']); ?>, last logged in <?php echo date("d/m/y H:i:s", $account_details['last_login']); ?></em></small></th>
			</tr>
		</thead>
		<tbody>
        	<tr>
				<td rowspan="7" class="text-center"><img class="img img-responsive" src="<?php echo Uri::base(false).'assets/img/avatars/'.$preferences->avatar.'.png'; ?>"></td>
            </tr>
			<tr>
				<td>User id</td>
				<td><?php echo $account_details['user_id']; ?></td>
			</tr> 
			<tr>
				<td>User level</td>
				<td><?php echo $account_details['level']; ?></td>
			</tr> 
			<tr>
				<td>Username</td>
				<td><?php echo $account_details['username']; ?></td>
			</tr> 
			<tr>
				<td>Email</td>
				<td><?php echo $account_details['email']; ?></td>
			</tr> 
            <tr>
                <td>Group</td>
                <td><?php echo $group->name; ?></td>
            </tr>
            <tr>
                <td>Group level</td>
                <td><?php echo $group->level; ?></td>
            </tr>
		</tbody>
	</table>