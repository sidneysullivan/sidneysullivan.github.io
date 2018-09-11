<?php
  /* ------------- BEGIN OF CUSTOMIZABLE INFO ------------------ */
  /* email of the person receiving the contact form (your email) */
  $to = 'sflsullivan@outlook.com';
  /* your site url (for info in the email) */
  $site_url = 'https://sidneysullivan.github.io/';
  $form_email_label = "Email:";
  $form_message_label = "Message:";
  $form_submit_label = "Submit";
  $attack_detected = "Sending information to administrator";
  $missing_from = "Please provide an email address";
  $invalid_from = "Please provide a valid email address - like something@something.com";
  $missing_message = "Please insert some text in the message";
  $could_not_send = "There was a problem while sending the email. Please try again a bit later.";
  /* ------------- END OF CUSTOMIZABLE INFO ------------------ */
  $from_errors = array();
  $message_errors = array();
  $sending_error = array();
  function cleanEmail($email) {
    return trim(strip_tags($email));
  }
  function validEmail($email) {
    $pattern = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/i";
    return preg_match($pattern, cleanEmail($email));
  }
  function verifyFrom($from){
    if(empty($from))       { array_push($from_errors, $missing_from); }
    if(!validEmail($from)) { array_push($from_errors, $invalid_from); }
    return count($from_errors) == 0;
  }
  function verifyMessage($message) {
    if(empty($message))    { array_push($message_errors, $missing_message); }
    return count($message_errors) == 0;
  }
  if($_POST) {
    $from = $_POST['from'];
    $message = $_POST['message'];
    if (verifyFrom($from) && verifyMessage($message)) {
      $cleanFrom = cleanEmail($from);
      $subject = 'Contact - '. $site_url;
      $headers = "From: " . $cleanFrom . "\r\n";
      $headers .= "Reply-To: ". $cleanFrom . "\r\n";
      $headers .= "MIME-Version: 1.0\r\n";
      $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
      if (mail($to, $subject, $message, $headers)) {
        header('Location: thanks.html');
        die();
      } else {
        array_push($sending_errors, $could_not_send);
      }
    }
  }
?>

<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
	<fieldset>
    		<input type="text" id="flname" name="firstlastname" placeholder="Name">
    		<input type="text" id="sender" name="senderemail" placeholder="Email">
    		<input type="text" id="subject" name="messagesubject" placeholder="Subject">
    		<textarea id="suject" name="sendermessage" placeholder="Message" style="height:130px"></textarea>
    		<input type="submit" value="Submit">
 	</fieldset>
</form>
