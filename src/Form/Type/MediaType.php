<?php

namespace Media\Form\Type;

use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class MediaType extends AbstractType
{

    /**
     *
     * @var \Silex\Application
     */
    private $app;
    
    /**
     * 
     * @param \Silex\Application $app
     */
    public function __construct(\Silex\Application $app)
    {
        $this->app = $app;
    }
    
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'compound' => true,
            'data_class' => null
        ));
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder->addModelTransformer(new \Media\Form\DataTransformer\MediaTransformer($this->app, $options));

        $builder->add('binary', FileType::class, array(
            'required' => false,
            'attr' => array(
                'class' => 'filestyle',
                'data-iconName' => 'glyphicon glyphicon-inbox'
            ),
        ));

        $builder->add('remove', CheckboxType::class, array(
            'data' => false,
            'mapped' => false,
            'required' => false
        ));

        $builder->addEventListener(FormEvents::SUBMIT, function(FormEvent $event) {
            if ($event->getForm()->has('remove') && $event->getForm()->get('remove')->getData()) {
                $event->setData(null);
            }
        });
    }

    public function getParent()
    {
        return FormType::class;
    }

}
