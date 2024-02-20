<?php

namespace App\Controller;

use Knp\Component\Pager\PaginatorInterface;
use App\Repository\ShoesRepository;
use App\Entity\Shoes;
use App\Form\ShoesType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * this fonction is used to display all the shoes
 * 
 * @param ShoesRepository $repository
 * @param PaginatorInterface $paginator
 * @param Request $request
 * @return Response
 */

class ShoesController extends AbstractController
{
    #[Route('/shoes', name: 'app_shoes', methods: ['GET'])]
    public function index(ShoesRepository $repository, PaginatorInterface $paginator, Request $request): Response
    {

        $shoes = $paginator->paginate(
            $repository->findAll(),
            $request->query->getInt('page', 1),
            10
        );

        return $this->render('pages/shoes/index.html.twig', ['shoes' => $shoes]);
    }

    /**
     * this fonction is used to display the form to create a new shoes
     * 
     * @param Request $request
     * @param EntityManagerInterface $entityManager
     * @return Response
     * 
     */

    #[Route('/shoes/new', name: 'shoes.new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $manager): Response
    {
        $shoes = new Shoes();
        $form = $this->createForm(ShoesType::class, $shoes);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $shoes = $form->getData();
            $manager->persist($shoes);
            $manager->flush();

            $this->addFlash('success', 'Votre chaussures a bien été ajouté.');

            return $this->redirectToRoute('app_shoes');
        }

        return $this->render('pages/shoes/new.html.twig', ['shoes' => $shoes, 'form' => $form->createView()]);
    }

    #[Route('/shoes/{id}/edit', name: 'shoes.edit', methods: ['GET', 'POST'])]
    public function edit(ShoesRepository $repository, Request $request, EntityManagerInterface $manager, int $id): Response
    {
        $shoes = $repository->findOneBy(['id' => $id]);
        $form = $this->createForm(ShoesType::class, $shoes);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $shoes = $form->getData();
            $manager->persist($shoes);
            $manager->flush();

            $this->addFlash('success', 'Votre chaussures a bien été modifiée.');

            return $this->redirectToRoute('app_shoes');
        }
        return $this->render('pages/shoes/edit.html.twig', ['shoes' => $shoes, 'form' => $form->createView()]);
    }

    #[Route('/shoes/{id}/delete', name:'shoes.delete', methods: ['GET','POST'])]
    public function delete(ShoesRepository $repository, EntityManagerInterface $manager, int $id): Response
    {
        if (!$shoes = $repository->findOneBy(['id' => $id])) {
            $this->addFlash('error', 'Votre chaussures n\'existe pas.');
            return $this->redirectToRoute('app_shoes');
        }

        $shoes = $repository->findOneBy(['id' => $id]);
        $manager->remove($shoes);
        $manager->flush();

        $this->addFlash('success', 'Votre chaussures a bien été supprimée.');

        return $this->redirectToRoute('app_shoes');
    }
}
