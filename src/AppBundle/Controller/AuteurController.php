<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

use AppBundle\Entity\Auteur;
use AppBundle\Entity\Livre;

use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\View\View;

class AuteurController extends FOSRestController
{
    /**
    * @Rest\Get("/authors")
    */
    public function getAction()
    {
    $result = $this->getDoctrine()->getRepository(Auteur::class)->findAll();
    if ($result === null) 
        return new View("there are no authors", Response::HTTP_NOT_FOUND);
    return $result;
    }


    /**
    * @Rest\Get("/authors/{id}")
    */
    public function getBooksAuteurAction($id)
    {
        $res = $this->getDoctrine()
        ->getRepository(Livre::class)
        ->AuteurBooks($id);
        return $res; 
    }

    /**
    * @Rest\Post("/authors")
    */
    public function addAuthor(Request $request)
    {
       
        $data = new Auteur();
        $data->setNom('sbaa');
        $data->setEmail('ahmedsbaa@gmail.com');
        $em = $this->getDoctrine()->getManager();
        $em->persist($data);
        $em->flush();
        return new View("author Added Successfully ", Response::HTTP_CREATED);
    }

    /**
    * @Rest\Put("/authors/{id}")
    */
    public function updatebook(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository(Auteur::class);
        $data = $repo->find($id);
        if($data == null)
        {
            return new View("NULL VALUES ARE NOT ALLOWED", Response::HTTP_NOT_CREATED);
        }
        $data->setNom('ahmed');
        $data->setEmail('ahmedsbaa@gmail.com');
        $em = $this->getDoctrine()->getManager();
        $em->persist($data);
        $em->flush();
        return new View("author updated ", Response::HTTP_CREATED);
    }


    /**
    * @Rest\Get("/authors/{id}")
    */
    public function detailAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository(Auteur::class);
        $result = $repo->find($id);
       
        if ($result === null) 
            {return new View("there are no authors with this id", Response::HTTP_NOT_FOUND);}
        return $result;
    }
}
