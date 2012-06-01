<?php
////////////////////////////////////////////////////////////////////////////////////////
// Class: sentry
// Purpose: Control access to pages
///////////////////////////////////////////////////////////////////////////////////////
class sentry {
	
	var $loggedin = false;	//	Boolean to store whether the user is logged in
	var $userdata;			//  Array to contain user's data
	
	function sentry(){
		session_start();
		header("Cache-control: private"); 
	}
	
	//======================================================================================
	// Log out, destroy session
	function logout(){
		unset($this->userdata);
		session_destroy();
		return true;
	}

	//======================================================================================
	// Log in, and either redirect to goodRedirect or badRedirect depending on success
	function checkLogin($user = '',$pass = '',$group = 10,$goodRedirect = '',$badRedirect = ''){

		// Include database and validation classes, and create objects
		require_once('DbConnector.php');
		require_once('Validator.php');
		$validate = new Validator();
		$loginConnector = new DbConnector();
		
		// If user is already logged in then check credentials
		if ($_SESSION['user'] && $_SESSION['pass']){

			// Validate session data
			if (!$validate->validateTextOnly($_SESSION['user'])){return false;}
			if (!$validate->validateTextOnly($_SESSION['pass'])){return false;}

			$getUser = $loginConnector->query("SELECT * FROM cmsusers WHERE user = '".$_SESSION['user']."' AND pass = '".$_SESSION['pass']."' AND thegroup <= ".$group.' AND enabled = 1');

			if ($loginConnector->getNumRows($getUser) > 0){
				// Existing user ok, continue
				if ($goodRedirect != '') { 
					header("Location: ".$goodRedirect."?".strip_tags(session_id())) ;
				}			
				return true;
			}else{
				// Existing user not ok, logout
				$this->logout();
				return false;
			}
			
		// User isn't logged in, check credentials
		}else{	
			// Validate input
			if (!$validate->validateTextOnly($user)){return false;}
			if (!$validate->validateTextOnly($pass)){return false;}

			// Look up user in DB
			$getUser = $loginConnector->query("SELECT * FROM cmsusers WHERE user = '$user' AND pass = PASSWORD('$pass') AND thegroup <= $group AND enabled = 1");
			$this->userdata = $loginConnector->fetchArray($getUser);

			if ($loginConnector->getNumRows($getUser) > 0){
				// Login OK, store session details
				// Log in
				$_SESSION["user"] = $user;
				$_SESSION["pass"] = $this->userdata['pass'];
				$_SESSION["thegroup"] = $this->userdata['thegroup'];
								
				if ($goodRedirect) { 
					header("Location: ".$goodRedirect."?".strip_tags(session_id())) ;
				}
				return true;

			}else{
				// Login BAD
				unset($this->userdata);
				if ($badRedirect) { 
					header("Location: ".$badRedirect) ;
				}		
				return false;
			}
		}			
	}
}	
?>