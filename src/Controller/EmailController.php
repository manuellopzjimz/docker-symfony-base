<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;

class EmailController extends AbstractController
{
    #[Route('/email')]
    public function sendEmail(MailerInterface $mailer): Response
    {
        $email = (new Email())
            ->from('prueba.docker@noexisto.es')
            ->to('smtp4dev@recibe.es')
            ->subject('Puedo enviar correos')
            ->text('Y puedo leerlos en la página web del Servidor SMTP fake')
            ->html('<p>Podría añadir HTML si quisiera</p>');

        $mailer->send($email);

        return new Response('<html><body>Correo enviado correctamente a SMTP4DEV</body></html>');
    }


}
