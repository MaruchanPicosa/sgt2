 <?php
    use SendGrid\Mail\To;
    use SendGrid\Mail\From;
    use SendGrid\Mail\Mail;
    use SendGrid\Mail\Subject;
    use SendGrid\Mail\Attachment;
    use SendGrid\Mail\HtmlContent;
    use SendGrid\Mail\PlainTextContent;

    use PhpOffice\PhpSpreadsheet\Spreadsheet;
    use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
    use PhpOffice\PhpSpreadsheet\IOFactory;

    // Creación del correo y uso de sendgrid
   /* function enviarMail($platillaSubTtl, $userMail, $contenidoHTML) {
        $from_email = "administracion@sistemaderegistro.com";
        $from_title = "Convención Aneas 2025";

        $email = new \SendGrid\Mail\Mail();
        $email->setFrom($from_email, $from_title);
        $email->setSubject($platillaSubTtl);
        $email->addTo($userMail);
        //$email->addCc("zzzaida09@gmail.com");
        //$email->addCc("pagos@aneas.com.mx");
        $email->addContent( "text/html", $contenidoHTML);
        $sendgrid = new \SendGrid(SENDGRID_KEY);
        $response = $sendgrid->send($email);

        return $response;

    }

    function enviarMuchosMails($platillaSubTtl, $correos) {
        $from_email = "soporteaneas@sistemaderegistro.com";
        $from_title = "Convención Aneas 2025";
    
        $from = new \SendGrid\Mail\From($from_email, $from_title);
        $tos = []; // Inicializa el arreglo de destinatarios
        $bccs = ["zzzaida09@gmail.com", "pagos@aneas.com.mx"]; // Arreglo de BCC
    
        foreach ($correos as $correo) {
            $email = $correo['email'];
            $user = $correo['nombre'];
            $template = $correo['template'];
    
            // Crear el objeto 'To' para cada destinatario
            $to = new \SendGrid\Mail\To($email, $user, [
                '-template-' => $template,
            ]);
    
            // Crear el correo para cada destinatario
            $subject = new \SendGrid\Mail\Subject($platillaSubTtl);
            $htmlContent = new \SendGrid\Mail\HtmlContent('-template-');
            $emailObj = new \SendGrid\Mail\Mail(
                $from,
                [$to], // Se pasa el destinatario individual aquí
                $subject,
                $htmlContent
            );
    
            // Añadir las direcciones de BCC a este correo
            foreach ($bccs as $bcc) {
                $emailObj->addBcc(new \SendGrid\Mail\Bcc($bcc));
            }
    
            // Enviar el correo utilizando SendGrid
            $sendgrid = new \SendGrid(SENDGRID_KEY);
    
            try {
                $response = $sendgrid->send($emailObj);
    
                $statusCode = $response->statusCode(); // Código de estado HTTP de la respuesta
                $headers = $response->headers(); // Encabezados de la respuesta
                $body = $response->body(); // Cuerpo de la respuesta (generalmente en formato JSON)
    
                if ($statusCode === 202) {
                    $msg = array("success" => true, "msg" => "Correos enviados", "data" => $body);
                        exit(json_encode($msg));
                    } else {
                    $msg = array("success" => false, "msg" => "Se produjo un problema al enviar el correo a " . $email, "data" => $body);
                        exit(json_encode($msg));
                }
            } catch (Exception $e) {
                echo 'Caught exception: ' . $e->getMessage() . "\n";
            }
        }
    }


    function enviaLeadsMail($platillaSubTtl, $correos) {
        $from_email = "soportectecnico@standex.com.mx";
        $from_title = "Convención Aneas 2025";
    
        $from = new From($from_email, $from_title);
        
        $tos = []; // Inicializa el arreglo de destinatarios
    
        foreach ($correos as $correo) {
            $email = $correo['email'];
            $user = $correo['nombre'];
            $template = $correo['template'];
                
            $tos[] = new To(
                $email,
                $user,
                [
                    '-template-' => $template,
                ]
            );
        }
    
        $subject = new Subject($platillaSubTtl);
        $htmlContent = new HtmlContent('-template-');
   
        $email = new Mail(
            $from,
            $tos,
            $subject,
            $htmlContent
        );
    
        $sendgrid = new \SendGrid(SENDGRID_KEY);

        try {
            $response = $sendgrid->send($email);
        
            $statusCode = $response->statusCode(); // Código de estado HTTP de la respuesta
            $headers = $response->headers(); // Encabezados de la respuesta
            $body = $response->body(); // Cuerpo de la respuesta (generalmente en formato JSON)
        
            if ($statusCode === 202) {

                $msg = array("success" => true, "msg" => "Correo enviados", "data" => $body);
				exit(json_encode($msg));

            } else {

                $msg = array("success" => false, "msg" => "Se produjo un problema al enviar los correos", "data" => $body);
				exit(json_encode($msg));
            }
        } catch (Exception $e) {
            echo 'Caught exception: ' .  $e->getMessage() . "\n";
        }
    }

    function enviarMailConAdjunto($platillaSubTtl, $userMail, $contenidoHTML, $filePath) {
        $from_email = "soportectecnico@standex.com.mx";
        $from_title = "Convención Aneas 2025";
    
        $email = new \SendGrid\Mail\Mail();
        $email->setFrom($from_email, $from_title);
        $email->setSubject($platillaSubTtl);
        $email->addTo($userMail);
        // $email->addCc("denilson.damg@gmail.com");
        // $email->addCc("anna.molina@aneas.com.mx");
        $email->addContent("text/html", $contenidoHTML);
    
        $fileData = file_get_contents($filePath);
        $encodedFile = base64_encode($fileData);

        $attachment = new Attachment();
        $attachment->setContent($encodedFile);
        $attachment->setType(mime_content_type($filePath));
        $attachment->setFilename(basename($filePath));
        $attachment->setDisposition("attachment");

        $email->addAttachment($attachment);
    
        $sendgrid = new \SendGrid(SENDGRID_KEY);
        return $sendgrid->send($email);
    } */

?>