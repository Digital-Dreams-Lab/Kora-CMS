    <table class="table table-striped vert-align">
        <thead>
            <tr>
                <th>Title</th>
                <th>Author</th>
                <th>Created</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($pages as $item): ?>
            <tr>
                <td><?php echo Kora\Permissions::get_link('admin/pages', $item->id, $item->title, 'edit'); ?></td>
                <td><?php echo ($item->user_id) ? $users[$item->user_id]: ''; ?></td>
                <td><span class="text-muted"><?php echo date("d/m/Y H:i:sa",$item->created_at); ?></span></td>
                <td><?php echo $item->active; ?></td>
                <td><?php echo Kora\Permissions::get_buttons('admin/pages', $item->id, 'label label'); ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>