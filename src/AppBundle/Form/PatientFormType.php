<?php

namespace AppBundle\Form;

use AppBundle\Entity\Patient;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PatientFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('patientId')
            ->add('name')
            ->add('surname')
            ->add('pesel')
            ->add('birthDay',DateType::class, [
                'widget' => 'single_text',
            ])
            ->add('city')
            ->add('zipCode')
            ->add('address')
            ->add('packets', CollectionType::class, [
                'label' => false,
                'entry_type' => PacketFormType::class,
                'entry_options' => array('label' => false),
                'allow_delete' => true,
                'allow_add' => true,
                'by_reference' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Patient::class
        ]);
    }

}
