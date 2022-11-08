<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class EmailController extends AbstractController
{
    public function sendEmailNewUser(MailerInterface $mailer, User $user)
    {
        $email = (new Email())
        ->from('nina.sellal@gmail.com')
        ->to($user->getEmail())
        ->subject('Nouvel utilisateur-trice')
        ->text('Bienvenue chez ISA COIFFE')
        ->html('
        <h1>Bienvenue chez ISA COIFFE</h1>
        <p>Je viens de créer votre compte utilisateur, vous pouvez désormais :</p></br>
        <ul>
            <li>Ajouter/modifier/supprimer des photos de la gallerie : <a href="/admin-image">Gérer les photos</a></li>
            <li>Ajouter/modifier/supprimer des tarifs : <a href="/admin-tarifs">Gérer les tarifs</a></li>
        </ul>');

        $mailer->send($email);
    }
}
