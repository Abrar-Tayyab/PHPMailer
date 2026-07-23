<?php
require_once __DIR__ . '/PHPMailLiabrary/send_email.php';

$is_ajax = !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';

$subject = 'Contact Form';
$recipient_email = 'your-email@example.com';
$website_logo_url = '';
$redirect_url = 'http://localhost/contact-form.php';
$separator = str_contains($redirect_url, '?') ? '&' : '?';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ' . $redirect_url);
    exit;
}

$form_fields = $_POST;

$form_data = '';
foreach ($form_fields as $key => $value) {
    if (is_array($value)) {
        $value = implode(', ', array_map('strval', $value));
    }

    $label = ucfirst(str_replace('_', ' ', htmlspecialchars((string) $key)));
    $display_value = htmlspecialchars((string) $value);
    $form_data .= "<tr><td>$label :</td><td>$display_value</td></tr>";
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
                <tbody>
                    <tr>
                        <td align='center'>
                            <table class='col-600' width='600' border='0' align='center' cellpadding='0' cellspacing='0'>
                                <tbody>
                                    <tr>
                                        <td style='font-family: sans-serif; font-size:15px; font-weight: 300;' align='center' valign='top'>
                                            <table class='col-600' width='600' height='400' border='0' align='center' cellpadding='0' cellspacing='0'>
                                                <tbody>
                                                    <tr><td height='20'></td></tr>
                                                    $logo_html
                                                    <tr align='center'><td><h3>$subject</h3></td></tr>
                                                    <tr>
                                                        <td align='center'>
                                                            <table>
                                                                $form_data
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    <tr><td height='20'></td></tr>
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

$send = send_mail($recipient_email, $subject, $body);

$response = $send === 'send' ? 'Detail has been sent' : 'Detail has not been sent';

if (!$is_ajax) {
    header('Location: ' . $redirect_url . $separator . 'res=' . urlencode($response));
    exit;
}

header('Content-Type: application/json');
echo json_encode(['redirect' => $redirect_url, 'message' => $response]);
