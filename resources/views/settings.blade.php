<div class="wrap">
    <h1><?php esc_html_e( 'Content Protection', 'protect-my-content' ); ?></h1>

    <form method="POST" action="options.php">
        <?php
        settings_fields( 'protect-my-content' );
        do_settings_sections( 'protect-my-content' );
        submit_button();
        ?>
    </form>
</div>
