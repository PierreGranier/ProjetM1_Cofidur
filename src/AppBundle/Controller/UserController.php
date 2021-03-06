<?php
namespace AppBundle\Controller;

use AppBundle\Entity\User;
use AppBundle\Form\Type\UserType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class UserController extends Controller
{

    public function showAction($idOp)
    {
        $em = $this->getDoctrine()->getManager();

        $user = $em->getRepository('AppBundle:User')->find($idOp);

        if (!$user) {
            throw $this->createNotFoundException('Pas d\'objet');
        }

        return $this->render('AppBundle:Page/User:user_show.html.twig', array(
            'user'     => $user,
        ));
    }

    public function showAllAction()
    {
        $em = $this->getDoctrine()->getRepository('AppBundle:User');

        $users = $em->findAll();

        return $this->render('AppBundle:Page/User:user_show_all.html.twig', array(
            'users'      => $users,
        ));
    }

    public function deleteAction($idOp)
    {
        $em = $this->getDoctrine()->getManager();

        $user = $em->getRepository('AppBundle:User')->find($idOp);

        if (!$user) {
            throw $this->createNotFoundException('Pas d\'objet');
        }

        $em->remove($user);
        $em->flush();

        return $this->redirectToRoute('AppBundle_user_show_all');
    }

    public function editAction(Request $request, $idOp)
    {
        $em = $this->getDoctrine()->getManager();

        $user = $em->getRepository('AppBundle:User')->find($idOp);

        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user = $form->getData();

            $em->persist($user);
            $em->flush();

            return $this->redirectToRoute('AppBundle_user_show_all');
        }

        return $this->render('AppBundle:Page/User:user_edit.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    public function addAction(Request $request)
    {
        $user = new User();

        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            return $this->redirectToRoute('AppBundle_user_show_all');
        }

        return $this->render('AppBundle:Page/User:user_add.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}
