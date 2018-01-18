<?php

namespace App\Entity\Concept;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PersonnageRepository")
 * @ORM\Table(name="personnage")
 */
class Personnage
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     */
    private $surnom;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Concept\Projet", inversedBy="personnages")
     * @ORM\JoinTable(name="personnage_has_projet")
     * @ORM\JoinColumn(name="personnage_id",referencedColumnName="id")
     *
     */
    private $projets;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getSurnom()
    {
        return $this->surnom;
    }

    /**
     * @param mixed $surnom
     */
    public function setSurnom($surnom)
    {
        $this->surnom = $surnom;
    }

    /**
     * @return mixed
     */
    public function getProjets()
    {
        return $this->projets;
    }

    /**
     * @param mixed $projets
     */
    public function setProjets($projets)
    {
        $this->projets = $projets;
    }

}