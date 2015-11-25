
    <table class="table table-striped">
        <thead>
            <tr>
                <th><i class="fa fa-user-secret"></i> <a href="#collapse_access" data-toggle="collapse" aria-expanded="false" aria-controls="collapse_access">Access</a></th>
                <th></th>
            </tr>
        </thead>
    	<tbody class="collapse" id="collapse_access">
            <?php foreach ($access_array as $access) : ?>
            <?php $groups_array = explode(',',$access->groups); ?>
            <tr>
                <td><span class="text-muted"><?php echo Uri::base(false); ?></span><?php echo $access->name; ?></td>
                <td><?php echo (isset($groups_array) && in_array($account_details['user_id'],$groups_array)) ? '<span class="label label-success"><i class="fa fa-unlocked"></i> Access granted</span>': '<span class="label label-warning"><i class="fa fa-locked"></i>Access granted</span>'; ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>	