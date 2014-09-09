<?php
/**
 * TUMonline --> Google Calendar Converter
 * Copyright 2014 by Janosch Maier
 * Licensed under the EUPL V.1.1
**/

	/** Make some settings here **/
	$hostname = "phynformatik.de";
	$directory = "calendar";

	function parse_calendar_url($input_url) {
		/** Make global settings available **/
		global $hostname, $directory;

		/** Prepare url **/
		$input_url = parse_url($input_url);
		$query = $input_url['query'];
		$query = str_replace(" ", "", $query);
		parse_str($query, $ics);
		
		/** Build output url **/
		$stud = $ics['pStud'];
		$token = $ics['pToken'];
		$output_url = "http://$hostname/$directory/$stud,$token.ics";
		echo "<h2>Your url:</h2>";
		echo "<a href=\"$output_url\">$output_url</a>";
		echo "<p>Now import your calendar accessible by this url to Google calendar. Make sure, you do not share this url, as all your appointments are accesible by it.</p>";
	}
	
	function print_form() {
		echo "<p>Please enter your TUMonline Calendar url:</p>";
		echo "<p><form action=\"index.php\" method=\"post\"><input type=\"text\" name=\"url\" /><input type=\"submit\" \></form></p>";
	}
?>
