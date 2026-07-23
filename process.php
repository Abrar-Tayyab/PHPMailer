<?php
require_once('PHPMailLiabrary/send_email.php');


$form_fields = $_POST;

$user_email = filter_var($form_fields['email'] ?? '', FILTER_VALIDATE_EMAIL);
if (!$user_email) {
    header('Location: ' . $_SERVER['HTTP_REFERER'] . '?res=' . urlencode('Invalid email'));
    exit;
}

$subject            = "Request A Quote from " . str_replace(["\r", "\n"], '', $user_email);
$to_email           = "ryanpaul.tsc@gmail.com";
$website_logo_url       = "https://avatars.githubusercontent.com/u/45249072?v=4";

$form_data = "";

foreach ($form_fields as $key => $value) {
    $key = htmlspecialchars(str_replace('_', ' ', $key));
    $value = htmlspecialchars($value);
    $form_data .= "<tr><td>$key :</td><td>$value</td></tr>";
}

$logo_html = '';
if ($website_logo_url) {
    $logo_html = "<tr><td align='center'><img src=\"$website_logo_url\" width='150' height='53' alt='logo'><hr></td></tr>";
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
                
                                            $logo_html

                                            <tr align='center'>
                                                <td><h3>$subject</h3></td>
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
                                        </tbody>
                                    </table>
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

if($send === 'send'){
    $response = "Detail has been sent";
}else{
    $response = "Detail has not been sent";
}

header('Location: /contact-form.php?res=' . urlencode($response));
exit;
