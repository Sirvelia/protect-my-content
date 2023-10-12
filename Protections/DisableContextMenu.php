<?php

namespace ProtectMyContent\Protections;

class DisableContextMenu
{

    protected $plugin_name;
    protected $plugin_version;

    public function __construct($plugin_name, $plugin_version)
    {
        $this->plugin_name = $plugin_name;
        $this->plugin_version = $plugin_version;

        add_action('wp_footer', [$this, 'render_script'], 90);
    }

    public function render_script()
    {
        echo "<script type=\"text/javascript\">
        document.addEventListener('contextmenu', function(event) {
            event.preventDefault();
        });</script>";
    }

}
