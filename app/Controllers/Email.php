<?php

namespace App\Controllers;
helper('email');
    require 'vendor/autoload.php';

class Email extends BaseController
{
    public function index()
    {
        // Aquí puedes llamar a las funciones de envío de correo
        // Por ejemplo:
        $platillaSubTtl = "Asunto del Correo";
        $userMail = "zzzaida09@gmail.com"; // Reemplaza con el correo del destinatario
        $contenidoHTML = "<h1>Contenido del Correo</h1><p>Este es un ejemplo de contenido HTML.</p>";
        $response = enviarMail($platillaSubTtl, $userMail, $contenidoHTML);
        if ($response->statusCode() == 202) {
            echo "Correo enviado exitosamente.";
        } else {
            echo "Error al enviar el correo: " . $response->body();
        }
    }

        public function email()
    {
        // Aquí puedes llamar a las funciones de envío de correo
        // Por ejemplo:
        $platillaSubTtl = "Asunto del Correo";
        $userMail = "zzzaida09@gmail.com"; // Reemplaza con el correo del destinatario
        $contenidoHTML = "<h1>Contenido del Correo</h1><p>Este es un ejemplo de contenido HTML.</p>";
        $response = enviarMail($platillaSubTtl, $userMail, $contenidoHTML);
        if ($response->statusCode() == 202) {
            echo "Correo enviado exitosamente.";
        } else {
            echo "Error al enviar el correo: " . $response->body();
        }
    }
}