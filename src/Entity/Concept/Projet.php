<?php

namespace App\Entity\Concept;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity(repositoryClass="App\Repository\ProjetRepository")
 * @ORM\Table(name="projet")
 */
class Projet
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     */
    private $titre;


    /**
     * @ORM\Column(type="text")
     */
    private $description;

//    /**
//     * @var \Doctrine\Common\Collections\Collection
//     *
//     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Type", inversedBy="types")
//     * @ORM\JoinTable(name="projet_has_type",
//     *   joinColumns={
//     *     @ORM\JoinColumn(name="projet_id", referencedColumnName="id")
//     *   },
//     *   inverseJoinColumns={
//     *     @ORM\JoinColumn(name="type_id", referencedColumnName="id")
//     *   }
//     * )
//     */
//    private $types;

//    /**
//     * @ORM\ManyToOne(targetEntity="InfictioBundle\Entity\Fiction")
//     */
//    private $fiction;
//
    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Concept\Evenement", mappedBy="evenements")
     */
    private $evenements;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Concept\Texte", mappedBy="projets")
     */
    private $textes;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $date_creation;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $last_update;


    public function __construct()
    {
        $this->types = new ArrayCollection();
        $this->textes = new ArrayCollection();
    }

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
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * @param mixed $titre
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

//    /**
//     * @return mixed
//     */
//    public function getTypes()
//    {
//        return $this->types;
//    }
//
//    /**
//     * @param mixed $types
//     */
//    public function setTypes($types)
//    {
//        $this->types = $types;
//    }


    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getDateCreation()
    {
        return $this->date_creation;
    }

    /**
     * @param mixed $date_creation
     */
    public function setDateCreation($date_creation)
    {
        $this->date_creation = $date_creation;
    }

    /**
     * @return mixed
     */
    public function getLastUpdate()
    {
        return $this->last_update;
    }

    /**
     * @param mixed $last_update
     */
    public function setLastUpdate($last_update)
    {
        $this->last_update = $last_update;
    }

//    /**
//     * @return mixed
//     */
//    public function getFiction()
//    {
//        return $this->fiction;
//    }
//
//    /**
//     * @param mixed $fiction
//     */
//    public function setFiction($fiction)
//    {
//        $this->fiction = $fiction;
//    }
//
    /**
     * @return mixed
     */
    public function getEvenements()
    {
        return $this->evenements;
    }

    /**
     * @param mixed $evenements
     */
    public function setEvenements($evenements)
    {
        $this->evenements = $evenements;
    }

    public function getCode()
    {
        $titre = $this->getTitre();
        $code = strtolower($titre);

        return $code;
    }

    /**
     * @return ArrayCollection|Texte[]
     */
    public function getTextes()
    {
        return $this->textes;
    }


    public function __toString()
    {
        return (string) $this->getId();
    }


}