<?php

namespace App\Controller;

use App\Entity\Drivers;
use App\Form\Drivers1Type;
use App\Repository\DriversRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/drivers/crud')]
class DriversCrudController extends AbstractController
{
    #[Route('/', name: 'app_drivers_crud_index', methods: ['GET'])]
    public function index(DriversRepository $driversRepository): Response
    {
        return $this->render('drivers_crud/index.html.twig', [
            'drivers' => $driversRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_drivers_crud_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $driver = new Drivers();
        $form = $this->createForm(Drivers1Type::class, $driver);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($driver);
            $entityManager->flush();

            return $this->redirectToRoute('app_drivers_crud_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('drivers_crud/new.html.twig', [
            'driver' => $driver,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_drivers_crud_show', methods: ['GET'])]
    public function show(Drivers $driver): Response
    {
        return $this->render('drivers_crud/show.html.twig', [
            'driver' => $driver,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_drivers_crud_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Drivers $driver, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(Drivers1Type::class, $driver);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_drivers_crud_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('drivers_crud/edit.html.twig', [
            'driver' => $driver,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_drivers_crud_delete', methods: ['POST'])]
    public function delete(Request $request, Drivers $driver, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$driver->getId(), $request->request->get('_token'))) {
            $entityManager->remove($driver);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_drivers_crud_index', [], Response::HTTP_SEE_OTHER);
    }
}
