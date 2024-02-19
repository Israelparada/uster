<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\TripRepository;
use App\Repository\VehiclesRepository;
use App\Repository\DriversRepository;
use App\Entity\Trip;
use Doctrine\ORM\EntityManagerInterface;

class TripController extends AbstractController
{

    private VehiclesRepository $vehiclesRepository;
    private DriversRepository $driversRepository;
    private EntityManagerInterface $em;
    private TripRepository $tripRepository;

    public function __construct(
            TripRepository $tripRepository,
            VehiclesRepository $vehiclesRepository,
            DriversRepository $driversRepository,
            EntityManagerInterface $em) {        
        $this->tripRepository = $tripRepository;
        $this->em = $em;
        $this->driversRepository = $driversRepository;
        $this->vehiclesRepository = $vehiclesRepository;
    }
    
    #[Route('/trip', name: 'app_trip')]
    public function index(TripRepository $tripRepository): Response
    {
        return $this->render('trip/index.html.twig', [
            'trips' => $tripRepository->findAll(),
        ]);         
    }
    
    #[Route('trip_schedule', name: 'app_trip_schedule')]
    public function tripSchedule(Request $request) {
        $trip = new Trip();
        $vehicles = $this->vehiclesRepository->findAll();
        $drivers = $this->driversRepository->findAll();
        $form = $this->createFormBuilder($trip)                      
                        ->add('date', null ,['label' => 'Select a date'])                        
                        ->add('submit', SubmitType::class, [
                            'label' => 'Create trip',
                            'attr'  => ['class' => 'btn btn-success']
                        ])
                        ->getForm();
        
        $form->handleRequest($request);
        
        if($form->isSubmitted()){            
                  $this->em->persist($trip);
                  $this->em->flush(); 
        }
            
        return $this->render('trip/trip_schedule.html.twig',[
            'form' => $form->createView(),
            'vehicles' => $vehicles,
            'drivers' => $drivers,
        ]);
    }
}
