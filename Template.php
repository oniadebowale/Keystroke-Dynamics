<?php
require_once 'Singleton.php';
$db = DatabaseConnection::get()->handle();
$db->debug = true;


class Template {  

   private $name;
   private $averages; //array
   private $keyparams; //array
   private $hovercount; //int
   private $pauses; //array
   private $maxPause; //double
   private $totalerrors; //int
   private $errorCorrectionMethods; //array
   private $totalErrorList; //array
   private $deleteList; //array
   private $backspaceList; //array
   private $arrowList; //array
   private $debug;
   
   //constructor.
   //creates a Template object
   public function __construct() {
   		//$this->newTemplate();
   }  
   
   //retrives a template from the database
   public function retrieve($name = "Jinah Adam")
   {
   		global $db;
		$recordSet = &$db->Execute('SELECT * FROM Templates where Name = "'.$name.'" limit 1');
		if (!$recordSet) {
					 print $db->ErrorMsg();
		}
		else 
		{
			
			while (!$recordSet->EOF) {
					 	//retiruve and assing it to local varialbes
						$this->name = $recordSet->fields[1];
						$this->averages = unserialize($recordSet->fields[2]);
						$this->keyparams = unserialize($recordSet->fields[3]);
						$this->hovercount = $recordSet->fields[4];
						$this->pauses = unserialize($recordSet->fields[5]);
						$this->maxPause = $recordSet->fields[6];
						$this->totalerrors = unserialize($recordSet->fields[7]);
						$this->errorCorrectionMethods = unserialize($recordSet->fields[8]);
						$this->totalErrorList = unserialize($recordSet->fields[9]);
						$this->deleteList = unserialize($recordSet->fields[10]);
						$this->backspaceList = unserialize($recordSet->fields[11]);
						$this->arrowList = unserialize($recordSet->fields[12]);	
						$recordSet->MoveNext();
			}
		}
		$recordSet->Close();	
   }
   
   //creates a new template
   public function newTemplate($name= "Jinah Adam", $debug = true)
   {
   		//assign parameters for constructor
		$this->name = $name;
		$this->debug = $debug;
		
		if($this->validate()) { //validates template . but only a basic validation
			//generates template
			$this->generate();
			//if debug is true prints out values
			if ($this->debug == true) $this->debug();
			//some thing wrong with data . so print out error message.
		} else
		{
			echo "can't generate template";
		}			
   }
   
   
   
   //saves the tempalte to the database
   public function save()
   {
   		//first serialize the arrays
		//to store in the database
		//assign ints to local func variables
		$name = $this->name;
		$averages = serialize($this->averages);
		$keyparams = serialize($this->keyparams);
		$hovercount = $this->hovercount;
		$pauses = serialize($this->pauses);
		$maxPause = $this->maxPause;
		$totalerrors = $this->totalerrors;
		$errorCorrectionMethod = serialize($this->errorCorrectionMethods);
		$totalErrorList = serialize($this->totalErrorList);
		$deleteList = serialize($this->deleteList);
		$backspaceList = serialize($this->backspaceList);
		$arrowList = serialize($this->arrowList);
		
		//serialzing done . create db object.
		global $db;
		
		//use adodb to generate insert query
		$record = array(); # Initialize an array to hold the record data to insert
		$record['Name'] = $name;
		$record['TimeValues'] = $averages;
		$record['KeyParams'] = $keyparams;
		$record['HoverCount'] = $hovercount;
		$record['Pauses'] = $pauses;
		$record['maxPause'] = $maxPause;
		$record['TotalErrors'] = $totalerrors;
		$record['CorrectionMethods'] = $errorCorrectionMethod;
		$record['AllErrors'] = $totalErrorList;
		$record['Deletes'] = $deleteList;
		$record['Backspaces'] = $backspaceList;
		$record['ArrowList'] = $arrowList;
		
		# Pass the table name and the array containing the data to insert
		# into the AutoExecute function. The function will process the data and return
		# a fully formatted insert sql statement.
		$insertSQL = $db->AutoExecute("Templates", $record, 'INSERT'); 
		
		//insert into db
		//$rs = $db->Execute($insertSQL);
  	
   }
   
   //generate template
   public function generate()
   {
	   //assigns values to local varialbes using local functions
		$this->averages = $this->getAverages(); //array
		$this->keyparams = $this->getKeyParams(); //array
		$this->hovercount = $this->getHoverCount(); //int
		$this->pauses = $this->pauseDetection(); //array
		$this->maxPause = $this->maxPause(); //double
		$this->totalerrors = $this->getTotalErrors(); //int
		$this->errorCorrectionMethods = $this->errorCorrectionMethods(); //array
		$this->totalErrorList = $this->totalErrorList(); //array
		$this->deleteList = $this->DeleteList(); //array
		$this->backspaceList = $this->BackspaceList(); //array
		$this->arrowList = $this->ArrowList(); //array
   }
   
    
   
