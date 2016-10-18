<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use AppBundle\Repository\MemberCountryRepository;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use DoctrineExtensions\Tests\Query\Postgresql\StringTest;
use Doctrine\DBAL\Types\StringType;



/**
 * 
 * @author Dragan Valjak
 *
 */
class MemberFormType  extends AbstractType
{
	
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		
		
		$choices = array();
		foreach ($options['countryes'] as $key => $c) {
			$id = $c->getId();
			$name = $c->getName();
			$choices[$name] = $id;
		}
		
		
		//dump($choices);die;
		
		$builder
		->add('membershipNumber')
		->add('firstName')
		->add('lastName')
		->add('address')
		->add('city')
		->add('country', ChoiceType::class, [
				'choices'           => $choices,
				'required' => true,
				'placeholder' => 'Choose Country'
		])
		->add('birthDate', DateType::class, [
				'widget' => 'single_text',
				'attr' => ['class' => 'js-datepicker-1'],
				'html5' => false,
		])
		->add('email')
		->add('tel')
		->add('joinDate', DateType::class, [
				'widget' => 'single_text',
				'attr' => ['class' => 'js-datepicker-2'],
				'html5' => false,
		])
		->add('validDate', DateType::class, [
				'widget' => 'single_text',
				'attr' => ['class' => 'js-datepicker-3'],
				'html5' => false,
		])
		->add('tShirtSize', ChoiceType::class, [
				'choices' => [
				'S' => 'S',
				'M' => 'M',
				'L' => 'L',
				'XL' => 'XL',
				'XXL' => 'XXL',
			    'XXXL'	 => 'XXXL'		
		      ],
				'required' => true,
				'placeholder' => 'Choose gender'
				
				]
				);
	}
	
	public function configureOptions(OptionsResolver $resolver)
	{
		$resolver->setDefaults([
				'data_class' => 'AppBundle\Entity\Member',
				'countryes' => null
		]);
	}
}