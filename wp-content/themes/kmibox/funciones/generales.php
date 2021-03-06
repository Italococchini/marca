<?php

	if(!function_exists('HOME')){
	    function HOME(){
	        return get_home_url();
	    }
	}

	if(!function_exists('TEMA')){
	    function TEMA(){
	        return get_template_directory_uri();
	    }
	}

	if(!function_exists('cssPAGE')){
	    function cssPAGE($_page){
	        return '
	        	<link rel="stylesheet" href="'.TEMA().'/css/'.$_page.'.css'.VERSION().'">
				<link rel="stylesheet" href="'.TEMA().'/css/responsive/'.$_page.'.css'.VERSION().'">
				<script src="'.TEMA().'/js/'.$_page.'.js'.VERSION().'"></script>
			';
	    }
	}

	if(!function_exists('VERSION')){
	    function VERSION(){
	        return "?ver=".time();
	    }
	}

	if(!function_exists('comprimir')){
	    function comprimir($HTML){
	        $HTML = str_replace("\t", "", $HTML);
	        $HTML = str_replace("      ", " ", $HTML);
	        $HTML = str_replace("     ", " ", $HTML);
	        $HTML = str_replace("    ", " ", $HTML);
	        $HTML = str_replace("   ", " ", $HTML);
	        $HTML = str_replace("  ", " ", $HTML);
	        return $HTML = str_replace("\n", " ", $HTML);
	    }
	}

	if(!function_exists('MENU')){
	    function MENU($page = ""){
	    	$user = get_user_by( 'id', get_current_user_id() );
	    	$home = HOME();
	    	$salir = wp_logout_url( HOME() );


	    	switch ($page) {
	    		default:
	    			// Aqui va el codigo personalizado
	    			// De ser necesario
	    		break;
	    	}

	        $HTML = '
	        	<nav> 
					<div class="nav_container">

						<a href="'.$home.'" class="hidden-xs">
							<img src="'.$home.'/img/Image-Header.png" style="margin-left:  -10%;" >
						</a> 
						<a href="'.$home.'" class="hidden-sm hidden-md hidden-lg">
							<img src="'.$home.'/img/Image-Header.png" style="margin-left:  -3%;" >
						</a> 

				    	<ul style="margin-left: -11%;" class="hidden-xs">';
				    		if ( is_user_logged_in() ){
				    			$HTML .= '
									<li>
										<a href="'.$home.get_source_url().'/quiero-mi-marca/"">
											<i class="fa fa-plus-circle"></i>
											<span>Quiero mi NutriHeroes</span>
										</a>
									</li>
									<li>
										<a href="'.$home.'/perfil/">
											<i class="fa fa-user"></i>
											<span>'.$user->display_name.'</span>
										</a>
									</li>
									<li>
										<a href="'.$salir.'" style="margin-right: -60%;">
											<i class="fa fa-close"></i>
											<span>Salir</span>
										</a>
									</li>';
							}else{
				    			$HTML .= '
									
									<li>
										<a href="'.$home.'/iniciar-sesion/">
											<i class="fa fa-key fa-2x"></i>
											<span>Iniciar Sesión</span>
										</a>
									</li>
									<li>
										<a href="'.$home.'/registro/">
											<i class="fa fa-user-plus fa-2x"></i> 
											<span>Registrarse</span>
										</a>
									</li>';
							} $HTML .= '
						</ul>

						<ul style="margin-left: -11%;" class="hidden-sm hidden-lg hidden-md visible-xs pull-left">';
				    		if ( is_user_logged_in() ){
				    			$HTML .= '
									<li>
										<a href="'.$home.get_source_url().'/quiero-mi-marca/"">
											<i class="fa fa-plus-circle"></i>
											<span>Quiero mi NutriHeroes</span>
										</a>
									</li>
									<li>
										<a href="'.$home.'/perfil/">
											<i class="fa fa-user"></i>
											<span>'.$user->display_name.'</span>
										</a>
									</li>
									<li>
										<a href="'.$salir.'">
											<i class="fa fa-close"></i>
											<span>Salir</span>
										</a>
									</li>';
							}else{
				    			$HTML .= '
									
									<li>
										<a href="'.$home.'/iniciar-sesion/">
											<i class="fa fa-key fa-2x"></i>
											<span>Iniciar Sesión</span>
										</a>
									</li>
									<li>
										<a href="'.$home.'/registro/">
											<i class="fa fa-user-plus fa-2x"></i> 
											<span>Registrarse</span>
										</a>
									</li>';
							} $HTML .= '
						</ul>
					</div>			
				</nav>
	        ';
	        return $HTML;
	    }

	    
	}


?>