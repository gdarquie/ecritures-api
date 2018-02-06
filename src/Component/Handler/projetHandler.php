<?php

namespace App\Component\Handler;

class projetHandler
{
    public function handleProjets($em)
    {
        $query = $em->createQuery('SELECT p.id, p.titre, p.description  FROM App\Entity\Concept\Projet p ORDER BY p.id DESC');
        $projets = $query->getResult();

        return $projets;
    }

    public function handleProjet($em, $id)
    {
        $query = $em->createQuery('SELECT p.id, p.titre, p.description  FROM App\Entity\Concept\Projet p WHERE p.id = :id');
        $query->setParameter('id', $id);
        $projet = $query->getResult();

        return $projet;
    }

    public function handleProjetTextes($em, $id)
    {
        $query = $em->createQuery('SELECT t.id, t.titre, t.contenu  FROM App\Entity\Concept\Texte t JOIN t.projets p WHERE p.id = :id');
        $query->setParameter('id', $id);
        $textes = $query->getResult();

        return $textes;
    }

    public function handleProjetEvenements($em, $id)
    {
        $query = $em->createQuery('SELECT e.id, e.nom, e.contenu FROM App\Entity\Concept\Evenement e JOIN e.projets p WHERE p.id = :id');
        $query->setParameter('id', $id);
        $evenements = $query->getResult();

        return $evenemnts;
    }

    public function handleProjetPersonnages($em, $id)
    {
        $query = $em->createQuery('SELECT p.id, p.surnom FROM App\Entity\Concept\Personnage p JOIN p.projets j WHERE j.id = :id');
        $query->setParameter('id', $id);
        $personnages = $query->getResult();

        return $personnages;
    }

    public function handleSaveProjet(Request $request)
    {
        $data = json_decode($request->getContent(), true);

        $projet = new Projet();
        $projet->setTitre($data['titre']);
        $projet->setDescription($data['description']);
        $em = $this->getDoctrine()->getManager();
        $em->persist($projet);
        $em->flush();

        return true;
    }

}