<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

use AppBundle\Entity\Livre;

use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\View\View;

class LivreController extends FOSRestController
{
    /**
    * @Rest\Get("/books")
    */
    public function getAction()
    {
    $result = $this->getDoctrine()->getRepository(Livre::class)->findAll();
    if ($result === null) 
        return new View("there are no books", Response::HTTP_NOT_FOUND);
    return $result;
    }

    /**
    * @Rest\Post("/books")
    */
    public function addbook(Request $request)
    {
       
        $data = new Livre();
        $data->setTitre('ahmed');
        $data->setDescriptif('descriptif');
        $data->setISBN('ahmed bns');
        $data->setDateedition(new \DateTime());
        $em = $this->getDoctrine()->getManager();
        $em->persist($data);
        $em->flush();
        return new View("book Added Successfully ", Response::HTTP_CREATED);
    }

    /**
    * @Rest\Put("/books/{id}")
    */
    public function updatebook(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository(Livre::class);
        $data = $repo->find($id);
        if($data == null)
        {
            return new View("NULL VALUES ARE NOT ALLOWED", Response::HTTP_NOT_CREATED);
        }
        $data->setTitre('Put Titre');
        $data->setDescriptif('Put descriptif');
        $data->setISBN('Put ahmed bns');
        $data->setDateedition(new \DateTime());
        $em = $this->getDoctrine()->getManager();
        $em->persist($data);
        $em->flush();
        return new View("book update Successfully", Response::HTTP_CREATED);
    }

    /**
    * @Rest\Get("/book/{titre}")
    */
    public function searchAction($titre)
    {
        
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository(Livre::class);
        $result = $repo->findOneByTitre($titre);
        if ($result === null) 
            {return new View("there are no books with this title", Response::HTTP_NOT_FOUND);}
        return $result;
    }

    /**
    * @Rest\Get("/books/{id}")
    */
    public function detailAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository(Livre::class);
        $result = $repo->find($id);
        if ($result === null) 
            {return new View("there are no books with this id", Response::HTTP_NOT_FOUND);}
        return $result;
    }

    /**
    * @Rest\DELETE("/books/{id}")
    */
    public function deletebook(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository(Livre::class);
        $data = $repo->find($id);
        if($data == null)
        {
            return new View("NULL VALUES ARE NOT ALLOWED", Response::HTTP_NOT_CREATED);
        }
        $em->remove($data);
        $em->flush();
        return new View("book deleted Successfully", Response::HTTP_CREATED);
    }
}
