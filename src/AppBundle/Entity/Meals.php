<?php

namespace AppBundle\Entity;

use AppBundle\Entity\MealsWithIngredients;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Meals
 *
 * @ORM\Table(name="meal")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\MealRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Meals
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
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\MealsWithIngredients", mappedBy="mealId", cascade={"persist"}, orphanRemoval=true)
     */
    private $ingredients;



    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\MealRatings", mappedBy="meal", cascade={"persist"}, orphanRemoval=true)
     */
    private $ratings;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var int
     *
     * @ORM\Column(name="weight", type="integer")
     */
    private $weight;

    /**
     * @var string
     *
     * @ORM\Column(name="about", type="text")
     */
    private $about;

    /**
     * @var string
     *
     * @ORM\Column(name="how_to_make", type="text")
     */
    private $howToMake;

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
        $this->ratings = new ArrayCollection();
        $this->ingredients = new ArrayCollection();
        $this->timeInserted = new \DateTime();
        $this->timeUpdated = new \DateTime();

    }

    /**
     * @ORM\PrePersist
     */
    public function insertTimestamps()
    {
        $this->timeInserted = new \DateTime();
        $this->timeUpdated = new \DateTime();
    }

    /**
     * @ORM\PreUpdate()
     */
    public function updateTimestamps()
    {
        $this->timeUpdated = new \DateTime();
    }

    /**
     * @return ArrayCollection
     */
    public function getIngredients()
    {
        return $this->ingredients;
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
     * Set name
     *
     * @param string $name
     *
     * @return Meals
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
     * Set weight
     *
     * @param integer $weight
     *
     * @return Meals
     */
    public function setWeight($weight)
    {
        $this->weight = $weight;

        return $this;
    }

    /**
     * Get weight
     *
     * @return int
     */
    public function getWeight()
    {
        return $this->weight;
    }

    /**
     * Set about
     *
     * @param string $about
     *
     * @return Meals
     */
    public function setAbout($about)
    {
        $this->about = $about;

        return $this;
    }

    /**
     * Get about
     *
     * @return string
     */
    public function getAbout()
    {
        return $this->about;
    }

    /**
     * Set howToMake
     *
     * @param string $howToMake
     *
     * @return Meals
     */
    public function setHowToMake($howToMake)
    {
        $this->howToMake = $howToMake;

        return $this;
    }

    /**
     * Get howToMake
     *
     * @return string
     */
    public function getHowToMake()
    {
        return $this->howToMake;
    }

    /**
     * Set timeInserted
     *
     * @param \DateTime $timeInserted
     *
     * @return Meals
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
     * @return Meals
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
     * @param mixed $ingredients
     * @return Meals
     */
    public function setIngredients($ingredients)
    {
        $this->ingredients = $ingredients;
        return $this;
    }

    public function addIngredient(MealsWithIngredients $ingredient)
    {
        $ingredient->setMealId($this);
        $this->ingredients->add($ingredient);
    }
}

