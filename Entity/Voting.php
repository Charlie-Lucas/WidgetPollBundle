<?php

namespace Victoire\Widget\PollBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Victoire\Bundle\UserBundle\Entity\User;
use Victoire\Widget\PollBundle\Entity\Answer\Participation;

/**
 * Voting
 *
 * @ORM\Table("vic_widget_poll_voting")
 * @ORM\Entity
 */
class Voting
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var  User
     * @ORM\ManyToOne(targetEntity="Victoire\Bundle\UserBundle\Entity\User")
     */
    private $user;

    /**
     * @var string
     * @ORM\Column(type="string", length=255)
     */
    private $userIp;

    /**
     * @var Participation []
     * @ORM\OneToMany(targetEntity="Victoire\Widget\PollBundle\Entity\Answer\Participation", mappedBy="voting")
     */
    private $participations;


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set userIp
     *
     * @param string $userIp
     *
     * @return Voting
     */
    public function setUserIp($userIp)
    {
        $this->userIp = $userIp;

        return $this;
    }

    /**
     * Get userIp
     *
     * @return string
     */
    public function getUserIp()
    {
        return $this->userIp;
    }

    /**
     * Set user
     *
     * @param \Victoire\Bundle\UserBundle\Entity\User $user
     *
     * @return Voting
     */
    public function setUser(\Victoire\Bundle\UserBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \Victoire\Bundle\UserBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->participations = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add poll
     *
     * @param \Victoire\Widget\PollBundle\Entity\Answer\Participation $participation
     *
     * @return Voting
     */
    public function addParticipation(\Victoire\Widget\PollBundle\Entity\Answer\Participation $participation)
    {
        $this->participations[] = $participation;

        return $this;
    }

    /**
     * Remove participation
     *
     * @param \Victoire\Widget\PollBundle\Entity\Answer\Participation $participation
     */
    public function removeParticipation(\Victoire\Widget\PollBundle\Entity\Answer\Participation $participation)
    {
        $this->participations->removeElement($participation);
    }

    /**
     * Get polls
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getParticipations()
    {
        return $this->participations;
    }
}
