<?php

namespace BiblioBundle\Controller;


use BiblioBundle\Entity\Etudiant;
use BiblioBundle\Form\EtudiantForm;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;


class EtudiantController extends Controller
{

    public function indexAction()
    {
        return new Response( "Bonjour");
        ;
    }
    public function AffichageAction($id)
    {
        return new Response( "Bonjour".$id.".");
        ;
    }

    public function voirAction($name)
    {
        return $this->render('@Biblio/Etudiant/index.html.twig',array('name'=>$name));
    }

    public function listAction()
    {
        $em = $this->container->get('doctrine') ->getEntityManager();
        $etudiants = $em->getRepository('BiblioBundle:Etudiant')->findAll();
        return $this->render('@Biblio/Etudiant/list.html.twig',array(
            'etudiants'=>$etudiants
        ));
    }

    public function addAction(Request $request)
    {
        $Etudiant = new Etudiant();
        $form = $this->createForm(EtudiantForm::class,$Etudiant);
       $form->handleRequest($request);
       if($form->isSubmitted() && $form->isValid())
       {
           $em= $this->getDoctrine()->getManager();
           $em->persist($Etudiant);
           $em->flush();
           return $this->redirect($this->generateUrl("list_etudiant"));

       }
        return $this->render('@Biblio/Etudiant/add.html.twig',
            array(
                'Form'=>$form->createView()
            ));

    }

    public function deleteAction(Request $request, $id)
    {
        $em= $this->getDoctrine()->getManager();
        $etudiant = $em->getRepository('BiblioBundle:Etudiant')->find($id);
        if($etudiant !== null)
        {
            $em->remove($etudiant);
            $em->flush();
        }
        else
        {
            throw new NotFoundHttpException("L'étudient d'id".$id."n'existe pas");
        }
        return $this->redirectToRoute("list_etudiant");
    }

    public function updateAction(Request $request,$id)
    {
        $em= $this->getDoctrine()->getManager();
        $Etudiant=$em->getRepository('BiblioBundle:Etudiant')->find($id);

        $editform = $this->createForm(EtudiantForm::class ,$Etudiant);
        $editform ->handleRequest($request);

        if($editform->isSubmitted() && $editform->isValid())
        {
            $em->persist($Etudiant);
            $em->flush();
            return $this->redirect($this->generateUrl("list_etudiant"));
        }
        return $this->render('@Biblio/Etudiant/update.html.twig',
            array(
                'editForm'=>$editform->createView()
            ));
    }
}