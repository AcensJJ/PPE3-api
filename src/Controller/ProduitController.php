<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Produit controller.
 * @Route("/api", name="api_")
 */
class ProduitController extends FOSRestController
{
    /**
     * Lists all Produit.
     * @Rest\Get("/produits")
     *
     * @return Response
     */
    public function getProduitAction(ObjectManager $manager)
    {
        $rawSql = "SELECT * FROM produit p";
        $stmt = $manager->getConnection()->prepare($rawSql);
        $stmt->execute();
        $data = $stmt->fetchAll();
                
        return $this->handleView($this->view($data, 200));
    }

    /**
       * Lists Produit by id.
       * @Rest\Get("/produit/{id}"), requirements={"id" = "\d+"}, defaults={"id" = 1})
       *
       * @return Response
       */
      public function getProduitByIdAction($id, ObjectManager $manager)
      {
        $conn = $manager->getConnection();
        $sql = '
                SELECT * FROM produit p
                WHERE p.id = :id
        ';
        $stmt = $conn->prepare($sql);
        $stmt->execute(['id' => $id]);
        $data = $stmt->Fetch();
        return $this->handleView($this->view($data, 200));
      }
}
