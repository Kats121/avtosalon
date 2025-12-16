<?php

namespace App\Controller;

use App\Entity\Car;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

 	class CarController extends AbstractController
    {
        #[Route('/entityCar', name:'car', methods:['POST'])]
        public function create(Request $request, EntityManagerInterface $entityManager): Response
        {
        $avto = $request->request->get('avto');
        $price= $request->request->get('price');

        $car=new Car();
        $car->setAvto($avto);
        $car->setPrice($price);

        $entityManager->persist($car);
        $entityManager->flush();
        return new Response('Машина добавлена ' . $car->getId());
        }
        #[Route('/formcar', name: 'formcar')]
         public function formcar(): Response
         {
          return $this->render('car.html.twig', []);
         }
    
    #[Route('/mostCar', name: 'most_car')]
public function showMostExpensiveCar(EntityManagerInterface $entityManager): Response
{
    $carRepository = $entityManager->getRepository(Car::class);
    $mostExpensiveCar = $carRepository->createQueryBuilder('c')
        ->orderBy('c.price', 'DESC')
        ->setMaxResults(1)
        ->getQuery()
        ->getOneOrNullResult();
    return $this->render('most_car.html.twig', [
        'car' => $mostExpensiveCar
    ]);
}
    }