<?php

use Louve\Model\Shift;
// Transforme un résultat de l'api Odoo dans un format moins dégueu :)
function formatUserInfo($userInfo)
{
    $revelant_data = $userInfo->me['struct'];    
    //Attention, ce formatage suppose que le prénom est le premier élément de Name, et permet de récupérer correctement les patronymes du type LE BOSCO
    $name_elts = explode (" ",$revelant_data['name']->me['string']);
    $firstname = array_shift($name_elts);
    $lastname = join(' ',$name_elts);

    //mobile return value (Cagette), is a boolean type
    return [
        "street" => $revelant_data['street']->me['string'],
        //"mobile" => $userInfo->me['struct']['mobile']->me['string'],
        "mobile" => $userInfo->me['struct']['phone']->me['string'],
        //Dans l'import initial c'est le champ Phone qui a été alimenté...
        "shift_type" => $revelant_data['shift_type']->me['string'],
        "cooperative_state" => $revelant_data['cooperative_state']->me['string'],
        "id" => $revelant_data['id']->me['int'],
        "birthdate" => $revelant_data['birthdate']->me['string'],
        "firstname" => $firstname,
        "lastname" => $lastname,
        "memberNum" => $revelant_data['barcode_base']->me['int']
    ];

    //~ TODO replace by return xml_decode($userInfo);
}

function formatDate($date)
{
    // Mise dans la bonne timezone
    $localizedDate = new DateTime($date.' +00', new DateTimeZone('Europe/Paris'));
    $localizedDate->setTimezone(new DateTimeZone('Europe/Paris'));
    //$localizedDate->setTimezone(new DateTimeZone('Europe/Berlin'));
    $localizedDate = $localizedDate->format('Y-m-d H:i:s');
    list ($date, $time) = explode (" ", $localizedDate);
    list($year, $month, $day) = explode("-", $date);
    list ($hour, $minutes, $secondes) = explode(":", $time);
    $timestamp = mktime(0, 0, 0, $month, $day, $year);
    $dd = date('D', $timestamp);
    if ($dd == 'Mon')
        $dd = 'Lundi';
    elseif ($dd == 'Tue')
        $dd = 'Mardi';
    elseif ($dd == 'Wed')
        $dd = 'Mercredi';
    elseif ($dd == 'Thu')
        $dd = 'Jeudi';
    elseif ($dd == 'Fri')
        $dd = 'Vendredi';
    elseif ($dd == 'Sat')
        $dd = 'Samedi';
    elseif ($dd == 'Sun')
        $dd = 'Dimanche';
    $months = array("janvier", "février", "mars", "avril", "mai", "juin",
    "juillet", "août", "septembre", "octobre", "novembre", "décembre");
    $month = $months[$month - 1];
    return array($dd, $day, $month, $year, $hour, $minutes);
}


// Transforme un résultat de l'api Odoo dans un format moins dégueu :)
// TODO_LATER: beaucoup de choses à améliorer ici
function formatShifts($shifts)
{
    //die(var_dump($shifts));
    $result = array();
    for($i = 0; $i < count($shifts) AND $i < 3; $i++)
    {
        

        $nextTime = $shifts[$i]->me['struct']['date_begin']->me['string'];
        list($dd, $day, $month, $year, $hour, $minutes) = formatDate($nextTime);
        
        //todo a virer des qu on sait comment virer les faux shifts d odoo
        if ($hour!="22"||$hour!="23")
        {
        $shift = new Shift();
        $shift->date =  $dd . ' ' . $day . ' ' . $month . ' ' . $year . ' : ' . $hour . 'H' . $minutes;
        //$shift->coordinator_id = $shifts[$i]->me['struct']['user_id'][0]->me['int'];
        //echo(var_dump($shifts[$i]));
        $result[count( $result)] = $shift;
        }
    }
    return $result;
    


}

// Formattage des shifts volants
// TODO: à refactoriser avec la fonction au dessus
function formatFtopShifts($shifts)
{
    $result = array();
    $ftopIndex = 0;
    
    for($i = 0; $i < count($shifts); $i++) {
       //die(var_dump($shifts[$i]->me['struct']['shift_id']->me['array'][0][0]));
       //die(var_dump($shifts[$i]));
       //die(var_dump($shifts[2]->me['struct']['shift_id']->me['array'][0]->me['int']));
       //die(var_dump($shifts[$i]->me['struct']['id']->me['int']));
        $shift_type = $shifts[$i]->me['struct']['shift_type']->me['string'];
        $available_seats = $shifts[$i]->me['struct']['seats_available']->me['int'];
        $name = $shifts[$i]->me['struct']['name']->me['string'];
        $shift_id = $shifts[$i]->me['struct']['shift_id']->me['array'][0]->me['int'];
        $shift_ticket_id = $shifts[$i]->me['struct']['id']->me['int'];
        // List only shifts which are kind 'volant' (id=2) and for which there are more than 1 available seats
        // TODO_NOW: !!! Clarify with ERP team which value should be used : "name" or "shift_type"!!!
        if ($available_seats <= 0 OR $name != "Volant") {
            continue;
        }
        $time = $shifts[$i]->me['struct']['date_begin']->me['string'];
        list($dd, $day, $month, $year, $hour, $minutes) = formatDate($time);
        $result[$ftopIndex] = (
            '<tr><td>' . $dd . ' ' . $day . ' ' . $month . ' ' . $year . '</td><td>' .
            $hour . 'H' . $minutes . '</td><td>' . $available_seats . '</td><td>'.
            '<input type="button" class="subscribeftop" name="inscription" value="inscription" data-date_begin="' . $time .'" data-date_begin_formated="' . $dd . ' ' . $day . ' ' . $month . ' ' . $year . ' à ' . $hour . 'H' . $minutes . '" data-shift_id="' . $shift_id . '" data-shift_ticket_id="' . $shift_ticket_id . '"></td></tr>'
        );
        $ftopIndex++;
    }
    return $result;
}
