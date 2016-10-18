<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

/**
 *
 * @Route("/admin")
 * @author Dragan Valjak
 */
class MemberNoteFormType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder
		->add('title')
		->add('note')
		->add('status', ChoiceType::class, [
				'choices' => [
						'Avctive' => '1',
						'In Progres' => '2',
						'Aproved' => '3',
                         ]
		        ]
				)
		->add('createdAt', DateType::class, [
				'widget' => 'single_text',
				'attr' => ['class' => 'js-datepicker-3'],
				'html5' => false,
		]);
	}
	
	public function configureOptions(OptionsResolver $resolver)
	{
		$resolver->setDefaults([
				'data_class' => 'AppBundle\Entity\MemberNote'
		]);
	}
	
}