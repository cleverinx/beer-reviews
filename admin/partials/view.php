<div class="wrap">
    <h1><?php echo $heading ?></h1>
    <div id="poststuff">
        <div id="post-body" class="metabox-holder columns-2">
            <div id="post-body-content">
                <form action="options.php" method="post">
                    <?php settings_fields($settings_group); ?>
                    <?php do_settings_sections($page_slug); ?>
                    <?php echo $fields ?>
                    <div class="submit-wrap">
                        <?php submit_button($submit_text); ?>
                        <div class="spinner"></div>
                    </div>
                </form>
            </div>
        </div>
        <br class="clear">
    </div>
</div>
