<?php

namespace App\Controller;

use App\Entity\Empleado;
use App\Form\EmpleadoType;
use App\Repository\EmpleadoRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class EmpleadoController extends AbstractController
{
    /**
     * @Route("/empleado", name="empleado_listar")
     */
    public function listar(EmpleadoRepository $repository) : Response
    {
        $empleados = $repository->findAllOrdenados();
        return $this->render('empleado/listar.html.twig', [
            'empleados' => $empleados
        ]);
    }

    /**
     * @Route("/empleado/nuevo", name="empleado_nuevo")
     * @Security("is_granted('ROLE_USUARIO')")
     */
    public function nuevo(Request $request, EmpleadoRepository $repository) : Response
    {
        $empleado = new Empleado();

        return $this->modificar($request, $repository, $empleado);
    }

    /**
     * @Route("/empleado/{id}", name="empleado_modificar")
     * @Security("is_granted('ROLE_MODERADOR')")
     */
    public function modificar(Request $request, EmpleadoRepository $repository, Empleado $empleado) : Response
    {
        $form = $this->createForm(EmpleadoType::class, $empleado);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $repository->add($empleado);
                $this->addFlash('success', 'Cambios guardados con éxito');
                return $this->redirectToRoute('empleado_listar');
            } catch (\Exception $e) {
                $this->addFlash('error', 'Error al guardar los cambios');
            }
        }

        return $this->render('empleado/modificar.html.twig', [
            'empleado' => $empleado,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/empleado/eliminar/{id}", name="empleado_eliminar")
     */
    public function eliminar(Request $request, EmpleadoRepository $repository, Empleado $empleado) : Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        if ($request->getMethod() === 'POST' && $request->get('confirmar') === 'ok') {
            try {
                $repository->remove($empleado);
                $this->addFlash('success', 'Empleado eliminado con éxito');
                return $this->redirectToRoute('empleado_listar');
            } catch (\Exception $e) {
                $this->addFlash('error', 'Error al eliminar el empleado');
            }
        }

        return $this->render('empleado/eliminar.html.twig', [
            'empleado' => $empleado
        ]);
    }

    /**
     * @Route("/clave", name=“usuario_clave")
     */
    /*
    public function indexAction(Request $request, UserPasswordEncoderInterface $passwordEncoder) {

    }
    */
}