<?php
include_once('../classes/config.php');
include_once('../classes/campaign.php');
include_once('../met_clgdekho/index.php');




if (isset($_POST['Apply'])) {

    // echo("hello");
    $camp_obj = new Campaign();
    //eduworld lms data
    $lms_obj = new Campaign();
    //
    //
    $RefUrl = $_SERVER['HTTP_REFERER'];
    $utm_parm = parse_url($RefUrl, PHP_URL_QUERY);
    //
    $tdata = array();
    $tdata['user_id'] = $camp_obj->generateUserId();
    $tName['Fname'] = isset($_POST['txtFName']) && $_POST['txtFName'] != '' ? $_POST['txtFName'] : '';
    // $tName['Lname'] = isset($_POST['txtLName']) && $_POST['txtLName'] != '' ? $_POST['txtLName'] : '';
    // $tdata['name'] = $tName['Fname'];
    $tdata['email'] = isset($_POST['txtEmail']) && $_POST['txtEmail'] != '' ? $_POST['txtEmail'] : '';
    $tdata['mobile'] = isset($_POST['txtMobile']) && $_POST['txtMobile'] != '' ? $_POST['txtMobile'] : '';
    $tdata['course_id'] = $_POST['course_id'];
    $tdata['extraaedge_id'] = $_POST['extraaedge_id'];
    // $tdata['institute_name']='Institute of Post Graduate Diploma in Management';
    $tdata['RefUrl'] = $RefUrl;
    $tdata['inst_id'] = '';

    if (isset($_POST['Apply']) && $_POST['Apply'] == 'Apply') {
        $_SESSION['BtnPressed'] = 'Apply';
    } else {
        $_SESSION['BtnPressed'] = 'Register';
    }
    //
    $tdata['refscript_name'] = isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER'] != '' ? $_SERVER['HTTP_REFERER'] : '';
    $tdata['scriptname'] = isset($_SERVER['SCRIPT_NAME']) && $_SERVER['SCRIPT_NAME'] != '' ?  $_SERVER['SCRIPT_NAME'] : '';
    $tdata['httpuser_agent'] = isset($_SERVER['HTTP_USER_AGENT']) && $_SERVER['HTTP_USER_AGENT'] != '' ? $_SERVER['HTTP_USER_AGENT'] : '';
    $tdata['httpvia'] = isset($_SERVER['HTTP_VIA']) && $_SERVER['HTTP_VIA'] != '' ? $_SERVER['HTTP_VIA'] : '';
    $tdata['pagevalue_count'] = 1;
    $tdata['hitdatetime'] = date('Y-m-d H:i:s');
    //
    $tdata['remote_host'] = isset($_SERVER['REMOTE_HOST']) && $_SERVER['REMOTE_HOST'] != '' ? $_SERVER['REMOTE_HOST'] : '';
    $tdata['remote_address'] = isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] != '' ? $_SERVER['REMOTE_ADDR'] : '';
    $tdata['httpxforwardedfor'] = isset($_SERVER['HTTP_X_FORWARDED_FOR']) && $_SERVER['HTTP_X_FORWARDED_FOR'] != '' ? $_SERVER['HTTP_X_FORWARDED_FOR'] : '';
    //
    $tdata['utm_param'] = $utm_parm;
    //

    $_SESSION['eduworld_params'] = array(
        'mobile' => $tdata['mobile'],
        'email'  => $tdata['email'],
        'fname'  => $tName['name'],
        'lname'  => $tName['lname']
    );
    //

    $camp_obj->insertCampaignData($tdata);
    //


    //send lms data to eduworld
    $lms_obj->sendCampaignDataToeduworld($tEdata);

    parse_str($tdata['utm_param'], $query);
    //
    $tdata['Fname'] = $tName['Fname'];

    $tdata['Lname'] = $tName['Lname'];


    $tdata['leadName'] = 'collegedekho';



    $tdata['utm_source']        = isset($query['utm_source'])       ? $query['utm_source']      : '';
    $tdata['utm_medium']        = isset($query['utm_medium'])       ? $query['utm_medium']      : '';
    $tdata['utm_campaign']      = isset($query['utm_campaign'])     ? $query['utm_campaign']    : '';
    $tdata['utm_adgroup']       = isset($query['utm_adgroup'])      ? $query['utm_adgroup']     : '';
    $tdata['utm_placement']     = isset($query['utm_placement'])    ? $query['utm_placement']   : '';
    //
    $tdata['utm_creative']      = isset($query['utm_creative'])     ? $query['utm_creative']    : '';
    $tdata['utm_adposition']    = isset($query['utm_adposition'])   ? $query['utm_adposition']  : '';
    $tdata['utm_device']        = isset($query['utm_device'])       ? $query['utm_device']      : '';
    $tdata['utm_content']       = isset($query['utm_content'])      ? $query['utm_content']     : '';
    $tdata['utm_matchtype']     = isset($query['utm_matchtype'])    ? $query['utm_matchtype']   : '';
    $tdata['utm_term']          = isset($query['utm_term'])         ? $query['utm_term']        : '';
    $tdata['utm_keyword']       = isset($query['utm_keyword'])      ? $query['utm_keyword']     : '';

    //   
    //$tdata['remarks']="utm_creative=".$tdata['utm_creative'].", "."utm_device=".$tdata['utm_device'].", "."utm_content=".$tdata['utm_content'].", "."utm_term=".$tdata['utm_term']."";

    extraaedgeApi($tdata);

    // print_r($tdata);


    header('Location:index_Res.php');
    exit();
} else {
    header('Location:hello.php');
}

