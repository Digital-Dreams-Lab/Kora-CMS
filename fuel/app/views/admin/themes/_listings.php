
<table class="table table-striped">
    <thead>
        <tr>
            <th colspan="2"><i class="fa fa-paint-brush"></i> Themes</th>
        </tr>
    </thead>
    <tbody>
	<?php foreach ($themes as $item) : ?>
        <tr>
            <td><?php echo $item->name; ?></td>
            <td><?php echo $item->name; ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>