
<?php
mb_internal_encoding("UTF-8");

$name = htmlspecialchars($_POST['name']);
$number = htmlspecialchars($_POST['number']);
$customer_email = htmlspecialchars($_POST['email']);
$address = htmlspecialchars($_POST['address']);
$comment = htmlspecialchars($_POST['comment']);

$our_email = 'revize@timidusrevize.cz';

$contact_array = [
    'name' => $name,
    'number' => $number,
    'email' => $customer_email,
    'address' => $address,
    'comment' => $comment,
];

function email_body_generator (string $from, array $contact) {
    
    $heading_customer = 'Vyplnili jste kontaktní formulář';
    $par_customer = 'Níže jsou Vámi vyplněné údaje, které byly přeposlány reviznímu technikovi:';
    $heading_technician = 'Byl vyplněn kontaktní formulář';
    $par_technician = 'Níže jsou vyplněné údaje, které je potřeba zpracovat:';

    $email_body =

    '<!DOCTYPE html>
    <html lang="cs-cz" xmlns="http://www.w3.org/1999/xhtml" xmlns:o="urn:schemas-microsoft-com:office:office">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <meta name="x-apple-disable-message-reformatting">
        <title></title>
        <!--[if mso]> 
    <noscript> 
    <xml> 
    <o:OfficeDocumentSettings> 
    <o:PixelsPerInch>96</o:PixelsPerInch> 
    </o:OfficeDocumentSettings> 
    </xml> 
    </noscript> 
    <![endif]-->
        <style>
            table, td, div, h1, p {font-family: Arial, sans-serif;}
            
        </style>
    </head>
    <body style="margin:0;padding:0;">
        <table role="presentation" style="width:100%;border-collapse:collapse;border:0;border-spacing:0;background:#ffffff;">
            <tr>
                <td align="center" style="padding:0;">
                    <table role="presentation" style="width:602px;border-collapse:collapse;border:1px solid #cccccc;border-spacing:0;text-align:left;">
                        <tr>
                            <td align="center" style="padding:40px 0 30px 0;background:#dddddd;">
                                <img src="https://timidusrevize.cz/img/logo.png" alt="Ing. Martin Plachý - Timidus Revize" width="300" style="height:auto;display:block;" />
                            </td>
                        </tr>
                        <tr>
                            <td style="padding:36px 30px 42px 30px;">
                                <table role="presentation" style="width:100%;border-collapse:collapse;border:0;border-spacing:0;">
                                    <tr>
                                        <td style="padding:0;">
                                            <h1 style="font-size:24px;margin:0 0 20px 0;font-family:Arial,sans-serif;">'; if($from == "revize@timidusrevize.cz"){$email_body .= $heading_customer;}else{$email_body .= $heading_technician;} $email_body .= '</h1>
                                            <p style="margin:0 0 20px 0;font-size:16px;line-height:24px;font-family:Arial,sans-serif;">'; if($from == "revize@timidusrevize.cz"){$email_body .= $par_customer;}else{$email_body .= $par_technician;} $email_body .= '</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding:0;"><p style="margin:0 0 12px 0;font-size:16px;line-height:24px;font-family:Arial,sans-serif;font-weight: bold;">Jméno a příjmení: <span style="font-weight: normal;">' . $contact['name'] . '</span></p>
                                        <p style="margin:0 0 12px 0;font-size:16px;line-height:24px;font-family:Arial,sans-serif;font-weight: bold;">Telefonní číslo: <span style="font-weight: normal;">';

                                        if($from == "revize@timidusrevize.cz"){$email_body .= '+420 ' . $contact['number'];}else{$email_body .= '+420' . str_replace(' ','',$contact['number']);}
                                        $email_body .= '</span></p>
                                        <p style="margin:0 0 12px 0;font-size:16px;line-height:24px;font-family:Arial,sans-serif;font-weight: bold;">E-mailová adresa: <span style="font-weight: normal;">' . $contact['email'] . '</span></p>
                                        <p style="margin:0 0 12px 0;font-size:16px;line-height:24px;font-family:Arial,sans-serif;font-weight: bold;">Adresa zařízení: <span style="font-weight: normal;">' . $contact['address'] . '</span></p>
                                        <p style="margin:0 0 12px 0;font-size:16px;line-height:24px;font-family:Arial,sans-serif;font-weight: bold;">Stručný popis zařízení: <span style="font-weight: normal;">' . $contact['comment'] . '</span></p></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td style="padding:30px;background:#d48d04">
                                <table role="presentation" style="width:100%;border-collapse:collapse;border:0;border-spacing:0;font-size:9px;font-family:Arial,sans-serif;">
                                    <tr>
                                        <td style="padding:0;width:50%;" align="left">
                                            <p style="margin:0;font-size:14px;line-height:16px;font-family:Arial,sans-serif;color:#ffffff;">© 2023 Coded by <a  href="mailto:revize@timidusrevize.cz"style="color:#ffffff;text-decoration:none;">Martin Plachý<br/></p>
                                        </td>
                                        <td style="padding:0;width:50%;" align="right">
                                            <table role="presentation" style="border-collapse:collapse;border:0;border-spacing:0;">
                                                <tr>
                                                    <td style="padding:0 0 0 10px;width:38px;">
                                                        <a href="https://www.linkedin.com/in/martin-plachý-29974359" style="color:#ffffff;" target="_blank"><img src="https://timidusrevize.cz/img/li.png" alt="Twitter" width="38" style="height:auto;display:block;border:0;" /></a>
                                                    </td>
                                                    <td style="padding:0 0 0 10px;width:38px;">
                                                        <a href="https://www.facebook.com/timidusrevize/?locale=cs_CZ" style="color:#ffffff;" target="_blank"><img src="https://timidusrevize.cz/img/fb.png" alt="Facebook" width="38" style="height:auto;display:block;border:0;" /></a>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </body>
    </html>';
    
    return $email_body;
}



function send_email (string $from, string $to, array $contact, bool $return_http_status) {
    if ($contact['name'] && $contact['number'] && $contact['email'] && $contact['address'] && $contact['comment']) {
	
        $header = 'From:' . $from;
        $header .= "\nMIME-Version: 1.0\n";
        $header .= "Content-Type: text/html; charset=\"utf-8\"\n";
        $subject = 'Zpráva z kontaktního formuláře';
        $email_sent = mb_send_mail($to, $subject, email_body_generator($from, $contact), $header);

        if($return_http_status){
            http_response_code(200);
        }
    }
    else{
        if($return_http_status){
            http_response_code(400);
        }       
    }
}

send_email($our_email, $customer_email, $contact_array, false);
send_email($customer_email, $our_email, $contact_array, true);
?>