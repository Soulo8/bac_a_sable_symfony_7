<?php

declare(strict_types=1);

namespace App\Form;

use App\Dto\CarSearch;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

final class CarSearchType extends AbstractType
{
    /**
     * @param array<string, mixed> $options
     */
    public function buildForm(
        FormBuilderInterface $builder,
        array $options,
    ): void {
        $builder
            ->setMethod('GET')
            ->add('name', TextType::class, [
                'label' => 'name',
                'required' => false,
            ])
        ;
    }

    public function getBlockPrefix(): string
    {
        return 'form';
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => CarSearch::class,
            'csrf_protection' => false,
        ]);
    }
}
