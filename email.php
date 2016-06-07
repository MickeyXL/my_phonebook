<?php if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $email = trim($_POST["email"]);

  require_once("phpmailer/class.phpmailer.php");
  $mail = new PHPMailer();

  if (!$mail->ValidateAddress($email)){
    echo'<div class="alert-box">';
      echo'<span>Favor digitar um email válido.</span>';
      echo'<a href="email.php">fechar</a>';
    echo'</div>';
  }

  $mail->IsSMTP();
  $mail->SMTPAuth = true;
  $mail->Host = 'smtp.gmail.com';
  $mail->Port = 587;
  $mail->SMTPSecure = 'tls';
  $mail->Username = "intruder.star@gmail.com"; // my email which I hope to receive the data inputed on the field
  $mail->Password = "fulltime12345";

  $mail->SetFrom('intruder.star@gmail.com', 'Interessado'); // the email from the person who filled the form, that will be in the body of the message that I will receive
  $address = $email; // my email which I hope to receive the data inputed on the field
  $mail->AddAddress($address, "Fine Design");
  $mail->Subject = "Fine Design - Avise me!";
  $mail->MsgHTML($email);

  if(!$mail->Send()) {
    echo'<div class="alert-box">';
      echo'<span>';
      echo $mail->ErrorInfo;
      echo '</span>';
      echo'<a href="email.php">fechar</a>';
    echo'</div>';
  } else {
    header("Location: email.php?status=thanks");
  }
}
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<form method="post" action="email.php">
  Email: <input name="email" id="email" type="text" /><br />

  Message:<br />
  <textarea name="message" id="message" rows="15" cols="40"></textarea><br />

  <input type="submit" value="Submit" />
</form>
</body>
</html>