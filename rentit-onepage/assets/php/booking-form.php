<?php
if ((isset($_POST['extras'])) && (strlen(trim($_POST['extras'])) > 0)) {
    $extras = stripslashes(strip_tags($_POST['extras']));
} else {
    $extras = '';
}
if ((isset($_POST['fdmrms'])) && (strlen(trim($_POST['fdmrms'])) > 0)) {
    $fdmrms = stripslashes(strip_tags($_POST['fdmrms']));
} else {
    $fdmrms = '';
}
if ((isset($_POST['fdname'])) && (strlen(trim($_POST['fdname'])) > 0)) {
    $fdname = stripslashes(strip_tags($_POST['fdname']));
} else {
    $fdname = 'No name entered';
}
if ((isset($_POST['fdemail'])) && (strlen(trim($_POST['fdemail'])) > 0)) {
    $fdemail = stripslashes(strip_tags($_POST['fdemail']));
} else {
    $fdemail = 'No email entered';
}
if ((isset($_POST['fadmessage'])) && (strlen(trim($_POST['fadmessage'])) > 0)) {
    $fadmessage = stripslashes(strip_tags($_POST['fadmessage']));
} else {
    $fadmessage = 'No message entered';
}
if ((isset($_POST['po'])) && (strlen(trim($_POST['po'])) > 0)) {
    $po = stripslashes(strip_tags($_POST['po']));
} else {
    $po = 'Payment option not selected';
}
ob_start();
?>
<html>
<head>
    <style type="text/css">
    </style>
</head>
<body>
<table width="550" border="0" cellspacing="0" cellpadding="15">
    <tr bgcolor="#eeffee">
        <td>Name</td>
        <td><?php echo $fdmrms; ?> <?php echo $fdname; ?></td>
    </tr>
    <tr bgcolor="#eeeeff">
        <td>Email</td>
        <td><?php echo $fdemail; ?></td>
    </tr>
    <tr bgcolor="#eeffee">
        <td>Message</td>
        <td><?php echo $fadmessage; ?></td>
    </tr>
    <tr bgcolor="#eeeeff">
        <td>Payment options</td>
        <td><?php echo $po; ?></td>
    </tr>
    <tr bgcolor="#eeffee">
        <td>Extras</td>
        <td><?php echo $extras; ?></td>
    </tr>
</table>
</body>
</html>
<?php
$body = ob_get_contents();

$to = 'your@mail.com';
$toname = 'Your Name';
//$anotheraddress = 'email@example.com';
//$anothername = 'Another Name';

require("phpmailer.php");

$mail = new PHPMailer();

$mail->From = $fdemail;
$mail->FromName = $name;
$mail->AddAddress($to, $toname); // Put your email
//$mail->AddAddress($anotheraddress,$anothername); // addresses here

$mail->WordWrap = 50;
$mail->IsHTML(true);

$mail->Subject = "Demo Form:  Subscribe Form submitted";
$mail->Body = $body;
$mail->AltBody = $message;

if (!$mail->Send()) {
    $recipient = $to;
    $subject = 'Subscribe failed';
    $content = $body;
    mail($recipient, $subject, $content, "From: $name\r\nReply-To: $email\r\nX-Mailer: DT_formmail");
    exit;
}
?>
