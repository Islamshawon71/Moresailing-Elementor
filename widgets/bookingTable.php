<?php

namespace ElementorMoresailing\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Elementor HTML widget.
 *
 * Elementor widget that insert a custom HTML code into the page.
 *
 * @since 1.0.0
 */
class BookingTable extends Widget_Base
{

    /**
     * Get widget name.
     *
     * Retrieve HTML widget name.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name()
    {
        return 'booking-table';
    }

    /**
     * Get widget title.
     *
     * Retrieve HTML widget title.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title()
    {
        return __('Moresailing Booking', 'elementor');
    }

    /**
     * Get widget icon.
     *
     * Retrieve HTML widget icon.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon()
    {
        return 'eicon-table';
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
        return ['table', 'moresailing'];
    }

    /**
     * Register HTML widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function _register_controls()
    {
        $this->start_controls_section(
            'section_title',
            [
                'label' => __('Select Destination', 'elementor'),
            ]
        );
        $this->add_control(
            'tourdestination',
            [
                'label' => __('Destination', 'elementor'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'Alla-destinationer' => __('Alla destinationer', 'elementor'),
                    'Kroatien' => __('Kroatien', 'elementor'),
                    'Karibien' => __('Karibien', 'elementor'),
                    'Grekland' => __('Grekland', 'elementor'),
                    'Italien' => __('Italien', 'elementor'),
                ],
                'default' => 'Alla-destinationer',
                'selectors' => [
                    '{{WRAPPER}} table td, table th ' => 'color: #08262e; font-family: Muli; font-size: 16px; background-color: #fff; border-top: 1px solid #dde1e4; border-bottom: 1px solid #dde1e4; border-left: none; border-right: none; text-align: center;',
                    '{{WRAPPER}} .filter-item ' => 'outline: none; font-size: 14px; font-family: Muli;max-width: 100%; display: block; width: 100%; padding-left: 10px; margin-bottom: 10px;font-size: 14px; line-height: 1.5; color: #495057; background-color: #fff; background-clip: padding-box; border: 1px solid #ced4da; border-radius: .25rem; transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out; height: 40px;',
                    '{{WRAPPER}} .tour-table-filter ' => 'display: flex; margin-bottom: 20px; justify-content: space-around; width: 100%; max-width: 100%;',
                    '{{WRAPPER}} .tour-table-filter > div' => 'width: 100%;margin-right: 30px;',
                    '{{WRAPPER}} .tour-table-filter > div:last-child' => 'margin-right: 0px;',
                    '{{WRAPPER}} .tour-table-filter i.eicon-calendar' => 'position: absolute;top: 8px;right: 10px;color: #0073aa;',
                    '{{WRAPPER}} .tour-table-filter .quantity.buttons_added' => 'height: 122px;width: 254px; border: 1px solid #d4dde3; border-radius: 0 0 2px 2px; background-color: #fff; padding:20px 0px; display: none; position: absolute; z-index: 99; margin-top: -10px;',
                    '{{WRAPPER}} .tour-table-filter .buttons_added button' => 'height: 26px; width: 64px; color: #377cb3; font-size: 16px; line-height: 26px; background: #fff; border: none; float: right; margin-right: 20px; cursor: pointer; outline: none; font-family: "muli"; font-weight: 600; padding: 0; padding-right: 20px;',
                    '{{WRAPPER}} .tour-table-filter .buttons_added p' => 'margin-right: 10px; margin-top: 5px; margin-left: 15px; font-size: 16px; font-family: "muli";',
                    '{{WRAPPER}} .tour-table-filter .value-button' => 'display: inline-block; border: 1px solid #dde1e4; margin: 0; width: 40px; height: 40px; text-align: center; vertical-align: middle; padding: 10px 18px; background: #fff; user-select: none; font-weight: 700; border-radius: 50%; display: flex; align-items: center; justify-content: center; cursor: pointer; font-size:14px;',
                    '{{WRAPPER}} .tour-table-filter #passengersCount' => 'display: inline-block; border: 1px solid #dde1e4; margin: 0; width: 40px; height: 40px; text-align: center; vertical-align: middle; padding: 4px 10px; background: #fff; user-select: none; font-weight: 500; border-radius: 50%; display: flex; align-items: center; justify-content: center; cursor: pointer; font-size:14px; outline: none; margin: 0px 10px; font-family: "muli";',
                    '{{WRAPPER}} .boka_resa_purchase' => 'outline: none;width: 120px; color: #fff; font-size: 16px; text-align: center; background-color: #377cb3; border-radius: 4px; border: none; cursor: pointer; padding: 12px; font-family: "muli"; font-weight: 600;',
                    '{{WRAPPER}} .tour-table-filter label' => 'color: #08262e; font-family: Muli; font-size: 13px; font-weight: 700; line-height: 16px; background-color: transparent; text-align: left;',
                    '{{WRAPPER}} .loader' => 'border: 10px solid #f3f3f3; border-top: 10px solid #377cb3; border-radius: 50%; width: 80px; height: 80px; animation: spin 2s linear infinite; margin: 0px auto;',
                ]
            ]
        );
        $this->end_controls_section();
    }

    /**
     * Render HTML widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function render()
    {
        $settings = $this->get_settings_for_display();  ?>
        <div class="tour-table-filter">
            <div>
                <label>Välj datum </label>
                <div style="position: relative;">
                    <input type="text" class="filter-item datrepicker" readonly placeholder="Alla datum" id="tourDate">
                    <i class="eicon-calendar"></i>
                </div>
            </div>

            <div>
                <label>Välj destination </label>
                <select id="destination" class="filter-item" <?php if ($settings['tourdestination'] != 'Alla-destinationer') {
                                                                            echo "disabled";
                                                                        } ?>>
                    <option value="Alla-destinationer" <?php if ($settings['tourdestination'] == 'Alla-destinationer') {
                                                                    echo "selected";
                                                                } ?>>Alla destinationer</option>
                    <option value="Kroatien" <?php if ($settings['tourdestination'] == 'Kroatien') {
                                                            echo "selected";
                                                        } ?>>Kroatien</option>
                    <option value="Karibien" <?php if ($settings['tourdestination'] == 'Karibien') {
                                                            echo "selected";
                                                        } ?>>Karibien</option>
                    <option value="Grekland" <?php if ($settings['tourdestination'] == 'Grekland') {
                                                            echo "selected";
                                                        } ?>>Grekland</option>
                    <option value="Italien" <?php if ($settings['tourdestination'] == 'Italien') {
                                                        echo "selected";
                                                    } ?>>Italien</option>
                </select>
            </div>
            <div>
                <label for="">Antal resenärer</label>
                <input type="text" name="" class="filter-item" id="newPersonUpdate" value="1 st" placeholder="Personer" readonly>
                <div class="quantity buttons_added">
                    <div style="display:flex;">
                        <p>Personer</p>
                        <div class="value-button" id="decrease" value="Decrease Value">
                            <i class="fa fa-minus"></i>
                        </div>
                        <input type="text" name="passengers" id="passengersCount" value="1" readonly>
                        <div class="value-button" id="increase" value="Increase Value">
                            <i class="fa fa-plus"></i>
                        </div> <br>
                    </div> <button type="button" class="add_quantity">Bekräfta</button>
                </div>
            </div>
        </div>

        <table id="tour-table" class="table table-responsive">
            <thead>
                <tr>
                    <th>Datum</th>
                    <th>Destination</th>
                    <th>Typ av resa</th>
                    <th>Pris</th>
                    <th>Lediga platser</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="6" style="padding:30px">
                        <div>
                            <div class="loader"></div>
                            <p>Loading...</p>
                        </div>
                    </td>
                </tr>
                <script>
                    var AllDates = [];
                </script>
            </tbody>
            <style>
                @keyframes spin {
                    0% {
                        transform: rotate(0deg);
                    }

                    100% {
                        transform: rotate(360deg);
                    }
                }
            </style>
        </table>

<?php }

    /**
     * Render HTML widget output in the editor.
     *
     * Written as a Backbone JavaScript template and used to generate the live preview.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function _content_template()
    {
        // $this->render();
    }
}
