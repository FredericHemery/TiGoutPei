<?php

namespace App\Form;

use App\Model\SearchData;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Regex;


// création d'un formulaire dedié a la recherche par mot clé
class RechercheType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('mots', TextType::class, [
                'constraints' => [
                    new Regex([
                        'pattern' => '/^[a-zA-Z0-9\s\']+$/u',
                        'message' => 'Veuillez ne pas entrer de caractères spéciaux.'
                    ])
                ],
                'attr' => [
                    'placeholder' => 'Recherche par mot clé',
                    // j'inclue ici la class bootstrap pour gerer la mise en forme car elle n'est pas trop volumineuse
                    // sinon je l'aurais mise dans le twig pour la lisibilité
                    'class' => 'form-control'
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => SearchData::class,
            'method' => 'GET',
            'csrf_protection' => false
        ]);
    }
}