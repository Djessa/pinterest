<?php

namespace App\Controller;

use App\Entity\Pin;
use App\Repository\PinRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PinsController extends AbstractController
{
    /**
     * @Route("/", name="app_home")
     */
    public function index(PinRepository $pinRepository): Response
    {
        $pins = $pinRepository->findBy([], ['createdAt' => 'DESC']);
        dump($pins);
        return $this->render('pins/index.html.twig', compact('pins'));
    }
    /**
     * @Route("/pins/{id<[0-9]+>}",name="app_pins_show")
     */
    public function show(Pin $pin)
    {
        return $this->render('pins/show.html.twig', compact('pin'));
    }
    /**
     * @Route("/test/{id}")
     *
     */
    public function test(Pin $pin, EntityManagerInterface $em)
    {
        $pin->setDescription('Description 5 (edited)');
        $em->flush();
        return new Response("ok");
    }
}
