<?php

namespace App\Controller;

use App\Entity\Concept\Texte;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Entity;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DefaultController extends AbstractController
{
    public function home()
    {

//        $repository = $this->getDoctrine()->getRepository(Texte::class);
//        $textes = $repository->findAll();

        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery('SELECT t.titre, t.contenu  FROM App\Entity\Concept\Texte t');
        $textes = $query->getResult();

        return new JsonResponse($textes);
    }

    public function personnages()
    {
        
    }

    public function fiction()
    {
        
    }
    
    public function evenements()
    {

    }
    
}