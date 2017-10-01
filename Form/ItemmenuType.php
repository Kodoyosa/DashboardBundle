<?php

namespace Kodo\DashboardBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class ItemmenuType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        if(property_exists ( $builder->getData() , 'sectionmenu' )){
            $sectionmenu = $builder->getData()->sectionmenu;

            foreach($sectionmenu as $sm){
                $section[$sm->getTitle()] = $sm->getId();
            }
        }else{
            $section = [];
        }

        $builder
            ->add('sectionmenuId', ChoiceType::class, [
                'choices' => $section,
                'label' => 'Section Menu (Parent)'
            ])
            ->add('routename')
            ->add('name')
            ->add('active');
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Kodo\DashboardBundle\Entity\Itemmenu'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'kodo_dashboardbundle_itemmenu';
    }


}
