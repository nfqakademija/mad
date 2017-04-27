<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ScheduleDayMeals
 *
 * @ORM\Table(name="schedule_day_meals")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ScheduleDayMealsRepository")
 */
class ScheduleDayMeals
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
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\ScheduleDays", inversedBy="meals")
     * @ORM\JoinColumn(name="schedule_day_id", referencedColumnName="id")
     */
    private $scheduleDay;

    /**
     * @var int
     *
     * @ORM\Column(name="meal_count", type="integer")
     */
    private $mealCount;

    /**
     * @var array
     *
     * @ORM\Column(name="meal_json", type="json_array")
     */
    private $mealJson;

    /**
     * @var int
     *
     * @ORM\Column(name="day_meals_order", type="integer")
     */
    private $dayMealsOrder;

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
    public function getScheduleDay()
    {
        return $this->scheduleDay;
    }

    /**
     * @param mixed $scheduleDay
     * @return ScheduleDayMeals
     */
    public function setScheduleDay($scheduleDay)
    {
        $this->scheduleDay = $scheduleDay;
        return $this;
    }



    /**
     * Set mealCount
     *
     * @param integer $mealCount
     *
     * @return ScheduleDayMeals
     */
    public function setMealCount($mealCount)
    {
        $this->mealCount = $mealCount;

        return $this;
    }

    /**
     * Get mealCount
     *
     * @return int
     */
    public function getMealCount()
    {
        return $this->mealCount;
    }

    /**
     * Set mealJson
     *
     * @param array $mealJson
     *
     * @return ScheduleDayMeals
     */
    public function setMealJson($mealJson)
    {
        $this->mealJson = $mealJson;

        return $this;
    }

    /**
     * Get mealJson
     *
     * @return array
     */
    public function getMealJson()
    {
        return $this->mealJson;
    }

    /**
     * Set dayMealsOrder
     *
     * @param integer $dayMealsOrder
     *
     * @return ScheduleDayMeals
     */
    public function setDayMealsOrder($dayMealsOrder)
    {
        $this->dayMealsOrder = $dayMealsOrder;

        return $this;
    }

    /**
     * Get dayMealsOrder
     *
     * @return int
     */
    public function getDayMealsOrder()
    {
        return $this->dayMealsOrder;
    }

    /**
     * Set timeInserted
     *
     * @param \DateTime $timeInserted
     *
     * @return ScheduleDayMeals
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
     * @return ScheduleDayMeals
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
}

