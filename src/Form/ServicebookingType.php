<?php

namespace App\Form;

use App\Entity\Servicebooking;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType; // <-- Make sure this is here
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ServicebookingType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('serviceType', ChoiceType::class, [
                'choices' => [
                    'Portrait Photography' => 'Portrait Photography',
                    'Event Photography' => 'Event Photography',
                    'Fashion Photography' => 'Fashion Photography',
                    'Commercial Photography' => 'Commercial Photography',
                ],
                'placeholder' => 'Select service type',
                'label' => 'Service Type',
            ])
            ->add('advisercategory', ChoiceType::class, [
                'choices' => [
                    'Photoshoot' => 'Photoshoot',
                    'Aesthetic' => 'Aesthetic',
                    'Editing' => 'Editing',
                    'Other' => 'Other',
                ],
                'placeholder' => 'Select adviser category',
                'label' => 'Adviser Category',
            ])
            ->add('preferredDate', DateTimeType::class, [
                'widget' => 'single_text',
                'label' => 'Preferred Date & Time',
            ])
            ->add('notes', TextareaType::class, [
                'required' => false,
                'label' => 'Additional Notes',
            ])
            ->add('customerName', TextType::class, [   // <-- Plain text input
                'label' => 'Customer Name',
                'required' => true,
                'attr' => [
                    'placeholder' => 'Enter customer name',
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Servicebooking::class,
        ]);
    }
}