// ........ Extraaedge Api ..........//

function extraaedgeApi($array_data)
{
    //print_r($array_data);
    $url = 'https://thirdpartyapi.extraaedge.com/api/SaveRequest';

    //Initiate cURL.
    $ch = curl_init($url);


    $jsonData = array(

        "AuthToken"     => 'MET-07-02-2017',
        "Source"        => 'met',
        "FirstName"     => $array_data['fname'],
        // "LastName"      => $array_data['Lname'],
        "Email"         => $array_data['email'],
        "MobileNumber"  => $array_data['mobile'],
        // "Course"        => $array_data['institute_name'],
        "Center"        => $array_data['extraaedge_id'],
        "LeadType"      => "Digital Paid",
        "LeadSource"    => "Google Ads",
        "LeadName"      => $array_data['leadName'],
        "State"         => $array_data['state'],
        "City"          => $array_data['city'],
        "SourceTo"      => $array_data['utm_source'],
        "leadMedium"    => $array_data['utm_medium'],
        "leadCampaign"  => $array_data['utm_campaign'],
        "leadChannel"   => $array_data['utm_content'],
        "field2"        => $array_data['utm_matchtype'],
        "field4"        => $array_data['utm_creative'],
        "field9"        => $array_data['utm_adposition'],
        "field10"       => $array_data['utm_device'],
        "field11"       => $array_data['utm_placement'],
        "field15"       => $array_data['utm_keyword'],
    );


    $jsonDataEncoded = json_encode($jsonData);

    // print_r($jsonDataEncoded);

    debuglog('[Request] cURL Error #::<pre>' . $jsonDataEncoded . '</pre>');
    //Tell cURL that we want to send a POST request.
    curl_setopt($ch, CURLOPT_POST, 1);

    //Attach our encoded JSON string to the POST fields.
    curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonDataEncoded);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

    curl_setopt($ch, CURLOPT_HEADER, false);



    $response = curl_exec($ch);

    $error_msg = "";
    if (curl_error($ch)) {
        $error_msg = curl_error($ch);
    }

    debuglog('[Response Success] cURL Error #::<pre>' . $response . '</pre>');
    debuglog('[Response Failer] cURL Error #::<pre>' . $error_msg . '</pre>');

    curl_close($ch);

    // return true;
}


function debuglog($stringData)
{
    $logFile = "log/debuglog_" . date("Y-m-d") . ".txt";
    $fh = fopen($logFile, 'a');
    fwrite($fh, "\n\n----------------------------------------------------\nDEBUG_START - time: " . date("Y-m-d H:i:s") . "\n" . $stringData . "\nDEBUG_END - time: " . date("Y-m-d H:i:s") . "\n----------------------------------------------------\n\n");
    fclose($fh);
}


