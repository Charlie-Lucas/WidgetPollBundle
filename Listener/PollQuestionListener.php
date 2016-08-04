<?php

namespace Victoire\Widget\PollBundle\Listener;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormFactoryInterface;
use Victoire\Widget\PollBundle\DependencyInjection\Chain\PollQuestionChain;
use Victoire\Widget\PollBundle\Entity\Question;
use Victoire\Widget\PollBundle\Entity\WidgetPoll;
use Victoire\Widget\PollBundle\Form\QuestionType;

/**
 * Class PollQuestionListener.
 */
class PollQuestionListener implements EventSubscriberInterface
{
    private $pollQuestionChain;

    /**
     * PollQuestionListener constructor.
     *
     * @param PollQuestionChain     $pollQuestionChain
     * @param FormFactoryInterface $factory
     */
    public function __construct( $pollQuestionChain)
    {
        $this->pollQuestionChain = $pollQuestionChain;
    }

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        return [
            FormEvents::PRE_SET_DATA => 'preSetData',
            FormEvents::PRE_SUBMIT => 'preSubmit',
        ];
    }

    /**
     * @param FormEvent $event
     */
    public function preSetData(FormEvent $event)
    {
        /** @var WidgetPoll $data */
        $data = $event->getData();
        $form = $event->getForm();
        /**
         * @var integer $index
         * @var Question $question
         */
        foreach ($data->getQuestions() as $index => $question) {

            $questionType = $this->pollQuestionChain->getQuestionTypeFromEntity($question);

            $form->get('questions')->remove($index);
            $form->get('questions')->add($index, $questionType, [
                'questionType' => $this->pollQuestionChain->getQuestionName($question)
            ]);
        }
     }

     /**
      * @param FormEvent $event
      */
    public function preSubmit(FormEvent $event)
    {
        $data = $event->getData();
        $form = $event->getForm();
        /**
         * @var integer $index
         * @var array $question
         */
        foreach ($data['questions'] as $index => $question) {
            $form->get('questions')->remove($index);
            $form->get('questions')->add($index, $this->pollQuestionChain->getQuestionTypeFromName($question['type']), [
                'questionType' => $question['type']
            ]);
        }
    }
}
