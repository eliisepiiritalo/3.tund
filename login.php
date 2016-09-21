<?php
	
	//võtab ja kopereerib faili sisu
	require("../../config.php");
	
	
	//var_dump(5.5);
	//var_dump($_GET);
	//echo "<br>";
	//var_dump($_POST);
	
	//MUUTUJAD
	
	$signupEmailError = "";
	$signupPasswordError = "";
	$signupEmail = "";
	
	// kas e/post oli olemas
	if ( isset ( $_POST["signupEmail"] ) ) {
		
		if ( empty ( $_POST["signupEmail"] ) ) {
			
			// oli email, kuid see oli tühi
			$signupEmailError = "See väli on kohustuslik!";
			
		}else {
			
			//email on õige
			$signupEmail = $_POST["signupEmail"];
			
		}
		
	}
	
	if ( isset ( $_POST["signupPassword"] ) ) {
		
		if ( empty ( $_POST["signupPassword"] ) ) {
			
			// oli password, kuid see oli tühi
			$signupPasswordError = "See väli on kohustuslik!";
			
		} 
			
	
			
		// tean et parool on ja see ei olnud tühi
		// VÄHEMALT 8
		
		if ( strlen($_POST["signupPassword"]) < 8 ) {
			
			$signupPasswordError = "Parool peab olema vähemalt 8 tähemärkki pikk";
			
		}
		
	}
	
	$gender = "male";
	// KUI Tühi
	// $gender = "";
	
	if ( isset ( $_POST["gender"] ) ) {
		if ( empty ( $_POST["gender"] ) ) {
			$genderError = "See väli on kohustuslik!";
		} else {
			$gender = $_POST["gender"];
		}
	}
	
	
	//Kus tean et ühtegi viga ei olnud ja saan kasutada andmed salvestada
	if ( isset($_POST["signupPassword"]) &&
		isset($_POST["signupEmail"]) &&
		empty ($signupEmailError) &&
		empty($signupPasswordError)
		) {
		
		echo "Salvestan...<br>";
		echo "email ".$signupEmail."<br>";
		
		$password = hash("sha512", $_POST["signupPassword"]);
		
		echo "parool ".$_POST["signupPassword"]."<br>";
		echo "räsi ".$password."<br>";
		
		//echo $serverUsername;
		
		$database = "if16_eliispiiri";
		
		$mysqli = new mysqli($serverHost,$serverUsername,$serverPassword,$database);
		
		//käsk
		$stmt = $mysqli->prepare("INSERT INTO user_sample (email, password) VALUES (?, ?)");
		
		echo $mysqli->error;
		
		//asendan küsimärgi väärtustega
		//iga muutuja kohta 1 täht, mis tüüpi muutuja on
		//s - string
		//i - integer
		//d - double/float
		$stmt->bind_param("ss", $signupEmail, $password);
		
		if($stmt->execute()) {
			
			echo "salvestamine õnnestus";
		} else {
			echo "ERROR ".$STMT->ERROR;
		}
		
	}
	
	
	
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Sisselogimise lehekülg</title>
	</head>
	<body>

		<h1>Logi sisse</h1>
		
		<form method="POST">
			
			<label>E-post</label><br>
			<input name="loginEmail" type="email">
			
			<br><br>
			
			<input name="loginPassword" type="password" placeholder="Parool">
			
			<br><br>
			
			<input type="submit" value="Logi sisse">
			
		</form>
		
		<h1>Loo kasutaja</h1>
		
		<form method="POST">
			
			<label>E-post</label><br>
			<input name="signupEmail" type="email" value="<?=$signupEmail;?>"> <?php echo $signupEmailError; ?>
			
			<br><br>
			
			<input name="signupPassword" type="password" placeholder="Parool"> <?php echo $signupPasswordError; ?>
			
			<br><br>
			
			<?php if($gender == "male") { ?>
				<input type="radio" name="gender" value="male" checked> Male<br>
			 <?php } else { ?>
				<input type="radio" name="gender" value="male" > Male<br>
			 <?php } ?>
			 
			 <?php if($gender == "female") { ?>
				<input type="radio" name="gender" value="female" checked> Female<br>
			 <?php } else { ?>
				<input type="radio" name="gender" value="female" > Female<br>
			 <?php } ?>
			 
			 <?php if($gender == "other") { ?>
				<input type="radio" name="gender" value="other" checked> Other<br>
			 <?php } else { ?>
				<input type="radio" name="gender" value="other" > Other<br>
			<?php } ?>
			
			
			<input type="submit" value="Loo kasutaja">
			
		</form>
		
	</body>
</html>