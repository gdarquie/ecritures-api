<?php

namespace App\Entity\Concept;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TexteRepository")
 */
class Texte extends AbstractTexte
{


    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Concept\Projet", inversedBy="textes")
     * @ORM\JoinTable(name="texte_has_projet")
     * @ORM\JoinColumn(name="texte_id",referencedColumnName="id")
     *
     */
    private $projets;

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
