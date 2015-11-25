
<table class="table table-condensed">
    <thead>
        <tr>
            <th colspan="2">Notifications</th>
        </tr>
    </thead>
    <tbody>
	<?php foreach ($notifications as $item) : ?>
        <tr>
            <td><small><?php echo date("Y-m-d H:i:s A", $item->created_at); ?></small></td>
            <td><small><?php echo $item->event; ?></small></td>
            <td class="text-right"><?php echo Kora\Permissions::get_buttons('admin/notifications', $item->id); ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>