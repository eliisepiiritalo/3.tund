<?php
	
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
			
			// oli email, kuid see oli t�hi
			$signupEmailError = "See v�li on kohustuslik!";
			
		}else {
			
			//email on �ige
			$signupEmail = $_POST["signupEmail"];
			
		}
		
	}
	
	if ( isset ( $_POST["signupPassword"] ) ) {
		
		if ( empty ( $_POST["signupPassword"] ) ) {
			
			// oli password, kuid see oli t�hi
			$signupPasswordError = "See v�li on kohustuslik!";
			
		} 
			
	
			
		// tean et parool on ja see ei olnud t�hi
		// V�HEMALT 8
		
		if ( strlen($_POST["signupPassword"]) < 8 ) {
			
			$signupPasswordError = "Parool peab olema v�hemalt 8 t�hem�rkki pikk";
			
		}
		
	}
	
	$gender = "male";
	// KUI T�hi
	// $gender = "";
	
	if ( isset ( $_POST["gender"] ) ) {
		if ( empty ( $_POST["gender"] ) ) {
			$genderError = "See v�li on kohustuslik!";
		} else {
			$gender = $_POST["gender"];
		}
	}
	
	
	
	
	
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Sisselogimise lehek�lg</title>
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