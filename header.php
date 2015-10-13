<?php
date_default_timezone_set('Europe/Berlin'); 
$page = "";
if(isset($_GET["page"])) {
    $page = htmlspecialchars($_GET["page"]);
}

?>
<!DOCTYPE html>
<html lang="de">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<meta name="description" content="Abgehen in Ilmenau - Party im BC, BD, BH und BI Club! Highlights in den Studentenclubs. Finde die Party mit den meisten Facebook Zusagen.">
		<meta name="keywords" content="abgehen,ilmenau,party,club,studentenclub,bh,bi,bd,bc,feiern,info,facebook,zusagen">
		
		<meta name="viewport" content="width=device-width,initial-scale=1">
		<link rel="stylesheet" href="nav/responsive-nav.css">
		<script src="nav/responsive-nav.js"></script>
		
		<link rel="icon" type="image/png" href="img/favicon-16x16.png" sizes="16x16">
        <link rel="icon" type="image/png" href="img/favicon-32x32.png" sizes="32x32">
		<link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Signika" />
		<link rel="stylesheet" href="style.css" type="text/css">
		
		<title>Abgehen in Ilmenau - Party time</title>
	</head>
	<body>
		<div id="wrapper">
			
			<?php
			$noMenu = "";
			$noMenu = $_GET["noMenu"];
			if($noMenu != "true") {
				?>
		<nav class="nav-collapse">
			<ul>
				<li class="<?php if($page=="") echo "active"; ?>"><a href="index.php">Home</a></li>
				<li class="<?php if($page=="update") echo "active"; ?>"><a href="update.php">Update</a></li>
				<li class="<?php if($page=="this_week") echo "active"; ?>"><a href="index.php?page=this_week">This Week</a></li>
				<li class="<?php if($page=="highlights") echo "active"; ?>"><a href="index.php?page=highlights">Highlights</a></li>
				<li class=""><a href="abgehen-ilmenau.apk">Download the APP</a></li>
			</ul>
		</nav>
		
		    <script>
      var navigation = responsiveNav(".nav-collapse", {
        animate: true,                    // Boolean: Use CSS3 transitions, true or false
        transition: 284,                  // Integer: Speed of the transition, in milliseconds
        label: "Menu",                    // String: Label for the navigation toggle
        insert: "after",                  // String: Insert the toggle before or after the navigation
        customToggle: "",                 // Selector: Specify the ID of a custom toggle
        closeOnNavClick: false,           // Boolean: Close the navigation when one of the links are clicked
        openPos: "relative",              // String: Position of the opened nav, relative or static
        navClass: "nav-collapse",         // String: Default CSS class. If changed, you need to edit the CSS too!
        navActiveClass: "js-nav-active",  // String: Class that is added to <html> element when nav is active
        jsClass: "js",                    // String: 'JS enabled' class which is added to <html> element
        init: function(){},               // Function: Init callback
        open: function(){},               // Function: Open callback
        close: function(){}               // Function: Close callback
      });
    </script>

		<hr />
    <?php } ?>
