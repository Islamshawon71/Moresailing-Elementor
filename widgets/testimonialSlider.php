<?php

namespace ElementorMoresailing\Widgets;

use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Color;
use Elementor\Scheme_Typography;
use Elementor\Widget_Base;
use ElementorPro\Modules\QueryControl\Module as Module_Query;
use ElementorPro\Modules\QueryControl\Controls\Group_Control_Related;
use Elementor\Controls_Manager;

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly
}

/**
 * Class Portfolio
 */
class TestimonialCarosel extends Widget_Base
{

	/**
	 * @var \WP_Query
	 */
	private $_query = null;

	protected $_has_template_content = false;

	public function get_name()
	{
		return 'moresailing-testimonial';
	}

	public function get_title()
	{
		return __('Moresailing Testimonial', 'elementor-pro');
	}

	public function get_icon()
	{
		return 'eicon-gallery-grid';
	}

	public function get_keywords()
	{
		return ['posts', 'cpt', 'item', 'loop', 'query', 'portfolio', 'custom post type'];
	}

	public function get_script_depends()
	{
		return ['imagesloaded'];
	}

	public function on_import($element)
	{
		if (!get_post_type_object($element['settings']['posts_post_type'])) {
			$element['settings']['posts_post_type'] = 'post';
		}

		return $element;
	}

	public function get_query()
	{
		return $this->_query;
	}

	protected function _register_controls()
	{
		$this->register_query_section_controls();
	}

