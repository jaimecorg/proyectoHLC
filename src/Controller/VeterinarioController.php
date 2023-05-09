<?php

namespace App\Controller;

use App\Entity\Veterinario;
use App\Form\DuenioType;
use App\Form\VeterinarioType;
use App\Repository\VeterinarioRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class VeterinarioController extends AbstractController
{
    /**
     * @Route("/veterinario", name="veterinario_listar")
     */
    public function listar(VeterinarioRepository $veterinarioRepository) : Response
    {
        $veterinarios = $veterinarioRepository->findAllOrdenados();
        return $this->render('veterinario/listar.html.twig', [
            'veterinarios' => $veterinarios
        ]);
    }

    /**
     * @Route("/veterinario/nuevo", name="veterinario_nuevo")
     */
    public function nuevo(Request $request, VeterinarioRepository $veterinarioRepository) : Response
    {
        $veterinario = new Veterinario();

        return $this->modificar($request, $veterinarioRepository, $veterinario);
    }

    /**
     * @Route("/veterinario/{id}", name="veterinario_modificar")
     */
    public function modificar(Request $request, VeterinarioRepository $veterinarioRepository, Veterinario $veterinario) : Response
    {
        $form = $this->createForm(VeterinarioType::class, $veterinario);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $veterinarioRepository->add($veterinario);
                $this->addFlash('success', 'Cambios guardados con éxito');
                return $this->redirectToRoute('veterinario_listar');
            } catch (\Exception $e) {
                $this->addFlash('error', 'Error al guardar los cambios');
            }
        }
        return $this->render('veterinario/modificar.html.twig', [
            'veterinario' => $veterinario,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/veterinario/eliminar/{id}", name="veterinario_eliminar")
     */
    public function eliminar(Request $request, VeterinarioRepository $veterinarioRepository, Veterinario $veterinario) : Response
    {
        if ($request->getMethod() === 'POST' && $request->get('confirmar') === 'ok') {
            try {
                $veterinarioRepository->remove($veterinario);
                $this->addFlash('success', 'Veterinario eliminado con éxito');
                return $this->redirectToRoute('veterinario_listar');
            } catch (\Exception $e) {
                $this->addFlash('error', 'Error al eliminar el veterinario');
            }
        }
        return $this->render('veterinario/eliminar.html.twig', [
            'veterinario' => $veterinario
        ]);
    }
}