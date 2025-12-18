<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\People;
use App\Entity\Orders;
use App\Entity\Cars;

class AutoSalonController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/fzadanie', name: 'fzadanie')]
    public function fzadanie(): Response
    {
        $query = $this->entityManager->createQuery(
            'SELECT c.name, COUNT(o.id) AS purchase_count FROM App\Entity\People c LEFT JOIN c.orders o GROUP BY c.id ORDER BY purchase_count DESC'
        );
        $result1 = $query->getResult();

        return $this->render('list.html.twig', [
            'orders' => $result1,
        ]);
    }

    #[Route('/twozadanie', name: 'twozadanie')]
    public function twozadanie(): Response
    {
        $query = $this->entityManager->createQuery(
            'SELECT o.id, c.name, o.orderDate, o.totalAmount
             FROM App\Entity\Orders o
             JOIN App\Entity\People c WITH o.People = c.id
             ORDER BY o.orderDate DESC'
        );
        $result2 = $query->getResult();

        return $this->render('total.html.twig', [
            'orders' => $result2,
        ]);
    }

    #[Route('/threezad', name: 'threezad')]
    public function threezad(): Response
    {
        $query = $this->entityManager->createQuery(
            'SELECT c.name, SUM(o.totalAmount) AS total_spent
             FROM App\Entity\People c
             JOIN App\Entity\Orders o WITH c.id = o.people
             GROUP BY c.id
             ORDER BY total_spent DESC'
        )->setMaxResults(3);
        $result3 = $query->getResult();

        return $this->render('top.html.twig', [
            'orders' => $result3,
        ]);
    }

    #[Route('/fourtask', name: 'fourtask')]
    public function fourtask(): Response
    {
        $query = $this->entityManager->createQuery(
            'SELECT AVG(o.totalAmount) AS average_purchase_amount
             FROM App\Entity\Orders o'
        );
        $result4 = $query->getSingleResult();

        return $this->render('avg.html.twig', [
            'orders' => $result4,
        ]);
    }

    #[Route('/fivetask', name: 'fivetask')]
    public function fivetask(): Response
    {
        $query = $this->entityManager->createQuery(
            'SELECT c.model, c.price
             FROM App\Entity\Cars c
             ORDER BY c.price DESC'
        )->setMaxResults(1);
        $result5 = $query->getSingleResult();

        return $this->render('gold.html.twig', [
            'orders' => $result5,
        ]);
    }
}

    

