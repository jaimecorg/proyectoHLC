<?php

namespace App\Controller;

use App\Repository\DuenioRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class DuenioController extends AbstractController
{
    /**
     * @Route("/", name="duenio_listar")
     */
    public function listar(DuenioRepository $duenioRepository) : Response
    {
        $duenios = $duenioRepository->findAllOrdenadas();
        return $this->render('duenio/listar.html.twig', [
            'duenios' => $duenios
        ]);
    }
}