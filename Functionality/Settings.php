<?php
namespace ProtectMyContent\Functionality;

class Settings
{

	protected $plugin_name;
	protected $plugin_version;

	protected $settings;

	protected $options_group = 'protect_my_content';

	public function __construct($plugin_name, $plugin_version)
	{
		$this->plugin_name = $plugin_name;
		$this->plugin_version = $plugin_version;

		$this->settings = (array) \ProtectMyContent\Components\Settings::get_data();

		if ($this->settings) {
			add_action('admin_init', [$this, 'settings_init']);
		}

	}

	public function settings_init()
	{

		add_settings_section(
			'protect_my_content_section',
			'',
			[$this, 'protect_my_content_callback'],
			'protect-my-content'
		);

		if ($this->settings) {
			foreach ($this->settings as $setting) {
				add_settings_field(
					$setting['slug'],
					$setting['name'],
					[$this, "{$setting['type']}_field_callback"],
					'protect-my-content',
					'protect_my_content_section',
					[
						'slug' => $setting['slug'],
						'description' => $setting['description'],
						'checked'      => (!isset(get_option($this->options_group)[$setting['slug']]))
						? 0 : get_option($this->options_group)[$setting['slug']],
					]
				);

				register_setting('protect-my-content', $this->options_group);
			}
		}

	}

	public function protect_my_content_callback()
	{
		
	}

	public function checkbox_field_callback($args)
	{
		$options_group = $this->options_group;
		$slug = esc_attr($args['slug']);
		$description = esc_attr($args['description']);
		$checked = esc_attr($args['checked']) ? 'checked="checked"' : '';

		echo "<label for=\"{$options_group}[{$slug}]\"><input name=\"{$options_group}[{$slug}]\" id=\"{$slug}\" type=\"checkbox\" value=\"1\" {$checked} /> {$description}</label>";
	}
}
