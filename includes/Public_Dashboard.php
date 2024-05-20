<?php

namespace Google\Site_Kit_Public_Dashboard;

class Public_Dashboard {

	public function register() {
		add_action( 'init', array( $this, 'register_public_dashboard' ) );
		add_filter( 'query_vars', array( $this, 'add_query_vars' ) );
		add_filter( 'template_include', array( $this, 'load_template' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
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
		if ( get_query_var( 'custom_page' ) === 'google-site-kit' ) {
			$template_path = GOOGLESITEKITPUBLICDASHBOARD_PLUGIN_DIR_PATH . 'includes/page-templates/page-public-dashboard.php';

			if ( file_exists( $template_path ) ) {
				return $template_path;
			}
		}

		return $template;
	}

	public function enqueue_scripts() {
		if ( get_query_var( 'custom_page' ) === 'google-site-kit' ) {
			wp_enqueue_script(
				'googlesitekit-public-dashboard',
				// plugin_dir_url( GOOGLESITEKIT_PLUGIN_MAIN_FILE ) . 'dist/assets/js/googlesitekit-public-dashboard.js',
				'',
				array(
					'googlesitekit-tracking-data',
					'googlesitekit-runtime',
					'googlesitekit-i18n',
					'googlesitekit-vendor',
					'googlesitekit-commons',
					'googlesitekit-data',
					'googlesitekit-datastore-forms',
					'googlesitekit-datastore-location',
					'googlesitekit-datastore-site',
					'googlesitekit-datastore-user',
					'googlesitekit-datastore-ui',
					'googlesitekit-widgets',
					'googlesitekit-components',
					'googlesitekit-dashboard-sharing-data'
				)
			);

			wp_enqueue_style( 'googlesitekit-admin-css' );
		}
	}
}
