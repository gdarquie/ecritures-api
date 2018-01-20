<?php

namespace App\Entity\Concept;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class AbstractProjet
 *
 * @package AppBundle\Model
 * @ORM\MappedSuperclass
 */
abstract class AbstractProjet
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


}