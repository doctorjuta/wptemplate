<?php

require_once(__DIR__ . '/vendor/autoload.php');
require_once(__DIR__ . '/include/navwalker.php');


global $custom_theme;


// Main class for theme initialization
class lbTemplate {

    protected $site_version = "1.0";
    protected $text_domain = "lensbuild";
    public $timber = False;

    public function __construct() {
        $this->manage_actions();
        $this->manage_filters();
        $this->timber = new Timber\Timber();
        // Sets the directories (inside your theme) to find .twig files
        $this->timber::$dirname = array('templates');
        // Autoescape values in Timber.
        $this->timber::$autoescape = false;
    }

    public function manage_actions() {
        // Add css and js
        add_action('wp_enqueue_scripts', array($this, 'include_css_and_js'));
        // Remove Wordpress emoji
        remove_action('wp_head', 'print_emoji_detection_script', 7);
        remove_action('admin_print_scripts', 'print_emoji_detection_script');
        remove_action('wp_print_styles', 'print_emoji_styles');
        remove_action('admin_print_styles', 'print_emoji_styles');
        // Manage theme features
        add_action('after_setup_theme', array($this, 'manage_theme_features'));
    }

    public function manage_theme_features() {
        // Activate featured images for posts
        // Addition image sizes
        add_theme_support('post-thumbnails');
        // Create menus
        register_nav_menus(
            array(
                'primary' => __("Top Menu", $text_domain)
            )
        );
        // Add default posts and comments RSS feed links to head.
		add_theme_support('automatic-feed-links');
        // Let WordPress manage the document title.
        add_theme_support('title-tag');
        // Switch default core markup for search form, comment form, and comments to output valid HTML5.
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
			)
		);
    }

    public function manage_filters() {
        // Add/remove additional file types, available for uploading
        add_filter('upload_mimes', array($this, 'manage_file_types'));
        // Change excerpt ending
        add_filter('excerpt_more', array($this, 'change_excerpt_and'));
        // Change excerpt length
        add_filter('excerpt_length', array($this, 'change_excerpt_length'));
        // Add elements to timber template context
        add_filter('timber/context', array($this, 'add_to_timber_context'));
    }

    public function change_excerpt_length($length) {
        return 20;
    }

    public function change_excerpt_and($more) {
        return '...';
    }

    public function manage_file_types($mimes) {
        $mimes['svg'] = 'image/svg+xml';
        return $mimes;
    }

    public function include_css_and_js() {
        wp_enqueue_style('mainStyle', get_template_directory_uri().'/dist/main.css', array(), $this->site_version);
        wp_enqueue_script('mainScript', get_template_directory_uri().'/dist/main.js', array(), $this->site_version, true);
        wp_localize_script('mainScript', 'theme', array(
            'ajaxurl' => admin_url('admin-ajax.php')
        ));
    }

    public function add_to_timber_context($context) {
        $context['menu'] = new \Timber\Menu('primary');
        return $context;
    }

}

$custom_theme = new lbTemplate();

?>
