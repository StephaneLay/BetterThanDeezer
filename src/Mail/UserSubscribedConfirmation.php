<?php

namespace App\Mail;

use App\Entity\User;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class UserSubscribedConfirmation{

    public function __construct(private MailerInterface $mailer) {}
    public function send(User $user)
  {
    $email = (new Email())
      ->from("admin@hb-corp.com")
      ->to($user->getEmail())
      ->subject("Inscription à la newsletter")
      ->text("Votre email " . $user->getEmail() . " a bien été enregistré, merci");

    $this->mailer->send($email);
  }
}