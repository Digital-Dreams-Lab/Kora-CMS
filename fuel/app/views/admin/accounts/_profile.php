
    <table class="table table-striped">
		<thead>
			<tr>
				<th><i class="fa fa-user"></i> Profile</th>
				<th></th>
			</tr>
		</thead>
       	<?php $set_array = isset($account_details['profile_fields']['profile']) ? $account_details['profile_fields']['profile']: array(); ?>
		<?php Config::load('users'); $profile_config = Config::get('forms.profile_fields.profile'); ?>
        
        <tbody>
            <?php foreach ($profile_config as $key => $value) : ?>
            <tr>
				<td><?php echo $value; ?></td>
                <td><?php echo isset($set_array[$key]) ? $set_array[$key]: ''; ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
	</table>
    
    <table class="table table-striped">
		<thead>
			<tr>
				<th><i class="fa fa-user"></i> Website preferences</th>
				<th></th>
			</tr>
		</thead>
       	<?php $set_array = isset($account_details['profile_fields']['preferences']) ? $account_details['profile_fields']['preferences']: array(); ?>
		<?php Config::load('users'); $preferences_config = Config::get('forms.profile_fields.preferences'); ?>
        <?php //var_dump($preferences_config); ?>
        <tbody>
            <?php foreach ($preferences_config as $key => $value) : ?>
            <tr>
				<td><?php echo $value['title']; ?></td>
                <td><?php echo isset($set_array[$key]) ? $set_array[$key]: ''; ?></td>
            </tr>
			<?php endforeach; ?>
        </tbody>
	</table>