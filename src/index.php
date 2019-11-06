<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include_once ('classes/ReturnMessage.php');
include_once ('classes/Email.php');
cors();

//send email/data
if($_SERVER['REQUEST_METHOD']=='POST') {
    if(!isset($_POST['type'])) {
        ReturnMessage::sendError('000','Missing parameter: type');
    }

    if($_POST['type']=='contactForm') {
        if (!isset($_POST['contactFormName'])) {
            ReturnMessage::sendError('000','Missing parameter: contactFormName');
        }
        if (!isset($_POST['contactFormSubject'])) {
            ReturnMessage::sendError('000','Missing parameter: contactFormSubject');
        }
        if (!isset($_POST['contactFormMessage'])) {
            ReturnMessage::sendError('000','Missing parameter: contactFormMessage');
        }
        if (!isset($_POST['contactFormEmail'])) {
            ReturnMessage::sendError('000','Missing parameter: contactFormEmail');
        }
        Email::sendEmailTo('hello@pimhakkert.com', $_POST['contactFormSubject'], $_POST['contactFormMessage'],array('Name'=>$_POST['contactFormName'],'Email'=>$_POST['contactFormEmail']));
    } else {
        ReturnMessage::sendError('999','No type found');
    }
}

function cors()
{

    // Allow from any origin
    if (isset($_SERVER['HTTP_ORIGIN'])) {
        // Decide if the origin in $_SERVER['HTTP_ORIGIN'] is one
        // you want to allow, and if so:
        header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
        header('Access-Control-Allow-Credentials: true');
        header('Access-Control-Max-Age: 86400');    // cache for 1 day
    }

    // Access-Control headers are received during OPTIONS requests
    if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {

        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
            // may also be using PUT, PATCH, HEAD etc
            header("Access-Control-Allow-Methods: GET, POST, OPTIONS");

        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
            header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");

        exit(0);
    }
}