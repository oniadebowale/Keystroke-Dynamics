<?php
$myFile = "data.txt";
require_once 'Singleton.php';
$db = DatabaseConnection::get()->handle();
//$db->debug = true;
foreach($_POST as $key=>$value)
{
 $$key = $value;		
}
if((strlen($password)) < 8)
{
				$msg = "<span class='Error'>Password is too short. Minimum 8 chars required.</span>";
				$filename  = dirname(__FILE__).'/data.txt';
				file_put_contents($filename,$msg);
} else
{
	//check attemp count
	$recordSet1 = &$db->Execute('SELECT * from Patterns where Name="'.$TemplateName.'"');
	$count =  $recordSet1->RecordCount();
	
	//if not first pattern attemp the. check of the passwrod matches
	if($count > 0)
	{
			$recordSet2 = &$db->Execute('SELECT password FROM Patterns where Name = "'.$TemplateName.'" limit 1');
			if (!$recordSet2) {
						 print $db->ErrorMsg();
			}
			else 
			{
				
				while (!$recordSet2->EOF) {
							//retiruve and assing it to local varialbes
							$oldpass = $recordSet2->fields[0];	
							$recordSet2->MoveNext();
				}
			}
			
			
			if($oldpass != $password) 
			{
				$msg = "<span class='Error'>Password doest match to previous attempt</span>";
				$filename  = dirname(__FILE__).'/data.txt';
				file_put_contents($filename,$msg);
			}
			else
			{	//check password lefnth
				
					$sql = "insert into Patterns (Name,DoubleClickCount,SingleClickCount,HoverCount,TotalErrors,BackspaceCount,DeleteCount,RightArrowCount,LeftArrowCount,
					TotalTime,AverageFlightTime,AverageHoldTime,TotalFlightTime,TotalHoldTime,FlightTimes,HoldTimes,KeyLocations,KeyModifiers,AllErrors,Backspaces,
					Deletes,RightArrows,LeftArrows,entryKeys,password) values('$TemplateName', $DoubleClickCount, $SingleClickCount, $HoverCount, $TotalErrors, $BackspaceCount, $DeleteCount, $RightArrowCount, $LeftArrowCount, $TotalTime, $AverageFlightTime, $AverageHoldTime, $TotalFlightTime, $TotalHoldTime, '$FlightTimes', '$HoldTimes', '$KeyLocations', '$KeyModifiers', '$AllErrors', '$Backspaces', '$Deletes', '$RightArrows', '$LeftArrows', '$Keys', '$password')";
					
					
					$db->debug = true; // for debuging
					//echo $sql;
					if ($db->Execute($sql) === false) print 'error inserting';
					
					//get total records for the specified user.
					$recordSet = &$db->Execute('SELECT * from Patterns where Name="'.$TemplateName.'" and TotalErrors = 0');
					$rcount =  $recordSet->RecordCount();
	
					
					$msg = "<span class='Green'>Pattern has been recorded for $TemplateName . <br/ >you have <span id='patterncount' class='Error'>$rcount</span> successful patterns so far. <br />Press 'New Attempt' to create more patterns<br /> $TemplateMsg </span>";
					$filename  = dirname(__FILE__).'/data.txt';
					file_put_contents($filename,$msg);
		
				
			}
	
	
	}
	else
	{
			$sql = "insert into Patterns (Name,DoubleClickCount,SingleClickCount,HoverCount,TotalErrors,BackspaceCount,DeleteCount,RightArrowCount,LeftArrowCount,
					TotalTime,AverageFlightTime,AverageHoldTime,TotalFlightTime,TotalHoldTime,FlightTimes,HoldTimes,KeyLocations,KeyModifiers,AllErrors,Backspaces,
					Deletes,RightArrows,LeftArrows,entryKeys,password) values('$TemplateName', $DoubleClickCount, $SingleClickCount, $HoverCount, $TotalErrors, $BackspaceCount, $DeleteCount, $RightArrowCount, $LeftArrowCount, $TotalTime, $AverageFlightTime, $AverageHoldTime, $TotalFlightTime, $TotalHoldTime, '$FlightTimes', '$HoldTimes', '$KeyLocations', '$KeyModifiers', '$AllErrors', '$Backspaces', '$Deletes', '$RightArrows', '$LeftArrows', '$Keys', '$password')";
					
					
					$db->debug = true; // for debuging
					//echo $sql;
					if ($db->Execute($sql) === false) print 'error inserting';
					
					//get total records for the specified user.
					$recordSet = &$db->Execute('SELECT * from Patterns where Name="'.$TemplateName.'" and TotalErrors = 0');
					$rcount =  $recordSet->RecordCount();
					
					
					
					$msg = "<span class='Green'>Pattern has been recorded for $TemplateName . <br/ >you have <span class='Error'>$rcount</span> successful patterns so far. <br />Press 'New Attempt' to create more patterns</span>";
					$filename  = dirname(__FILE__).'/data.txt';
					file_put_contents($filename,$msg);
	}
}
?>
