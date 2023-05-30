<?php

namespace App\Controller;

use App\Entity\Cita;
use App\Entity\Mascota;
use App\Form\CitaType;
use App\Form\MascotaType;
use App\Repository\CitaRepository;
use App\Repository\MascotaRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CitaController extends AbstractController
{
    /**
     * @Route("/cita", name="cita_listar")
     */
    public function listar(CitaRepository $repository) : Response
    {
        $citas = $repository->findAllOrdenadas();
        return $this->render('cita/listar.html.twig', [
            'citas' => $citas
        ]);
    }

    /**
     * @Route("/cita/nueva", name="cita_nueva")
     * @Security("is_granted('ROLE_USUARIO')")
     */
    public function nueva(Request $request, CitaRepository $repository) : Response
    {
        $cita = new Cita();

        return $this->modificar($request, $repository, $cita);
    }

    /**
     * @Route("/cita/{id}", name="cita_modificar")
     * @Security("is_granted('ROLE_MODERADOR')")
     */
    public function modificar(Request $request, CitaRepository $repository, Cita $cita) : Response
    {
        $form = $this->createForm(CitaType::class, $cita);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $repository->add($cita);
                $this->addFlash('success', 'Cambios guardados con éxito');
                return $this->redirectToRoute('cita_listar');
            } catch (\Exception $e) {
                $this->addFlash('error', 'Error al guardar los cambios');
            }
        }
        return $this->render('cita/modificar.html.twig', [
            'cita' => $cita,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/cita/eliminar/{id}", name="cita_eliminar")
     */
    public function eliminar(Request $request, CitaRepository $repository, Cita $cita) : Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        if ($request->getMethod() === 'POST' && $request->get('confirmar') === 'ok') {
            try {
                $repository->remove($cita);
                $this->addFlash('success', 'Cita eliminada con éxito');
                return $this->redirectToRoute('cita_listar');
            } catch (\Exception $e) {
                $this->addFlash('error', 'Error al eliminar la cita');
            }
        }

        return $this->render('cita/eliminar.html.twig', [
            'cita' => $cita
        ]);
    }
}