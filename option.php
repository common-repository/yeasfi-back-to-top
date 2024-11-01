<?php
/*
 * Plugin Seting Option
 * 
 */
add_action('admin_menu', 'ybtb_add_admin_menu');
add_action('admin_init', 'ybtb_settings_init');
add_action('admin_enqueue_scripts', 'ybtb_color_picker');
function ybtb_color_picker() {
    wp_enqueue_script('ybtb-iris', plugins_url('/js/iris.min.js', __FILE__));
    wp_enqueue_script('ybtb-myscript', plugins_url('/js/myscript.js', __FILE__));
}
function ybtb_add_admin_menu() {
    add_menu_page('Yeasfi Back to Top Button', 'Back to Top Button', 'manage_options', 'yeasfi_back_to_top_button', 'ybtb_options_page');
}
function ybtb_settings_init() {
    register_setting('YBTB', 'ybtb_settings');
    add_settings_section(
            'ybtb_YBTB_section', __('Yeasfi Back to Top Button', 'back to Top'), 'ybtb_settings_section_callback', 'YBTB'
    );
    add_settings_field(
            'ybtb_text_field_0', __('Button Background Color', 'back to Top'), 'ybtb_text_field_0_render', 'YBTB', 'ybtb_YBTB_section'
    );
    add_settings_field(
            'ybtb_select_field_1', __('Button Position', 'back to Top'), 'ybtb_select_field_1_render', 'YBTB', 'ybtb_YBTB_section'
    );
}
function ybtb_text_field_0_render() {
    $options = get_option('ybtb_settings');
    ?>
    <input type="text"  name="ybtb_settings[ybtb_text_field_0]" class="color-picker" id='color-picker' value="<?php echo $options['ybtb_text_field_0']; ?>" />
    <?php
}
function ybtb_select_field_1_render() {
    $options = get_option('ybtb_settings');
    ?>
    <select name='ybtb_settings[ybtb_select_field_1]'>
        <option value='right'>Select</option>
        <option value='left' <?php selected($options['ybtb_select_field_1'], 1); ?>>Bottom Left</option>
        <option value='right' <?php selected($options['ybtb_select_field_1'], 2); ?>>Bottom Right</option>
    </select>
    <?php
}
function ybtb_settings_section_callback() {
    echo __('Back to Top Button With Smooth Scroll', 'back to Top');
}
function ybtb_options_page() {
    ?>
    <form action='options.php' method='post'>      
        <?php
        settings_fields('YBTB');
        do_settings_sections('YBTB');
        submit_button();
        ?>

    </form>
    <?php
}
?>