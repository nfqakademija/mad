<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UserBlockedIngredients
 *
 * @ORM\Table(name="user_blocked_ingredients")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserBlockedIngredientsRepository")
 */
class UserBlockedIngredients
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
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User", inversedBy="blockedIngredients")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $userId;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Ingredients", inversedBy="usersWhoBlocked")
     * @ORM\JoinColumn(name="ingredient_id", referencedColumnName="id")
     */
    private $ingredientId;


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
     * Set userId
     *
     * @param integer $userId
     *
     * @return UserBlockedIngredients
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * Get userId
     *
     * @return int
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Set ingredientId
     *
     * @param integer $ingredientId
     *
     * @return UserBlockedIngredients
     */
    public function setIngredientId($ingredientId)
    {
        $this->ingredientId = $ingredientId;

        return $this;
    }

    /**
     * Get ingredientId
     *
     * @return int
     */
    public function getIngredientId()
    {
        return $this->ingredientId;
    }
}

