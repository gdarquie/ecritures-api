<?php

namespace App\Controller;

use App\Entity\Concept\Projet;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class ProjetController extends AbstractController
{

    /**
     * @Route("/projets", name="projets")
     * @Method("GET")
     */
    public function projets()
    {
        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery('SELECT p.id, p.titre, p.description  FROM App\Entity\Concept\Projet p ORDER BY p.id DESC');
        $textes = $query->getResult();

        return new JsonResponse($textes);
    }


    /**
     * @Route("/projet={id}", name="projet")
     * @Method("GET")
     */
    public function projet($id)
    {
        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery('SELECT p.id, p.titre, p.description  FROM App\Entity\Concept\Projet p WHERE p.id = :id');
        $query->setParameter('id', $id);
        $textes = $query->getResult();

        return new JsonResponse($textes);
    }

    /**
     * @Route("/projet={id}/textes", name="projetTextes")
     * @Method("GET")
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
     * @Route("/projet={id}/evenements", name="projetEvenements")
     * @Method("GET")
     */
    public function projetEvenements($id){

        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery('SELECT e.id, e.nom, e.contenu FROM App\Entity\Concept\Evenement e JOIN e.projets p WHERE p.id = :id');
        $query->setParameter('id', $id);
        $evenements = $query->getResult();

        return new JsonResponse($evenements);
    }

    /**
     * @Route("/projet={id}/personnages", name="projetPersonnages")
     * @Method("GET")
     */
    public function projetPersonnages($id){

        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery('SELECT p.id, p.surnom FROM App\Entity\Concept\Personnage p JOIN p.projets j WHERE j.id = :id');
        $query->setParameter('id', $id);
        $personnages = $query->getResult();

        return new JsonResponse($personnages);
    }

    /**
     * @Route("/projet")
     * @Method("POST")
     */
    public function newProjetAction(Request $request)
    {
        $data = json_decode($request->getContent(), true);

        $projet = new Projet();
        $projet->setTitre($data['titre']);
        $projet->setDescription($data['description']);
        $em = $this->getDoctrine()->getManager();
        $em->persist($projet);
        $em->flush();


        return new Response("Save done!!");
    }
    //post
}
