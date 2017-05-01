<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MealsWithIngredients
 *
 * @ORM\Table(name="meal_with_ingredients")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\MealWithIngredientsRepository")
 */
class MealsWithIngredients
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
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Ingredients", inversedBy="meals")
     * @ORM\JoinColumn(name="ingredient_id", referencedColumnName="id")
     */
    private $ingredientId;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Meals", inversedBy="ingredients")
     * @ORM\JoinColumn(name="meal_id", referencedColumnName="id")
     */
    private $mealId;

    /**
     * @var int
     *
     * @ORM\Column(name="ammount", type="integer")
     */
    private $ammount;


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
    public function getIngredientId()
    {
        return $this->ingredientId;
    }

    /**
     * @param mixed $ingredientId
     * @return MealsWithIngredients
     */
    public function setIngredientId($ingredientId)
    {
        $this->ingredientId = $ingredientId;
        return $this;
    }



    /**
     * @param  mixed $mealId
     *
     * @return MealsWithIngredients
     */
    public function setMealId($mealId)
    {
        $this->mealId = $mealId;

        return $this;
    }

    /**
     * Get mealId
     *
     * @return int
     */
    public function getMealId()
    {
        return $this->mealId;
    }

    /**
     * Set ammount
     *
     * @param integer $ammount
     *
     * @return MealsWithIngredients
     */
    public function setAmmount($ammount)
    {
        $this->ammount = $ammount;

        return $this;
    }

    /**
     * Get ammount
     *
     * @return int
     */
    public function getAmmount()
    {
        return $this->ammount;
    }
}

