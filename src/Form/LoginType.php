<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType as TypeTextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class LoginType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('username', TypeTextType::class, [
            "label"           => "Nom d'utilisateur",
            "required"        => true,
            "constraints"     => [
                new NotBlank([
                    "message" => "Le nom d'utilisateur ne peut pas être vide !"])]
        ])
        ->add('password', PasswordType::class, [
            "label"           => "Mot de passe",
            "required"        => true,
            "constraints"     => [
                new NotBlank([
                    "message" => "Le mot de passe ne peut pas être vide !"])
            ]
        ])
    ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
            'csrf_protection' => true,
            'csrf_field_name' => '_token',
            'csrf_token_id' => 'post_item'
        ]);
    }
}
