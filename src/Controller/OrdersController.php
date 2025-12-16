<?php

namespace App\Controller;

use App\Entity\Orders;
use App\Repository\OrdersRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

 	class OrdersController extends AbstractController
    {
        #[Route('/entityOrders', name:'orders', methods:['POST'])]
        public function create(Request $request, EntityManagerInterface $entityManager, OrdersRepository $OrdersRepository): Response
        {
        $name = $request->request->get('name');
        $avto = $request->request->get('avto');
        $price= $request->request->get('price');
        
        $orders=new Orders();
        $orders->setName($name);
        $orders->setAvto($avto);
        $orders->setPrice($price);
        $ordersList = $OrdersRepository->findAll();
        $totalPrice = 0;
        $count = 0;
        foreach ($ordersList as $order) {
            $totalPrice += $order->getPrice(); 
            $count++;
        }
         $averagePrice = $count > 0 ? $totalPrice / $count : 0;

        $entityManager->persist($orders);
        $entityManager->flush();
        $orders = $OrdersRepository->findAll();
        return $this->render('list1.html.twig', [
            'orders' => $orders,
        ]);
    }

    #[Route('/formorders', name: 'formporders')]
    public function formplayer(): Response
    {
        return $this->render('orders.html.twig', []);
    }
}
        