	private function register_query_section_controls()
	{


		$this->start_controls_section(
			'section_query',
			[
				'label' => __('Testimonial Query', 'elementor-pro'),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_group_control(
			Group_Control_Related::get_type(),
			[
				'name' => 'posts',
				'presets' => ['full'],
				'exclude' => [
					'posts_per_page', //use the one from Layout section
				],
			]
		);
		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'thumbnail_size',
				'exclude' => ['custom'],
				'default' => 'medium',
				'prefix_class' => 'elementor-portfolio--thumbnail-size-',
			]
		);

		$this->end_controls_section();


		$this->start_controls_section(
			'section_design_layout',
			[
				'label' => __('Items', 'elementor-pro'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		/*
		 * The `item_gap` control is replaced by `column_gap` and `row_gap` controls since v 2.1.6
		 * It is left (hidden) in the widget, to provide compatibility with older installs
		 */
		$this->add_control(
			'column_gap',
			[
				'label' => __('Columns Gap', 'elementor-pro'),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .single-day' => 'padding-left: {{SIZE}}px;padding-right: {{SIZE}}px',
					'{{WRAPPER}} ' => 'margin-left: -{{SIZE}}px;margin-right: -{{SIZE}}px',
				],
			]
		);

		$this->add_control(
			'row_gap',
			[
				'label' => __('Rows Gap', 'elementor-pro'),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'frontend_available' => true,
				'selectors' => [
					'{{WRAPPER}} ' => 'margin-top: {{SIZE}}px;margin-bottom: {{SIZE}}px',
				],
			]
		);


		$this->add_control(
			'color_title',
			[
				'label' => __('Color', 'elementor-pro'),
				'separator' => 'before',
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .single-day .single-day-image p' => 'color: {{VALUE}};',
					'{{WRAPPER}} .single-day .single-day-image h3' => 'color: {{VALUE}};',
					'{{WRAPPER}} .single-day .single-day-content p' => 'color: {{VALUE}};',
				]
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'typography_subtitle',
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .single-day .single-day-image p',
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'typography_title',
				'scheme' => Scheme_Typography::TYPOGRAPHY_2,
				'selector' => '{{WRAPPER}} .single-day .single-day-content h3',
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'typography_content',
				'scheme' => Scheme_Typography::TYPOGRAPHY_3,
				'selector' => '{{WRAPPER}} .single-day .single-day-content p',
			]
		);

		$this->end_controls_section();
	}

	protected function get_taxonomies()
	{
		$taxonomies = get_taxonomies(['show_in_nav_menus' => true], 'objects');

		$options = ['' => ''];

		foreach ($taxonomies as $taxonomy) {
			$options[$taxonomy->name] = $taxonomy->label;
		}

		return $options;
	}

	protected function get_posts_tags()
	{
		$taxonomy = $this->get_settings('taxonomy');

		foreach ($this->_query->posts as $post) {
			if (!$taxonomy) {
				$post->tags = [];

				continue;
			}

			$tags = wp_get_post_terms($post->ID, $taxonomy);

			$tags_slugs = [];

			foreach ($tags as $tag) {
				$tags_slugs[$tag->term_id] = $tag;
			}

			$post->tags = $tags_slugs;
		}
	}

	public function query_posts()
	{

		$query_args = [
			'posts_per_page' => -1,
		];

		/** @var Module_Query $elementor_query */
		$elementor_query = Module_Query::instance();
		$this->_query = $elementor_query->get_query($this, 'posts', $query_args, []);
	}

	public function render()
	{
		$this->query_posts();

		$wp_query = $this->get_query();

		if (!$wp_query->found_posts) {
			return;
		}

		$this->get_posts_tags();

		$this->render_loop_header();

		// var_dump($wp_query);
		// count($wp_query->have_posts());

		while ($wp_query->have_posts()) {
			$wp_query->the_post();

			$this->render_post();
		}

		$this->render_loop_footer();

		wp_reset_postdata();
	}

	protected function render_thumbnail()
	{
		$settings = $this->get_settings();

		$settings['thumbnail_size'] = [
			'id' => get_post_thumbnail_id(),
		];

		echo $thumbnail_html = Group_Control_Image_Size::get_attachment_image_html($settings, 'thumbnail_size');
	}

	protected function render_filter_menu()
	{
		$taxonomy = $this->get_settings('taxonomy');

		if (!$taxonomy) {
			return;
		}

		$terms = [];

		foreach ($this->_query->posts as $post) {
			$terms += $post->tags;
		}

		if (empty($terms)) {
			return;
		}

		usort($terms, function ($a, $b) {
			return strcmp($a->name, $b->name);
		});

		?>
		<ul class="elementor-portfolio__filters">
			<li class="elementor-portfolio__filter elementor-active" data-filter="__all"><?php echo __('All', 'elementor-pro'); ?></li>
			<?php foreach ($terms as $term) { ?>
				<li class="elementor-portfolio__filter" data-filter="<?php echo esc_attr($term->term_id); ?>"><?php echo $term->name; ?></li>
			<?php } ?>
		</ul>
	<?php
		}

		protected function render_title()
		{
			the_title();
		}

		protected function render_categories_names()
		{
			global $post;

			if (!$post->tags) {
				return;
			}

			$separator = '<span class="elementor-portfolio-item__tags__separator"></span>';

			$tags_array = [];

			foreach ($post->tags as $tag) {
				$tags_array[] = '<span class="elementor-portfolio-item__tags__tag">' . $tag->name . '</span>';
			}

			?>
		<div class="elementor-portfolio-item__tags">
			<?php echo implode($separator, $tags_array); ?>
		</div>
	<?php
		}

		protected function render_post_header()
		{
			global $post;

			$tags_classes = array_map(function ($tag) {
				return 'elementor-filter-' . $tag->term_id;
			}, $post->tags);

			$classes = [
				'elementor-portfolio-item',
				'elementor-post',
				implode(' ', $tags_classes),
			];

			?>
		<article <?php post_class($classes); ?>>
			<a class="elementor-post__thumbnail__link" href="<?php echo get_permalink(); ?>">
			<?php
				}

				protected function render_post_footer()
				{
					?>
			</a>
		</article>
	<?php
		}

		protected function render_overlay_header()
		{
			?>
		<div class="elementor-portfolio-item__overlay">
		<?php
			}

			protected function render_overlay_footer()
			{
				?>
		</div>
	<?php
		}

		protected function render_loop_header()
		{
			if ($this->get_settings('show_filter_bar')) {
				$this->render_filter_menu();
			}
			echo '
				<div class="swiper-container moresailing-testimonial">
				<div class="swiper-wrapper">
			';
		}

		protected function render_loop_footer()
		{
			echo 	'</div>
						<div class="elementor-swiper-button elementor-swiper-button-prev">
							<i class="eicon-chevron-left" aria-hidden="true"></i>
							<span class="elementor-screen-only">' . _e('Previous', 'elementor') . '</span>
						</div>
						<div class="elementor-swiper-button elementor-swiper-button-next">
							<i class="eicon-chevron-right" aria-hidden="true"></i>
							<span class="elementor-screen-only">' . _e('Next', 'elementor') . '</span>
						</div>
					</div>';
		}

		protected function render_post()
		{ ?>

		<div class="swiper-slide single-day">
			<div class="single-day-image" style="position:relative;">
				<?php $this->render_thumbnail(); ?>
				<p style="position:absolute;bottom: 0;background: white;padding: 10px;"><?php echo strip_tags(get_the_excerpt()); ?></p>
			</div>
			<div class="single-day-content">
				<h3><?php the_title(); ?></h3>
				<p><?php echo strip_tags(get_the_content()); ?></p>
			</div>
		</div>
<?php }

	public function render_plain_content()
	{ }
}
// $this->render_post_header();
		// $this->render_thumbnail();
		// $this->render_overlay_header();
		// $this->render_title();
		// $this->render_categories_names();
		// $this->render_overlay_footer();
		// $this->render_post_footer();
