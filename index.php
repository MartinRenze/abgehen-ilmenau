<?php
	include "header.php";


	/* GLOBAL VAR*/
	$events = array();
	$events_sortClub = array();
	$events_sortDate = array();
	
	//MYSQLI Connect
	//
	//Change this
	//$mysqli = new mysqli("#", "#", "#", "#");

	/* check connection */
	if ($mysqli->connect_errno) {
		printf("Connect failed: %s\n", $mysqli->connect_error);
		exit();
	}
	
	$query = "SELECT * FROM `ilmenauAbgehen` ORDER BY `ilmenauAbgehen`.`ATTENDING` DESC ";
			
	if ($result = $mysqli->query($query)) {
		
		//printf("Errormessage: %s\n", $mysqli->error);
		
		/* Get field information for all columns */
		//var_dump($result);
		$finfo = $result->fetch_all();
		//printf("--------");
		//var_dump($finfo);
		
		$k = 0;
		foreach ($finfo as $val) {
			
			$events[$k] = new fbEvent($val[1],$val[2],$val[3],$val[4],$val[5], $val[6]);
			$k = $k + 1;
		}
		$result->close();
	}
	
	$query = "SELECT * FROM `ilmenauAbgehen` ORDER BY `ilmenauAbgehen`.`CLUB` DESC ";
			
	if ($result = $mysqli->query($query)) {

		$finfo = $result->fetch_all();
		
		$k = 0;
		foreach ($finfo as $val) {
			
			$events_sortClub[$k] = new fbEvent($val[1],$val[2],$val[3],$val[4],$val[5], $val[6]);
			$k = $k + 1;
		}
		$result->close();
	}
	
	$query = "SELECT * FROM `ilmenauAbgehen` ORDER BY `ilmenauAbgehen`.`DATE` ASC ";
			
	if ($result = $mysqli->query($query)) {

		$finfo = $result->fetch_all();
		
		$k = 0;
		foreach ($finfo as $val) {
			
			$events_sortDate[$k] = new fbEvent($val[1],$val[2],$val[3],$val[4],$val[5], $val[6]);
			$k = $k + 1;
		}
		$result->close();
	}

	/* close connection */
	$mysqli->close();
	
	
class fbEvent {
	public $eventId;
	public $eventName;
	public $eventDate;
	public $eventAttending;
	public $eventCover;
	public $eventClub;
	
	function __construct($eventId, $eventName, $eventDate, $eventAttending, $eventCover, $eventClub) {
		$this->eventId = $eventId;
		$this->eventName = $eventName;
		$this->eventDate = $eventDate;
		$this->eventAttending = $eventAttending;
		$this->eventCover = $eventCover;
		$this->eventClub = $eventClub;
	}
		
		
		
	public function getEventId()
	{
      return $this->eventId;
	}
	public function getEventName()
	{
      return $this->eventName;
	}
	public function getEventDate()
	{
      return $this->eventDate;
	}
	
	public function getEventDateString()
	{
	  //Heute
      if(date('Y-m-d', time()) == date('Y-m-d', strtotime($this->eventDate))) {
		  return strftime("Today %H:%M",strtotime($this->eventDate));
	  }
	  //Morgen
	  if(date('Y-m-d', strtotime('+1 day', time())) == date('Y-m-d', strtotime($this->eventDate))) {
		  return strftime("Tomorrow %H:%M",strtotime($this->eventDate));
	  }
	  
      
      return strftime("%A, %d %B %H:%M",strtotime($this->eventDate));
	}
	
	public function getEventAttending()
	{
      return $this->eventAttending;
	}
	
	public function getEventCover()
	{
      return $this->eventCover;
	}
	
	public function getEventCoverOffset_y()
	{
      return $this->eventCover->offset_y;
	}
	
	public function getEventCoverOffset_x()
	{
      return $this->eventCover->offset_x;
	}
	
	public function getEventClub()
	{
      return $this->eventClub;
	}
	
	
	public function displayEvent() {
		?>
		<div class="eventImg">
				<div class="eventCaption">	
					<a target="_blank" href="https://www.facebook.com/events/<?php echo $this->eventId ?>"> <?php echo $this->eventName ?></a>
					| Club: <?php echo $this->eventClub ?>
					| Attending: <?php echo $this->eventAttending ?>
					| <?php echo $this->getEventDateString() ?>
				</div>
			<figure>
				<a target="_blank" href="https://www.facebook.com/events/<?php echo $this->eventId ?>"><img class="eventCover" src="<?php echo $this->eventCover ?>" /></a>
			</figure>
		</div>



		<?php
	}
	
}


$page = "";
if(isset($_GET["page"])) {
    $page = htmlspecialchars($_GET["page"]);
}

