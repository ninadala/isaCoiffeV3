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
            <li>Ajouter/modifier/supprimer des photos de la gallerie : </li>
            <li>Ajouter/modifier/supprimer des tarifs : </li>
            <li>Ajouter/modifier/supprimer les informations concernant votre entreprise : </li>
        </ul></br>
        <p>Veuillez s\'il vous plait changer ce mot de passe dès votre première connexion</p>
        <a href="#" target="_blank" title="site ISACOIFFE">www.isacoiffe.fr/login</a>
        ');

        $mailer->send($email);
    }
}
