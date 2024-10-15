<?php

declare(strict_types=1);

namespace App\Form;

use App\Entity\Car;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CarType extends AbstractType
{
    /**
     * @param array<string, mixed> $options
     */
    public function buildForm(
        FormBuilderInterface $builder,
        array $options,
    ): void {
        $car = $builder->getData();

        $builder
            ->add('name', TextType::class, [
                'label' => 'name',
            ])
        ;

        if (null !== $car->getId()) {
            $builder->setMethod('PUT');
        }
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Car::class,
        ]);
    }
}