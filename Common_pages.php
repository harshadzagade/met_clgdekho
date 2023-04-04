<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Common_pages extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        //
        // Load Required Models.
        //
        $this->load->model('commonpages_model', 'commonpages');
        $this->load->model('submenu_model', 'submenu');
        $this->load->model('common_model', 'common');
    }
    public function index($param1 = '', $param2 = '')
    {
        //
        // Fetch Data for Menu
        //
        $submenu = $this->submenu->getSubmenu();
        //
        $programme_slider = $this->common->getAllProgrammesforAdmission();
        //
        $page_url = '';
        //
        if ($param1 != '') {
            $page_url .= $param1;
        }
        //if($param2 != '') { $page_url.= '/'.$param2; }
        //
        $page_data = $this->commonpages->is_valid_url($page_url);
        //
        // print_r($page_data);
        //
        if (is_array($page_data) && count($page_data) > 0) {
            //
            // Fetch Banner Details
            //
            $page_name = $page_data['name'];
            //
            $page_banner = $this->common->getBanner($page_data['banner']);
            //
            $sidebar = $this->commonpages->getleftmenu();
            $sidebar['prefix'] = '';
            //
            $page_breadcrumb = $page_data['name'];
            //
            $page_banner_header = $page_breadcrumb;
            //
            $shortcode_data = $this->common->replace_shortcode($page_data['content']);
            //
            // print_r($shortcode_data);
            // exit();
            //
            for ($i = 0; $i < count($shortcode_data); $i++) {
                $info_data = $shortcode_data[$i]['info'];
                //
                if (is_array($info_data) && count($info_data) > 0) {
                    $shortcode_design = $this->load->view('shortcode', array('shortdata' => $shortcode_data[$i]), TRUE);
                    $shortcode_data[$i]['design'] = $shortcode_design;
                    //
                    $pattern = '/\[(' . $shortcode_data[$i]['pattern'] . ')\]/';
                    $design = $shortcode_data[$i]['design'];
                    $page_data['content'] = preg_replace($pattern, $design, $page_data['content']);
                }
            }
            //
            $shared_array = array(
                'submenu'           => $submenu,
                'page_banner'       => $page_banner,
                'page_banner_header' => $page_name,
                'page_breadcrumb'   => $page_breadcrumb,
                'page_header'       => $page_name,
                'page_data'         => $page_data,
                'programme_slider'  => $programme_slider
            );
            $this->load->view('commonpages/innerpage', $shared_array);
        } else {
            return redirect(base_url('pagenotfound'));
        }
    }

    public function getProgrammeInOption()
    {
        $option = '<option value="" translate="no">Select Programme</option>';
        $programme_name_id = isset($_POST['programme_name_id']) && $_POST['programme_name_id'] != '' ? $_POST['programme_name_id'] : '';
        //
        $programmelist = $this->commonpages->getProgrammeByProgrammNameId($programme_name_id);
        //
        if (is_array($programmelist) && count($programmelist)) {
            foreach ($programmelist as $pgn_record) {
                $option .= '<option value="' . $pgn_record['programme_id'] . '" translate="no">' . $pgn_record['short_name'] . '</option>';
            }
        }
        $res = array('error' => 0, 'data' => $option);
        //    
        echo json_encode($res);
    }
    public function getProgrammeInformation()
    {
        $programme_id = isset($_POST['programme_id']) && $_POST['programme_id'] != '' ? $_POST['programme_id'] : '';
        $programme_name_id = isset($_POST['programme_name_id']) && $_POST['programme_name_id'] != '' ? $_POST['programme_name_id'] : '';
        //
        $other_data = $this->commonpages->getProgrammeNameById($programme_id, $programme_name_id);
        //
        $res = array_merge(array('error' => 0), $other_data);
        //    
        echo json_encode($res);
    }
    public function getUserDetailByMob()
    {
        $mob = isset($_POST['mob']) && $_POST['mob'] != '' ? $_POST['mob'] : '';
        //
        $res = array('error' => 0, 'name' => '', 'surname' => '', 'email' => '', 'qualification' => '');
        if ($mob != '') {
            $userDetail = $this->commonpages->getUserDetailByMob($mob);
            if (count($userDetail) > 0) {
                $res = array('error' => 0, 'name' => $userDetail['name'], 'surname' => $userDetail['surname'], 'email' => $userDetail['email'], 'qualification' => $userDetail['qualification']);
            }
        }
        echo json_encode($res);
        exit();
    }
    public function insertUserDetail()
    {
        $array_data = array(
            'name'              => isset($_POST['name']) ? $_POST['name'] : '',
            'surname'           => isset($_POST['surname']) ? $_POST['surname'] : '',
            'email'             => isset($_POST['email']) ? $_POST['email'] : '',
            'mobile'            => isset($_POST['mobile']) ? $_POST['mobile'] : '',
            'qualification'     => isset($_POST['qualification']) ? $_POST['qualification'] : '',
        );
        if ($last_id = $this->commonpages->chkUserExist($array_data['mobile'])) {
            $this->commonpages->updateUserDetail($last_id, $array_data);
        } else {
            $last_id = $this->commonpages->insertUserDetail($array_data);
        }
        $res = array('error' => 0, 'last_id' => $last_id, 'hname' => $array_data['name'], 'hsurname' => $array_data['surname'], 'hemail' => $array_data['email'], 'hmobile' => $array_data['mobile'], 'hqualification' => $array_data['qualification']);
        echo json_encode($res);
        exit();
    }
    public function insertProgrammeDetail()
    {
        $programme_id = isset($_POST['programme_id']) && $_POST['programme_id'] != '' ? $_POST['programme_id'] : '';
        $programme_name_id = isset($_POST['programme_name_id']) && $_POST['programme_name_id'] != '' ? $_POST['programme_name_id'] : '';
        //
        $pg_detail = $this->commonpages->getProgrammeNameById($programme_id, $programme_name_id);
        $array_data = array(
            'user_id'              => isset($_POST['user_id'])                  ? $_POST['user_id']           : '',
            'institute_name'   => isset($pg_detail['institute_name'])       ? $pg_detail['institute_name']       : '',
            'programme_name_id'    => isset($pg_detail['discipline_name'])      ? $pg_detail['discipline_name'] : '',
            'programme_id'         => isset($pg_detail['programme_name'])       ? $pg_detail['programme_name']      : '',
            'msg'                  => isset($_POST['msg'])                      ? $_POST['msg']               : '',
        );

        if ($array_data['user_id'] != '') {

            $user_detail = $this->commonpages->getUserDetailByUserId($array_data['user_id']);

            //
            $name = isset($user_detail['name']) ? $user_detail['name'] : '';
            $sname = isset($user_detail['surname']) ? $user_detail['surname'] : '';
            $mobile = isset($user_detail['mobile']) ? $user_detail['mobile'] : '';
            $email = isset($user_detail['email']) ? $user_detail['email'] : '';
            //    
            $extraedgeParm = array(
                'FirstName'             => $name . ' ' . $sname,
                "Email"                 => $email,
                "MobileNumber"          => $mobile,
                "LeadSource"            => 'Apply Now From Website',
                "Center"                => $array_data['programme_id'],
                "Course"                => $array_data['institute_name'],
                "State"                 => '',
                "City"                  => '',
                "HighestQualification"  => isset($user_detail['qualification']) ? $user_detail['qualification'] : ''
            );
            //
            $this->commonpages->extraaedgeApi($extraedgeParm);
            // 

            if ($this->commonpages->insertUserProgrammeDetail($array_data)) {
                //$is_external_apply=isset($pg_detail['is_external_apply']) && isset($pg_detail['is_external_apply'])==1  ? $pg_detail['is_external_apply']  : '0';
                //
                if ($pg_detail['course_id'] != 0) {
                    $url = 'https://eduworld.met.edu/API/QualCampus_OA/Get_Applicant?Mobile_No=' . urlencode($mobile) . '&Email_ID=' . $email . '&First_Name=' . urlencode($name) . '&Last_Name=' . urlencode($sname) . '&Institute=' . urlencode($array_data['institute_name']) . '&program=' . urlencode($pg_detail['course_id']) . '&Specialization=NA&Media_Type=Website&Media=Website&Campaign=Website';
                    //


                    // init curl object        
                    $ch = curl_init();

                    // define options
                    $optArray = array(
                        CURLOPT_URL => $url,
                        CURLOPT_RETURNTRANSFER => true
                    );

                    // apply those options
                    curl_setopt_array($ch, $optArray);

                    // execute request and get response
                    $result = curl_exec($ch);
                    //
                    if (!$result) {
                        die('Error: "' . curl_error($ch) . '" - Code: ' . curl_errno($ch));
                    }

                    // also get the error and response code
                    $errors = curl_error($ch);
                    $response = curl_getinfo($ch, CURLINFO_HTTP_CODE);

                    curl_close($ch);
                    //
                    $return_url = trim($result, '"');
                    //
                    if (filter_var($return_url, FILTER_VALIDATE_URL)) {
                        $res = array('error' => 1, 'msg' => 'success', 'url' => $return_url);
                        echo json_encode($res);
                        exit();
                    } else {
                        $res = array('error' => 0, 'msg' => 'Thank you for your enquiry. MET Counsellor shall get in touch with you shortly');
                        echo json_encode($res);
                        exit();
                    }
                }
            }
            $res = array('error' => 0, 'msg' => 'Thank you for your enquiry. MET Counsellor shall get in touch with you shortly');
        }
        echo json_encode($res);
        exit();
    }


    // API 
    public function extraaedgeApi($array_data)
    {
        $url = 'https://thirdpartyapi.extraaedge.com/api/SaveRequest';

        // $url = 'https://prodapi.extraaedge.com/api/WebHook/add';

        //Initiate cURL.
        $ch = curl_init($url);

        $array_data['AuthToken'] = 'MET-07-02-2017';
        $array_data['Source'] = 'met';


        $jsonDataEncoded = json_encode($array_data);

        // print_r($jsonDataEncoded);
        // exit();

        //Tell cURL that we want to send a POST request.
        curl_setopt($ch, CURLOPT_POST, 1);

        //Attach our encoded JSON string to the POST fields.
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonDataEncoded);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

        curl_setopt($ch, CURLOPT_HEADER, false);


        $result = curl_exec($ch);

        $this->debuglog('Request: ' . $jsonDataEncoded . "\n" . 'Reponse: ' . $result);

        if (curl_error($ch)) {
            //$error_msg = curl_error($ch);
        }
        curl_close($ch);

        return true;
    }

    public function debuglog($stringData)
    {
        $logFile = "./userlog/lead_debuglog_" . date("Y-m-d") . ".txt";
        $fh = fopen($logFile, 'a');
        fwrite($fh, "\n\n----------------------------------------------------\nDEBUG_START - time: " . date("Y-m-d H:i:s") . "\n" . $stringData . "\nDEBUG_END - time: " . date("Y-m-d H:i:s") . "\n----------------------------------------------------\n\n");
        fclose($fh);
    }

    // END API INTEGRATION


    public function sendApplicationForm()
    {
        $res = array();
        $programme_id = isset($_POST['programme_id']) && $_POST['programme_id'] != '' ? $_POST['programme_id'] : '';
        $programme_name_id = isset($_POST['programme_name_id']) && $_POST['programme_name_id'] != '' ? $_POST['programme_name_id'] : '';
        //
        $pg_detail = $this->commonpages->getProgrammeNameById($programme_id, $programme_name_id);

        $array_data_usr = array(
            'name'              => isset($_POST['admsn_name'])          ? $_POST['admsn_name'] : '',
            'surname'           => isset($_POST['admsn_surname'])       ? $_POST['admsn_surname'] : '',
            'email'             => isset($_POST['admsn_email'])         ? $_POST['admsn_email'] : '',
            'mobile'            => isset($_POST['admsn_mobile'])        ? $_POST['admsn_mobile'] : '',
            'qualification'     => isset($_POST['admsn_qualification']) ? $_POST['admsn_qualification'] : '',
        );
        if ($last_id = $this->commonpages->chkUserExist($array_data_usr['mobile'])) {
            $this->commonpages->updateUserDetail($last_id, $array_data_usr);
        } else {
            $last_id = $this->commonpages->insertUserDetail($array_data_usr);
        }

        $array_data = array(
            'user_id'              => $last_id,
            'institute_name'       => isset($pg_detail['institute_name'])       ? $pg_detail['institute_name']       : '',
            'programme_name_id'    => isset($pg_detail['discipline_name'])      ? $pg_detail['discipline_name']      : '',
            'programme_id'         => isset($pg_detail['programme_name'])       ? $pg_detail['programme_name']       : '',
            'msg'                  => isset($_POST['remark'])                   ? addslashes($_POST['remark'])       : '',
        );

        if ($array_data['user_id'] != '') {

            $name = isset($array_data_usr['name']) ? $array_data_usr['name'] : '';
            $sname = isset($array_data_usr['surname']) ? $array_data_usr['surname'] : '';
            $mobile = isset($array_data_usr['mobile']) ? $array_data_usr['mobile'] : '';
            $email = isset($array_data_usr['email']) ? $array_data_usr['email'] : '';
            //

            $extraedgeParm = array(
                'FirstName'             => $name . ' ' . $sname,
                "Email"                 => $email,
                "MobileNumber"          => $mobile,
                // "LeadType"              => 264,           //'Digital Organic',
                "LeadSource"            => 7941,         //'Apply Now From Website',
                "leadName"              => "Website",        //Website
                "Center"                => $pg_detail['extraegde_id'],
                // "Course"                => $pg_detail['extraedge_inst_id'],
                "State"                 => '',
                "City"                  => '',
                "HighestQualification"  => isset($array_data_usr['qualification']) ? $array_data_usr['qualification'] : ''
            );


            //
            $this->extraaedgeApi($extraedgeParm);
            //    


            if ($this->commonpages->insertUserProgrammeDetail($array_data)) {
                //$is_external_apply=isset($pg_detail['is_external_apply']) && isset($pg_detail['is_external_apply'])==1  ? $pg_detail['is_external_apply']  : '0';
                //
                if ($pg_detail['course_id'] != 0) {
                    // print_r($pg_detail);
                    //
                    $name = isset($array_data_usr['name']) ? $array_data_usr['name'] : '';
                    $sname = isset($array_data_usr['surname']) ? $array_data_usr['surname'] : '';
                    $mobile = isset($array_data_usr['mobile']) ? $array_data_usr['mobile'] : '';
                    $email = isset($array_data_usr['email']) ? $array_data_usr['email'] : '';
                    //
                    $url = 'https://eduworld.met.edu/API/QualCampus_OA/Get_Applicant?Mobile_No=' . urlencode($mobile) . '&Email_ID=' . $email . '&First_Name=' . urlencode($name) . '&Last_Name=' . urlencode($sname) . '&Institute=' . urlencode($array_data['institute_name']) . '&program=' . urlencode($pg_detail['course_id']) . '&Specialization=NA&Media_Type=Website&Media=Website&Campaign=Website';
                    //
                    // init curl object        
                    $ch = curl_init();

                    // define options
                    $optArray = array(
                        CURLOPT_URL => $url,
                        CURLOPT_RETURNTRANSFER => true
                    );

                    // apply those options
                    curl_setopt_array($ch, $optArray);

                    // execute request and get response
                    $result = curl_exec($ch);

                    //
                    if (!$result) {
                        die('Error: "' . curl_error($ch) . '" - Code: ' . curl_errno($ch));
                    }

                    // also get the error and response code
                    $errors = curl_error($ch);
                    $response = curl_getinfo($ch, CURLINFO_HTTP_CODE);

                    curl_close($ch);
                    //
                    $return_url = trim($result, '"');
                    //
                    //print_r($return_url);
                    if (filter_var($return_url, FILTER_VALIDATE_URL)) {
                        $res[] = array('error' => 1, 'msg' => 'success', 'url' => $return_url);
                        echo json_encode($res);
                        exit();
                    } else {

                        $res[] = array('error' => 0, 'msg' => 'Thank you for your enquiry. MET Counsellor shall get in touch with you shortly');
                        echo json_encode($res);
                        exit();
                    }
                }
            }
            $res[] = array('error' => 0, 'msg' => 'Thank you for your enquiry. MET Counsellor shall get in touch with you shortly');
        }
        echo json_encode($res);
        exit();
    }

    public function sendAdmissionForm()
    {
        $res = array();
        $programme_id = isset($_POST['programme_id']) && $_POST['programme_id'] != '' ? $_POST['programme_id'] : '';
        $programme_name_id = isset($_POST['programme_name_id']) && $_POST['programme_name_id'] != '' ? $_POST['programme_name_id'] : '';
        //
        $pg_detail = $this->commonpages->getProgrammeNameById($programme_id, $programme_name_id);

        $array_data_usr = array(
            'name'              => isset($_POST['admsn_name'])          ? $_POST['admsn_name'] : '',
            'surname'           => isset($_POST['admsn_surname'])       ? $_POST['admsn_surname'] : '',
            'email'             => isset($_POST['admsn_email'])         ? $_POST['admsn_email'] : '',
            'mobile'            => isset($_POST['admsn_mobile'])        ? $_POST['admsn_mobile'] : '',
            'qualification'     => isset($_POST['admsn_qualification']) ? $_POST['admsn_qualification'] : '',
        );
        if ($last_id = $this->commonpages->chkUserExist($array_data_usr['mobile'])) {
            $this->commonpages->updateUserDetail($last_id, $array_data_usr);
        } else {
            $last_id = $this->commonpages->insertUserDetail($array_data_usr);
        }

        $array_data = array(
            'user_id'              => $last_id,
            'institute_name'       => isset($pg_detail['institute_name'])       ? $pg_detail['institute_name']       : '',
            'programme_name_id'    => isset($pg_detail['discipline_name'])      ? $pg_detail['discipline_name']      : '',
            'programme_id'         => isset($pg_detail['programme_name'])       ? $pg_detail['programme_name']       : '',
            'msg'                  => isset($_POST['remark'])                   ? addslashes($_POST['remark'])       : '',
        );

        if ($array_data['user_id'] != '') {

            $name = isset($array_data_usr['name']) ? $array_data_usr['name'] : '';
            $sname = isset($array_data_usr['surname']) ? $array_data_usr['surname'] : '';
            $mobile = isset($array_data_usr['mobile']) ? $array_data_usr['mobile'] : '';
            $email = isset($array_data_usr['email']) ? $array_data_usr['email'] : '';
            //

            $extraedgeParm = array(
                'FirstName'             => $name . ' ' . $sname,
                "Email"                 => $email,
                "MobileNumber"          => $mobile,
                // "LeadType"              => 264,           //'Digital Organic',
                "LeadSource"            => 7942,              //Floating Form
                "leadName"              => "Website",        //Website
                "Center"                => $pg_detail['extraegde_id'],
                // "Course"                => $pg_detail['extraedge_inst_id'],
                "State"                 => '',
                "City"                  => '',
                "HighestQualification"  => isset($array_data_usr['qualification']) ? $array_data_usr['qualification'] : ''
            );
            //
            $this->commonpages->extraaedgeApi($extraedgeParm);
            //    
            if ($this->commonpages->insertUserProgrammeDetail($array_data)) {
                //$is_external_apply=isset($pg_detail['is_external_apply']) && isset($pg_detail['is_external_apply'])==1  ? $pg_detail['is_external_apply']  : '0';
                //
                if ($pg_detail['course_id'] != 0) {
                    // print_r($pg_detail);
                    //
                    $name = isset($array_data_usr['name']) ? $array_data_usr['name'] : '';
                    $sname = isset($array_data_usr['surname']) ? $array_data_usr['surname'] : '';
                    $mobile = isset($array_data_usr['mobile']) ? $array_data_usr['mobile'] : '';
                    $email = isset($array_data_usr['email']) ? $array_data_usr['email'] : '';
                    //
                    $url = 'https://eduworld.met.edu/API/QualCampus_OA/Get_Applicant?Mobile_No=' . urlencode($mobile) . '&Email_ID=' . $email . '&First_Name=' . urlencode($name) . '&Last_Name=' . urlencode($sname) . '&Institute=' . urlencode($array_data['institute_name']) . '&program=' . urlencode($pg_detail['course_id']) . '&Specialization=NA&Media_Type=Website&Media=Website&Campaign=Website';
                    //
                    // init curl object        
                    $ch = curl_init();

                    // define options
                    $optArray = array(
                        CURLOPT_URL => $url,
                        CURLOPT_RETURNTRANSFER => true
                    );

                    // apply those options
                    curl_setopt_array($ch, $optArray);

                    // execute request and get response
                    $result = curl_exec($ch);

                    //
                    if (!$result) {
                        die('Error: "' . curl_error($ch) . '" - Code: ' . curl_errno($ch));
                    }

                    // also get the error and response code
                    $errors = curl_error($ch);
                    $response = curl_getinfo($ch, CURLINFO_HTTP_CODE);

                    curl_close($ch);
                    //
                    $return_url = trim($result, '"');
                    //
                    //print_r($return_url);
                    if (filter_var($return_url, FILTER_VALIDATE_URL)) {
                        $res[] = array('error' => 1, 'msg' => 'success', 'url' => $return_url);
                        echo json_encode($res);
                        exit();
                    } else {

                        $res[] = array('error' => 0, 'msg' => 'Thank you for your enquiry. MET Counsellor shall get in touch with you shortly');
                        echo json_encode($res);
                        exit();
                    }
                }
            }
            $res[] = array('error' => 0, 'msg' => 'Thank you for your enquiry. MET Counsellor shall get in touch with you shortly');
        }
        echo json_encode($res);
        exit();
    }

    public function getGuestLectureGallery()
    {
        $gallery_name_id = isset($_POST['gallery_name_id']) ? $_POST['gallery_name_id'] : 0;
        $firstimg = $_POST['img'];
        $name = $_POST['name'];
        $imglist = $this->common->GetGalleryImageById($gallery_name_id);
        $temp = '<div class="item active">
                        <img class="img-responsive" src="' . base_url($firstimg) . '">
                         <div class="carousel-caption"></div>
                       </div>';
        if (count($imglist) > 0) {
            $k = 0;
            foreach ($imglist as $record) {
                //$active=$k==0 ? 'active' :'';
                $img = $record['img'] != '' ? base_url() . 'uploadfile/gallery/' . $record['gallery_name_id'] . '/' . $record['img'] : '';
                $temp .= '<div class="item">
                        <img class="img-responsive" src="' . $img . '" alt="' . $record['title'] . '">
                         <div class="carousel-caption">' . $record['title'] . '</div>
                       </div>';
                $k++;
            }
        }


        $res = array('dt' => $temp);
        echo json_encode($res);
        exit();
    }
    public function getVaultgallery()
    {
        $dt = isset($_POST['dt']) ? $_POST['dt'] : 0;
        $imglist = $this->common->GetVaultGalleryImageByDt($dt);
        //print_r($imglist);
        $temp = '';
        if (count($imglist) > 0) {
            $k = 0;
            foreach ($imglist as $record) {
                $active = $k == 0 ? 'active' : '';
                $img = $record['img'] != '' ? base_url() . 'uploadfile/vaultgallery/' . $record['img'] : '';
                $temp .= '<div class="item ' . $active . '">
                        <img class="img-responsive" src="' . $img . '" alt="' . $record['title'] . '">
                         <div class="carousel-caption">' . $record['title'] . '</div>
                       </div>';
                $k++;
            }
        }
        $res = array('dt' => $temp);
        echo json_encode($res);
        exit();
    }
}
