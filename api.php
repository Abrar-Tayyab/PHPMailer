<?php
require_once('PHPMailLiabrary/send_email.php');

$user_email         = $_POST['email'];
$subject            = "Request A Quote from " . $_POST['email'];
$to_email           = "brand_mail@gmail.com";
$logo_address       = "https://www.google.com/url?sa=i&url=https%3A%2F%2Fwww.bharatagritech.com%2F%3Fq%3Dsmtp-server-for-bulk-email-sending-latest-leads-medium-xx-1k3EBQfm&psig=AOvVaw1uSC7Wr3bbkpCJj2nyc5ni&ust=1705073826628000&source=images&cd=vfe&opi=89978449&ved=0CBMQjRxqFwoTCNDJkK_V1YMDFQAAAAAdAAAAABAU";

foreach ($_POST as $key => $value) {
    $key = str_replace('_', ' ', $key);
    $form_data .= "<tr><td>$key :</td><td>$value</td></tr>";
}

$body = "
    <!DOCTYPE html>
    <html lang='en'>
        <head>
            <meta charset='UTF-8'>
            <meta http-equiv='X-UA-Compatible' content='IE=edge'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <title>$subject</title>
        </head>
        <body align='center' style='height:400px;'>
            <table width='100%' border='0' align='center' cellpadding='0' cellspacing='0'>
            <!-- START HEADER/BANNER -->
            <tbody>
                <tr>
                    <td align='center'>
                        <table class='col-600' width='600' border='0' align='center' cellpadding='0' cellspacing='0'>
                            <tbody>
                                <tr>
                            
                                <td style='font-family: sans-serif; font-size:15px; font-weight: 300;' align='center' valign='top'>
                                    <table class='col-600' width='600' height='400' border='0' align='center' cellpadding='0' cellspacing='0'>

                                        <tbody>
                                        <tr>
                                            <td height='20'></td>
                                        </tr>
            
                                        <tr>
                                            <td align='center' style=''>
                                                <img src='$logo_address' width='150' height='53' bgcolor:'#66809b' alt='logo'>
                                                <hr>
                                            </td>
                                        </tr>

                                        <tr align='center'>
                                            <td><h3>$subject</h3></td>
                                        </tr>

                                    </tr>

                                        <tr>
                                            <td align='center'>
                                                <table>
                                                    $form_data
                                                </table>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td height='20'></td>
                                        </tr>
                                    </tbody></table>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
            </tbody>
            </table>
        </body>
    </html>
";

$send = send_mail($to_email,$subject,$body);

if($send == 'send'){
    $response = "Detail has been sent";
}else{
    $response = "Detail has not been sent";
}
header('Location: ' . $_SERVER['HTTP_REFERER'] . '?res=' .$response);
