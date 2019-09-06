<?php

namespace PTS\SyliusOrderBatchPlugin\Form\Type;

use PTS\SyliusOrderBatchPlugin\Entity\DocumentTemplate;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class DocumentTemplateType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, [
                'required' => true,
            ])
            ->add('templateData', TextareaType::class, [
                'required' => true,
            ]);

        $builder->addViewTransformer(new CallbackTransformer(
            function (DocumentTemplate $entity) {
                return $entity;
            },
            function (DocumentTemplate $entity) {
                $entity->setTemplateData(json_encode($entity->getTemplateData()));
                return $entity;
            }
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'document_template_form';
    }
}
