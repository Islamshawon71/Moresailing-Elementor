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
class BookForm extends Widget_Base
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
        return 'booking-form';
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
        return __('Moresailing Form', 'elementor');
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
        return 'eicon-form-horizontal';
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
        return ['form', 'moresailing'];
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
        // $this->add_control(
        //     'tourdestination',
        //     [
        //         'label' => __('Destination', 'elementor'),
        //         'type' => Controls_Manager::SELECT,
        //         'options' => [
        //             'Alla-destinationer' => __('Alla destinationer', 'elementor'),
        //             'Kroatien' => __('Kroatien', 'elementor'),
        //             'Karibien' => __('Karibien', 'elementor'),
        //             'Grekland' => __('Grekland', 'elementor'),
        //             'Italien' => __('Italien', 'elementor'),
        //         ],
        //         'default' => 'Alla-destinationer',
        //         'selectors' => [
        //             '{{WRAPPER}} table td, table th ' => 'color: #08262e; font-family: Muli; font-size: 16px; background-color: #fff; border-top: 1px solid #dde1e4; border-bottom: 1px solid #dde1e4; border-left: none; border-right: none; text-align: center;',
        //             '{{WRAPPER}} .filter-item ' => 'outline: none; font-size: 14px; font-family: Muli;max-width: 100%; display: block; width: 100%; padding-left: 10px; margin-bottom: 10px;font-size: 14px; line-height: 1.5; color: #495057; background-color: #fff; background-clip: padding-box; border: 1px solid #ced4da; border-radius: .25rem; transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out; height: 40px;',
        //             '{{WRAPPER}} .tour-table-filter ' => 'display: flex; margin-bottom: 20px; justify-content: space-around; width: 100%; max-width: 100%;',
        //             '{{WRAPPER}} .tour-table-filter > div' => 'width: 100%;margin-right: 30px;',
        //             '{{WRAPPER}} .tour-table-filter > div:last-child' => 'margin-right: 0px;',
        //             '{{WRAPPER}} .tour-table-filter i.eicon-calendar' => 'position: absolute;top: 8px;right: 10px;color: #0073aa;',
        //             '{{WRAPPER}} .tour-table-filter .quantity.buttons_added' => 'height: 122px;width: 254px; border: 1px solid #d4dde3; border-radius: 0 0 2px 2px; background-color: #fff; padding:20px 0px; display: none; position: absolute; z-index: 99; margin-top: -10px;',
        //             '{{WRAPPER}} .tour-table-filter .buttons_added button' => 'height: 26px; width: 64px; color: #377cb3; font-size: 16px; line-height: 26px; background: #fff; border: none; float: right; margin-right: 20px; cursor: pointer; outline: none; font-family: "muli"; font-weight: 600; padding: 0; padding-right: 20px;',
        //             '{{WRAPPER}} .tour-table-filter .buttons_added p' => 'margin-right: 10px; margin-top: 5px; margin-left: 15px; font-size: 16px; font-family: "muli";',
        //             '{{WRAPPER}} .tour-table-filter .value-button' => 'display: inline-block; border: 1px solid #dde1e4; margin: 0; width: 40px; height: 40px; text-align: center; vertical-align: middle; padding: 10px 18px; background: #fff; user-select: none; font-weight: 700; border-radius: 50%; display: flex; align-items: center; justify-content: center; cursor: pointer; font-size:14px;',
        //             '{{WRAPPER}} .tour-table-filter #passengersCount' => 'display: inline-block; border: 1px solid #dde1e4; margin: 0; width: 40px; height: 40px; text-align: center; vertical-align: middle; padding: 4px 10px; background: #fff; user-select: none; font-weight: 500; border-radius: 50%; display: flex; align-items: center; justify-content: center; cursor: pointer; font-size:14px; outline: none; margin: 0px 10px; font-family: "muli";',
        //             '{{WRAPPER}} .boka_resa_purchase' => 'outline: none;width: 120px; color: #fff; font-size: 16px; text-align: center; background-color: #377cb3; border-radius: 4px; border: none; cursor: pointer; padding: 12px; font-family: "muli"; font-weight: 600;',
        //             '{{WRAPPER}} .tour-table-filter label' => 'color: #08262e; font-family: Muli; font-size: 13px; font-weight: 700; line-height: 16px; background-color: transparent; text-align: left;',
        //             '{{WRAPPER}} .loader' => 'border: 10px solid #f3f3f3; border-top: 10px solid #377cb3; border-radius: 50%; width: 80px; height: 80px; animation: spin 2s linear infinite; margin: 0px auto;',
        //         ]
        //     ]
        // );
        $this->add_control(
            'title',
            [
                'label' => __('Title', 'elementor-moresailing'),
                'type' => Controls_Manager::TEXT,
                'default' => 'Boka resa',
                'selectors' => [
                    '{{WRAPPER}} .book-form-title h3' => 'font-size: 78px; font-weight: bold; letter-spacing: 2px; text-transform: none; color: #08262e; font-family: "Playfair Display",serif; padding: 60px 0 30px;',
                    '{{WRAPPER}}' => 'background-color:transparent;',
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
        $settings = $this->get_settings_for_display();
        $totalTour =  getToursAndTypesNew($_REQUEST['passengers'], $_REQUEST['month'], $_REQUEST['destination'],  $_REQUEST['type'],  $_REQUEST['tour_id']);
        $totalTour = $totalTour[0];
        // var_dump($totalTour);

        $passwngers = $_REQUEST['passengers'];
        $localPrice = str_replace(' ', '', $totalTour->localPrice);
        $totalPrice = $localPrice * $passwngers;
        $tour_id    = $_REQUEST['tour_id'];
        $freeSpaces = $totalTour->freeSpaces;

        $tour_tourtype_id   = $totalTour->tour_tourtype_id;
        $destination        = $totalTour->tourtype_location;
        $tour_type_name     = $totalTour->tour_type_name;
        $startDay           = $totalTour->tour_departure;
        $transfer_price     = $totalTour->transfer_price;
        $endDayExplode      = explode(" ", $totalTour->tour_return);
        $endDay             = $endDayExplode[0];
        // var_dump($totalTour);
        if ($totalTour != null) {
            ?>

            <div class="book-form-container">
                <div class="book-form-left">
                    <h4 class="header">Uppgifter</h4>
                    <div class="booking-form">
                        <h3 class="header">Resenär 1 (Bokningsansvarig)</h3>
                        <div class="form-group">
                            <label for="">Förnamn</label>
                            <input type="text" class="form-control " id="customer_firstname" value="">
                        </div>
                        <div class="form-group">
                            <label for="">Efternamn</label>
                            <input type="text" class="form-control " id="customer_lastname" value="">
                        </div>
                        <div class="form-group">
                            <label for="">Personnummer (ÅÅÅÅMMDD)</label>
                            <input type="text" class="form-control" value="" id="customer_person_number">
                        </div>
                        <div class="form-group">
                            <label for="">Mobiltelefon</label>
                            <input type="number" class="form-control " maxlength="8" id="customer_phone" value="">
                        </div>
                        <div class="form-group">
                            <label for="">Epost</label>
                            <input type="email" class="form-control " id="customer_email" value="">
                        </div>
                        <div class="form-group custom-select">
                            <label for="">Flygplats</label>

                            <select name="" id="customer_airport" class="form-control ">
                                <option value="">Välj flygplats för ut- och återresa</option>
                                <?php $AllAirports =  GetAirport($tour_id);
                                            foreach ($AllAirports as  $AllAirport) {
                                                echo "<option value='$AllAirport->price'>$AllAirport->airport_name</option>";
                                            }  ?>
                                <option value="no_transfer">Utan flyg och transfer (- <?php echo $transfer_price; ?> SEK) </option>

                            </select>
                            <input type="hidden" id="no_transfer_value" value="<?php echo $transfer_price; ?>"></div>
                        <div class="form-group">
                            <label for="">Extra information (valfritt)</label>
                            <textarea class="form-control" name="" id="extra-info" rows="3"></textarea>
                        </div>
                    </div>
                    <?php if ($passwngers > 1) { ?>
                        <h4 class="header">Andra personer</h4>
                        <div class="booking-form other-perosn">

                            <?php for ($number = 2; $number <= $passwngers; $number++) { ?>
                                <div class="other-single-person">
                                    <div class="booking-form-header">

                                        <h3 class="header">Resenär 2</h3>
                                        <button class="btn remove_passenger">
                                            <i class="eicon-close"></i>
                                            Ta bort resenär <span class="badge badge-primary">
                                            </span>
                                        </button>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Namn</label>
                                        <input type="text" class="form-control other_passenger_firstname" value="" placeholder="Förnamn...">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Efternamn</label>
                                        <input type="text" class="form-control other_passenger_lastname" value="" placeholder="Efternamn...">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Personnummer (ÅÅMMDD)</label>
                                        <input type="number" class="form-control other_passenger_day" value="" placeholder="Personnumme...">
                                    </div>

                                </div>
                            <?php } ?>
                            <div class="addPersonDiv">
                                <button type="button" name="" id="add_passenger" class="btn person-add">Lägg till resenären</button>
                            </div>

                        </div>
                    <?php } ?>
                    <h4 class="header">Tillval</h4>
                    <div class="booking-form tilval">
                        <div class="tilval-container">
                            <?php
                                        $getSupplements = getSupplements($tour_tourtype_id);
                                        $i = 1;
                                        foreach ($getSupplements as $key => $value) {   ?>
                                <div class="single-tilval supplements " id="tilval_supplements" data-value="<?php echo $value['supplement_price']; ?>" data-id="<?php echo $i; ?>" data-supplement_id="<?php echo $value['supplement_id']; ?>" data-title="<?php echo $value['supplement_title']; ?>">
                                    <div class="tilval-left">
                                        <h4 class="tilval-title"><?php echo $value['supplement_title']; ?></h4>
                                        <p class="details"><?php echo $value['supplement_description']; ?></p>
                                    </div>
                                    <div class="tilval-right">
                                        <h4 class="tilval_price">
                                            <span class="tilval_totalprice"><?php echo $value['supplement_price']; ?></span> SEK per
                                            person
                                            <input type="hidden" class="supplement_id" value="<?php echo $value['supplement_id']; ?>">
                                            <input type="hidden" class="supplement_price" value="<?php echo $value['supplement_price']; ?>">
                                        </h4>
                                        <span class="input">
                                            <input type="checkbox" name="checkbox" id="checkbox-<?php echo $i ?>">
                                            <label class="supplement-label" for="checkbox-<?php echo $i ?>">Lägg till</label>
                                        </span>
                                        <!-- <button class="addTilvalTour" type="button" value="">Lägg till</button>
                        <button class="removeTilvalTour" type="button" style="display:none;" value="">Tillagd</button> -->
                                    </div>
                                    <hr>
                                </div>
                            <?php $i++;
                                        } ?>
                            <div class="single-tilval cancellation_insurance insurance" id="tilval_insurance" data-value="<?php echo ($totalPrice * .06) / $passwngers; ?>" data-id="<?php echo $i; ?>" data-title="Avbeställningsförsäkring">
                                <div class="tilval-left">
                                    <h4 class="tilval-title">Avbeställningsförsäkring</h4>
                                    <p class="details">Oväntade saker kan inträffa, som t.ex. sjukdom. Det är då skönt att ha en
                                        avbeställningsförsäkring. Denna försäkring kostar 6% av hela resans pris.
                                    </p>
                                </div>
                                <div class="tilval-right">
                                    <h4 class="tilval_price">
                                        <span class="tilval_totalprice"><?php echo ($totalPrice * .06) / $passwngers; ?></span> SEK per
                                        Person

                                    </h4>
                                    <span class="input">
                                        <input type="checkbox" name="checkbox" class="cancellation_insurance_redio" id="checkbox-<?php echo $i; ?>">
                                        <label class="insurance-label" for="checkbox-<?php echo $i; ?>">Lägg till</label>
                                    </span>
                                    <!-- <button class="addInsurance" type="button" value="">Lägg till</button>
                        <button class="removeInsurance" type="button" style="display:none;" value="">Tillagd</button> -->
                                </div>
                                <hr>
                            </div>
                            <div class="single-tilval travel_insurance insurance" id="tilval_insurance" data-value="<?php echo ($totalPrice * .03) / $passwngers; ?>" data-id="<?php echo ++$i; ?>" data-title="Semesterförsäkring">
                                <div class="tilval-left">
                                    <h4 class="tilval-title">Semesterförsäkring</h4>
                                    <p class="details">Försäkringen är utformad så att de täcker hålen i din hemförsäkring. Det
                                        innebär att du får ett komplett skydd mot det som kan hända under resan, utan att du blir
                                        dubbelförsäkrad.

                                    </p>
                                </div>
                                <div class="tilval-right">
                                    <h4 class="tilval_price">
                                        <span class="tilval_totalprice"><?php echo ($totalPrice * .03) / $passwngers; ?></span> SEK per
                                        Person
                                    </h4>
                                    <span class="input">
                                        <input type="checkbox" name="checkbox" class="travel_insurance_redio" id="checkbox-<?php echo $i; ?>">
                                        <label class="insurance-label" for="checkbox-<?php echo $i; ?>">Lägg till</label>
                                    </span>
                                    <!-- <button class="addInsurance" type="button" value="">Lägg till</button>
                        <button class="removeInsurance" type="button" style="display:none;" value="">Tillagd</button> -->
                                </div>
                                <hr>
                            </div>
                        </div>
                    </div>
                    <div class="promo booking-form">
                        <div class="promo-container">
                            <label class="promoLabel">Kampanjkod okej!</label>
                            <input type="text" id="promoInput" style="display: none" class="form-control" placeholder="Ange kampanjkod...">
                            <input type="hidden" id="coupon_id" value="0">
                            <input type="hidden" id="coupon_value" value="0">
                            <?php

                                        $getPromoCodesurl = MORESAILING_API_URL . "ms-admin/API/toursAPI/getPromoCodes/$tour_id/$tour_tourtype_id/$destination";
                                        $getPromoCodesrequest = wp_remote_get($getPromoCodesurl);
                                        if (is_wp_error($getPromoCodesrequest)) {
                                            return false;
                                        }
                                        $getPromoCodes = wp_remote_retrieve_body($getPromoCodesrequest);
                                        ?>
                            <script>
                                var codes = JSON.parse('<?php echo $getPromoCodes; ?>');
                            </script>
                        </div>

                        <div class="booking-form-confirm">
                            <label class="checkbox-container">
                                <input type="checkbox" class="privacy_check">
                                <span class="checkmark"></span>
                            </label>
                            <p>Jag har läst och godkänner <a target="_blank" href="https://www.moresailing.se/resevillkor/">resevillkoren</a> och <a target="_blank" href="https://www.moresailing.se/resevillkor/">hanteringen av
                                    personuppgifter</a></p>
                            <div class="submit-button">
                                <input type="hidden" value="<?php echo $freeSpaces; ?>" id="freeSpace">
                                <input type="hidden" value="<?php echo $_REQUEST['passengers'] ?>" id="TotalPassengers">
                                <input type="hidden" value="<?php echo $startDay; ?>" id="StartDay">
                                <input type="hidden" value="<?php echo $_REQUEST['tour_id']; ?>" id="tourID">
                                <input type="hidden" value="<?php echo $localPrice; ?>" id="TourPrice">
                                <button type="button" id="SendData" disabled="">Fortsätt</button>
                            </div>
                        </div>

                    </div>

                </div>
                <div class="book-form-right to_move_content">
                    <div class="booking-form">
                        <h3 class="tour-title"><?php echo  $tour_type_name; ?></h3>
                        <label>Avresa: </label>
                        <p class="ddate"><?php echo  $startDay; ?></p>
                        <input type="hidden" value="<?php echo  $startDay; ?>" id="start_date">
                        <label>Hemresa: </label>
                        <p class="rdate"><?php echo  $endDay; ?></p>
                        <label>Resans pris: </label>
                        <p class="price"> <span><?php echo $localPrice; ?>
                                <?php echo $_REQUEST['local_currency']; ?></span> SEK</p>
                        <label>Resenärer: </label>
                        <p class="passengers"><?php echo  $passwngers; ?></p>


                        <div class="tillvalAdd"></div>
                        <div class="PromoAdd"></div>

                        <label>Totalt pris: </label>
                        <p class="price"> <span class="basePrice"><?php echo $totalPrice; ?>
                                <?php echo $_REQUEST['local_currency']; ?></span> SEK</p>
                        <input type="hidden" id="localPrice" value="<?php echo $totalPrice; ?>">
                        <a class="chang-trip" href="<?php echo site_url() ?>/boka-resa/">Boka annan resa</a>
                    </div>
                    <button class="mobile-cart">
                        <i class="eicon-product-add-to-cart"></i>
                    </button>
                </div>



                <!-- <div class="promo-box">
                <div class="promo-hideshow" style="display: block;">
                    <div class="promi-input">
                        <label for="youridhere" class="static-value">Kampanjkod okej!</label>
                        <input type="text" id="promo_input" class="form-control" placeholder="Ange kampanjkod...">
                    </div>
                    <input type="hidden" id="coupon_id" value="0">
                    <input type="hidden" id="coupon_value" value="0">
                    <input type="hidden" id="coupon_tour_id" value="1225">
                    <input type="hidden" id="coupon_tourtype_id" value="46">
                    <input type="hidden" id="coupon_destination" value="Kroatien">
                </div>
            </div> -->


            </div>
            <div class="hover_bkgr_fricc">
                <span class="helper"></span>
                <div>
                    <div class="popupCloseButton">x</div>
                    <p class="popup-content">Tack för din bokning, du kommer nu skickas vidare till vår kundportal. Du har fått ditt
                        inlogg till kundportalen på din e-post</p>
                </div>
            </div>
        <?php } else { ?>
            <div class="book-form-container already-book">
                <div class="booking-form">

                    <p> * Turnén har redan avgår</p>

                    <a id="goback" href="<?php echo site_url(); ?>">Please go back</a>
                </div>
            </div>

        <?php } ?>
        <style>
            .already-book {
                text-align: center;
            }

            .already-book p {
                font-size: 25px;
                font-family: "muli";
                font-weight: 500;
                color: red;
            }

            #goback {
                padding: 0.76rem 1rem !important;
                color: #fff;
                font-family: Muli;
                font-size: 16px;
                text-align: center;
                height: 40px;
                width: 141px;
                border-radius: 4px;
                background-color: #377cb3;
                border: none;
                cursor: pointer;
                padding: initial;
            }

            .hover_bkgr_fricc {
                background: rgba(0, 0, 0, .4);
                cursor: pointer;
                display: none;
                height: 100%;
                position: fixed;
                text-align: center;
                top: 0;
                left: 0;
                width: 100%;
                z-index: 10000;
            }

            .hover_bkgr_fricc .helper {
                display: inline-block;
                height: 100%;
                vertical-align: middle;
            }

            .hover_bkgr_fricc>div {
                background-color: #fff;
                box-shadow: 10px 10px 60px #555;
                display: inline-block;
                height: auto;
                min-height: 100px;
                vertical-align: middle;
                width: 60%;
                position: relative;
                border-radius: 8px;
                padding: 15px 5%;
            }

            .popupCloseButton {
                background-color: #fff;
                border-radius: 50px;
                cursor: pointer;
                display: inline-block;
                font-family: arial;
                font-weight: 700;
                position: absolute;
                top: -20px;
                right: -20px;
                font-size: 25px;
                line-height: 50px;
                width: 50px;
                height: 50px;
                text-align: center;
            }

            .hover_bkgr_fricc div p {
                padding: 20px;
                margin-bottom: 0;
            }

            .checkbox-container {
                display: block;
                position: relative;
                padding-left: 35px;
                margin-bottom: 12px;
                cursor: pointer;
                font-size: 22px;
                -webkit-user-select: none;
                -moz-user-select: none;
                -ms-user-select: none;
                user-select: none;
            }

            .booking-form-header {
                float: left;
                width: 100%;
                display: flex;
                justify-content: space-between;
                align-items: center;
            }

            .booking-form-header h3.header {
                float: left;
            }

            .addPersonDiv {
                display: flex;
                justify-content: flex-end;
            }

            .promo-container {
                min-height: 50px;
            }

            .checkbox-container input {
                position: absolute;
                opacity: 0;
                cursor: pointer;
                height: 0;
                width: 0;
            }

            /* Create a custom checkbox */
            .checkmark {
                position: absolute;
                top: 0;
                left: 0;
                height: 25px;
                width: 25px;
                background-color: white;
                border: 1px solid #ccc;
            }

            /* On mouse-over, add a grey background color */
            .checkbox-container:hover input~.checkmark {
                background-color: white;
                border: 1px solid #ccc;
            }

            /* When the checkbox is checked, add a blue background */
            .checkbox-container input:checked~.checkmark {
                background-color: #377cb3;
            }

            /* Create the checkmark/indicator (hidden when not checked) */
            .checkmark:after {
                content: "";
                position: absolute;
                display: none;
            }

            /* Show the checkmark when checked */
            .checkbox-container input:checked~.checkmark:after {
                display: block;
            }

            /* Style the checkmark/indicator */
            .checkbox-container span:after {
                left: 9px;
                top: 6px;
                width: 5px;
                height: 10px;
                border: solid white;
                border-width: 0 2px 2px 0;
                -webkit-transform: rotate(45deg);
                -ms-transform: rotate(45deg);
                transform: rotate(45deg);
            }

            .booking-form {
                background: white;
                padding: 32px;
                margin-bottom: 32px;
                border-radius: 10px
            }

            .booking-form.other-perosn {
                min-height: 100px;
            }

            button.btn.remove_passenger {
                display: block;
                background: transparent;
                border: none;
                color: #377cb3;
                cursor: pointer;
                outline: none;
                font-size: 14px;
                font-weight: 700;
                font-family: "muli";
            }

            button.person-add {
                display: block;
                border: none;
                float: right;
                font-weight: 400;
                color: #fff;
                text-align: center;
                cursor: pointer;
                z-index: 3;
                background-color: #377cb3;
                border-radius: 4px;
                font-size: 16px;
                padding: 10px;
                outline: none;
            }

            .booking-form-confirm p {
                display: flex;
                float: left;
                margin: 5px;
                color: #08262e;
                font-family: Muli;
                font-size: 16px;
            }

            .booking-form-confirm p a {
                padding-left: 5px;
                padding-right: 5px;
            }

            .book-form-container .submit-button button {
                color: #fff;
                font-family: Muli;
                font-size: 16px;
                text-align: center;
                height: 40px;
                width: 141px;
                border-radius: 4px;
                background-color: #377cb3;
                border: none;
                cursor: pointer;
                padding: initial;
            }

            .book-form-container .submit-button button:disabled {
                background: #377CB3a3;
            }

            label.checkbox-container {
                float: left;
                line-height: 0px;
                display: block;
                margin-top: 8px;
            }

            .book-form-container h4.header {
                color: #08262e;
                font-family: "Playfair Display";
                font-size: 22px;
                font-weight: 700;
                letter-spacing: 1.22px;
                line-height: 30px;
            }

            .single-tilval {
                display: flex;
                margin-bottom: 32px;
                border-bottom: 1px solid #dde1e4;
                padding-bottom: 20px;
            }

            .tilval-left {
                max-width: 570px;
                width: 100%;
            }

            .tilval h4.tilval-title {
                height: 18px;
                color: #08262e;
                font-family: Muli;
                font-size: 14px;
                font-weight: 700;
                line-height: 18px;
            }

            .tilval-container h4.tilval_price {
                height: 16px;
                max-width: 141px;
                color: #08262e;
                font-family: Muli;
                font-size: 13px;
                font-weight: 700;
                line-height: 16px;
            }

            .tilval-right .input {
                border-radius: 2px;
                color: #000;
                box-shadow: 0 2px 5px 0 rgba(0, 0, 0, .16), 0 2px 10px 0 rgba(0, 0, 0, .12);
            }

            .book-form-container .booking-form .tilval-right .input label {
                font-weight: 400;
                color: #fff;
                text-align: center;
                cursor: pointer;
                z-index: 3;
                background-color: #377cb3;
                width: 141px;
                border-radius: 4px;
                font-size: 16px;
                padding: 12px;
                font-family: "Muli", sans-serif;
            }

            .book-form-container .booking-form .tilval-right input[type=checkbox]:checked+label {
                background: #43a200;
            }

            .tilval-right .input input {
                display: none;
            }

            .tilval-container p.details {
                height: 78px;
                max-width: 468px;
                color: #08262e;
                font-family: Muli;
                font-size: 16px;
                line-height: 26px;
            }

            .book-form-container .form-control {
                display: block;
                width: 100%;
                height: 40px;
                padding: 6px 12px;
                font-size: 14px;
                line-height: 1.42857143;
                border: 1px solid #d4dde3;
                border-radius: 2px;
                color: #08262e;
                margin-bottom: 30px;
                outline: none !important;
                font-family: "Muli";
            }

            .book-form-container .booking-form h3 {
                color: #08262e;
                font-family: Muli;
                font-size: 16px;
                font-weight: 700;
                line-height: 20px;
                margin-top: 0;
            }

            .book-form-container .booking-form textarea#extra-info {
                display: block;
                width: 100%;
                padding: 6px 12px;
                font-size: 14px;
                line-height: 1.42857143;
                border: 1px solid #d4dde3;
                border-radius: 2px;
                color: #08262e;
                min-height: 100px;
            }

            .book-form-container input.form-control:focus {
                border-color: #34a1b8;
            }

            .book-form-container .booking-form label {
                color: #08262e;
                font-family: "Muli";
                font-size: 13px;
                font-weight: 700;
                line-height: 16px;
                display: block;
                margin-bottom: 8px;
            }

            .book-form-left {
                max-width: 100%;
                width: 70%;
                float: left;
                padding-right: 30px;
            }

            .book-form-right {
                max-width: 100%;
                width: 30%;
                float: right;
                z-index: 9;
            }

            .book-form-right p {
                color: #2f4b53;
                font-family: Muli;
                font-size: 16px;
                line-height: 26px;
            }

            .book-form-container .chang-trip {
                color: #377cb3;
                outline: none;
                font-family: "muli";
                font-size: 16px;
            }

            @media (min-width: 1025px) {

                button.mobile-cart {
                    display: none;
                }

            }

            @media (min-width: 768px) and (max-width: 1024px) {
                .book-form-left {
                    width: 100%;
                    padding-right: 0px;
                }

                .book-form-right.to_move_content.open {
                    right: 0;
                }

                .book-form-right.to_move_content {
                    position: fixed;
                    right: -30%;
                    top: 150px;
                    z-index: 99;
                    transition: all .5s;
                }

                button.mobile-cart {
                    position: absolute;
                    top: 20px;
                    left: -60px;
                    border-top-right-radius: 0;
                    border-bottom-right-radius: 0;
                    outline: none;
                    background: #0073aa;
                }


            }

            @media (min-width: 481px) and (max-width: 767px) {
                .book-form-left {
                    width: 100%;
                    padding-right: 0px;
                }

                .book-form-right.to_move_content.open {
                    right: 0;
                }

                .book-form-right.to_move_content {
                    position: fixed;
                    right: -30%;
                    top: 150px;
                    z-index: 99;
                    transition: all .5s;
                }

                button.mobile-cart {
                    position: absolute;
                    top: 20px;
                    left: -60px;
                    border-top-right-radius: 0;
                    border-bottom-right-radius: 0;
                    outline: none;
                    background: #0073aa;
                }
            }

            @media (min-width: 320px) and (max-width: 480px) {
                .book-form-left {
                    width: 100%;
                    padding-right: 0px;
                }

                .book-form-right.to_move_content.open {
                    right: 0;
                    width: 80%;
                }

                .book-form-right.to_move_content {
                    position: fixed;
                    right: -30%;
                    top: 150px;
                    z-index: 99;
                    transition: all .5s;
                }

                button.mobile-cart {
                    position: absolute;
                    top: 10px;
                    left: -60px;
                    border-top-right-radius: 0;
                    border-bottom-right-radius: 0;
                    outline: none;
                    background: #0073aa;
                }

                .single-tilval {
                    display: block;
                }

                .tilval-container p.details {
                    height: auto;
                }

                .book-form-container .booking-form .tilval-right .input label {
                    width: 100%;
                }

                .booking-form-confirm p {
                    display: block;
                    float: initial;
                }

                .book-form-container .submit-button button {
                    width: 100%;
                    margin-top: 18px;
                }
            }
        </style>

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
