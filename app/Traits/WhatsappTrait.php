<?php

namespace App\Traits;

use App\Services\WaveConnectedService;

trait WhatsappTrait
{
    public function sendWhatsAppJoinForm($name,$email, $phone): void
    {
        $message = "El usuario $name, con email: $email, teléfono: $phone, ha llenado el formulario únete";
        (new WaveConnectedService)->apiSendWhatsapp($email,'51960749076',$message);
    }
    public function sendWhatsAppWelcome($name,$email, $phone): void
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
        (new WaveConnectedService)->apiSendWhatsapp($email,$phone,$message);
    }

}
