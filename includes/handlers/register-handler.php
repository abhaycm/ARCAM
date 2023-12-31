<?php 

function sanitizeFormPassword($inputText) {
	$inputText = strip_tags($inputText);
	return $inputText;  
}

function sanitizeFormUsername($inputText) {
	$inputText = strip_tags($inputText);
	$inputText = str_replace(" ", "", $inputText);
	return $inputText;
}

function sanitizeFormString($inputText) {
	$inputText = strip_tags($inputText);
	$inputText = str_replace(" ", "", $inputText);
	$inputText = ucfirst(strtolower($inputText));
	return $inputText;
}


if(isset($_POST['registerButton'])) {
	//Register button was pressed
	$username = sanitizeFormUsername($_POST['username']);
	$name = sanitizeFormString($_POST['name']);
	$type = $_POST['type'];
	$email = sanitizeFormString($_POST['email']);
	$email2 = sanitizeFormString($_POST['email2']);
	$password = sanitizeFormPassword($_POST['password']);
	$password2 = sanitizeFormPassword($_POST['password2']);

    $wasSuccessful = $account->register($username,$name,$type,$email,$email2,$password,$password2);

    if($wasSuccessful){
        $_SESSION['userLoggedIn'] = $username;
        header("Location: index.php");
    }
}


?>


