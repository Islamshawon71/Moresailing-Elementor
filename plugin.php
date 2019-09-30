<?php

namespace ElementorMoresailing;

/**
 * Class Plugin
 *
 * Main Plugin class
 * @since 1.2.0
 */
class Plugin
{

	/**
	 * Instance
	 *
	 * @since 1.2.0
	 * @access private
	 * @static
	 *
	 * @var Plugin The single instance of the class.
	 */
	private static $_instance = null;

	/**
	 * Instance
	 *
	 * Ensures only one instance of the class is loaded or can be loaded.
	 *
	 * @since 1.2.0
	 * @access public
	 *
	 * @return Plugin An instance of the class.
	 */
	public static function instance()
	{
		if (is_null(self::$_instance)) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	/**
	 * widget_scripts
	 *
	 * Load required plugin core files.
	 *
	 * @since 1.2.0
	 * @access public
	 */
	public function widget_scripts()
	{
		wp_register_style('jquery-ui', 'https://code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css');
		wp_register_style('style_moresailing', plugins_url('/assets/css/style_moresailing.css', __FILE__));
		wp_register_script('script_moresailing', plugins_url('/assets/js/script_moresailing.js', __FILE__), array('jquery'), '1.0', true);
		wp_enqueue_script('jquery-ui-datepicker');
		wp_enqueue_style('jquery-ui');
		wp_enqueue_style('style_moresailing');
		wp_enqueue_script('script_moresailing');
	}

	/**
	 * Include Widgets files
	 *
	 * Load widgets files
	 *
	 * @since 1.2.0
	 * @access private
	 */
	private function include_widgets_files()
	{
		require_once(__DIR__ . '/widgets/hello-world.php');
		require_once(__DIR__ . '/widgets/inline-editing.php');
		require_once(__DIR__ . '/widgets/moresailing_tab.php');
		require_once(__DIR__ . '/widgets/moresailing_newsletter.php');
		require_once(__DIR__ . '/widgets/facebookSlider.php');
		require_once(__DIR__ . '/widgets/testimonialSlider.php');
		require_once(__DIR__ . '/widgets/bookingTable.php');
		require_once(__DIR__ . '/widgets/bookingForm.php');
	}

	/**
	 * Register Widgets
	 *
	 * Register new Elementor widgets.
	 *
	 * @since 1.2.0
	 * @access public
	 */
	public function register_widgets()
	{
		// Its is now safe to include Widgets files
		$this->include_widgets_files();

		// Register Widgets
		// \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\Hello_World());
		// \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\Inline_Editing());
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\Moresailing_Tab());
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\Moresailing_NewsLetter());
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\FacebookCommentSlider());
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\TestimonialCarosel());
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\BookingTable());
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\BookForm());
	}

	/**
	 *  Plugin class constructor
	 *
	 * Register plugin action hooks and filters
	 *
	 * @since 1.2.0
	 * @access public
	 */
	public function __construct()
	{

		// Register widget scripts
		add_action('elementor/frontend/after_register_scripts', [$this, 'widget_scripts']);
		// Register widgets
		add_action('elementor/widgets/widgets_registered', [$this, 'register_widgets']);
	}
}

// Instantiate Plugin Class
Plugin::instance();
