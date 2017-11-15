<?php
/**
 * This example shows settings to use when sending via Google's Gmail servers.
 * This uses traditional id & password authentication - look at the gmail_xoauth.phps
 * example to see how to use XOAUTH2.
 * The IMAP section shows how to save this message to the 'Sent Mail' folder using IMAP commands.
 */
//Import PHPMailer classes into the global namespace
use PHPMailer\PHPMailer\PHPMailer;
require 'vendor/autoload.php';

$nombre = $_POST["nombre"];
$phone = $_POST["telefono"];
$address = $_POST["direccion"];

$humectante = $_POST["item1"];
$anticelulitis = $_POST["item2"];
$antigripal = $_POST["item3"];
$dologel = $_POST["item4"];
$reductiva = $_POST["item5"];
$dia = $_POST["item6"];
$noche = $_POST["item7"];
$shampoo = $_POST["item8"];
$rejuvenecedora = $_POST["item9"];

$subject = "Compra de " . $nombre;

$message = "Compra de " . $nombre . "\n" . "Teléfono: " . $phone .
  "\n" . "Dirección: " . $address . "\n_____________________________\n" ;

$total = 0;

if ($humectante > 0) {
  $message .= "Jabón Humectante x " . $humectante . " = " . ($humectante*40) . "\n" ;
  $total += $humectante*40;
}
if ($anticelulitis > 0) {
  $message .= "Jabón Anticelulitis x " . $anticelulitis . ($anticelulitis*40) . "\n" ;
  $total += $anticelulitis*40;
}
if ($antigripal > 0) {
  $message .= "Antigripal x " . $antigripal . " = " . ($antigripal*80) . "\n" ;
  $total += $antigripal*80;
}
if ($dologel > 0) {
  $message .= "Dologel x " . $dologel . " = " . ($dologel*80) . "\n" ;
  $total += $dologel*80;
}
if ($reductiva > 0) {
  $message .= "Crema Reductiva x " . $reductiva . " = " . ($reductiva*80) . "\n" ;
  $total += $reductiva*80;
}
if ($dia > 0) {
  $message .= "Crema de Día x " . $dia . " = " . ($dia*100) . "\n" ;
  $total += $dia*100;
}
if ($noche > 0) {
  $message .= "Crema de Noche x " . $noche . " = " . ($noche*100) . "\n" ;
  $total += $noche*100;
}
if ($shampoo > 0) {
  $message .= "Shampoo x " . $shampoo . ($shampoo*80) . "\n" ;
  $total += $shampoo*80;
}
if ($rejuvenecedora > 0) {
  $message .= "Crema Rejuvenecedora x " . $rejuvenecedora . " = " . ($rejuvenecedora*100) . "\n" ;
  $total += $rejuvenecedora*100;
}

$message .= "_______________________\n" . "Total: $" . $total;

//Create a new PHPMailer instance
$mail = new PHPMailer;
//Tell PHPMailer to use SMTP
$mail->isSMTP();
//Enable SMTP debugging
// 0 = off (for production use)
// 1 = client messages
// 2 = client and server messages
$mail->SMTPDebug = 2;
//Set the hostname of the mail server
$mail->Host = 'smtp.gmail.com';
// use
// $mail->Host = gethostbyname('smtp.gmail.com');
// if your network does not support SMTP over IPv6
//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
$mail->Port = 587;
//Set the encryption system to use - ssl (deprecated) or tls
$mail->SMTPSecure = 'tls';
//Whether to use SMTP authentication
$mail->SMTPAuth = true;
//Username to use for SMTP authentication - use full email address for gmail
$mail->Username = "luis061997@gmail.com";
//Password to use for SMTP authentication
$mail->Password = "********";
//Set who the message is to be sent from
$mail->setFrom('luis061997@gmail.com', 'Luis Zul');
//Set an alternative reply-to address
$mail->addReplyTo('luis061997@gmail.com', 'Luis Zul');
//Set who the message is to be sent to
$mail->addAddress('luis061997@gmail.com', 'Luis Zul');
//Set the subject line
$mail->Subject = $subject;
//Replace the plain text body with one created manually
$mail->Body = $message;
//send the message, check for errors
if (!$mail->send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
} else {
    echo "Message sent!";
    //Section 2: IMAP
    //Uncomment these to save your message in the 'Sent Mail' folder.
    #if (save_mail($mail)) {
    #    echo "Message saved!";
    #}
}
//Section 2: IMAP
//IMAP commands requires the PHP IMAP Extension, found at: https://php.net/manual/en/imap.setup.php
//Function to call which uses the PHP imap_*() functions to save messages: https://php.net/manual/en/book.imap.php
//You can use imap_getmailboxes($imapStream, '/imap/ssl') to get a list of available folders or labels, this can
//be useful if you are trying to get this working on a non-Gmail IMAP server.
function save_mail($mail)
{
    //You can change 'Sent Mail' to any other folder or tag
    $path = "{imap.gmail.com:993/imap/ssl}[Gmail]/Sent Mail";
    //Tell your server to open an IMAP connection using the same username and password as you used for SMTP
    $imapStream = imap_open($path, $mail->Username, $mail->Password);
    $result = imap_append($imapStream, $path, $mail->getSentMIMEMessage());
    imap_close($imapStream);
    return $result;
}

ob_start(); // ensures anything dumped out will be caught

// do stuff here
$url = 'http://localhost:8000/index.html'; // this can be set based on whatever

// clear out the output buffer
while (ob_get_status())
{
    ob_end_clean();
}

// no redirect
header( "Location: $url" );
?>
