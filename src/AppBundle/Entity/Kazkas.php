<?php

namespace AppBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="Kazkas")
 */
class Kazkas
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=60, nullable=true)
     */
    private $kazkas;

    /**
     * @return mixed
     */
    public function getKazkas()
    {
        return $this->kazkas;
    }

    /**
     * @param mixed $kazkas
     */
    public function setKazkas($kazkas)
    {
        $this->kazkas = $kazkas;
    }

}