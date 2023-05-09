<?php

namespace App\Controller;

use App\Entity\Duenio;
use App\Form\DuenioType;
use App\Repository\DuenioRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EmpleadoController extends AbstractController
{
    /**
     * @Route("/empleado", name="empleado_listar")
     */
    public function listar(DuenioRepository $duenioRepository) : Response
    {
        $duenios = $duenioRepository->findAllOrdenados();
        return $this->render('empleado/listar.html.twig', [
            'empleados' => $duenios
        ]);
    }

    /**
     * @Route("/empleado/nuevo", name="empleado_nuevo")
     */
    public function nuevo(Request $request, DuenioRepository $duenioRepository) : Response
    {
        $duenio = new Duenio();

        return $this->modificar($request, $duenioRepository, $duenio);
    }

    /**
     * @Route("/empleado/{id}", name="empleado_modificar")
     */
    public function modificar(Request $request, DuenioRepository $duenioRepository, Duenio $duenio) : Response
    {
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
        return $this->render('empleado/modificar.html.twig', [
            'empleado' => $duenio,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/empleado/eliminar/{id}", name="empleado_eliminar")
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