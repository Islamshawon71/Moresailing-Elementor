<?php

namespace ElementorMoresailing\Widgets;

use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Border;
use Elementor\Scheme_Typography;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

/**
 * Elementor image carousel widget.
 *
 * Elementor widget that displays a set of images in a rotating carousel or
 * slider.
 *
 * @since 1.0.0
 */
class FacebookCommentSlider extends Widget_Base
{

	/**
	 * Get widget name.
	 *
	 * Retrieve image carousel widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name()
	{
		return 'image-carousel';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve image carousel widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title()
	{
		return __('Facebook Review', 'elementor');
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve image carousel widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon()
	{
		return 'eicon-facebook-comments';
	}

	/**
	 * Get widget keywords.
	 *
	 * Retrieve the list of keywords the widget belongs to.
	 *
	 * @since 2.1.0
	 * @access public
	 *
	 * @return array Widget keywords.
	 */
	public function get_keywords()
	{
		return ['image', 'photo', 'visual', 'carousel', 'slider'];
	}

	/**
	 * Register image carousel widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function _register_controls()
	{
		$this->start_controls_section(
			'section_image_carousel',
			[
				'label' => __('Facebook Carousel', 'elementor'),
			]
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'thumbnail', // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.
				'separator' => 'none',
			]
		);

		$slides_to_show = range(1, 10);
		$slides_to_show = array_combine($slides_to_show, $slides_to_show);

		$this->add_responsive_control(
			'slides_to_show',
			[
				'label' => __('Slides to Show', 'elementor'),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'' => __('Default', 'elementor'),
				] + $slides_to_show,
				'frontend_available' => true,
			]
		);

		$this->add_responsive_control(
			'slides_to_scroll',
			[
				'label' => __('Slides to Scroll', 'elementor'),
				'type' => Controls_Manager::SELECT,
				'description' => __('Set how many slides are scrolled per swipe.', 'elementor'),
				'options' => [
					'' => __('Default', 'elementor'),
				] + $slides_to_show,
				'condition' => [
					'slides_to_show!' => '1',
				],
				'frontend_available' => true,
			]
		);

		$this->add_control(
			'image_stretch',
			[
				'label' => __('Image Stretch', 'elementor'),
				'type' => Controls_Manager::SELECT,
				'default' => 'no',
				'options' => [
					'no' => __('No', 'elementor'),
					'yes' => __('Yes', 'elementor'),
				],
			]
		);

		$this->add_control(
			'navigation',
			[
				'label' => __('Navigation', 'elementor'),
				'type' => Controls_Manager::SELECT,
				'default' => 'both',
				'options' => [
					'both' => __('Arrows and Dots', 'elementor'),
					'arrows' => __('Arrows', 'elementor'),
					'dots' => __('Dots', 'elementor'),
					'none' => __('None', 'elementor'),
				],
				'frontend_available' => true,
			]
		);

		$this->add_control(
			'link_to',
			[
				'label' => __('Link', 'elementor'),
				'type' => Controls_Manager::SELECT,
				'default' => 'none',
				'options' => [
					'none' => __('None', 'elementor'),
					'file' => __('Media File', 'elementor'),
					'custom' => __('Custom URL', 'elementor'),
				],
			]
		);

		$this->add_control(
			'link',
			[
				'label' => __('Link', 'elementor'),
				'type' => Controls_Manager::URL,
				'placeholder' => __('https://your-link.com', 'elementor'),
				'condition' => [
					'link_to' => 'custom',
				],
				'show_label' => false,
			]
		);

		$this->add_control(
			'open_lightbox',
			[
				'label' => __('Lightbox', 'elementor'),
				'type' => Controls_Manager::SELECT,
				'default' => 'default',
				'options' => [
					'default' => __('Default', 'elementor'),
					'yes' => __('Yes', 'elementor'),
					'no' => __('No', 'elementor'),
				],
				'condition' => [
					'link_to' => 'file',
				],
			]
		);

		$this->add_control(
			'caption_type',
			[
				'label' => __('Caption', 'elementor'),
				'type' => Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					'' => __('None', 'elementor'),
					'title' => __('Title', 'elementor'),
					'caption' => __('Caption', 'elementor'),
					'description' => __('Description', 'elementor'),
				],
			]
		);

		$this->add_control(
			'view',
			[
				'label' => __('View', 'elementor'),
				'type' => Controls_Manager::HIDDEN,
				'default' => 'traditional',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_additional_options',
			[
				'label' => __('Additional Options', 'elementor'),
			]
		);

		$this->add_control(
			'pause_on_hover',
			[
				'label' => __('Pause on Hover', 'elementor'),
				'type' => Controls_Manager::SELECT,
				'default' => 'yes',
				'options' => [
					'yes' => __('Yes', 'elementor'),
					'no' => __('No', 'elementor'),
				],
				'frontend_available' => true,
			]
		);

		$this->add_control(
			'autoplay',
			[
				'label' => __('Autoplay', 'elementor'),
				'type' => Controls_Manager::SELECT,
				'default' => 'yes',
				'options' => [
					'yes' => __('Yes', 'elementor'),
					'no' => __('No', 'elementor'),
				],
				'frontend_available' => true,
			]
		);

		$this->add_control(
			'autoplay_speed',
			[
				'label' => __('Autoplay Speed', 'elementor'),
				'type' => Controls_Manager::NUMBER,
				'default' => 5000,
				'frontend_available' => true,
			]
		);

		$this->add_control(
			'infinite',
			[
				'label' => __('Infinite Loop', 'elementor'),
				'type' => Controls_Manager::SELECT,
				'default' => 'yes',
				'options' => [
					'yes' => __('Yes', 'elementor'),
					'no' => __('No', 'elementor'),
				],
				'frontend_available' => true,
			]
		);

		$this->add_control(
			'effect',
			[
				'label' => __('Effect', 'elementor'),
				'type' => Controls_Manager::SELECT,
				'default' => 'slide',
				'options' => [
					'slide' => __('Slide', 'elementor'),
					'fade' => __('Fade', 'elementor'),
				],
				'condition' => [
					'slides_to_show' => '1',
				],
				'frontend_available' => true,
			]
		);

		$this->add_control(
			'speed',
			[
				'label' => __('Animation Speed', 'elementor'),
				'type' => Controls_Manager::NUMBER,
				'default' => 500,
				'frontend_available' => true,
			]
		);

		$this->add_control(
			'direction',
			[
				'label' => __('Direction', 'elementor'),
				'type' => Controls_Manager::SELECT,
				'default' => 'ltr',
				'options' => [
					'ltr' => __('Left', 'elementor'),
					'rtl' => __('Right', 'elementor'),
				],
				'frontend_available' => true,
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_navigation',
			[
				'label' => __('Navigation', 'elementor'),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'navigation' => ['arrows', 'dots', 'both'],
				],
			]
		);

		$this->add_control(
			'heading_style_arrows',
			[
				'label' => __('Arrows', 'elementor'),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'navigation' => ['arrows', 'both'],
				],
			]
		);

		$this->add_control(
			'arrows_position',
			[
				'label' => __('Position', 'elementor'),
				'type' => Controls_Manager::SELECT,
				'default' => 'inside',
				'options' => [
					'inside' => __('Inside', 'elementor'),
					'outside' => __('Outside', 'elementor'),
				],
				'prefix_class' => 'elementor-arrows-position-',
				'condition' => [
					'navigation' => ['arrows', 'both'],
				],
			]
		);

		$this->add_control(
			'arrows_size',
			[
				'label' => __('Size', 'elementor'),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 20,
						'max' => 60,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-swiper-button.elementor-swiper-button-prev, {{WRAPPER}} .elementor-swiper-button.elementor-swiper-button-next' => 'font-size: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'navigation' => ['arrows', 'both'],
				],
			]
		);

		$this->add_control(
			'arrows_color',
			[
				'label' => __('Color', 'elementor'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-swiper-button.elementor-swiper-button-prev, {{WRAPPER}} .elementor-swiper-button.elementor-swiper-button-next' => 'color: {{VALUE}};',
				],
				'condition' => [
					'navigation' => ['arrows', 'both'],
				],
			]
		);

		$this->add_control(
			'heading_style_dots',
			[
				'label' => __('Dots', 'elementor'),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'navigation' => ['dots', 'both'],
				],
			]
		);

		$this->add_control(
			'dots_position',
			[
				'label' => __('Position', 'elementor'),
				'type' => Controls_Manager::SELECT,
				'default' => 'outside',
				'options' => [
					'outside' => __('Outside', 'elementor'),
					'inside' => __('Inside', 'elementor'),
				],
				'prefix_class' => 'elementor-pagination-position-',
				'condition' => [
					'navigation' => ['dots', 'both'],
				],
			]
		);

		$this->add_control(
			'dots_size',
			[
				'label' => __('Size', 'elementor'),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 5,
						'max' => 10,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .swiper-pagination-bullet' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'navigation' => ['dots', 'both'],
				],
			]
		);

		$this->add_control(
			'dots_color',
			[
				'label' => __('Color', 'elementor'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .swiper-pagination-bullet' => 'background: {{VALUE}};',
				],
				'condition' => [
					'navigation' => ['dots', 'both'],
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_image',
			[
				'label' => __('Image', 'elementor'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'gallery_vertical_align',
			[
				'label' => __('Vertical Align', 'elementor'),
				'type' => Controls_Manager::CHOOSE,
				'label_block' => false,
				'options' => [
					'flex-start' => [
						'title' => __('Start', 'elementor'),
						'icon' => 'eicon-v-align-top',
					],
					'center' => [
						'title' => __('Center', 'elementor'),
						'icon' => 'eicon-v-align-middle',
					],
					'flex-end' => [
						'title' => __('End', 'elementor'),
						'icon' => 'eicon-v-align-bottom',
					],
				],
				'condition' => [
					'slides_to_show!' => '1',
				],
				'selectors' => [
					'{{WRAPPER}} .swiper-wrapper' => 'display: flex; align-items: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'image_spacing',
			[
				'label' => __('Spacing', 'elementor'),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'' => __('Default', 'elementor'),
					'custom' => __('Custom', 'elementor'),
				],
				'default' => '',
				'condition' => [
					'slides_to_show!' => '1',
				],
			]
		);

		$this->add_control(
			'image_spacing_custom',
			[
				'label' => __('Image Spacing', 'elementor'),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 100,
					],
				],
				'default' => [
					'size' => 20,
				],
				'show_label' => false,
				'condition' => [
					'image_spacing' => 'custom',
					'slides_to_show!' => '1',
				],
				'frontend_available' => true,
				'render_type' => 'none',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'image_border',
				'selector' => '{{WRAPPER}} .elementor-image-carousel-wrapper .elementor-image-carousel .swiper-slide-image',
				'separator' => 'before',
			]
		);

		$this->add_control(
			'image_border_radius',
			[
				'label' => __('Border Radius', 'elementor'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors' => [
					'{{WRAPPER}} .elementor-image-carousel-wrapper .elementor-image-carousel .swiper-slide-image' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_caption',
			[
				'label' => __('Caption', 'elementor'),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'caption_type!' => '',
				],
			]
		);

		$this->add_control(
			'caption_align',
			[
				'label' => __('Alignment', 'elementor'),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __('Left', 'elementor'),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => __('Center', 'elementor'),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => __('Right', 'elementor'),
						'icon' => 'eicon-text-align-right',
					],
					'justify' => [
						'title' => __('Justified', 'elementor'),
						'icon' => 'eicon-text-align-justify',
					],
				],
				'default' => 'center',
				'selectors' => [
					'{{WRAPPER}} .elementor-image-carousel-caption' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'caption_text_color',
			[
				'label' => __('Text Color', 'elementor'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .elementor-image-carousel-caption' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'caption_typography',
				'scheme' => Scheme_Typography::TYPOGRAPHY_4,
				'selector' => '{{WRAPPER}} .elementor-image-carousel-caption',
			]
		);

		$this->end_controls_section();
	}

	/**
	 * Render image carousel widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render()
	{
		$settings = $this->get_settings_for_display();
		global $wpdb;
		$total_reviews = $wpdb->get_results("Select * from  {$wpdb->prefix}fb_comments ORDER BY RAND() ");
		foreach ($total_reviews as $total_review) {

			$image_html = '<img class="swiper-slide-image" style="width: 95px; height: 95px; border-radius: 50%; border: 4px solid #999;" src="' . esc_attr($total_review->profile) . '" alt="' . esc_attr($total_review->profile) . '" />';
			$slide_html = '<div class="swiper-slide" style="background-color:white;height: auto;min-height: 600px;padding-top: 50px;"><figure class="swiper-slide-inner">' . $image_html;


			$slide_html .= '<figcaption class="elementor-image-carousel-caption">
            
            <h3 class="his-name" style="font-size: 16px; letter-spacing: 1px; margin-bottom: 20px; margin-top: 15px;">' . $total_review->name . '</h3>
            <div class="great-point-icon"> 
                <i class="fa fa-star" style="color: #ff7c01;font-size:16px;"></i> 
                <i class="fa fa-star" style="color: #ff7c01;font-size:16px;"></i> 
                <i class="fa fa-star" style="color: #ff7c01;font-size:16px;"></i> 
                <i class="fa fa-star" style="color: #ff7c01;font-size:16px;"></i> 
                <i class="fa fa-star" style="color: #ff7c01;font-size:16px;"></i>  
            </div>
            <p style="padding: 0 40px; color: #08262e;  font-size: 16px; margin-bottom: 5px;line-height: 26px;" >' . wp_trim_words($this->remove_emoji($total_review->message), 39, '...') . '<a target="_blank" href="https://facebook.com/' . $total_review->comment_id . '" tabindex="0"> See More</a></p>
            <p style="color: #b0afaf; font-size: 13px; margin-bottom: 5px; line-height: 26px; padding: 0 40px;">' . $total_review->time . '</p>
            <p style="color: #b0afaf; font-size: 13px; margin-bottom: 5px; line-height: 26px; padding: 0 40px;">
                <i class="fa fa-thumbs-up"></i> ' . $total_review->likes . ' <i  class="fa fa-comments"></i> ' . $total_review->comments . '
            </p>
            </figcaption>';
			$slide_html .= '</figure>';

			$slide_html .= '</div>';

			$slides[] = $slide_html;
		}

		$this->add_render_attribute([
			'carousel' => [
				'class' => 'elementor-image-carousel swiper-wrapper',
			],
			'carousel-wrapper' => [
				'class' => 'elementor-image-carousel-wrapper swiper-container',
				'dir' => $settings['direction'],
			],
		]);


		?>
		<div <?php echo $this->get_render_attribute_string('carousel-wrapper'); ?>>
			<div <?php echo $this->get_render_attribute_string('carousel'); ?>>
				<?php echo implode('', $slides); ?>
			</div>
			<div class="elementor-swiper-button elementor-swiper-button-prev">
				<i class="eicon-chevron-left" aria-hidden="true"></i>
				<span class="elementor-screen-only"><?php _e('Previous', 'elementor'); ?></span>
			</div>
			<div class="elementor-swiper-button elementor-swiper-button-next">
				<i class="eicon-chevron-right" aria-hidden="true"></i>
				<span class="elementor-screen-only"><?php _e('Next', 'elementor'); ?></span>
			</div>
		</div>
<?php
	}

	/**
	 * Retrieve image carousel link URL.
	 *
	 * @since 1.0.0
	 * @access private
	 *
	 * @param array $attachment
	 * @param object $instance
	 *
	 * @return array|string|false An array/string containing the attachment URL, or false if no link.
	 */
	private function get_link_url($attachment, $instance)
	{
		if ('none' === $instance['link_to']) {
			return false;
		}

		if ('custom' === $instance['link_to']) {
			if (empty($instance['link']['url'])) {
				return false;
			}

			return $instance['link'];
		}

		return [
			'url' => wp_get_attachment_url($attachment['id']),
		];
	}

	/**
	 * Retrieve image carousel caption.
	 *
	 * @since 1.2.0
	 * @access private
	 *
	 * @param array $attachment
	 *
	 * @return string The caption of the image.
	 */
	private function get_image_caption($attachment)
	{
		$caption_type = $this->get_settings_for_display('caption_type');

		if (empty($caption_type)) {
			return '';
		}

		$attachment_post = get_post($attachment['id']);

		if ('caption' === $caption_type) {
			return $attachment_post->post_excerpt;
		}

		if ('title' === $caption_type) {
			return $attachment_post->post_title;
		}

		return $attachment_post->post_content;
	}

	public function remove_emoji($text)
	{
		return str_replace('�', '', $text);
		// return $text;
	}
}
