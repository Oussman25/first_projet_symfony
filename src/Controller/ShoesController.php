<?php

namespace App\Controller;

use Knp\Component\Pager\PaginatorInterface;
use App\Repository\ShoesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ShoesController extends AbstractController
{
    #[Route('/shoes', name: 'app_shoes')]
    public function index(ShoesRepository $repository, PaginatorInterface $paginator, Request $request): Response
    {

        $shoes = $paginator->paginate(
            $repository->findAll(),
            $request->query->getInt('page', 1),
            10
        );

        return $this->render('pages/shoes/index.html.twig', ['shoes' => $shoes]);
    }
}
