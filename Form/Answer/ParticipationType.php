<?php

namespace Victoire\Widget\PollBundle\Form\Answer;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Victoire\Widget\PollBundle\DependencyInjection\Chain\PollQuestionChain;
use Victoire\Widget\PollBundle\Entity\Answer\Answer;
use Victoire\Widget\PollBundle\Listener\PollAnswerListener;

class ParticipationType extends AbstractType
{
    private $pollQuestionChain;

    public function __construct(PollQuestionChain $pollQuestionChain)
    {
        $this->pollQuestionChain = $pollQuestionChain;
    }
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('answers', CollectionType::class, [
                'entry_type' => AnswerType::class,

            ]);
        $listener = new PollAnswerListener($this->pollQuestionChain, $options['questions']);
        $builder->get('answers')->addEventSubscriber($listener);
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Victoire\Widget\PollBundle\Entity\Answer\Participation',
            'questions' => []
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'victoire_widget_pollbundle_answer_participation';
    }
}
