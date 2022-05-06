<?php

namespace App\Controller;

use App\Entity\Country;
use App\Form\CountryType;
use App\Repository\CountryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/pays')]
class CountryController extends AbstractController
{
    #[Route('/', name: 'app_country')]
    public function index(CountryRepository $countryRepository): Response
    {
        return $this->render('country/index.html.twig', [
            'countries' => $countryRepository->findAll(),
        ]);
    }

    #[Route('/nouveau', name: 'app_country_show')]
    public function show(Request $request, EntityManagerInterface $em): Response
    {
        $form = $this->createForm(CountryType::class, new Country());
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var Country $country */
            $country = $form->getData();
            $country->setUrlFlag('https://flagcdn.com/32x24/' . $country->getCode() . '.png');
            $em->persist($form->getData());
            $em->flush();
            return $this->redirectToRoute('app_country');
        }

        return $this->render('country/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/modifier/{slug}', name: 'app_country_edit')]
    public function edit(Country $country, Request $request, EntityManagerInterface $em): Response
    {
        $form = $this->createForm(CountryType::class, $country);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var Country $country */
            $country->setUrlFlag('https://flagcdn.com/32x24/' . $country->getCode() . '.png');
            $em->flush();
            return $this->redirectToRoute('app_country');
        }

        return $this->render('country/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
