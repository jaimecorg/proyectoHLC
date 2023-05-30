<?php

namespace App\Controller;

use App\Entity\Mascota;
use App\Form\MascotaType;
use App\Repository\MascotaRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MascotaController extends AbstractController
{
    /**
     * @Route("/mascota", name="mascota_listar")
     */
    public function listar(MascotaRepository $mascotaRepository) : Response
    {
        $mascotas = $mascotaRepository->findAllOrdenadas();
        return $this->render('mascota/listar.html.twig', [
            'mascotas' => $mascotas
        ]);
    }

    /**
     * @Route("/mascota/nueva", name="mascota_nueva")
     * @Security("is_granted('ROLE_USUARIO')")
     */
    public function nueva(Request $request, MascotaRepository $mascotaRepository) : Response
    {
        $mascota = new Mascota();

        return $this->modificar($request, $mascotaRepository, $mascota);
    }

    /**
     * @Route("/mascota/{id}", name="mascota_modificar")
     * @Security("is_granted('ROLE_MODERADOR')")
     */
    public function modificar(Request $request, MascotaRepository $mascotaRepository, Mascota $mascota) : Response
    {
        $form = $this->createForm(MascotaType::class, $mascota);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $mascotaRepository->add($mascota);
                $this->addFlash('success', 'Cambios guardados con éxito');
                return $this->redirectToRoute('mascota_listar');
            } catch (\Exception $e) {
                $this->addFlash('error', 'Error al guardar los cambios');
            }
        }
        return $this->render('mascota/modificar.html.twig', [
            'mascota' => $mascota,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/mascota/eliminar/{id}", name="mascota_eliminar")
     */
    public function eliminar(Request $request, MascotaRepository $mascotaRepository, Mascota $mascota) : Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        if ($request->getMethod() === 'POST' && $request->get('confirmar') === 'ok') {
            try {
                $mascotaRepository->remove($mascota);
                $this->addFlash('success', 'Mascota eliminada con éxito');
                return $this->redirectToRoute('mascota_listar');
            } catch (\Exception $e) {
                $this->addFlash('error', 'Error al eliminar la mascota');
            }
        }
        return $this->render('mascota/eliminar.html.twig', [
            'mascota' => $mascota
        ]);
    }
}