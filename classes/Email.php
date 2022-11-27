<?php 
    namespace Classes;

    use PHPMailer\PHPMailer\PHPMailer;

    class Email{
        public $email;
        public $name;
        public $token;

        public function __construct($email, $name, $token){
            $this->email = $email;
            $this->name = $name;
            $this->token = $token;
        }

        public function sendConfirmation(){
            //Crear el objeto de email
            $mail = new PHPMailer();
            $mail->isSMTP();
            $mail->Host = 'smtp.mailtrap.io';
            $mail->SMTPAuth = true;
            $mail->Username = '081f80e5977d1d';
            $mail->Password = '8bec6ca29a32a5';
            $mail->SMTPSecure = 'tls';
            $mail->Port = 2525;
            
            //Configurar el contenido del mail
            $mail->setFrom('cuentas@appsalon.com');
            $mail->addAddress('cuentas@appsalon.com', 'AppSalon.com');
            $mail->Subject = 'Confirma tu cuenta';

            //Set HTML
            $mail -> isHTML(true);
            $mail -> CharSet = 'UTF-8';

            $content = "<html>";
            $content .= "<p><strong>Hola " . $this->name . "</strong> Has creado tu cuenta en App Salon, solo debes confirmarla presionando el siguiente enlace</p>";
            $content .= "<p>Presiona aquí: <a href='http://localhost:3000/confirm-account?token=" . $this->token . "'>Confirmar Cuenta</a></p>";
            $content .= "<p>Si tu no solicitaste esta cuenta, puedes ignorar el mensaje</p>";
            $content .= "</html>";

            $mail->Body = $content;

            //Enviar el email 
            if($mail->send()){
                echo "Mensaje enviado correctamente";
            }else{
                echo "El mensaje no se ha enviado";
            }
        }

        public function sendInstructions(){
            //Crear el objeto de email
            $mail = new PHPMailer();
            $mail->isSMTP();
            $mail->Host = 'smtp.mailtrap.io';
            $mail->SMTPAuth = true;
            $mail->Username = '081f80e5977d1d';
            $mail->Password = '8bec6ca29a32a5';
            $mail->SMTPSecure = 'tls';
            $mail->Port = 2525;
            
            //Configurar el contenido del mail
            $mail->setFrom('cuentas@appsalon.com');
            $mail->addAddress('cuentas@appsalon.com', 'AppSalon.com');
            $mail->Subject = 'Reestable tu password';

            //Set HTML
            $mail -> isHTML(true);
            $mail -> CharSet = 'UTF-8';

            $content = "<html>";
            $content .= "<p><strong>Hola " . $this->name . "</strong> Has solicitado reestablecer tu password, sigue el siguiente enlace para hacerlo</p>";
            $content .= "<p>Presiona aquí: <a href='http://localhost:3000/recover?token=" . $this->token . "'>Restablecer Password</a></p>";
            $content .= "<p>Si tu no solicitaste esta cuenta, puedes ignorar el mensaje</p>";
            $content .= "</html>";

            $mail->Body = $content;

            //Enviar el email 
            $mail->send();
        }
    }
?>