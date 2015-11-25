			<?php if (Kora\Permissions::check_group_level('0')): ?>

  				<?php if ($registers): ?>              
                <table class="table table-striped align-vert" style="border-collapse:collapse;">
                  	<thead>
                    	<tr>
                        	<th style="width:20%">Route</th>
                        	<th>Controller</th>
                        	<th></th>
                        </tr>
                    </thead>
                    <tbody> 
                    <?php foreach ($registers_array as $regs): ?> 
                                   
                        <tr>
                            <th>
                            	<a class="toogle_chevron" data-toggle="collapse" aria-expanded="<?php echo $regs=='admin' ? 'true': 'false'; ?>" data-target=".<?php echo $regs; ?>" class="accordion-toggle" href="javascript:void(0)"><?php echo $regs; ?> <i class="fa fa-chevron-down"></i></a>
                            </th>
                            <th></th>
                            <th></th>
                        </tr>
                    
					<?php endforeach; ?>
                    

                    <?php foreach ($registers as $item): ?>
                          
                        <tr class="collapse <?php echo $item->route; ?>">
                            <td><?php echo Kora\Permissions::get_link('admin/registers', $item->id, $item->route, 'edit'); ?></td>
                            <td><?php echo $item->controller; ?></td>
                            <td class="text-right"><?php echo Kora\Permissions::get_buttons('admin/registers', $item->id); ?></td>
                        </tr>
                 
                    <?php endforeach; ?>
                    </tbody>       
                </table>
				<?php else: ?>
                <div class="alert alert-info">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <i class="fa fa-info-circle"></i> No access rules listed. 
                    <?php echo \Kora\Permissions::get_link_check('admin', 'registers', 'create', '', '<i class="fa fa-plus"></i> Create new register rules',  array('class'=>'btn btn-success')); ?>
                </div>
                <?php endif; ?>
				
			<?php else: ?>
                <div class="alert alert-warning">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <i class="fa fa-warning"></i> You do not have the required access level to view this page
                </div>                
            <?php endif; ?>
			
            
<script>
	$('.toogle_chevron').on('click',function(){
		$(this).find('i.fa').toggleClass('fa-chevron-up fa-chevron-down');
	});
</script>