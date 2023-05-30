<?php

namespace App\Controller;

use App\Entity\Tratamiento;
use App\Form\TratamientoType;
use App\Repository\TratamientoRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TratamientoController extends AbstractController
{
    /**
     * @Route("/tratamiento", name="tratamiento_listar")
     */
    public function listar(TratamientoRepository $repository) : Response
    {
        $tratamientos = $repository->findAllOrdenados();
        return $this->render('tratamiento/listar.html.twig', [
            'tratamientos' => $tratamientos
        ]);
    }

    /**
     * @Route("/tratamiento/nuevo", name="tratamiento_nuevo")
     * @Security("is_granted('ROLE_USUARIO')")
     */
    public function nuevo(Request $request, TratamientoRepository $repository) : Response
    {
        $tratamiento = new Tratamiento();

        return $this->modificar($request, $repository, $tratamiento);
    }

    /**
     * @Route("/tratamiento/{id}", name="tratamiento_modificar")
     * @Security("is_granted('ROLE_MODERADOR')")
     */
    public function modificar(Request $request, TratamientoRepository $repository, Tratamiento $tratamiento) : Response
    {
        $form = $this->createForm(TratamientoType::class, $tratamiento);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $repository->add($tratamiento);
                $this->addFlash('success', 'Cambios guardados con éxito');
                return $this->redirectToRoute('tratamiento_listar');
            } catch (\Exception $e) {
                $this->addFlash('error', 'Error al guardar los cambios');
            }
        }
        return $this->render('tratamiento/modificar.html.twig', [
            'tratamiento' => $tratamiento,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/tratamiento/eliminar/{id}", name="tratamiento_eliminar")
     */
    public function eliminar(Request $request, TratamientoRepository $repository, Tratamiento $tratamiento) : Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        if ($request->getMethod() === 'POST' && $request->get('confirmar') === 'ok') {
            try {
                $repository->remove($tratamiento);
                $this->addFlash('success', 'Tratamiento eliminado con éxito');
                return $this->redirectToRoute('tratamiento_listar');
            } catch (\Exception $e) {
                $this->addFlash('error', 'Error al eliminar el tratamiento');
            }
        }

        return $this->render('tratamiento/eliminar.html.twig', [
            'tratamiento' => $tratamiento
        ]);
    }
}