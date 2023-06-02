<?php

declare(strict_types=1);

namespace App\Form;

use App\Helpers\CalculationTypeDictionary;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CalculateVATFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('rate', NumberType::class, [
                'label' => 'VAT RATE, %',
                'html5' => true,
                'attr' => [
                    'min' => 0,
                    'max' => 100
                ]
            ])
            ->add('amount', NumberType::class, [
                'label' => 'AMOUNT',
                'html5' => true,
                'attr' => [
                    'min' => 1,
                ]
            ])
            ->add('type', ChoiceType::class, [
                'choices' => [
                    'Remove VAT from the price' => CalculationTypeDictionary::REMOVE_VAT_FROM_THE_PRICE,
                    'Add VAT to the price' => CalculationTypeDictionary::ADD_VAT_TO_THE_PRICE,
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => CalculateVATFormData::class,
        ]);
    }
}
