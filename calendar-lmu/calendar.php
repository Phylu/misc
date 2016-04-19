<?php
/**
 * LMU LSF --> Google Calendar Converter
 * Copyright 2014 by Janosch Maier
 * Licensed under the EUPL V.1.1
**/
header("Content-Type: text/calendar; charset=UTF-8");
header('Content-Disposition: filename=pub_calendar');

// create a new cURL resource
$curl = curl_init();
$cookie = tempnam("/tmp", "CURL_");

// set URL and other appropriate options
curl_setopt($curl, CURLOPT_HEADER, false);
if (isset($_GET['username']) and isset($_GET['password']) and isset($_GET['semester'])) {

    // Set Information for curl login
    $username = htmlspecialchars($_GET['username']);
    $password = htmlspecialchars($_GET['password']);
    $semester = htmlspecialchars($_GET['semester']);
    
    $postinfo = "asdf=" . $username . "&fdsa=" .$password;

    curl_setopt($curl, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.2.12) Gecko/20101026 Firefox/3.6.12');
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($curl, CURLOPT_POST, 1);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $postinfo);

    curl_setopt($curl, CURLOPT_COOKIEJAR, $cookie);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

    curl_setopt($curl, CURLOPT_URL, "https://lsf.verwaltung.uni-muenchen.de/qisserver/rds?state=user&type=1&category=auth.login&startpage=portal.vm&breadCrumbSource=portal");

    $store = curl_exec($curl);


    // Change semester
    $semesterParts = explode('-', $semester);
    $semesterId = $semesterParts[0] . $semesterParts[1];
    
    if ($semesterParts[1] == 1) {
         $semesterName = "Sommersemester+$semesterParts[0]";
    } else {
         $nextYear = $semesterParts[0] + 1;
         $semesterName = "Wintersemester+$semesterParts[0]%2F$nextYear";
    }

    $semesterUrl = "https://lsf.verwaltung.uni-muenchen.de/qisserver/rds?state=user&type=0&k_semester.semid=$semesterId&idcol=k_semester.semid&idval=$semesterId&purge=n&getglobal=semester&text=$semesterName";
    
    curl_setopt($curl, CURLOPT_URL, $semesterUrl);
    $change_semester = curl_exec($curl);

    // Get ical url from calendar page
    curl_setopt($curl, CURLOPT_URL, "https://lsf.verwaltung.uni-muenchen.de/qisserver/rds?state=wplan&act=show&show=plan&P.subc=plan&navigationPosition=functions%2Cschedule&breadcrumb=schedule&topitem=functions&subitem=schedule");

    $content = curl_exec($curl);
    
    $htmlDoc = new DOMDocument();
    @$htmlDoc->loadHTML($content);
    $links = $htmlDoc->getElementsByTagName('a');
    foreach ($links as $link) {
        $trimmedLink = trim($link->nodeValue);
        if ($trimmedLink == "Stundenplan als iCal-Datei herunterladen") {
            $calendarUrl = $link->getAttribute('href');
            curl_setopt($curl, CURLOPT_URL, $calendarUrl);
        }
    }

    // grab URL and pass it to the browser
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 0); // Return calendar to browser
    curl_exec($curl);
}
   


// close cURL resource, and free up system resources
unlink($cookie);
curl_close($curl);
?>
