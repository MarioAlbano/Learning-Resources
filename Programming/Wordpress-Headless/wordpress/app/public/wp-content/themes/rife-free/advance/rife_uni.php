<?php
class Apollo13Framework_Rife_Uni{
	function __construct(){
		add_filter( 'apollo13framework_docs_address', array( $this, 'docs_link' ), 10, 2 );
		add_filter( 'apollo13framework_docs_locations', array( $this, 'docs_locations' ), 10, 2 );
	}

	function docs_link() {
		return 'https://rifetheme.com/help/';
	}

	function docs_locations() {
		return array(
			'license-code'           => 'docs/getting-started/where-i-can-find-license-code/',
			'header-color-variants'  => 'docs/customizing-the-theme/header/variant-light-dark-overwrites/',
			'importer-configuration' => 'docs/installation-updating/importing-designs/importer-configuration/',
			'export'                 => 'docs/installation-updating/exporting-theme-options/',
			'support-forum'          => 'docs/getting-started/support-forum/',
		);
	}
}

new Apollo13Framework_Rife_Uni();






