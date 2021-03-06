<?php
add_action( 'admin_menu', 'elit_add_admin_menu' );
add_action( 'admin_init', 'elit_settings_init' );

function elit_add_admin_menu(  ) { 
	add_options_page( 'Homepage Intro Menu ID', 
                    'Homepage Intro Menu ID', 
                    'manage_options', 
                    'elit_homepage_intro_menu_custom_fields', 
                    'elit_options_page' );
}

function elit_settings_init(  ) { 

	register_setting( 'homePageIntroCF', 'elit_settings' );

	add_settings_section(
		'elit_homePageIntroCF_section', 
		__( 'Set the menu that should have the &ldquo;Tag text&rdquo; custom field', 
        'elit-homepage-intro-menu-custom-fields' ), 
		'elit_settings_section_callback', 
		'homePageIntroCF'
	);

	add_settings_field( 
		'elit_menu_id_for_custom_field', 
		__( 'Menu id', 'elit-homepage-intro-menu-custom-fields' ), 
		'elit_menu_id_for_custom_field_render', 
		'homePageIntroCF',
    'elit_homePageIntroCF_section' 
	);
}


function elit_menu_id_for_custom_field_render(  ) { 

	$options = get_option( 'elit_settings' );
	?>
	<input type='text' 
         name='elit_settings[elit_menu_id_for_custom_field]' 
         value='<?php echo $options['elit_menu_id_for_custom_field']; ?>'>
	<?php

}


function elit_settings_section_callback(  ) { 
	echo __( 'The &ldquo;Tag text&rdquo; custom field will appear in the menu with this ID', 
           'elit-homepage-intro-menu-custom-fields' );
}


function elit_options_page(  ) { 

	?>
	<form action='options.php' method='post'>

		<?php
		settings_fields( 'homePageIntroCF' );
		do_settings_sections( 'homePageIntroCF' );
		submit_button();
		?>

	</form>
	<?php

}

?>
