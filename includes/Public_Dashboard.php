<?php

namespace Google\Site_Kit_Public_Dashboard;

class Public_Dashboard {

	public function register() {
		add_filter( 'theme_page_templates', array( $this, 'add_page_template' ) );
		add_filter('template_include', array( $this, 'load_page_template' ) );
	}

	public function load_page_template( $template ) {
		if ( is_page_template( 'page-public-dashboard.php' ) ) {
			$public_dashboard_template = GOOGLESITEKITPUBLICDASHBOARD_PLUGIN_DIR_PATH . 'includes/page-templates/page-public-dashboard.php';

			if ( file_exists( $public_dashboard_template ) ) {
				return $public_dashboard_template;
			}
		}

		return $template;
	}

	public function add_page_template( $templates ) {
		$templates['page-public-dashboard.php'] = __( 'Site Kit Public Dashboard' );

    	return $templates;
	}
}
