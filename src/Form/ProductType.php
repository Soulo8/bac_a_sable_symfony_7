<?php

namespace App\Form;

use App\Entity\Product;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Event\PreSetDataEvent;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Vich\UploaderBundle\Form\Type\VichImageType;

class ProductType extends AbstractType
{
    public function __construct(
        private UrlGeneratorInterface $router,
    ) {
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $product = $builder->getData();

        $builder
            ->add('name')
            ->add('imageFile', VichImageType::class, [
                'image_uri' => false,
                'download_uri' => null === $product->getId() ? false : $this->router->generate('app_product_image', ['id' => $product->getId()]),
                'required' => null === $product->getId() ? true : false,
            ])
            ->add('newImages', FileType::class, [
                'multiple' => true,
                'mapped' => false,
                'required' => null === $product->getId() ? true : false,
            ])
            ->addEventListener(
                FormEvents::PRE_SET_DATA,
                [$this, 'onPreSetData']
            )
        ;

        if (null !== $product->getId()) {
            $builder->setMethod('PUT');
        }
    }

    public function onPreSetData(PreSetDataEvent $event): void
    {
        $product = $event->getData();
        $form = $event->getForm();

        if (null !== $product->getId()) {
            $form->add('images', CollectionType::class, [
                'entry_type' => ProductImageType::class,
                'allow_delete' => true,
                'by_reference' => false,
            ]);
        }
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);
    }
}
