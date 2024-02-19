<?php

namespace App\Controller;

use App\Entity\Vehicles;
use App\Form\Vehicles1Type;
use App\Repository\VehiclesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/vehicles/crud')]
class VehiclesCrudController extends AbstractController
{
    #[Route('/', name: 'app_vehicles_crud_index', methods: ['GET'])]
    public function index(VehiclesRepository $vehiclesRepository): Response
    {
        return $this->render('vehicles_crud/index.html.twig', [
            'vehicles' => $vehiclesRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_vehicles_crud_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $vehicle = new Vehicles();
        $form = $this->createForm(Vehicles1Type::class, $vehicle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($vehicle);
            $entityManager->flush();

            return $this->redirectToRoute('app_vehicles_crud_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('vehicles_crud/new.html.twig', [
            'vehicle' => $vehicle,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_vehicles_crud_show', methods: ['GET'])]
    public function show(Vehicles $vehicle): Response
    {
        return $this->render('vehicles_crud/show.html.twig', [
            'vehicle' => $vehicle,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_vehicles_crud_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Vehicles $vehicle, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(Vehicles1Type::class, $vehicle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_vehicles_crud_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('vehicles_crud/edit.html.twig', [
            'vehicle' => $vehicle,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_vehicles_crud_delete', methods: ['POST'])]
    public function delete(Request $request, Vehicles $vehicle, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$vehicle->getId(), $request->request->get('_token'))) {
            $entityManager->remove($vehicle);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_vehicles_crud_index', [], Response::HTTP_SEE_OTHER);
    }
}
