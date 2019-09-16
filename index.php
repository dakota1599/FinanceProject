<?php session_start();
	if($_SESSION['passAccepted']){
		header("Location: finance.php");
	}?>
<!doctype html>
<html lang="en-us">
<head>
<meta charset="utf-8">
	
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="Keywords" content="finance, web, app, dakota, shapiro">
<meta name="Description" content="Online finance manager for keeping track of expenses and income.">
	
<!--W3 SCHOOLS' CSS LIBRARY-->
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	
<!--GOOGLE FONT LIBRARY-->
<link href="https://fonts.googleapis.com/css?family=Share+Tech&display=swap" rel="stylesheet">

<!--MY OWN CSS-->
<link href="css/main.css" rel="stylesheet" type="text/css">
	
<link rel="shortcut icon" href="../images/android-icon-36x36.png">
	
<!--MY JAVASCRIPT-->
<script src="js/main.js"></script>
	
<style>
	/*CONTROLS THE FONT FOR THE PAGE BECAUSE FOR SOME REASON
	  FONTS WON'T AFFECT CERTAIN OBJECTS WHEN USING ONLY THE 
	  ASTERISK, AND I HAVE TO SPECIFY THEM SEPERATELY.*/
	*{
		font-family: 'Share Tech', sans-serif;
	}
	#headerTitle, .titles, h1{
		font-family: 'Share Tech', sans-serif;
	}
	
	/*SETS THE LOGBOX ATTRIBUTES.*/
	#logDiv{
		width: 25em;
		height: auto;
		margin:auto;
		margin-top:4em;
		padding:1em;
	}
	h2{
		text-align:center;
	}
	#logDiv form, span{
		font-size: 20px;
	}
	#logDiv span{
		text-align:center;
	}
	input{
		cursor: text;
		letter-spacing: 6px;
		font-weight: bold;
	}
	table{
		width: 100%;
	}
	
	/*SETS THE TEXTBOX ATTRIBUTES SO THAT IT LOOKS COOL WHEN HOVERING AND WHAT NOT.*/
	.textBox{
		outline: none;
		transition: .4s;
	}
	.textBox:hover{
		border-bottom: 5px solid #1FB5E8;
	}
	.textBox:focus{
		border-bottom: 5px solid #1FB5E8;
	}
	
	/*MEDIA QUERIES... JUST THE ONE THOUGH.*/
	@media only screen and (max-width: 420px){
		#logDiv{
			width: 17em;
			height: 15em;
		}
	}
</style>

	
	
<title>Finance Login | Dakota Shapiro</title>
</head>

<body>
	
	<?php 
		$pass = "SquareRoot12";
		$incorrect = "";
		$passAccepted = false;
		
		//CHECKS TO SEE IF PASS IS CORRECT.
		if($_SERVER['REQUEST_METHOD'] == "POST"){
			if($_POST['pass'] == $pass){
				$hideLog = "display:none;";
				$_SESSION['passAccepted'] = true; //SETS ACCEPTED PASS VALIDATION.
				$incorrect = "<meta http-equiv=\"Refresh\" content=\"0; url=finance.php\">";
			}//OUTPUTS IF PASS DOES NOT EQUAL ANYTHING.
			elseif($_POST['pass'] == null){
				$incorrect = "Must Enter a Password.";
			}//OUTPUTS IF PASS DOES NOT EQUAL THE CORRECT PASSWORD.
			else{
				$incorrect = "Password is Incorect.";
				$_POST['pass'] = "";
			}
		}
	?>
	
	
	<!--THE FORM ITSELF, WITH PHP INJECTED INTO THE CLASS SECTION
					IN ORDER TO HIDE IT WHEN IT HAS BEEN SUBMITTED.-->
	<div class="w3-card-4" id="logDiv">
		<h2 style="text-decoration:underline;"><em><strong>Sign In</strong></em></h2>
		<form action="index.php" method="post">
			<table>
				<tbody>
					<tr>
						<td><input class="w3-input textBox" type="password" placeholder="Password" name="pass">
						</td>
					</tr>
					<tr>
						<td style="text-align:center;">
							<button class="submit w3-round-medium w3-large" type="submit" style="margin-top:1em;">Log in</button>
						</td>
					</tr>
					<tr>
						<td style="color:red;"><?php echo $incorrect;?></td>
					</tr>
				</tbody>
			</table>
			
		</form>
	</div>
	<div style="text-align:center; margin-top: 1em;"><a href="demo/demo.php" class="abLinks" style="text-align:center; margin:auto; font-size:20px;" title="Demo" target="_blank">Click Here for Demo</a></div>
		
	
	<!--ALLOWS FOR ENTER BUTTON TO RUN THE LOG IN-->
	<script>
		var input = document.getElementByName("pass");
		
		input.addEventListener("keyup", function(event){
			if(event.keyCode === 13){
				event.preventDefault();
				document.getElementByTagName("button").click();
			}
		});
	</script>
	
	<p style="text-align:center; margin: 0 1em 1em 1em; color:dimgray;">Version: 2.0<br>Copyright &copy; 2019 Dakota Shapiro<br><br>
		
		Tab Icon, made by <a class="abLinks" href="https://www.freepik.com/" title="Freepik">Freepik</a> from <a class="abLinks" href="https://www.flaticon.com/" 	title="Flaticon">www.flaticon.com</a>, is licensed by <a class="abLinks" href="http://creativecommons.org/licenses/by/3.0/" title="Creative Commons BY 3.0" target="_blank">CC 3.0 BY</a>
	</p>
	
</body>
</html>