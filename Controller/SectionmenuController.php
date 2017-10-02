<?php

namespace Kodoyosa\DashboardBundle\Controller;

use Kodoyosa\DashboardBundle\Entity\Sectionmenu;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Sectionmenu controller.
 *
 */
class SectionmenuController extends Controller
{
    /**
     * Lists all sectionmenu entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $sectionmenus = $em->getRepository('KodoyosaDashboardBundle:Sectionmenu')->findAll();

        return $this->render('KodoyosaDashboardBundle:sectionmenu:index.html.twig', array(
            'sectionmenus' => $sectionmenus,
        ));
    }

    /**
     * Creates a new sectionmenu entity.
     *
     */
    public function newAction(Request $request)
    {
        $sectionmenu = new Sectionmenu();
        $form = $this->createForm('Kodoyosa\DashboardBundle\Form\SectionmenuType', $sectionmenu);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($sectionmenu);
            $em->flush();

            return $this->redirectToRoute('sectionmenu_show', array('id' => $sectionmenu->getId()));
        }

        return $this->render('KodoyosaDashboardBundle:sectionmenu:new.html.twig', array(
            'sectionmenu' => $sectionmenu,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a sectionmenu entity.
     *
     */
    public function showAction(Sectionmenu $sectionmenu)
    {
        $deleteForm = $this->createDeleteForm($sectionmenu);

        return $this->render('KodoyosaDashboardBundle:sectionmenu:show.html.twig', array(
            'sectionmenu' => $sectionmenu,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing sectionmenu entity.
     *
     */
    public function editAction(Request $request, Sectionmenu $sectionmenu)
    {
        $deleteForm = $this->createDeleteForm($sectionmenu);
        $editForm = $this->createForm('Kodoyosa\DashboardBundle\Form\SectionmenuType', $sectionmenu);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('sectionmenu_edit', array('id' => $sectionmenu->getId()));
        }

        return $this->render('KodoyosaDashboardBundle:sectionmenu:edit.html.twig', array(
            'sectionmenu' => $sectionmenu,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a sectionmenu entity.
     *
     */
    public function deleteAction(Request $request, Sectionmenu $sectionmenu)
    {
        $form = $this->createDeleteForm($sectionmenu);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($sectionmenu);
            $em->flush();
        }

        return $this->redirectToRoute('sectionmenu_index');
    }

    /**
     * Creates a form to delete a sectionmenu entity.
     *
     * @param Sectionmenu $sectionmenu The sectionmenu entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Sectionmenu $sectionmenu)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('sectionmenu_delete', array('id' => $sectionmenu->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
