<!doctype html>

<?php
	//THIS IS THE CLASS THAT WILL HOLD THE PARALLEL ARRAYS FOR THE FINANCIAL RECORDS.
	class parallelArrays{
		public $name;
		public $amt;
		
		public function _construct($nm, $amts){
			$this->name = explode(";",$nm);
			$this->amt = explode(";",$amts);
		}
		
		//PARSES THE INFO INTO THEIR SEPARATE ARRAYS.
		public function parseArrays($nm, $amts){
			$this->name = explode(";",$nm);
			$this->amt = explode(";",$amts);
		}
		
		//DISPLAYS THE PRESCHOSEN RECORD.
		public function displayRecordInfo($num){
			$num = (int)$num;
			$line = "This Record: ".$this->name[$num]." | ".$this->amt[$num];
			return $line;
		}
		
		//SEARCHES FOR THE INDEX OF AN ARRAY BY ITS NAME.
		public function search($ser){
			$pos = array_search($ser, $name);
			return $pos;
		}
		
		public function SetArraysManually(){
			//OPENS THE RECORDS FILE.
    		$file = fopen("records/finRec.txt", 'r');
			
			while(!feof($file)){
				$tmp = fgets($file);
				$money = explode(':',$tmp);
				
				//ADDS THE INFO TO CONTAINER STRINGS
				$names .= "$money[0];";
				$amts .= "$money[1];";

			}
			$this->parseArrays($names, $amts);
			
			
		}
		
	}
?>