<?php

namespace App\Controller;

use App\Entity\People;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\PeopleRepository;



 	class PeopleController extends AbstractController
{
    #[Route('/entityPeople', name:'people', methods:['POST'])]
    public function create(Request $request, EntityManagerInterface $entityManager, PeopleRepository $PeopleRepository): Response
    {
        
        $name = $request->request->get('name');
        $email = $request->request->get('email');
        $quantity = $request->request->get('quantity');
        $people = new People();
        $people->setName($name);
        $people->setEmail($email);
        $people->setQuantity($quantity);
        $entityManager->persist($people);
        $entityManager->flush();
          $peoples = $PeopleRepository->findAll();
       return $this->render('list.html.twig', [
            'peoples' => $peoples,
        ]);
    }

    #[Route('/formpeople', name: 'formpeople')]
    public function formplayer(): Response
    {
        return $this->render('peoples.html.twig', []);
    }
}

    

