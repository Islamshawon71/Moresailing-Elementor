<?php


add_action('wp_ajax_bookresa_request', 'bookresa_request');
add_action('wp_ajax_nopriv_bookresa_request', 'bookresa_request');

function bookresa_request()
{
    $passengers = $_REQUEST['passengers'];
    $month = $_REQUEST['month'];
    $destination = $_REQUEST['destination'];
    $tour_id = "";

    if ($_REQUEST['type'] !=  'Antal personer') {
        $type = $_REQUEST['type'];
    } else {
        $type = "all";
    }
    $totalTour =  getToursAndTypesNew($passengers, $month, $destination, $type, $tour_id);

    usort($totalTour, "cmp");

    if (count($totalTour) > 0) {
        ob_start();
        $allDates = "";
        $i = 0;

        foreach ($totalTour as $tripinfo) {
            $tour_departure = $tripinfo->tour_departure;
            $tour_return = explode(' ', $tripinfo->tour_return);
            $tour_return = $tour_return[0];
            ?>
            <tr>
                <td><?php echo $tour_departure . ' - ' . $tour_return; ?></td>
                <td><?php
                                if ($tripinfo->tourtype_location == 'Italy') {
                                    echo "Italien";
                                } else {
                                    echo $tripinfo->tourtype_location;
                                }
                                ?></td>
                <td><?php echo $tripinfo->tour_type_name; ?></td>
                <td><?php echo $tripinfo->localPrice . ' ' . $tripinfo->local_currency; ?></td>
                <td>
                    <?php
                                if ($tripinfo->freeSpaces >= 10) {
                                    echo "10+";
                                } else {
                                    echo $tripinfo->freeSpaces;
                                }
                                ?>
                </td>
                <td>
                    <form action="<?php echo site_url(); ?>/boka-resa-form/" method="get">
                        <button type="submit" name="book" class="boka_resa_purchase">Boka</button>
                        <input type="hidden" name="passengers" value="<?php echo $passengers; ?>">
                        <input type="hidden" name="tour_id" value="<?php echo $tripinfo->tour_id; ?>">
                        <input type="hidden" name="destination" value="<?php echo $tripinfo->tourtype_location; ?>">

                    </form>
                </td>
            </tr>
        <?php

                }

                $allDates = GetTourDate($destination);
                ?>
        <script>
            var AllDates = [<?php echo rtrim($allDates, ', '); ?>];
        </script>
<?php
        $output_string = ob_get_contents();
        ob_end_clean();
        $return = array(
            'status'  => 'success',
            'content' => $output_string
        );
    } else {
        $return = array(
            'status'  => 'failed',
            'content'       => "<td colspan='6' style='padding: 30px;'>Ingen resa tillgänglig !</td>"
        );
    }
    //echo $output_string;


    wp_send_json($return);
    die();
}


function getToursAndTypesNew($passengers = 1, $month = "", $destination = "all", $type = "", $tour_id = "")
{
    error_reporting(0);

    $url = MORESAILING_API_URL . "ms-admin/API/toursAPI/getToursAndTypesNew?destination=$destination&type=$type&month=$month&passengers=$passengers&tour_id=$tour_id";

    $request = wp_remote_get($url);
    if (is_wp_error($request)) {
        return false;
    }
    $body = wp_remote_retrieve_body($request);
    $data = json_decode($body);


    if (!empty($data)) {

        $data_array = array();
        foreach ($data as $trip) {

            $trip_array = $trip->toursArray;
            $tour_type_name = $trip->tourType->description->tourtype_name;
            $tourtype_location = $trip->tourType->tourtype_location;
            $transfer_price     = $trip->tourType->tourtype_transfer_price;
            foreach ($trip_array as $item) {
                $item->tour_type_name = $tour_type_name;
                $item->tourtype_location = $tourtype_location;
                $item->transfer_price = $transfer_price;
                array_push($data_array, $item);
            }
        }
    }
    usort($data_array, "cmp");
    return $data_array;
}

function GetTourDate($destination = "all")
{
    $totalTour =  getToursAndTypesNew('1', '', $destination, '', '');
    //    var_dump($totalTour);
    if (count($totalTour) > 0) {
        $allDates = "";
        foreach ($totalTour as $tripinfo) {
            $allDates = $allDates . '"' . date('d-n-Y', strtotime($tripinfo->tour_departure)) . '",';
        }
    } else {
        $allDates = "";
    }
    return $allDates;
}
function GetAirport($tour_id, $destination = 'all', $passengers = 1)
{

    $url = MORESAILING_API_URL . "ms-admin/API/toursAPI/getToursAndTypes?destination=$destination&tour_id=$tour_id&passengers=$passengers";

    $request = wp_remote_get($url);
    if (is_wp_error($request)) {
        return false;
    }
    $body = wp_remote_retrieve_body($request);
    $GetAirport = json_decode($body);
    return $GetAirport[0]->airports;
}
function getSupplements($tourtype_id)
{

    $url = MORESAILING_API_URL . "ms-admin/API/toursAPI/getSupplements/$tourtype_id";

    $request = wp_remote_get($url);
    if (is_wp_error($request)) {
        return false;
    }
    $body = wp_remote_retrieve_body($request);
    $getSupplements = json_decode($body, true);

    return $getSupplements;
}
