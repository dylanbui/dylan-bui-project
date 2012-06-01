<?php
// Require the database class
require_once('includes/DbConnector.php');

class KaraokeWS extends DbConnector 
{
	function index()
	{
		
		echo '<pre>';
		print_r('index --- aaaaabbbbbbbbbbbbbbbbb');
		echo '</pre>';
		exit();
		
	}
	
	function loadKaraokeData()
	{
		$start = empty($_POST['start']) ? 0 : $_POST['start'];
		$num_row = empty($_POST['num_row']) ? 10 : $_POST['num_row'];
		
		// Execute the query to retrieve articles
		$result = $this->query("SELECT code,name,ascii,more,author FROM kara ORDER BY id ASC LIMIT {$start},{$num_row}");
		
		$return = array();
		while ($row = $this->fetchArray($result))
		{
		
			$temp = array();
			$temp['code'] = $row['code'];
			$temp['name'] = $row['name'];
			$temp['ascii'] = $row['ascii'];
			$temp['more'] = $row['more'];
			$temp['author'] = $row['author'];
			array_push($return, $temp);
		}

		$data = array(
				"Type" => "OK",
				"Message" => "Moi su thong",
				"Data" => $return
		);
		
		echo json_encode($data);
	}
	
}

// Create an object (instance) of the DbConnector
$service = new KaraokeWS();

$action = empty($_REQUEST['action']) ? 'index' : $_REQUEST['action'];
$service->{$action}();
// $service->index();
