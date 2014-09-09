<?php
/**
 * LMU LSF --> Google Calendar Converter
 * Copyright 2014 by Janosch Maier
 * Licensed under the EUPL V.1.1
**/
	//error_reporting(E_ALL);
	//ini_set('display_errors','On');
	include("functions.php");
?>
<html>
	<head>
		<title>LMU Stundenplan &rarr; Google Calendar Converter</title>
		<link rel="stylesheet" href="style.css" type="text/css" media="all">
	</head>

	<body>
		<h1>LMU Stundenplan &rarr; Google Calendar Converter</h2>
		<p>Converts your LMU calendar url to a format that is usable by Google Calendar</p>
		<?php
			if (isset($_POST['username']) && $_POST['username']) {
				parse_calendar_url($_POST['username'], $_POST['password'], $_POST['semester']);
			} else {
				print_form();
			}
		?>
		<p>&copy; 2014 Janosch Maier <a href="http://phynformatik.de/de/impressum/">Impressum</a></p>
	<!-- Piwik --> 
	<script type="text/javascript">
	var pkBaseURL = (("https:" == document.location.protocol) ? "https://piwik.phynformatik.de/" : "http://piwik.phynformatik.de/");
document.write(unescape("%3Cscript src='" + pkBaseURL + "piwik.js' type='text/javascript'%3E%3C/script%3E"));
	</script><script type="text/javascript">
	try {
	var piwikTracker = Piwik.getTracker(pkBaseURL + "piwik.php", 1);
	piwikTracker.trackPageView();
	piwikTracker.enableLinkTracking();
	} catch( err ) {}
	</script><noscript><p><img src="http://phynformatik.de/piwik/piwik.php?idsite=1" style="border:0" alt="" /></p></noscript>
	<!-- End Piwik Tracking Code -->
	</body>
</html>
