<?php

namespace App\Controller;

use App\Entity\Duenio;
use App\Form\DuenioType;
use App\Repository\DuenioRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DuenioController extends AbstractController
{
    /**
     * @Route("/", name="duenio_listar")
     */
    public function listar(DuenioRepository $duenioRepository) : Response
    {
        $duenios = $duenioRepository->findAllOrdenados();
        return $this->render('duenio/listar.html.twig', [
            'duenios' => $duenios
        ]);
    }

    /**
     * @Route("/duenio/nuevo", name="duenio_nuevo")
     */
    public function nuevo(Request $request, DuenioRepository $duenioRepository) : Response
    {
        $duenio = new Duenio();

        return $this->modificar($request, $duenioRepository, $duenio);
    }

    /**
     * @Route("/duenio/{id}", name="duenio_modificar")
     */
    public function modificar(Request $request, DuenioRepository $duenioRepository, Duenio $duenio) : Response
    {
        $this->denyAccessUnlessGranted('ROLE_USUARIO');

        $form = $this->createForm(DuenioType::class, $duenio);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $duenioRepository->add($duenio);
                $this->addFlash('success', 'Cambios guardados con éxito');
                return $this->redirectToRoute('duenio_listar');
            } catch (\Exception $e) {
                $this->addFlash('error', 'Error al guardar los cambios');
            }
        }
        return $this->render('duenio/modificar.html.twig', [
            'duenio' => $duenio,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/duenio/eliminar/{id}", name="duenio_eliminar")
     */
    public function eliminar(Request $request, DuenioRepository $duenioRepository, Duenio $duenio) : Response
    {
        if ($request->getMethod() === 'POST' && $request->get('confirmar') === 'ok') {
            try {
                $duenioRepository->remove($duenio);
                $this->addFlash('success', 'Dueño eliminado con éxito');
                return $this->redirectToRoute('duenio_listar');
            } catch (\Exception $e) {
                $this->addFlash('error', 'Error al eliminar el dueño');
            }
        }
        return $this->render('duenio/eliminar.html.twig', [
            'duenio' => $duenio
        ]);
    }
}