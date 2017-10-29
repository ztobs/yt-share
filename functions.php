<?php
/**
 * Created by PhpStorm.
 * User: donztobs
 * Date: 10/28/17
 * Time: 11:58 PM
 */


error_reporting(0); // I don't want errors in production
register_shutdown_function("fatal_handler"); // This guy will handle fatal errors for us.

// include all autoloaded classes
include "vendor/autoload.php";

use Behat\Mink\Mink,
    Behat\Mink\Session,
    Behat\Mink\Driver\GoutteDriver,
    Behat\Mink\Driver\Goutte\Client as GoutteClient;


// init Mink and register sessions
$mink = new Mink(array(
    'session1' => new Session(new GoutteDriver(new GoutteClient())),
    'session2' => new Session(new GoutteDriver(new GoutteClient()))
));

$mink->setDefaultSessionName('session1');

/*
 * Function loads the page for video to edit
 * @params: String $videoId
 * @return: stdObj $page
 */
function loadPage($videoId)
{
    global $mink;

    $mink->getSession()->visit("https://www.youtube.com/edit?video_id=".$videoId);
    if($mink->getSession()->getStatusCode() !== 200) die("Cannot load page");
    $page = $mink->getSession()->getPage();
    return $page;
}


/*
 * Function signs in to your google account
 * @params: String $email, String $password
 */
function signIn($email, $password)
{
    global $mink;
    $mink->getSession()->getPage()->find("css", "#Email")->setValue($email);
    $mink->getSession()->getPage()->find("css", "#next")->click();
    $mink->getSession()->getPage()->find("css", "#Passwd")->setValue($password);
    $mink->getSession()->getPage()->find("css", "#signIn")->click();
    if(strpos($mink->getSession()->getPage()->getContent(), "Creator Studio") !== FALSE) echo "Login Successful\n";
}

/*
 * Function checks if the bot is logged in
 * @return: boolean
 */
function isLoggedin()
{
    global $mink;
    if(strpos($mink->getSession()->getPage()->getContent(), "Creator Studio") !== FALSE)
    {
        echo "Already logged in\n";
        return true;
    }
    else return false;

}


/*
 * Function uses curl to share the video
 * @params: String $videoId, String $share_emails, boolean $notify_users
 */
function share($videoId, $share_emails, $notify_users)
{
    global $mink;
    $data2 = array(
        "share_emails"  =>  str_replace(" ", "", $share_emails),
        "video_id"      =>  $videoId
    );
    $postdata = array_merge(getData($notify_users), $data2);

    // Since Mink cannot submit POST request required to share video, cURL does the job with cookie data from logged in Mink session
    $ch = curl_init('https://www.youtube.com/metadata_ajax?action_edit_video=1');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_COOKIE, getCookies());
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);

    $response = curl_exec($ch);
    curl_close($ch);

    if($response === '{"metadata_errors":[]}') echo "Sharing Completed!!!\n";
}

/*
 * Function gets the form data from video, needed to share it
 * @params: boolean $notify_users
 * @return: Array formData
 */
function getData($notify_users)
{
    global $mink;

    $title = $mink->getSession()->getPage()->find("css", ".video-settings-title")->getValue();
    $description = $mink->getSession()->getPage()->find("css", "textarea.video-settings-description")->getValue();

    $page_string = $mink->getSession()->getPage()->getContent();
    $position = strpos($page_string, "session_token =");
    $page_part = substr($page_string, $position, 400);
    $session_token = explode('"', $page_part)[1];


    return array(
        "title"             =>  $title,
        "description"       =>  $description,
        "modified_fields"   =>  "privacy,share_emails",
        "privacy"           =>  "private",
        "notify_via_email"  =>  $notify_users?"true":"false",
        "session_token"     =>  $session_token,
    );
}


/*
 * Function gets the cookie data from Mink session
 * @return: String $cookies
 */
function getCookies()
{
    global $mink;

    $cookies = "";

    $cookies .= "VISITOR_INFO1_LIVE=".$mink->getSession()->getCookie("VISITOR_INFO1_LIVE")."; ";
    $cookies .= "LOGIN_INFO=".$mink->getSession()->getCookie("LOGIN_INFO")."; ";
    $cookies .= "YSC=".$mink->getSession()->getCookie("YSC")."; ";
    $cookies .= "SID=".$mink->getSession()->getCookie("SID")."; ";
    $cookies .= "HSID=".$mink->getSession()->getCookie("HSID")."; ";
    $cookies .= "SSID=".$mink->getSession()->getCookie("SSID")."; ";

    return $cookies;
}


/*
 * Function helps take care of ambiguous errors resulting from invalid user variables
 */
function fatal_handler() {
    global $feedPos;
    global $argv;
    global $logfile;
    global $campaign_id;
    $errfile = "unknown file";
    $errstr  = "shutdown";
    $errno   = E_CORE_ERROR;
    $errline = 0;

    $error = error_get_last();

    if( $error !== NULL) {
        $errno   = $error["type"];
        $errfile = $error["file"];
        $errline = $error["line"];
        $errstr  = $error["message"];

        // If fatal error, restart script
        if($errno)
        {
            echo "Please check the parameters are correct, video id or username or password\nIf problem persists, google must have blocked the hack.\n";

        }

    }
}
