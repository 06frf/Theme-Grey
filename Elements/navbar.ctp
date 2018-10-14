	<div class="navbar navbar-default navbar-static-top menu" role="navigation">
	    <div class="container">
	        <div class="navbar-header">
	            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-servername">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
	            </button>
                <a href="<?= $this->Html->url('/') ?>" class="navbar-brand no-txt">
                <?php
					if(isset($theme_config['logo']) && $theme_config['logo']) {
                    echo '<img src="'.$theme_config['logo'].'">';
                    } else {
                    echo ''.$website_name.'';
                    }
                ?>
                </a>				
			</div>
			<div class="collapse navbar-collapse navbar-servername nav-menu">
				<ul class="nav navbar-nav navbar-right">
					<li><a href="<?= $this->Html->url('/') ?>"><?= $Lang->get('GLOBAL__HOME') ?></a></li>
					<?php
                        if (!empty($nav)) {
                            $i = 0;
                            foreach ($nav as $key => $value) {
                                if (empty($value['Navbar']['submenu'])) {
                                    echo '<li class="scroll';
                                    echo ($this->params['controller'] == $value['Navbar']['name']) ? ' active' : '';
                                    echo '">';
                                    echo '<a href="' . $value['Navbar']['url'] . '"';
                                    echo ($value['Navbar']['open_new_tab']) ? ' target="_blank"' : '';
                                    echo '>';
                                    echo $value['Navbar']['name'];
                                    echo '</a>';
                                    echo '</li>';
                                } else {
                                    echo '<li class="dropdown">';
                                    echo '<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">';
                                    echo $value['Navbar']['name'] . ' <i class="fa fa-angle-down parent-symbol"></i>';
                                    echo '</a>';
                                    echo '<ul class="dropdown-menu" role="menu">';
                                    $submenu = json_decode($value['Navbar']['submenu']);
                                    foreach ($submenu as $k => $v) {
                                        echo '<li>';
                                        echo '<a href="' . rawurldecode(rawurldecode($v)) . '"';
                                        echo ($value['Navbar']['open_new_tab']) ? ' target="_blank"' : '';
                                        echo '>';
                                        echo rawurldecode(str_replace('+', ' ', $k));
                                        echo '</a>';
                                        echo '</li>';
                                    }
                                    echo '</ul>';
                                    echo '</li>';
                                }
                                $i++;
                            }
                        }
                     ?>
					<li class="dropdown">
						<?php if(!$isConnected) { ?>
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="dropdown" aria-expanded="false"> Espace membre<span class="caret"></span></a>
							<ul class="dropdown-menu" role="menu">
								<li><a href="#" data-toggle="modal" data-target="#login"><i class="fa fa-sign-in"></i> <?= $Lang->get('USER__LOGIN')?></a></li>
								<li><a href="#" data-toggle="modal" data-target="#register"><i class="fa fa-user-plus"></i> <?= $Lang->get('USER__REGISTER')?></a></li>
							</ul>
						<?php } else { ?>
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><?= $user['pseudo'] ?> <img src="<?= $this->Html->url(['controller' => 'API', 'action' => 'get_head_skin', 'plugin' => false, $user['pseudo'], 16]) ?>"/> <span class="caret"></span></a>
							<ul class="dropdown-menu" role="menu">
								<li><a href="#notifications_modal" onclick="notification.markAllAsSeen(2)" data-toggle="modal"><i class="fa fa-flag"></i> <?= $Lang->get('NOTIFICATIONS__LIST') ?></a><span class="notification-indicator"></span></li>
								<li><a href="<?= $this->Html->url(array('controller' => 'profile', 'action' => 'index', 'plugin' => null)) ?>" data-toggle="modal"><i class="fa fa-user"></i> <?= $Lang->get('USER__PROFILE') ?></a></li>
								<li><a href="<?= $this->Html->url(array('controller' => 'user', 'action' => 'logout', 'plugin' => null)) ?>"><i class="fa fa-power-off"></i> <?= $Lang->get('USER__LOGOUT') ?></a></li>
								<?php if($Permissions->can('ACCESS_DASHBOARD')) { ?>
								<li><a href="<?= $this->Html->url(array('controller' => '', 'action' => 'index', 'plugin' => 'admin')) ?>"><i class="fa fa-cogs"></i> <?= $Lang->get('GLOBAL__ADMIN_PANEL') ?></a></li>
							<?php } ?>
							</ul>
						<?php } ?>
					</li>
				</ul>
			</div>
		</div>
	</div>