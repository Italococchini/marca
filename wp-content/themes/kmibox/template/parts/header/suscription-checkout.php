<?php $user = get_user_by( 'id', get_current_user_id() ); ?>

 		<aside id="top"> 
			<div class="container">
				
				<a href="<?php echo get_home_url(); ?>">
					<img src="<?php echo get_home_url(); ?>/img/marca-logo.png"  class="hidden-xs"  >
				</a> 
				<a href="<?php echo get_home_url(); ?>">
					<img src="<?php echo get_home_url(); ?>/img/marca-logo.png"  class="hidden-sm hidden-md hidden-lg visible-xs" width="25%;" >
				</a>		
				

		    	<ul class="option-menu list-unstyled list-inline col-xs-8 col-md-6 col-sm-9 pull-right text-right">
					<?php if ( is_user_logged_in() ){ ?>

						<li>

						<a href="<?php echo get_home_url(); ?>/quiero-mi-marca"  class="btn-kmibox-link-suscription">
						<i class="fa fa-plus-circle" aria-hidden="true"></i>
						<span class="hidden-xs caviar">Quiero mi marca</span></a>
						</li>

						<li>
							<a class="btn-kmibox-link" href="<?php echo get_home_url() ?>/?source=<?php echo get_source_url(); ?>">
							<i class="fa fa-user" aria-hidden="true"></i>
							<span class="hidden-xs caviar"><?php echo $user->display_name; ?></span></a>
						</li> 
						<li>
							<a class="btn-kmibox-link" 
							href="<?php echo wp_logout_url( get_home_url() );?> ">
							<i class="fa fa-close" aria-hidden="true"></i>
							<span class="hidden-xs caviar">Salir</span></a>
						</li>
					<?php }else{ ?>

						<a href="<?php echo get_home_url(); ?>/quiero-mi-marca"  class="btn-kmibox-link caviar">Quiero mi marca</a>

						<li>
							<a class="btn-kmibox-link" href="<?php echo get_home_url(); ?>/iniciar-sesion">
							<i class="fa fa-key" aria-hidden="true"></i>
							<span class="hidden-xs caviar">Iniciar Sesion</span></a>
						</li>
						<li>
							<a class="btn-kmibox-link" href="<?php echo get_home_url(); ?>/registro">
							<i class="fa fa-user-plus" aria-hidden="true"></i> <span class="hidden-xs  caviar">Registro</span></a>
						</li>
					<?php } ?>

				</ul>
			</div>			
		</aside>