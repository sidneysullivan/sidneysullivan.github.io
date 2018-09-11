<?PHP
$top = "<!DOCTYPE HTML";
$bottom = "<body></body></html>";
$blank = ' ';
$sep = "\r\n";
$name = $_POST['name'];
$email = $_POST['email'];
$subject = $_POST['subject'];
$message = $_POST['message'];
$contact = $_POST['email'];
$body = $name .$sep .$email .$sep .$subject .$sep .$message;
mail('sflsullivan@outlook.com',$subject, $body);
	echo ("Thank you for contacting me, " .$name."<br> Your message: <b>");
	echo $subject;
	echo "</b>, has been recieved.</br> I will get back to you soon. <br><br> Have a wonderful day! <br> - Sidney";
?>