if($page=="") {


	$today = strftime("%A, %d %B",time());
	echo('<h2>Today (' . $today . ')</h2>');
	foreach ($events as $i) {
		//echo date('Y-m-d', strtotime($i->getEventDate()))."__";
		//echo date('Y-m-d', time())."__";
		
		if (date('Y-m-d', time()) == date('Y-m-d', strtotime($i->getEventDate()))) {

			$i->displayEvent();
		}		
		
	}
	echo("<hr />");

	$tomorrow = strftime("%A, %d %B",strtotime('+1 day', time()));
	echo('<h2>Tomorrow (' . $tomorrow . ')</h2>');

	foreach ($events as $i) {
		//echo date('Y-m-d', strtotime($i->getEventDate()))."__";
		//echo date('Y-m-d', time())."__";
		
		if (date('Y-m-d', strtotime('+1 day', time())) == date('Y-m-d', strtotime($i->getEventDate()))) {
			$i->displayEvent();
		}		
		
	}

}
	$today = strftime("%A, %d %B",time());
	$endOfWeek = strftime("%A, %d %B",strtotime('+7 day', time()));
	
if($page=="this_week") {
	$sortActive = "";
	if(isset($_GET["sortActive"])) {
		$sortActive = $_GET["sortActive"];
	}
	?>
	
	
	<h2>This Week (<?php echo $today; ?> - <?php echo $endOfWeek; ?>)
	 | <span class="h2-low">sort by: <a href="index.php?page=this_week" class="<?php if($sortActive=="") echo "sortActive"; ?>">Date</a>
	 | <a href="index.php?page=this_week&sortActive=club" class="<?php if($sortActive=="club") echo "sortActive"; ?>">Club</a>
	 | <a href="index.php?page=this_week&sortActive=attending" class="<?php if($sortActive=="date") echo "sortActive"; ?>">Attending</a><span></h2>
	 
	<?php
	if($sortActive=="") {
		foreach ($events_sortDate as $i) {
			if ((date('Y-m-d', strtotime('+7 day', time())) >= date('Y-m-d', strtotime($i->getEventDate()))) && (date('Y-m-d', time()) <= date('Y-m-d', strtotime($i->getEventDate())))) {
				$i->displayEvent();
			}		
			
		}
	}
	if($sortActive=="club") {
		foreach ($events_sortClub as $i) {
			if ((date('Y-m-d', strtotime('+7 day', time())) >= date('Y-m-d', strtotime($i->getEventDate()))) && (date('Y-m-d', time()) <= date('Y-m-d', strtotime($i->getEventDate())))) {
				$i->displayEvent();
			}		
			
		}
	}
	if($sortActive=="attending") {		
		foreach ($events as $i) {
			if ((date('Y-m-d', strtotime('+7 day', time())) >= date('Y-m-d', strtotime($i->getEventDate()))) && (date('Y-m-d', time()) <= date('Y-m-d', strtotime($i->getEventDate())))) {
				$i->displayEvent();
			}		
			
		}
	}
}

if($page=="highlights") {
	$sortActive = "";
	if(isset($_GET["sortActive"])) {
		$sortActive = $_GET["sortActive"];
	}
	
	?>
	
	<h2>All Events | <span class="h2-low">sort by: <a href="index.php?page=highlights" class="<?php if($sortActive=="") echo "sortActive"; ?>">Attending</a>
	 | <a href="index.php?page=highlights&sortActive=club" class="<?php if($sortActive=="club") echo "sortActive"; ?>">Club</a>
	 | <a href="index.php?page=highlights&sortActive=date" class="<?php if($sortActive=="date") echo "sortActive"; ?>">Date</a><span></h2>
	
	<?php
	if($sortActive=="") {
		foreach ($events as $i) {
			if ($i->getEventAttending() >= "90" && (date('Y-m-d', time()) <= date('Y-m-d', strtotime($i->getEventDate())))) {
				$i->displayEvent();
			}		
			
		}
	}
	if($sortActive=="club") {
		foreach ($events_sortClub as $i) {
			if ($i->getEventAttending() >= "90" && (date('Y-m-d', time()) <= date('Y-m-d', strtotime($i->getEventDate())))) {
				$i->displayEvent();
			}		
			
		}
	}
	if($sortActive=="date") {
		foreach ($events_sortDate as $i) {
			if ($i->getEventAttending() >= "90" && (date('Y-m-d', time()) <= date('Y-m-d', strtotime($i->getEventDate())))) {
				$i->displayEvent();
			}		
			
		}
	}
}

if($page=="impressum") {
	include "impressum.php";
}

include "footer.php";
?>

