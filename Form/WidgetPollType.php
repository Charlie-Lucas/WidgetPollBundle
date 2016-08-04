<?php

namespace Victoire\Widget\PollBundle\Form;

use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Victoire\Bundle\CoreBundle\Form\WidgetType;
use Victoire\Widget\PollBundle\DependencyInjection\Chain\PollQuestionChain;
use Victoire\Widget\PollBundle\Listener\PollQuestionListener;

class WidgetPollType extends WidgetType
{
    private $pollQuestionChain;

    public function __construct(PollQuestionChain $pollQuestionChain)
    {
        $this->pollQuestionChain = $pollQuestionChain;
    }
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        parent::buildForm($builder, $options);
        $builder->add('questions', CollectionType::class, [
            'entry_type' => QuestionType::class,
            'allow_add' => true,
            'allow_delete' => true,
            'by_reference' => false,
            'vic_widget_add_btn' => null
        ]);
        $listener = new PollQuestionListener($this->pollQuestionChain);
        $builder->addEventSubscriber($listener);
    }


    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        parent::configureOptions($resolver);

        $resolver->setDefaults(array(
            'data_class'         => 'Victoire\Widget\PollBundle\Entity\WidgetPoll',
            'widget'             => 'Poll',
            'translation_domain' => 'victoire'
        ));
    }
}
