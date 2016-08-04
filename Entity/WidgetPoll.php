<?php
namespace Victoire\Widget\PollBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Victoire\Bundle\WidgetBundle\Entity\Widget;

/**
 * WidgetPoll
 *
 * @ORM\Table("vic_widget_poll")
 * @ORM\Entity
 */
class WidgetPoll extends Widget
{

    /**
     * To String function
     * Used in render choices type (Especially in VictoireWidgetRenderBundle)
     * //TODO Check the generated value and make it more consistent
     *
     * @return String
     */

    /**
     * @var Question []
     * @ORM\OneToMany(targetEntity="Victoire\Widget\PollBundle\Entity\Question", mappedBy="widget", cascade={"persist"})
     */
    private $questions;

    public function __construct()
    {
        parent::__construct();
        $this->questions = new ArrayCollection();
    }

    public function __toString()
    {
        return 'Poll #'.$this->id;
    }

    /**
     * Add question
     *
     * @param \Victoire\Widget\PollBundle\Entity\Question $question
     *
     * @return WidgetPoll
     */
    public function addQuestion(\Victoire\Widget\PollBundle\Entity\Question $question)
    {
        $this->questions[] = $question;
        $question->setWidget($this);

        return $this;
    }

    /**
     * Remove question
     *
     * @param \Victoire\Widget\PollBundle\Entity\Question $question
     */
    public function removeQuestion(\Victoire\Widget\PollBundle\Entity\Question $question)
    {
        $this->questions->removeElement($question);
    }

    /**
     * Get questions
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getQuestions()
    {
        return $this->questions;
    }
}
