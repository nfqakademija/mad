<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * ScheduleDays
 *
 * @ORM\Table(name="schedule_days", indexes={@ORM\Index(name="schedule_id_idx", columns={"schedule_id"})})
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ScheduleDaysRepository")
 */
class ScheduleDays
{
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @Assert\NotBlank()
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\UserMealsSchedules", inversedBy="scheduleDays", cascade={"persist"})
     * @ORM\JoinColumn(name="schedule_id", referencedColumnName="id")
     */
    private $userMealsSchedule;


    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\ScheduleDayMeals", mappedBy="scheduleDay", cascade={"persist"})
     */
    private $meals;


    /**
     * @Assert\NotBlank()
     *
     * @ORM\Column(name="week_day", type="integer")
     */
    private $weekDay;

    /**
     * @Assert\NotBlank()
     *
     * @ORM\Column(name="time_inserted", type="datetime")
     */
    private $timeInserted;

    /**
     * @Assert\NotBlank()
     *
     * @ORM\Column(name="time_updated", type="datetime")
     */
    private $timeUpdated;


    public function __construct()
    {
        $this->meals = new ArrayCollection();
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
     * @return mixed
     */
    public function getUserMealsSchedule()
    {
        return $this->userMealsSchedule;
    }

    /**
     * @param mixed $userMealsSchedule
     * @return ScheduleDays
     */
    public function setUserMealsSchedule($userMealsSchedule)
    {
        $this->userMealsSchedule = $userMealsSchedule;
        return $this;
    }



    /**
     * Set weekDay
     *
     * @param integer $weekDay
     *
     * @return ScheduleDays
     */
    public function setWeekDay($weekDay)
    {
        $this->weekDay = $weekDay;

        return $this;
    }

    /**
     * Get weekDay
     *
     * @return int
     */
    public function getWeekDay()
    {
        return $this->weekDay;
    }

    /**
     * Set timeInserted
     *
     * @param \DateTime $timeInserted
     *
     * @return ScheduleDays
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
     * @return ScheduleDays
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
     * @param mixed $meals
     * @return ScheduleDays
     */
    public function setMeals($meals)
    {
        $this->meals = $meals;
        return $this;
    }

    public function addMeal(ScheduleDayMeals $meal)
    {
        $meal->setScheduleDay($this);
        $this->meals->add($meal);
    }
}

