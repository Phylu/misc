<?php
/**
 * LMU LSF --> Google Calendar Converter
 * Copyright 2014 by Janosch Maier
 * Licensed under the EUPL V.1.1
**/

	/** Make some settings here **/
	$hostname = "phynformatik.de";
	$directory = "calendar-lmu";

	function parse_calendar_url($username, $password, $semester) {
		/** Make global settings available **/
		global $hostname, $directory;

		/** Build output url **/
		$output_url = "https://$hostname/$directory/$username,$password,$semester.ics";
		echo "<h2>Your url:</h2>";
		echo "<a href=\"$output_url\">$output_url</a>";
		echo "<p>Now import your calendar accessible by this url to Google calendar. Make sure, you do not share this url, as all your appointments are accesible by it.</p>";
	}
	
	function print_form() {
		echo "<p>Please enter your LSF username and password:</p>";
        echo "<p><form action=\"index.php\" method=\"post\">";
        echo "Username: <input type=\"text\" name=\"username\" /><br />";
        echo "Password: <input type=\"password\" name=\"password\" /><br />";
        echo "Semester: <select name=\"semester\"><option value=\"2013-2\"> Wintersemester 2013/14</option><option value=\"2014-1\">Sommersemester 2014</option><option value=\"2014-2\">Wintersemester 2014/15</option><option value=\"2015-1\">Sommersemester 2015</option><option value=\"2015-2\">Wintersemester 2015/16</option><option value=\"2016-1\" selected=\"selected\">Sommersemester 2016</option></select><br />";
        echo "<input type=\"submit\" \></form></p>";
        echo "<p>Sorry. Currently there is no possibility to get your calendar file propperly without useranme and password. Therefore you should not use this service, unless you fully thust, that I will not use these information for anything else than this service. If in doubt, do not use it, but download the source and operate it on your own.</p>";
	}
?>
