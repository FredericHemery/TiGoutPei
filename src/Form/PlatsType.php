<?php

namespace App\Form;

use App\Entity\Categorie;
use App\Entity\Constitue;
use App\Entity\Plats;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PlatsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nomPlat', TextType::class)
            ->add('descriptionPlat', TextareaType::class)
            ->add('quantite', IntegerType::class, [
                'required' => false,
                'trim' => true
            ])
            ->add('categorie', ChoiceType::class, [

                    'choices' => [
                        'apero' => 'apero',
                        'grignote' => 'grignote',
                        'plat' => 'plat',
                        'dessert' => 'dessert'
                    ],
                    'multiple' => false]
            )
            ->add('prixVenteTTCPlat', MoneyType::class, [
                'label' => 'Prix de vente TTC',
                'currency' => false
            ])
            ->add('prixVenteHTPlat', MoneyType::class, [
                'label' => 'Prix de vente HT',
                'required' => false,
                'currency' => false
            ])
            ->add('prixRevient', MoneyType::class, [
                'label' => 'Prix de revient',
                'required' => false,
                'currency' => false
            ])
            ->add('nomImage', TextType::class, [
                'required' => false
            ])
            ->add('imgDescription', TextType::class, [
                'required' => false
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Plats::class,
        ]);
    }
}
