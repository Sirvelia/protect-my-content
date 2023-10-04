<?php

namespace ProtectMyContent\Functionality;

use ProtectMyContent\Includes\BladeLoader;

class AdminMenus
{

	protected $plugin_name;
	protected $plugin_version;

	private $blade;

	public function __construct($plugin_name, $plugin_version)
	{
		$this->plugin_name = $plugin_name;
		$this->plugin_version = $plugin_version;
		$this->blade = BladeLoader::getInstance();

		add_action('admin_menu', [$this, 'add_admin_menus']);
	}

	public function add_admin_menus()
	{

		add_options_page(
			__('Content Protection', 'protect-my-content'),
			__('Content Protection', 'protect-my-content'),
			'manage_options',
			'protect-my-content',
		    function() {
				$this->display_template('settings');
			},
		    'dashicons-admin-settings',
		    6
		);
	}

	private function display_template(string $template)
	{
		echo $this->blade->template($template);
	}
}
