<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Controller de Contacto (landing)
class ContactController extends Controller
{
    public function index()
    {
        $head = [
            'title' => 'Contáctanos - Mister PC Boteo',
            'heroImage' => 'https://res.cloudinary.com/drztldzvn/image/upload/v1753135286/nosotros_jbfyu8.png'
        ];

        $this->view('landing/contacto', [
            'head' => $head
        ]);
    }

    public function enviar()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            echo "Método no permitido.";
            return;
        }

        $nombre = trim($_POST['nombre'] ?? '');
        $correo = trim($_POST['correo'] ?? '');
        $telefono = trim($_POST['telefono'] ?? '');
        $departamento = trim($_POST['departamento'] ?? '');
        $asunto = trim($_POST['asunto'] ?? '');
        $mensaje = trim($_POST['mensaje'] ?? '');

        if (
            empty($nombre) || empty($correo) || !filter_var($correo, FILTER_VALIDATE_EMAIL) ||
            empty($telefono) || empty($departamento) || empty($asunto) || empty($mensaje)
        ) {
            $_SESSION['error'] = 'Por favor, completa todos los campos correctamente.';
            header('Location: http://localhost/mister-pc-boteo/public/contacto');
            exit;
        }

        if ($this->enviarCorreoContacto($nombre, $correo, $telefono, $departamento, $asunto, $mensaje)) {
            $_SESSION['exito'] = '¡Gracias! Tu mensaje ha sido enviado. Nos contactaremos contigo pronto.';
        } else {
            $_SESSION['error'] = 'Hubo un problema al enviar tu mensaje. Por favor, inténtalo más tarde.';
        }

        header('Location: http://localhost/mister-pc-boteo/public/contacto');
        exit;
    }

    private function enviarCorreoContacto($nombre, $correo, $telefono, $departamento, $asunto, $mensaje)
    {
        // Incluir PHPMailer desde Lib/
        require_once __DIR__ . '/../../lib/PHPMailer/src/PHPMailer.php';
        require_once __DIR__ . '/../../lib/PHPMailer/src/SMTP.php';
        require_once __DIR__ . '/../../lib/PHPMailer/src/Exception.php';

        //Datos privados desde el .env a travez de config
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = EMAIL_HOST; 
        $mail->SMTPAuth = true;
        $mail->Username = EMAIL_USERNAME;    // correo que enviará el mensaje
        $mail->Password = EMAIL_PASSWORD;    // contraseña de app de Gmail
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = EMAIL_PORT;            // 587

        $mail->setFrom(EMAIL_USERNAME, 'Nuevo mensaje desde sitio web');

        $mail->addReplyTo($correo, $nombre);

        // Destinatario final
        $mail->addAddress(EMAIL_TO);

        $mail->Subject = "Contacto desde sitio web: $asunto";
        $mail->Body =
            "Nuevo mensaje de contacto:\n\n" .
            "Nombre: $nombre\n" .
            "Correo: $correo\n" .
            "Teléfono: $telefono\n" .
            "Departamento: $departamento\n" .
            "Asunto: $asunto\n" .
            "Mensaje:\n$mensaje";

        $mail->isHTML(false);

        return $mail->send();
    }
}
