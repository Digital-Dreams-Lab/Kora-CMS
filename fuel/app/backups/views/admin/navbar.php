<?php

/*
 *		Controller				Title			Icons			Tooltip	hints								Sub controllers (to maintain active status)
 */		
$navbar = array(
		'pages'			=>array('Pages',		'files-o',		"Manage website pages.",					array()),
		'media'			=>array('Media',		'picture-o',	"Manage media files.",						array()),
		//'layouts'		=>array('Layout',		'paint-brush',	"Manage website layout.",					array('themes','blocks')),
		'addons'		=>array('Add-ons',		'puzzle-piece',	"Manage plugins, modules and templates.",	array('modules','templates','plugins')),
		'settings'		=>array('Settings',		'cog',			"Manage site settings.",					array('accounts','notifications')),
		'tools'			=>array('Tools',		'wrench',		"Manage admin tools.",						array('access','registers')),
		'permissions'	=>array('Permissions',	'lock',			"Manage site permissions.",					array('groups','users')),
	);
?>
	<div class="navbar navbar-inverse navbar-static-top">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="<?php echo Uri::base(false); ?>admin/dashboard">
				<div class="hidden-sm">
					<?php echo Asset::img('koracms_visible-md.png', array('id' => 'logo')); ?>
                </div>
                <div class="visible-sm">
					<?php echo Asset::img('koracms_visible-sm.png', array('id' => 'logo')); ?>
				</div>
                </a>
			</div>
			<div class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <?php foreach ($navbar as $key => $value) : ?>
                    <li class="<?php echo (Uri::segment(2) == $key || in_array(Uri::segment(2), $value[3])==true) ? 'active' : '' ?>">
                        <a href="<?php echo Uri::base(false).'admin/'.$key; ?>" data-toggle="tooltip" data-placement="bottom" title="<?=$value[2]?>"><i class="nav_icons visible-sm fa fa-lg fa-<?=$value[1]?>"></i><span class="hidden-sm"> <?=$value[0]?></span></a>
                    </li>
                    <?php endforeach; ?>
                </ul>
                <?php //var_dump($preferences->avatar); ?>
                
                <ul class="nav navbar-nav pull-right">
                    <li class="dropdown">                    	
                        <a data-toggle="dropdown" class="dropdown-toggle" href="javascript:void(0)"><img class="visible-sm nav_avatar" src="<?php echo Uri::base(false).'assets/img/avatars/'.$preferences->avatar.'.png'; ?>"><span class="hidden-sm"> <?php echo $current_user->username ?> <b class="caret"></b></span></a>
                        <ul class="dropdown-menu">
                            <li><?php echo Html::anchor('admin/notifications', '<i class="fa fa-bell-o"></i> Notifications') ?></li>
                            <li><?php echo Html::anchor('admin/mail', '<i class="fa fa-inbox"></i> Mailbox') ?></li>
                            <li><?php echo Html::anchor('admin/accounts', '<i class="fa fa-info-circle"></i> Account') ?></li>
                            <li class="divider"></li>
                            <li><?php echo Html::anchor('pages', '<i class="fa fa-globe"></i> View site', array('target'=>'_blank')) ?></li>
                            <li class="divider"></li>
                            <li><?php echo Html::anchor('admin/logout', '<i class="fa fa-sign-out"></i> Logout') ?></li>
                        </ul>
                    </li>
                </ul>
          
			</div>
		</div>
	</div>