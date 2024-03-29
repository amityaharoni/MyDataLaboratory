<?php

namespace MyDataLab\Bundle\WhitePaperBundle\Form;

use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class WhitePaperType extends AbstractType
{
    /**
     *
     * @var ObjectManager
     */
    private $manager;

    public function __construct(ObjectManager $manager, $whitePaperImagesDirectory, $whitePaperFilesDirectory)
    {
        $this->manager = $manager;
        $this->whitePaperImagesDirectory = $whitePaperImagesDirectory;
        $this->whitePaperFilesDirectory = $whitePaperFilesDirectory;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'mydatalab_bundle_glossarybundle_definition';
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('slug', TextType::class, [
                'label' => 'URL'
            ])
            ->add('language', EntityType::class, [
                'class' => 'MyDataLabCoreBundle:Language',
                'choice_value' => 'code',
            ])
            ->add('image', FileType::class, [
                'data_class' => null
            ])
            ->add('file', FileType::class, [
                'data_class' => null
            ])
            ->add('metaDescription')
            ->add('description')
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'MyDataLab\Bundle\WhitePaperBundle\Entity\WhitePaper',
        ]);
    }
}

