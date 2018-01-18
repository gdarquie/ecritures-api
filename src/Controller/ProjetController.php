<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

class ProjetController extends AbstractController
{

    /**
     * @Route("/projets", name="projets")
     */
    public function projets()
    {
        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery('SELECT p.id, p.titre, p.description  FROM App\Entity\Concept\Projet p');
        $textes = $query->getResult();

        return new JsonResponse($textes);
    }

    /**
     * @Route("/projet/{id}/textes", name="projetTextes")
     */
    public function projetTextes($id)
    {
        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery('SELECT t.id, t.titre, t.contenu  FROM App\Entity\Concept\Texte t JOIN t.projets p WHERE p.id = :id');
        $query->setParameter('id', $id);
        $textes = $query->getResult();

        return new JsonResponse($textes);
    }

    /**
     * @Route("/projet/{id}/evenements", name="projetEvenements")
     */
    public function projetEvenements($id){

        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery('SELECT e.id, e.nom, e.contenu FROM App\Entity\Concept\Evenement e JOIN e.projets p WHERE p.id = :id');
        $query->setParameter('id', $id);
        $evenements = $query->getResult();

        return new JsonResponse($evenements);
    }

    /**
     * @Route("/projet/{id}/personnages", name="projetPersonnages")
     */
    public function projetPersonnages($id){

        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery('SELECT p.id, p.surnom FROM App\Entity\Concept\Personnage p JOIN p.projets j WHERE j.id = :id');
        $query->setParameter('id', $id);
        $personnages = $query->getResult();

        return new JsonResponse($personnages);
    }

}
