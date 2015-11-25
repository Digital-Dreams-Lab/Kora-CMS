
<table class="table table-striped">
    <thead>
        <tr>
            <th colspan="2">{Ttile}</th>
        </tr>
    </thead>
    <tbody>
	<?php foreach ($array as $key => $value) : ?>
        <tr>
            <td><?php echo $key; ?></td>
            <td><?php echo $value; ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>