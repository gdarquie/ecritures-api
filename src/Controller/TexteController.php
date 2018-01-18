<?php

namespace App\Controller;

use App\Entity\Concept\Texte;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;


class TexteController extends AbstractController
{
    /**
     * @Route("/textes", name="textes")
     * @Method("GET")
     */
    public function getTextes()
    {
        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery('SELECT t.id, t.titre, t.contenu FROM App\Entity\Concept\Texte t');
        $query->setMaxResults(100);
        //système de pagination

        $textes = $query->getResult();

        return new JsonResponse($textes);
    }

    /**
     * @Route("/texte={id}", name="texte")
     * @Method("GET")
     */
    public function getTexteById($id)
    {
        $em = $this->getDoctrine()->getManager();

        //si l'user à l'autorisation - pour l'instant j'ai accès à tous les textes sans vérification
        //si l'user n'est pas admin, on procède à une vérification, est-ce que l'user a bien le droit de regarder ce texte (= est-ce que le texte est public ou est-ce qu'il en est l'auteur)

        $query = $em->createQuery('SELECT t FROM App\Entity\Concept\Texte t WHERE t.id = :id');
        $query->setParameter('id', $id);

        $texte = $query->getSingleResult();

        if(!$texte){
            return new JsonResponse("Message d'erreur");
        }

        $texte = $this->serializeTexte($texte);

        return new JsonResponse($texte);
    }

//    /**
//     * @Route("/texte", name="texte")
//     * @Method("POST")
//     */
//    public function postTexte()
//    {
//        //create a new texte
//        return "La requête a marché";
//    }

    public function serializeTexte(Texte $texte)
    {
        return array(
            'id' => $texte->getId(),
            'titre' => $texte->getTitre(),
            'contenu' => $texte->getContenu(),
            'resume' => $texte->getContenu(), //a changer avec limit 255 char par exemple
        );
    }

}
