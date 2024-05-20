<?php

namespace Google\Site_Kit_Public_Dashboard;

class Public_Dashboard {

	public function register() {
		add_action( 'init', array( $this, 'register_public_dashboard' ) );
		add_filter( 'query_vars', array( $this, 'add_query_vars' ) );
		add_filter( 'template_include', array( $this, 'load_template' ) );
	}

	public function register_public_dashboard() {
		add_rewrite_rule(
			'^google-site-kit/?',
			'index.php?custom_page=google-site-kit',
			'top'
		);
	}

	public function add_query_vars( $vars ) {
		$vars[] = 'custom_page';

		return $vars;
	}

	public function load_template( $template ) {
		if ( get_query_var( 'custom_page' ) == 'google-site-kit' ) {
			$template_path = GOOGLESITEKITPUBLICDASHBOARD_PLUGIN_DIR_PATH . 'includes/page-templates/page-public-dashboard.php';

			if ( file_exists( $template_path ) ) {
				return $template_path;
			}
		}

		return $template;
	}
}
