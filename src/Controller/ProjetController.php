<?php

namespace App\Controller;

use App\Entity\Concept\Projet;
use App\Form\ProjetType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use App\Component\Handler\projetHandler;


class ProjetController extends AbstractController
{

    /**
     * @Route("/projets", name="projets")
     * @Method("GET")
     */
    public function projets()
    {
        $em = $this->getDoctrine()->getManager();
        $projets = (new projetHandler())->handleProjets($em);
        $response  = new JsonResponse($projets);
        $response->headers->set('Content', 'application/json');

        return $response;
    }


    /**
     * @Route("/projet={id}", name="projet")
     * @Method("GET")
     */
    public function projet($id)
    {
        $projet = $this->getDoctrine()
            ->getRepository('App:Concept\Projet')->findOneById($id);

        if(!$projet){
            throw $this->createNotFoundException('Pas de projet trouvé pour cet id');
        }


        $data = [
            'id' => $projet->getId(),
            'titre' => $projet->getTitre(),
            'description' => $projet->getDescription()
        ];

        return new JsonResponse($data);
    }

    /**
     * @Route("/projet={id}/textes", name="projetTextes")
     * @Method("GET")
     */
    public function projetTextes($id)
    {
        $em = $this->getDoctrine()->getManager();
        $textes = (new projetHandler())->handleProjetTextes($em, $id);

        return new JsonResponse($textes);
    }

    /**
     * @Route("/projet={id}/evenements", name="projetEvenements")
     * @Method("GET")
     */
    public function projetEvenements($id){

        $em = $this->getDoctrine()->getManager();
        $evenements = (new projetHandler())->handleProjetEvenements($em, $id);

        return new JsonResponse($evenements);
    }

    /**
     * @Route("/projet={id}/personnages", name="projetPersonnages")
     * @Method("GET")
     */
    public function projetPersonnages($id){

        $em = $this->getDoctrine()->getManager();
        $personnages = (new projetHandler())->handleProjetPersonnages($em, $id);

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
        $form = $this->createForm(ProjetType::class, $projet);
        $form->submit($data);
        $em = $this->getDoctrine()->getManager();
        $em->persist($projet);
        $em->flush();
//
//        (new projetHandler())->handleSaveProjet($request);

        $response = new Response("Save done!!", 201);
        $response->headers->set('Location', 'some/projet/url');

        return $response;
    }
}
