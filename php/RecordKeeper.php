<!doctype html>

<?php 

class RecordKeeper{
	
	//BACKING FIELDS
	
	
	//METHODS
	public function AddRecord($name){
		$file = fopen("records/$name.txt", 'w'); //OPENS THE FILE TO WRITE A NEW ONE.
		
		fwrite($file, $name.":0"); //WRITES IN THE DEFAULT INFO.
		
		fclose($file); //CLOSES THE FILE
		
	}
	
	public function RewriteRecords($ind, $value){
		
		$file = fopen("records/$ind.txt", "r"); //OPENS THE FILE USING THE $IND ARGUMENT.
		
		$record = explode(":", fgets($file)); //SPLITS UP THE RECORD INTO TWO PARTS.
		fclose($file); //CLOSES THE FILE.
		
		$file = fopen("records/$ind.txt", 'w'); //OPENS UP THE SAME FILE IN ORDER TO WRITE.
		
		$record[1] += (float)$value; //ADDS NEW MONEY VALUE ONTO THE OLD.
		
		fwrite($file, "$record[0]:$record[1]"); //STICHES IT ALL BACK TOGETHER INTO THE FILE.
		fclose($file); //CLOSES THE FILE.
		
		
	}
	
	public function DeleteRecord($ind){
		$file = "records/$ind.txt";
		
		unlink($file);
	}
	
	public function FetchRecords(){
		$records = scandir("records/"); //SCANS THE DIRECTORY FOR ALL THE TEXT FILES.
		$holdRecords = ""; //DEFAULTS THE HOLDING VARIABLE
		
		for($i = 2; $i< count($records); $i++){ //ITERATES THROUGH EACH NAMED TXT FILE IN ORDER TO GET THEIR INFO.
			$file = fopen("records/".$records[$i], 'r');
			
			if($i != count($records)-1){ //MAKES SURE THAT THIS IS NOT THE LAST RECORD.
				$holdRecords .= fgets($file)."\n";
				fclose($file);
			}
			else{ //ON THE LAST RECORD, THE METHOD WILL NOT CREATE A NEW LINE. THIS PREVENTS BLANK ACCOUNTS.
				$holdRecords .= fgets($file);
				fclose($file);
			}
		}
		
		return $holdRecords;
	}

}

?>