   //prints out values for debuging.
   public function debug()
   {
   			print("<pre>");
			echo "BASIC\n\n";
			print_r($this->averages);
			echo "\nKey Parmeters\n";
			print_r($this->keyparams);
			echo "\nMousehover count\n";
			echo $this->hovercount;
			echo "\nPauses\n";
			print_r($this->pauses);
			echo "\nMax Pause\n";
			print $this->maxPause;//
			echo "\nError Correction\n";
			echo "\n";
			echo "\nTotal Errors\n";
			echo $this->totalerrors;
			echo "\nMethods Used\n";
			print_r($this->errorCorrectionMethods);
			echo "\nWhere All Errors Occured\n";
			print_r($this->totalErrorList);
			echo "\nWhere the user used deleted\n";
			print_r($this->deleteList);
			echo "\nWhere the user used Backspace\n";
			print_r($this->backspaceList);
			echo "\nWhere the user used Arrow list\n";
			print_r($this->arrowList);
   }
   
   private function getKeyParams()
   {
   		$keys = $this->getKey();
		$holdtimes = $this->getHoldTimeAverages();
		$flighttimes = $this->getFlightTimeAverages();
		$keylocation = $this->getLocation();
		//$keyparams[] = "";
		
		foreach($holdtimes as $key=>$value)
		{
			$keyparams[$keys[$key]]['HoldTime'] = $value;
		}
		
		foreach($flighttimes as $key=>$value)
		{
			$keyparams[$keys[$key]]['FlightTime'] = $value;
		}
		foreach($keylocation as $key=>$value)
		{
			$keyparams[$keys[$key]]['KeyLocation'] = $value;
		}
		
		return ($keyparams);
   
   }
   
