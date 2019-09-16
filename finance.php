<?php 
//CHECKS FOR ACCEPTED PASSWORD.
session_start();
if(!$_SESSION['passAccepted']){
	header("Location: index.php");
}else{
	require "php/ParallelArrays.php";
	require "php/RecordKeeper.php";
	//CHECKS TO SEE IF THERE WERE ANY FORM REQUESTS.
	if($_SERVER['REQUEST_METHOD'] == "POST"){
        if(isset($_POST['addAct'])){
            $recordKeep = new RecordKeeper();

            $recordKeep->AddRecord($_POST['act']);
        }
		
		//FOR MODIFYING ANY OF THE RECORDS. IT CHECKS TO SEE IF THE FIRST POSSIBLE BUTTONS EXITS.
		for($i = 0; $i < 100; $i++){
			$cur = "save$i"; //THESE ARE COMPUTER GENERATED.  THAT'S WHY THIS IS THE WAY IT IS.
			$val = "value$i";
			if(isset($_POST[$cur])){
				$editRecords = new RecordKeeper(); //CREATES NEW RECORD KEEPER.
				$editRecords->RewriteRecords($_POST[$cur],$_POST[$val]); //GOES TO REWRITE THE CURRENT RECORD.
				$i = 100;
			}
		}
		
		//FOR DELETING ANY OF THE RECORDS.
		for($i = 0; $i < 100; $i++){
			$cur = "del$i"; //THESE ARE COMPUTER GENERATED.  THAT'S WHY THIS IS THE WAY IT IS.
			$val = "value$i";
			if(isset($_POST[$cur])){
				$editRecords = new RecordKeeper(); //CREATES NEW RECORD KEEPER.
				$editRecords->DeleteRecord($_POST[$cur],$_POST[$val]); //GOES TO REWRITE THE CURRENT RECORD.
				$i = 100;
			}
		}
}
	
	//IF ACCEPTED IT OPENS THE RECORDS FILE.
    $records = new RecordKeeper();
	$recordsArray = explode("\n",$records->FetchRecords());
	
	
    //COUNTER VARIABLE
    $count = 0;

    //THIS WILL HOLD ALL THE HTML CODE FOR THE MONEY CARDS.
    $output = "";
	$names = "";
	$amts = "";
	$total = 0;
	$formattedMoney;

    //ITERATES THROUGH THE FILE.
    for($i = 0; $i < count($recordsArray); $i++){

		if(empty($records->FetchRecords())){
			break;
		}
		
        $money = explode(':', $recordsArray[$i]); //SPLITS THE LINE INTO THREE PARTS
		
		$total += (double)$money[1]; //ADDS UP THE TOTAL AMOUNT OF MONEY FROM ALL ACCOUNTS.
		
		
		$formattedMoney = number_format($money[1],2);
		
        //ADDS CARDS WITH THE INFO FROM THE CURRENT CARD LINE.
        $output .= "<div class=\"cards w3-card-4\" id=\"$money[0]\">
        <h1>$money[0] - $$formattedMoney</h1>
        <form action=\"finance.php\" method=\"post\">
			
            <input style=\"width:50%; margin:auto;\" type=\"number\" placeholder=\"Amt\" class=\"w3-input text\" name=\"value$count\" step=\".01\">
            <button style=\"transition: .4s;\" type=\"submit\" class=\"submit w3-round-medium\" value=\"$money[0]\" name=\"save$count\">Add</button>
			<button type=\"submit\" class=\"submit w3-round-medium delButton\" value=\"$money[0]\" name=\"del$count\" id=\"del$count\">Delete</button>
        </form>
    </div>\n";
		
		//ADDS THE INFO TO CONTAINER STRINGS
		$names .= "$money[0];";
		$amts .= "$money[1];";

        //COUNTS UP IN ORDER TO GET SPECIFIC IDENTIFYERS TO THE CARDS.
        $count++;


    }
	
	$total = number_format($total,2);
	
	//CREATES THE PARALLEL ARRAY OBJECT.
	$arrays = new parallelArrays();
	$arrays->parseArrays($names, $amts);
}

?>

<!doctype html>
<html lang="en-us">
<head>
<meta charset="utf-8">
	
<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
<!--SHORTCUT ICON-->
<link rel="shortcut icon" href="images/android-icon-36x36.png">
	
<!--W3 SCHOOLS' CSS LIBRARY-->
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	
<!--GOOGLE FONT LIBRARY-->
<link href="https://fonts.googleapis.com/css?family=Share+Tech&display=swap" rel="stylesheet">

<!--MY OWN CSS-->
<link href="css/main.css" rel="stylesheet" type="text/css">
<link href="css/finance.css" rel="stylesheet" type="text/css">
	
<link rel="shortcut icon" href="../images/android-icon-36x36.png">

<script src="js/main.js"></script>
	
<style>
	*{
		font-family: 'Share Tech', sans-serif;
	}
	h1{
		font-family: 'Share Tech', sans-serif;
	}	
</style>

	
<title>Financial Manager | Dakota Shapiro</title>
</head>

<body>
	<!--NAVIGATION BAR (JUST FOR THE SIGN OUT BUTTON FOR NOW.  NOT SURE WHAT ELSE I WOULD ADD.)-->
	<div class="w3-bar w3-top">
		<a href="php/logout.php" class="w3-button" style="float: right; transition: .4s;" title="Log out.">Log Out</a>
	</div>
	
	<h1 id="headerTitle">Finance</h1>
	<h1 class="totalAmt">$<?php echo $total;?><span style="font-size: 20px;">(Total)</span></h1>
	<hr class="pageHr" style="margin: 2em auto 1em;">
	
	<div id="newActRow">
		  <!--BUTTON FOR OPENING UP THE NEW ACCOUNT BUBBLE.-->
          <button style="outline:none;" onclick="displayPanel();" class="w3-button w3-round-medium w3-blue w3-hover-blue-grey">&plus;New Account</button>
		  
		  <!--BUTTON FOR ACTIVATING THE DELETE BUTTONS ON ALL THE CARDS.-->
		  <button style="outline:none;" onclick="displayDel();" class="w3-button w3-round-medium w3-red w3-hover-amber">Delete Account</button>
		
		
          <form action="finance.php" method="post" class="addNew ">
              <div class="w3-round-medium w3-hide" id="newPanel">
                  <input type="text" class="w3-input text" maxlength="20" name="act" placeholder="Account Name">
                  <button name="addAct" title="Add New Account" type="submit" class="submit add w3-round-medium">&plus;</button>
              </div>
          </form>
	</div>
	
	
	<!--THIS IS WHERE ALL THE CARDS WOULD BE DELEGATED.-->
	<div id="cardBody">
		<?php echo $output;?>
		
	</div>
	
	<!--FOOT NOTE SECTION-->
	<div class="sectionDiv" id="footer">
		<p style="text-align:center; margin: 0 1em 1em 1em; color:dimgray;">Version: 2.0<br>Copyright &copy; 2019 Dakota Shapiro<br><br>
		
		Tab Icon, made by <a class="abLinks" href="https://www.freepik.com/" title="Freepik">Freepik</a> from <a class="abLinks" href="https://www.flaticon.com/" 	title="Flaticon">www.flaticon.com</a>, is licensed by <a class="abLinks" href="http://creativecommons.org/licenses/by/3.0/" title="Creative Commons BY 3.0" target="_blank">CC 3.0 BY</a>
		</p>
	</div>
	<!--END OF FOOT NOTE SECTION-->
	
</body>
</html>