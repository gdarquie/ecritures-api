<?php

namespace App\Controller;

use App\Entity\Concept\Fiction;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class FictionController extends AbstractController
{
    /**
     * @Route("/fictions", name="fictions")
     * @Method("GET")
     */
    public function getfictions()
    {

        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery('SELECT f.id as id, f.nom, f.description FROM App\Entity\Concept\Fiction f');
        $query->setMaxResults(100);
        //système de pagination

        $fictions = $query->getResult();

        return new JsonResponse($fictions);
    }

    /**
     * @Route("/fiction={id}", name="fiction")
     * @Method("GET")
     */
    public function getfictionById($id)
    {
        $em = $this->getDoctrine()->getManager();

        //si l'user à l'autorisation - pour l'instant j'ai accès à tous les fictions sans vérification
        //si l'user n'est pas admin, on procède à une vérification, est-ce que l'user a bien le droit de regarder ce fiction (= est-ce que le fiction est public ou est-ce qu'il en est l'auteur)

        $query = $em->createQuery('SELECT f FROM App\Entity\Concept\Fiction f WHERE f.id = :id');
        $query->setParameter('id', $id);

        $fiction = $query->getSingleResult();

        if(!$fiction){
            return new JsonResponse("Message d'erreur");
        }

        $fiction = $this->serializeFiction($fiction);
        return new JsonResponse($fiction);
    }

    public function serializeFiction(Fiction $fiction)
    {
        return array(
            'id' => $fiction->getId(),
            'nom' => $fiction->getNom(),
            'description' => $fiction->getDescription()
            );
    }

}