   private function getAverages()
   {

		//get time monitor values
		global $db;
		$recordSet = &$db->Execute('SELECT sum(TotalTime)/count(TotalTime) as TotalTime, sum(AverageFlightTime)/count(AverageFlightTime) as AverageFlightTime,
sum(AverageHoldTime)/count(AverageHoldTime) as AverageHoldTime, sum(TotalFlightTime)/count(TotalFlightTime) as TotalFlightTime,
sum(TotalHoldTime)/count(TotalHoldTime) as TotalHoldTime from Patterns where Name="'.$this->name.'" and TotalErrors = 0');
		if (!$recordSet) {
					 print $db->ErrorMsg();
		}
		else 
		{
			
			while (!$recordSet->EOF) {
					 $TimeMonitor['TotalTime'] = $recordSet->fields[0];	
					 $TimeMonitor['AverageFlightTime'] = $recordSet->fields[1];
					 $TimeMonitor['AverageHoldTime'] = $recordSet->fields[2];
 					 $TimeMonitor['TotalFlightTime'] = $recordSet->fields[3];
 					 $TimeMonitor['TotalHoldTime'] = $recordSet->fields[4];
					 $TimeMonitor['AverageHoldTime'] = $recordSet->fields[0];
					 $recordSet->MoveNext();
					// print_r($TimeMonitor);
					return $TimeMonitor;
			}
		}
		$recordSet->Close();	
   }
   
   private function getFlightTimeAverages()
   {
   		//get flight times
		global $db;
		$recordSet = &$db->Execute('SELECT FlightTimes from Patterns where Name="'.$this->name.'" and TotalErrors = 0');
		if (!$recordSet) {
					 print $db->ErrorMsg();
		}
		else 
		{
			$i = 0;
			$flightTimesArray[] = "";
			while (!$recordSet->EOF) {
					if($i == 0) {
						//create new array
					 	$flightTimes = substr(trim($recordSet->fields[0]),0,strlen($recordSet->fields[0])-1); //removes trailing coma. breaks 
					 	$flightTimesArray = explode(",",$flightTimes); //breaks cvs into array
					 	$recordSet->MoveNext();
					 	$i++;
					}
					else
					{ //append to old array
						$flightTimes = substr(trim($recordSet->fields[0]),0,strlen($recordSet->fields[0])-1); //removes trailing coma. breaks 
					 	$flightTimesArrayTemp = explode(",",$flightTimes); //breaks cvs into array
						//print_r($flightTimesArrayTemp);
						foreach($flightTimesArrayTemp as $key=>$value)
						{
							$flightTimesArray[$key] += $value;
						}
					 	
					 	$recordSet->MoveNext();
					 	$i++;
					}
					
			}
			//get average
			foreach($flightTimesArray as $key=>$value)
			{
				$flightTimesArray[$key] = $value/$i; //$i = number of records
			}
			
			return $flightTimesArray;
		}
		$recordSet->Close();	
   }
   
   private function getHoldTimeAverages()
   {
   		//get flight times
		global $db;
		$recordSet = &$db->Execute('SELECT HoldTimes from Patterns where Name="'.$this->name.'" and TotalErrors = 0');
		if (!$recordSet) {
					 print $db->ErrorMsg();
		}
		else 
		{
			$i = 0;
			$HoldTimesArray[] = "";
			while (!$recordSet->EOF) {
					if($i == 0) {
						//create new array
					 	$HoldTimes = substr(trim($recordSet->fields[0]),0,strlen($recordSet->fields[0])-1); //removes trailing coma. breaks 
					 	$HoldTimesArray = explode(",",$HoldTimes); //breaks cvs into array
					 	$recordSet->MoveNext();
					 	$i++;
					}
					else
					{ //append to old array
						$HoldTimes = substr(trim($recordSet->fields[0]),0,strlen($recordSet->fields[0])-1); //removes trailing coma. breaks 
					 	$HoldTimesArrayTemp = explode(",",$HoldTimes); //breaks cvs into array
						//print_r($HoldTimesArrayTemp);
						foreach($HoldTimesArrayTemp as $key=>$value)
						{
							$HoldTimesArray[$key] += $value;
						}
					 	
					 	$recordSet->MoveNext();
					 	$i++;
					}
					
			}
			//get average
			foreach($HoldTimesArray as $key=>$value)
			{
				$HoldTimesArray[$key] = $value/$i; //$i = number of records
			}
			
			return $HoldTimesArray;
		}
		$recordSet->Close();	
   }
   
	private function getKey() 
	{
			//get entry keys
			global $db;
			$recordSet = &$db->Execute('SELECT entryKeys from Patterns where Name="'.$this->name.'" and TotalErrors = 0');
			if (!$recordSet) {
						 print $db->ErrorMsg();
			}
			else 
			{
				
				while (!$recordSet->EOF) {
						$entryKey = substr(trim($recordSet->fields[0]),0,strlen($recordSet->fields[0])-1); 
						$entryKeys = explode(",",$entryKey);
						$recordSet->MoveNext();
						
				}
			}
			return ($entryKeys);
			$recordSet->Close();	
	}	   
	
	private function getLocation()
   {

		//get time monitor values
		global $db;
		$recordSet = &$db->Execute('SELECT KeyLocations from Patterns where Name="'.$this->name.'" and TotalErrors = 0');
		if (!$recordSet) {
					 print $db->ErrorMsg();
		}
		else 
		{
			
			while (!$recordSet->EOF) {
					 $location = substr(trim($recordSet->fields[0]),0,strlen($recordSet->fields[0])-1); 
				     $locations = explode(",",$location);
					 
					 $recordSet->MoveNext();
           			 $locarray[] = $locations;
			}
//			print_r($locarray);
			
			foreach($locarray as $key=>$value)
			{
					foreach($value as $k=>$v) {
						if($v == 'standard')
						$locationcount['standard'][$k]++; 
						if($v == 'left')
						$locationcount['left'][$k]++; 
						if($v == 'right')
						$locationcount['right'][$k]++; 
						if($v == 'numpad')
						$locationcount['numpad'][$k]++; 
						
					}
			}
			
//			print_r($locationcount);
			foreach($locations as $key=>$value)
			{
				if($locationcount['standard'][$key] > (count($locations)/2))
				{
					$locationArray[$key] = 'standard';
				}
				if($locationcount['left'][$key] > (count($locations)/2))
				{
					$locationArray[$key] = 'left';
				}
				if($locationcount['right'][$key] > (count($locations)/2))
				{
					$locationArray[$key] = 'right';
				}
				if($locationcount['numpad'][$key] > (count($locations)/2))
				{
					$locationArray[$key] = 'numpad';
				}
			}
			return ($locationArray);		
		}
		$recordSet->Close();	
   }
	
	
	private function getHoverCount()
   {

		//get time monitor values
		global $db;
		$recordSet = &$db->Execute('SELECT round(sum(HoverCount)/count(HoverCount)) as HoverCount FROM Patterns where Name="'.$this->name.'" and TotalErrors = 0');
		if (!$recordSet) {
					 print $db->ErrorMsg();
		}
		else 
		{
			
			while (!$recordSet->EOF) {
					 $HoverCount = $recordSet->fields[0];	
					 $recordSet->MoveNext();
					return $HoverCount;
			}
		}
		$recordSet->Close();	
   }
   
   //badic check before creating template counts how many records the person have that have matching entryKeys
   private function validate()
   {
		global $db;
		$recordSet = &$db->Execute('SELECT * from Patterns where Name="'.$this->name.'" and TotalErrors = 0 group by entryKeys ');
		$count =  $recordSet->RecordCount();
		$recordSet->Close();	
		if($count == 1) return true;
		else return false;
   }
   
   //detects pauses in users typing ..
   private function PauseDetection()
   {
   		//get average flight time
		$averages = $this->getAverages();
		$averagepause = $averages['AverageFlightTime'];
  		//array of pauses. flight times above average flight tme
		$flighttimes = $this->getFlightTimeAverages();

		foreach($flighttimes as $key=>$value)
		{
			if($value > $averagepause) {
			$pauses[$key] = $value;
			}
		}
		return ($pauses); 
   }
   
   private function maxPause()
   {
   		$pauses = $this->PauseDetection();
		$max = 0;
		foreach($pauses as $key=>$value)
		{
			if($value > $max) $max = $value;
		}
		return $max;
   }
   
   //check need for error correction patterns
   private function getTotalErrors()
   {
		//get time monitor values
		global $db;
		$recordSet = &$db->Execute('SELECT sum(RightArrowCount + LeftArrowCount) as ArrowCount, sum(TotalErrors) as TotalErrors from Patterns where Name="'.$this->name.'" and TotalErrors != 0');
		if (!$recordSet) {
					 print $db->ErrorMsg();
		}
		else 
		{
			
			while (!$recordSet->EOF) {
					 $totalerrors = $recordSet->fields[0] + $recordSet->fields[1];	
					 $recordSet->MoveNext();
			}
		}
		$recordSet->Close();	
		return $totalerrors;
   }
   /*//checks weather single clicks have been used for error correction // assumeing more than 1 click is error
   private function SingleClickFlag()
   {
		//get time monitor values
		global $db;
		$recordSet = &$db->Execute('select * from Patterns where SingleClickCount>1 and Name="'.$this->name.'" and TotalErrors != 0');
		$count =  $recordSet->RecordCount();
		$recordSet->Close();	
		if($count > 0) return true;
		else return false;
   }
   
   //checks the usage of double clicks for error correction. assumes double clicks are only used within the textbox for error correction
   private function DoubleClickFlag()
   {
		//get time monitor values
		global $db;
		$recordSet = &$db->Execute('select * from Patterns where DoubleClickCount>0 and Name="'.$this->name.'" and TotalErrors != 0');
		$count =  $recordSet->RecordCount();
		$recordSet->Close();	
		if($count > 0) return true;
		else return false;
   }
   
   //checks the use of delete keys
   private function DeleteFlag()
   {
		//get time monitor values
		global $db;
		$recordSet = &$db->Execute('select * from Patterns where DeleteCount>0 and Name="'.$this->name.'" and TotalErrors != 0');
		$count =  $recordSet->RecordCount();
		$recordSet->Close();	
		if($count > 0) return true;
		else return false;
   }
   
   //checks the use of backspace key
   private function BackspaceFlag()
   {
		//get time monitor values
		global $db;
		$recordSet = &$db->Execute('select * from Patterns where BackspaceCount>0 and Name="'.$this->name.'" and TotalErrors != 0');
		$count =  $recordSet->RecordCount();
		$recordSet->Close();	
		if($count > 0) return true;
		else return false;
   }
   
   //checks the use of right key
   private function RightArrowFlag()
   {
		//get time monitor values
		global $db;
		$recordSet = &$db->Execute('select * from Patterns where RightArrowCount>0 and Name="'.$this->name.'" and TotalErrors != 0');
		$count =  $recordSet->RecordCount();
		$recordSet->Close();	
		if($count > 0) return true;
		else return false;
   }
   
   //checks the use of left key
   private function LeftArrowFlag()
   {
		//get time monitor values
		global $db;
		$recordSet = &$db->Execute('select * from Patterns where LeftArrowCount>0 and Name="'.$this->name.'" and TotalErrors != 0');
		$count =  $recordSet->RecordCount();
		$recordSet->Close();	
		if($count > 0) return true;
		else return false;
   }*/

	//check methods used for error correction
	private function errorCorrectionMethods()
	{

		global $db;
		$recordSet = &$db->Execute('SELECT BackspaceCount,DeleteCount,RightArrowCount,LeftArrowCount,SingleClickCount,DoubleClickCount from Patterns where Name="'.$this->name.'" and TotalErrors != 0');
		if (!$recordSet) {
					 print $db->ErrorMsg();
		}
		else 
		{
			
			while (!$recordSet->EOF) {
					 $correctionMethod['Backspace'] = ($recordSet->fields[0] > 0) ? "true" : "false";
					 $correctionMethod['Delete'] = ($recordSet->fields[1] > 0) ? "true": "false";
 					 $correctionMethod['RightArrow'] = ($recordSet->fields[2] > 0) ? "true": "false";
 					 $correctionMethod['LeftArrow'] = ($recordSet->fields[3] > 0) ? "true": "false";
 					 $correctionMethod['Clicks'] = (($recordSet->fields[4] + $recordSet->fields[5]) > 0) ? "true": "false";
					 $recordSet->MoveNext();
			}
		}
		$recordSet->Close();	
		return $correctionMethod;
	}
	
	//the total error list with positions
	private function totalErrorList()
	{
		global $db;
		$recordSet = &$db->Execute('SELECT AllErrors from Patterns where Name="'.$this->name.'" and TotalErrors != 0');
		if (!$recordSet) {
					 print $db->ErrorMsg();
		}
		else 
		{
			$errorSet = "";
			while (!$recordSet->EOF) {
					 $errorSet .= $recordSet->fields[0];
					 $recordSet->MoveNext();
			}
			$errorSet = substr(trim($errorSet),0,strlen($errorSet)-1);
			$errors = explode(",",$errorSet);
		}
		
		$recordSet->Close();	
		
		//remove duplicate values
		$errors = array_unique($errors);
		//sorts key positions ..chrnological order
		sort($errors);
		return $errors;
		
		
	}
	
	//list all deletes
	private function DeleteList()
	{
		global $db;
		$recordSet = &$db->Execute('SELECT Deletes from Patterns where Name="'.$this->name.'" and TotalErrors != 0');
		if (!$recordSet) {
					 print $db->ErrorMsg();
		}
		else 
		{
			$errorSet = "";
			while (!$recordSet->EOF) {
					 $errorSet .= $recordSet->fields[0];
					 $recordSet->MoveNext();
			}
			$errorSet = substr(trim($errorSet),0,strlen($errorSet)-1);
			$errors = explode(",",$errorSet);
		}
		
		$recordSet->Close();	
		
		//remove duplicate values
		$errors = array_unique($errors);
		//sorts key positions ..chrnological order
		sort($errors);
		return $errors;
		
		
	}
	
	//list all Backspaces
	private function BackspaceList()
	{
		global $db;
		$recordSet = &$db->Execute('SELECT Backspaces from Patterns where Name="'.$this->name.'" and TotalErrors != 0');
		if (!$recordSet) {
					 print $db->ErrorMsg();
		}
		else 
		{
			$errorSet = "";
			while (!$recordSet->EOF) {
					 $errorSet .= $recordSet->fields[0];
					 $recordSet->MoveNext();
			}
			$errorSet = substr(trim($errorSet),0,strlen($errorSet)-1);
			$errors = explode(",",$errorSet);
		}
		
		$recordSet->Close();	
		
		//remove duplicate values
		$errors = array_unique($errors);
		//sorts key positions ..chrnological order
		sort($errors);
		return $errors;
		
		
	}
	
	//list all errors
	private function ArrowList()
	{
		global $db;
		$recordSet = &$db->Execute('SELECT RightArrows,LeftArrows from Patterns where Name="'.$this->name.'" and TotalErrors != 0');
		if (!$recordSet) {
					 print $db->ErrorMsg();
		}
		else 
		{
			$errorSet = "";
			while (!$recordSet->EOF) {
					 $errorSet .= $recordSet->fields[0] + $recordSet->fields[1];
					 $recordSet->MoveNext();
			}
			$errorSet = substr(trim($errorSet),0,strlen($errorSet)-1);
			$errors = explode(",",$errorSet);
		}
		
		$recordSet->Close();	
		
		//remove duplicate values
		$errors = array_unique($errors);
		//sorts key positions ..chrnological order
		sort($errors);
		return $errors;
		
		
	}
} 


$t = new Template();
//$t->newTemplate("Jinah Adam",false);
//$t->save();
$t->retrieve("jinahadam");
$t->debug();

?>