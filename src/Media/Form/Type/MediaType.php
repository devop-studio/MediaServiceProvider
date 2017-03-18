<?php

namespace Media\Form\Type;

use Media\Entity\MediaInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Media\Form\Type\MediaTypeInterface;
use Symfony\Component\Form\AbstractType;
use Media\Provider\MediaProviderInterface;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class MediaType extends AbstractType implements MediaTypeInterface
{

    /**
     *
     * @var MediaProviderInterface
     */
    private $provider;
    
    /**
     *
     * @var MediaInterface
     */
    private $entityClass;
    
    /**
     *
     * @var DataTransformerInterface
     */
    private $transformer;

    public function __construct($transformer, MediaProviderInterface $provider, $entityClass)
    {
        $this->provider = $provider;
        $this->transformer = $transformer;
        $this->entityClass = $entityClass;
    }

    /**
     * 
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'context' => null,
            'new_on_update' => false,
            'data_class' => $this->entityClass
        ])->setRequired(['context']);
    }

    /**
     * 
     * @param FormBuilderInterface $builder
     * 
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        
        $builder->addModelTransformer(new $this->transformer($this->provider, $this->entityClass, $options));

        $builder->add('fileContent', FileType::class, [
            'label' => false,
            'required' => false,
        ]);
        
        $builder->addEventListener(FormEvents::PRE_SET_DATA, function(FormEvent $event) {
            if ($event->getData() && $event->getData()->getId()) {
                $event->getForm()->add('fileContentRemove', CheckboxType::class, [
                    'data' => false,
                    'mapped' => false,
                    'required' => false
                ]);
            }
        });

        $builder->addEventListener(FormEvents::SUBMIT, function(FormEvent $event) {
            if ($event->getForm()->has('fileContentRemove') && $event->getForm()->get('fileContentRemove')->getData()) {
                $event->setData(null);
            }
        });
    }

    /**
     * 
     * @return string
     */
    public function getParent()
    {
        return FormType::class;
    }

}
