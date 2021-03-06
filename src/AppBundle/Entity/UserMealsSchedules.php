<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * UserMealsSchedules
 *
 * @ORM\Table(name="user_meals_schedules", indexes={@ORM\Index(name="user_idx", columns={"user_id"})})
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserMealsSchedulesRepository")
 */
class UserMealsSchedules
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\ScheduleDays", mappedBy="userMealsSchedule", cascade={"persist"})
     */
    private $scheduleDays;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User", inversedBy="mealsSchedules")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="time_inserted", type="datetime")
     */
    private $timeInserted;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="time_updated", type="datetime")
     */
    private $timeUpdated;


    public function __construct()
    {
        $this->scheduleDays = new ArrayCollection();
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return UserMealsSchedules
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param User $user
     * @return UserMealsSchedules
     */
    public function setUser($user)
    {
        $this->user = $user;
        return $this;
    }



    /**
     * Set name
     *
     * @param string $name
     *
     * @return UserMealsSchedules
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set timeInserted
     *
     * @param \DateTime $timeInserted
     *
     * @return UserMealsSchedules
     */
    public function setTimeInserted($timeInserted)
    {
        $this->timeInserted = $timeInserted;

        return $this;
    }

    /**
     * Get timeInserted
     *
     * @return \DateTime
     */
    public function getTimeInserted()
    {
        return $this->timeInserted;
    }

    /**
     * Set timeUpdated
     *
     * @param \DateTime $timeUpdated
     *
     * @return UserMealsSchedules
     */
    public function setTimeUpdated($timeUpdated)
    {
        $this->timeUpdated = $timeUpdated;

        return $this;
    }

    /**
     * Get timeUpdated
     *
     * @return \DateTime
     */
    public function getTimeUpdated()
    {
        return $this->timeUpdated;
    }

    /**
     * @return mixed
     */
    public function getScheduleDays()
    {
        return $this->scheduleDays;
    }

    /**
     * @param mixed $scheduleDays
     * @return UserMealsSchedules
     */
    public function setScheduleDays($scheduleDays)
    {
        $this->scheduleDays = $scheduleDays;
        return $this;
    }

    public function addScheduleDay(ScheduleDays $scheduleDay)
    {
        $scheduleDay->setUserMealsSchedule($this);
        $this->scheduleDays->add($scheduleDay);
    }


}

