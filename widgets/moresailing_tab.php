<?php

namespace ElementorMoresailing\Widgets;

use Elementor\Scheme_Color;
use Elementor\Group_Control_Typography;
use Elementor\Icons_Manager;
use Elementor\Scheme_Typography;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

/**
 * Elementor Hello World
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class Moresailing_Tab extends Widget_Base
{

	/**
	 * Retrieve the widget name.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name()
	{
		return 'moresailing-tab';
	}

	/**
	 * Retrieve the widget title.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title()
	{
		return __('Moresailing Tab', 'elementor-moresailing');
	}

	/**
	 * Retrieve the widget icon.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon()
	{
		return 'eicon-posts-ticker';
	}

	/**
	 * Retrieve the list of categories the widget belongs to.
	 *
	 * Used to determine where to display the widget in the editor.
	 *
	 * Note that currently Elementor supports only one category.
	 * When multiple categories passed, Elementor uses the first one.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories()
	{
		return ['moresailing'];
	}

	/**
	 * Retrieve the list of scripts the widget depended on.
	 *
	 * Used to set scripts dependencies required to run the widget.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return array Widget scripts dependencies.
	 */
	public function get_script_depends()
	{
		return ['elementor-moresailing'];
	}

	/**
	 * Register the widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function _register_controls()
	{
		$this->start_controls_section(
			'section_icon',
			[
				'label' => __('Icon List', 'elementor'),
			]
		);

		$this->add_control(
			'view',
			[
				'label' => __('Layout', 'elementor'),
				'type' => Controls_Manager::CHOOSE,
				'default' => 'traditional',
				'options' => [
					'traditional' => [
						'title' => __('Default', 'elementor'),
						'icon' => 'eicon-editor-list-ul',
					],
					'inline' => [
						'title' => __('Inline', 'elementor'),
						'icon' => 'eicon-ellipsis-h',
					],
				],
				'render_type' => 'template',
				'classes' => 'elementor-control-start-end',
				'label_block' => false,
				'style_transfer' => true,
				'prefix_class' => 'elementor-icon-list--layout-',
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'text',
			[
				'label' => __('Text', 'elementor'),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'placeholder' => __('List Item', 'elementor'),
				'default' => __('List Item', 'elementor'),
				'dynamic' => [
					'active' => true,
				],
			]
		);
		$repeater->add_control(
			'subtext',
			[
				'label' => __('Sub Text', 'elementor'),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'placeholder' => __('List Item', 'elementor'),
				'default' => __('List Item', 'elementor'),
				'dynamic' => [
					'active' => true,
				],
			]
		);

		$repeater->add_control(
			'selected_icon',
			[
				'label' => __('Icon', 'elementor'),
				'type' => Controls_Manager::ICONS,
				'label_block' => true,
				'default' => [
					'value' => 'fas fa-check',
					'library' => 'fa-solid',
				],
				'fa4compatibility' => 'icon',
			]
		);

		$repeater->add_control(
			'link',
			[
				'label' => __('Link', 'elementor'),
				'type' => Controls_Manager::URL,
				'dynamic' => [
					'active' => true,
				],
				'label_block' => true,
				'placeholder' => __('https://your-link.com', 'elementor'),
			]
		);

		$this->add_control(
			'icon_list',
			[
				'label' => '',
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'text' => __('List Item #1', 'elementor'),
						'selected_icon' => [
							'value' => 'fas fa-check',
							'library' => 'fa-solid',
						],
					],
					[
						'text' => __('List Item #2', 'elementor'),
						'selected_icon' => [
							'value' => 'fas fa-times',
							'library' => 'fa-solid',
						],
					],
					[
						'text' => __('List Item #3', 'elementor'),
						'selected_icon' => [
							'value' => 'fas fa-dot-circle',
							'library' => 'fa-solid',
						],
					],
				],
				'title_field' => '{{{ elementor.helpers.renderIcon( this, selected_icon, {}, "i", "panel" ) || \'<i class="{{ icon }}" aria-hidden="true"></i>\' }}} {{{ text }}}',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_icon_list',
			[
				'label' => __('List', 'elementor'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'space_between',
			[
				'label' => __('Space Between', 'elementor'),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-icon-list-items:not(.elementor-inline-items) .elementor-icon-list-item:not(:last-child)' => 'padding-bottom: calc({{SIZE}}{{UNIT}}/2)',
					'{{WRAPPER}} .elementor-icon-list-items:not(.elementor-inline-items) .elementor-icon-list-item:not(:first-child)' => 'margin-top: calc({{SIZE}}{{UNIT}}/2)',
					'{{WRAPPER}} .elementor-icon-list-items.elementor-inline-items .elementor-icon-list-item' => 'margin-right: calc({{SIZE}}{{UNIT}}/2); margin-left: calc({{SIZE}}{{UNIT}}/2)',
					'{{WRAPPER}} .elementor-icon-list-items.elementor-inline-items' => 'margin-right: calc(-{{SIZE}}{{UNIT}}/2); margin-left: calc(-{{SIZE}}{{UNIT}}/2)',
					'body.rtl {{WRAPPER}} .elementor-icon-list-items.elementor-inline-items .elementor-icon-list-item:after' => 'left: calc(-{{SIZE}}{{UNIT}}/2)',
					'body:not(.rtl) {{WRAPPER}} .elementor-icon-list-items.elementor-inline-items .elementor-icon-list-item:after' => 'right: calc(-{{SIZE}}{{UNIT}}/2)',
				],
			]
		);

		$this->add_responsive_control(
			'icon_align',
			[
				'label' => __('Alignment', 'elementor'),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __('Left', 'elementor'),
						'icon' => 'eicon-h-align-left',
					],
					'center' => [
						'title' => __('Center', 'elementor'),
						'icon' => 'eicon-h-align-center',
					],
					'right' => [
						'title' => __('Right', 'elementor'),
						'icon' => 'eicon-h-align-right',
					],
				],
				'prefix_class' => 'elementor%s-align-',
			]
		);

		$this->add_control(
			'divider',
			[
				'label' => __('Divider', 'elementor'),
				'type' => Controls_Manager::SWITCHER,
				'label_off' => __('Off', 'elementor'),
				'label_on' => __('On', 'elementor'),
				'selectors' => [
					'{{WRAPPER}} .elementor-icon-list-item:not(:last-child):after' => 'content: ""',
				],
				'separator' => 'before',
			]
		);

		$this->add_control(
			'divider_style',
			[
				'label' => __('Style', 'elementor'),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'solid' => __('Solid', 'elementor'),
					'double' => __('Double', 'elementor'),
					'dotted' => __('Dotted', 'elementor'),
					'dashed' => __('Dashed', 'elementor'),
				],
				'default' => 'solid',
				'condition' => [
					'divider' => 'yes',
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-icon-list-items:not(.elementor-inline-items) .elementor-icon-list-item:not(:last-child):after' => 'border-top-style: {{VALUE}}',
					'{{WRAPPER}} .elementor-icon-list-items.elementor-inline-items .elementor-icon-list-item:not(:last-child):after' => 'border-left-style: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'divider_weight',
			[
				'label' => __('Weight', 'elementor'),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 1,
				],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 20,
					],
				],
				'condition' => [
					'divider' => 'yes',
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-icon-list-items:not(.elementor-inline-items) .elementor-icon-list-item:not(:last-child):after' => 'border-top-width: {{SIZE}}{{UNIT}}',
					'{{WRAPPER}} .elementor-inline-items .elementor-icon-list-item:not(:last-child):after' => 'border-left-width: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_control(
			'divider_width',
			[
				'label' => __('Width', 'elementor'),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'unit' => '%',
				],
				'condition' => [
					'divider' => 'yes',
					'view!' => 'inline',
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-icon-list-item:not(:last-child):after' => 'width: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_control(
			'divider_height',
			[
				'label' => __('Height', 'elementor'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['%', 'px'],
				'default' => [
					'unit' => '%',
				],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 100,
					],
					'%' => [
						'min' => 1,
						'max' => 100,
					],
				],
				'condition' => [
					'divider' => 'yes',
					'view' => 'inline',
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-icon-list-item:not(:last-child):after' => 'height: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_control(
			'divider_color',
			[
				'label' => __('Color', 'elementor'),
				'type' => Controls_Manager::COLOR,
				'default' => '#ddd',
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_3,
				],
				'condition' => [
					'divider' => 'yes',
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-icon-list-item:not(:last-child):after' => 'border-color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_icon_style',
			[
				'label' => __('Icon', 'elementor'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'icon_color',
			[
				'label' => __('Color', 'elementor'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .elementor-icon-list-icon i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .elementor-icon-list-icon svg' => 'fill: {{VALUE}};',
				],
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_1,
				],
			]
		);

		$this->add_control(
			'icon_color_hover',
			[
				'label' => __('Hover', 'elementor'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .elementor-icon-list-item:hover .elementor-icon-list-icon i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .elementor-icon-list-item:hover .elementor-icon-list-icon svg' => 'fill: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'icon_size',
			[
				'label' => __('Size', 'elementor'),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 14,
				],
				'range' => [
					'px' => [
						'min' => 6,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-icon-list-icon' => 'width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .elementor-icon-list-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'icon_self_align',
			[
				'label' => __('Alignment', 'elementor'),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __('Left', 'elementor'),
						'icon' => 'eicon-h-align-left',
					],
					'center' => [
						'title' => __('Center', 'elementor'),
						'icon' => 'eicon-h-align-center',
					],
					'right' => [
						'title' => __('Right', 'elementor'),
						'icon' => 'eicon-h-align-right',
					],
				],
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .elementor-icon-list-icon' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_text_style',
			[
				'label' => __('Text', 'elementor'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'text_color',
			[
				'label' => __('Text Color', 'elementor'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .elementor-icon-list-text' => 'color: {{VALUE}};',
				],
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_2,
				],
			]
		);

		$this->add_control(
			'text_color_hover',
			[
				'label' => __('Hover', 'elementor'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .elementor-icon-list-item:hover .elementor-icon-list-text' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'text_indent',
			[
				'label' => __('Text Indent', 'elementor'),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-icon-list-text' => is_rtl() ? 'padding-right: {{SIZE}}{{UNIT}};' : 'padding-left: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'icon_typography',
				'selector' => '{{WRAPPER}} .elementor-icon-list-item',
				'scheme' => Scheme_Typography::TYPOGRAPHY_3,
			]
		);

		$this->end_controls_section();
	}
	/**
	 * Render the widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function render()
	{
		$settings = $this->get_settings_for_display();
		$fallback_defaults = [
			'fa fa-check',
			'fa fa-times',
			'fa fa-dot-circle-o',
		];

		$this->add_render_attribute('icon_list', 'class', 'elementor-icon-list-items moresailing-tab-items');
		$this->add_render_attribute('list_item', 'class', 'elementor-icon-list-item');

		if ('inline' === $settings['view']) {
			$this->add_render_attribute('icon_list', 'class', 'elementor-inline-items ');
			$this->add_render_attribute('list_item', 'class', 'elementor-inline-item');
		}
		?>
		<ul <?php echo $this->get_render_attribute_string('icon_list'); ?>>
			<?php
					foreach ($settings['icon_list'] as $index => $item) :
						$repeater_setting_key = $this->get_repeater_setting_key('text', 'icon_list', $index);

						$this->add_render_attribute($repeater_setting_key, 'class', 'elementor-icon-list-text');

						$this->add_inline_editing_attributes($repeater_setting_key);
						$migration_allowed = Icons_Manager::is_migration_allowed();
						?>
				<li class="elementor-icon-list-item moresailing-tabs<?php echo $index + 1; ?>" data-tab-id="<?php echo $index + 1; ?>">
					<?php
								if (!empty($item['link']['url'])) {
									$link_key = 'link_' . $index;

									$this->add_render_attribute($link_key, 'href', $item['link']['url']);

									if ($item['link']['is_external']) {
										$this->add_render_attribute($link_key, 'target', '_blank');
									}

									if ($item['link']['nofollow']) {
										$this->add_render_attribute($link_key, 'rel', 'nofollow');
									}

									echo '<a ' . $this->get_render_attribute_string($link_key) . '>';
								}
								?>
					<div class="elementor-icon-list-text-container">
						<span class="subText"><?php echo $item['subtext']; ?></span>
						<span <?php echo $this->get_render_attribute_string($repeater_setting_key); ?>><?php echo $item['text']; ?></span>
					</div>
					<?php

								// add old default
								if (!isset($item['icon']) && !$migration_allowed) {
									$item['icon'] = isset($fallback_defaults[$index]) ? $fallback_defaults[$index] : 'fa fa-check';
								}

								$migrated = isset($item['__fa4_migrated']['selected_icon']);
								$is_new = !isset($item['icon']) && $migration_allowed;
								if (!empty($item['icon']) || (!empty($item['selected_icon']['value']) && $is_new)) :
									?>
						<span class="elementor-icon-list-icon">
							<?php
											if ($is_new || $migrated) {
												Icons_Manager::render_icon($item['selected_icon'], ['aria-hidden' => 'true']);
											} else { ?>
								<i class="<?php echo esc_attr($item['icon']); ?>" aria-hidden="true"></i>
							<?php } ?>
						</span>
					<?php endif; ?>

					<?php if (!empty($item['link']['url'])) : ?>
						</a>
					<?php endif; ?>
				</li>
			<?php
					endforeach;
					?>
		</ul>
	<?php
		}
		/**
		 * Render the widget output in the editor.
		 *
		 * Written as a Backbone JavaScript template and used to generate the live preview.
		 *
		 * @since 1.0.0
		 *
		 * @access protected
		 */
		protected function _content_template()
		{
			?>
		<# view.addRenderAttribute( 'icon_list' , 'class' , 'elementor-icon-list-items' ); view.addRenderAttribute( 'list_item' , 'class' , 'elementor-icon-list-item' ); if ( 'inline'==settings.view ) { view.addRenderAttribute( 'icon_list' , 'class' , 'elementor-inline-items' ); view.addRenderAttribute( 'list_item' , 'class' , 'elementor-inline-item' ); } var iconsHTML={}, migrated={}; #>
			<# if ( settings.icon_list ) { #>
				<ul {{{ view.getRenderAttributeString( 'icon_list' ) }}}>
					<# _.each( settings.icon_list, function( item, index ) { var iconTextKey=view.getRepeaterSettingKey( 'text' , 'icon_list' , index ); view.addRenderAttribute( iconTextKey, 'class' , 'elementor-icon-list-text' ); view.addInlineEditingAttributes( iconTextKey ); #>

						<li {{{ view.getRenderAttributeString( 'list_item' ) }}}>
							<# if ( item.link && item.link.url ) { #>
								<a href="{{ item.link.url }}">
									<# } #>
										<# if ( item.icon || item.selected_icon.value ) { #>
											<span class="elementor-icon-list-icon">
												<# iconsHTML[ index ]=elementor.helpers.renderIcon( view, item.selected_icon, { 'aria-hidden' : true }, 'i' , 'object' ); migrated[ index ]=elementor.helpers.isIconMigrated( item, 'selected_icon' ); if ( iconsHTML[ index ] && iconsHTML[ index ].rendered && ( ! item.icon || migrated[ index ] ) ) { #>
													{{{ iconsHTML[ index ].value }}}
													<# } else { #>
														<i class="{{ item.icon }}" aria-hidden="true"></i>
														<# } #>
											</span>
											<# } #>
												<span {{{ view.getRenderAttributeString( iconTextKey ) }}}>{{{ item.text }}}</span>
												<# if ( item.link && item.link.url ) { #>
								</a>
								<# } #>
						</li>
						<# } ); #>
				</ul>
				<# } #>

			<?php
				}

				public function on_import($element)
				{
					return Icons_Manager::on_import_migration($element, 'icon', 'selected_icon', true);
				}
			}
