<?php

namespace App\Traits;

use App\Services\WaveConnectedService;

trait WhatsappTrait
{
    public function sendWhatsAppJoinForm($name,$email, $phone): void
    {
        $message = "El usuario $name, con email: $email, teléfono: $phone, ha llenado el formulario únete";
        $res1 = (new WaveConnectedService)->apiSendWhatsapp('960749076',$message);
        if($res1){
            echo "Mensaje enviado\n";
        }else{
            echo "Error al enviar mensaje\n";
        }
    }
    public function sendWhatsAppJoinNameForm($name): void
    {
        $res2 = (new WaveConnectedService)->apiSendWhatsapp('960749076',$name);
        if($res2){
            echo "Mensaje enviado\n";
        }else{
            echo "Error al enviar mensaje\n";
        }
    }
    public function sendWhatsAppWelcome($name, $phone): void
    {
        $message = "*¡Hola!. $name* \n".
            "Te damos la bienvenida a la plataforma participativa Padres Peruanos, un movimiento ciudadano cuya finalidad es la promoción de la libertad y la defensa del derecho de los padres de familia a ser los primeros educadores de sus hijos. Recibimos con mucho agrado tu deseo de participar.\n".
            "*Ingrésanos A TUS CONTACTOS del CELULAR para que puedas recibir la información de nuestra lista de difusión por WhatsApp 960749076*.\n".
            "Síguenos en nuestras redes sociales:\n".
            "1. *https://www.facebook.com/padres.peruanos*\n".
            "2. *https://instagram.com/padres.peruanos*\n".
            "3. *https://x.com/Padres_Peruanos*\n".
            "4. *https://www.youtube.com/@padres.peruanos*\n".
            "También puedes suscribirte a nuestro canal de WhatsApp:\n".
            "https://whatsapp.com/channel/0029Va6XbGj2975DDEDeys3C\n".
            "Seguiremos en contacto para contarte de nuestras actividades.\n".
            "*¡SEAMOS MÁS PARA QUE NOS ESCUCHEN MEJOR!*\n".
            "Atte.\n".
            "*www.padresperuanos.pe*";
        $res = (new WaveConnectedService)->apiSendWhatsapp($phone,$message);
        if($res){
            echo "Mensaje enviado\n";
        }else{
            echo "Error al enviar mensaje\n";
        }
    }

}
