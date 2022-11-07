<?php

namespace App\Form;

use App\Entity\User;
use PhpParser\Builder;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\NotBlank;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                "label" => "Email",
                "required" => true,
                "constraints" => [ new Email(["message" => "Vous devez entrer un email valide"])]
            ])
            ->add('roles', ChoiceType::class, [
                "label" => "Rôle",
                "required" => true,
                "expanded" => false,
                "multiple" => false,
                'choices' => [
                    'Administrateur' => 'ROLE_ADMIN',
                    'IsaCoiffe' => 'ROLE_USER'
                ]
            ])
            ->add('password', PasswordType::class, [
                "label" => "Mot de passe",
                "required" => true,
                "constraints" => [
                    new NotBlank([
                        "message" => "Le mot de passe ne peut pas être vide !"
                    ])
                ]
            ])
        ;

        $builder->get('roles')
            ->addModelTransformer(new CallbackTransformer(
                function ($rolesArray)
                {
                    return count($rolesArray) ? $rolesArray[0] : null;
                },
                function ($rolesString) {
                    return [$rolesString];
                }
            ));
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
