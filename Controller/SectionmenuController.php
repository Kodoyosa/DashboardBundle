<?php

namespace Kodo\DashboardBundle\Controller;

use Kodo\DashboardBundle\Entity\Sectionmenu;
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

        $sectionmenus = $em->getRepository('KodoDashboardBundle:Sectionmenu')->findAll();

        return $this->render('KodoDashboardBundle:sectionmenu:index.html.twig', array(
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
        $form = $this->createForm('Kodo\DashboardBundle\Form\SectionmenuType', $sectionmenu);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($sectionmenu);
            $em->flush();

            return $this->redirectToRoute('sectionmenu_show', array('id' => $sectionmenu->getId()));
        }

        return $this->render('KodoDashboardBundle:sectionmenu:new.html.twig', array(
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

        return $this->render('KodoDashboardBundle:sectionmenu:show.html.twig', array(
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
        $editForm = $this->createForm('Kodo\DashboardBundle\Form\SectionmenuType', $sectionmenu);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('sectionmenu_edit', array('id' => $sectionmenu->getId()));
        }

        return $this->render('KodoDashboardBundle:sectionmenu:edit.html.twig', array(
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
