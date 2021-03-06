<?php

namespace AppBundle\Form\Type;

use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class OperatorSortType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
		$builder
            ->add('firstName', TextType::class, ['label_format' => 'operator.firstName',])
            ->add('lastName', TextType::class,  ['label_format' => 'operator.lastName',])
            ->add('registrationNumber', TextType::class,  ['label_format' => 'operator.registrationNumber', 'required' => false,])
            ->add('status', ChoiceType::class,
                array(
                    'choices'  => array(
                        'operator.statusChoices.interim' => 1,
                        'operator.statusChoices.cdd' => 2,
                        'operator.statusChoices.cdi' => 3,
                    ),
                    'label_format' => 'operator.employmentStatus',
                )
            )
            ->add('superiorLvl1', EntityType::class,
                array(
                   'class'  => 'AppBundle:User', 'choice_label' => 'firstName',
                    'label_format' => 'operatorFormation.superior1Name',
                )
            )
            ->add('superiorLvl2', EntityType::class,
                array(
                    'class'  => 'AppBundle:User', 'choice_label' => 'firstName',
                    'label_format' => 'operatorFormation.superior2Name',
                )
            )
            ->add('site', ChoiceType::class,
				array(
					'choices' => array(
						'Périgueux' => 'operator.siteChoices.perigueux',
						'Laval' => 'operator.siteChoices.laval',
						'Cherbourg' => 'operator.siteChoices.cherbourg',
						'Montpellier' => 'operator.siteChoices.montpellier',
					),
				)
			)
            ->add('save', SubmitType::class, array('label' => 'operator.add.submit'));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\User',
        ));
    }

//    public function getParent()
//    {
////        return 'AppBundle\Form\Type\RegistrationType';
//        return 'FOS\UserBundle\Form\Type\RegistrationFormType';
//    }

    public function getBlockPrefix()
    {
        return 'app_user_registration';
    }

    public function getFirstName()
    {
        return $this->getBlockPrefix();
    }

    public function getLastName()
    {
        return $this->getBlockPrefix();
    }

}

