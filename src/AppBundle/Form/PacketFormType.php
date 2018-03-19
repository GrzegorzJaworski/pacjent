<?php

namespace AppBundle\Form;

use AppBundle\Entity\Packet;
use AppBundle\Entity\PacketType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PacketFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('packetType', EntityType::class, [
                'class' => PacketType::class,
                'label' => false
            ])
            ->add('start', DateType::class, [
                'label' => false,
                'widget' => 'single_text',
            ])
            ->add('end', DateType::class, [
                'label' => false,
                'widget' => 'single_text',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
           'data_class' => Packet::class
        ]);
    }
}
