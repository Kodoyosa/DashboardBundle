<?php

namespace Kodo\DashboardBundle\Controller;

use Kodo\DashboardBundle\Entity\General;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * General controller.
 *
 */
class GeneralController extends Controller
{
    /**
     * Lists all general entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $generals = $em->getRepository('KodoDashboardBundle:General')->findAll();

        return $this->render('KodoDashboardBundle:general:index.html.twig', array(
            'generals' => $generals,
        ));
    }

    /**
     * Creates a new general entity.
     *
     */
    public function newAction(Request $request)
    {
        $general = new General();
        $form = $this->createForm('Kodo\DashboardBundle\Form\GeneralType', $general);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($general);
            $em->flush();

            return $this->redirectToRoute('general_show', array('id' => $general->getId()));
        }

        return $this->render('KodoDashboardBundle:general:new.html.twig', array(
            'general' => $general,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a general entity.
     *
     */
    public function showAction(General $general)
    {
        $deleteForm = $this->createDeleteForm($general);

        return $this->render('KodoDashboardBundle:general:show.html.twig', array(
            'general' => $general,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing general entity.
     *
     */
    public function editAction(Request $request, General $general)
    {
        $deleteForm = $this->createDeleteForm($general);
        $editForm = $this->createForm('Kodo\DashboardBundle\Form\GeneralType', $general);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('general_edit', array('id' => $general->getId()));
        }

        return $this->render('KodoDashboardBundle:general:edit.html.twig', array(
            'general' => $general,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a general entity.
     *
     */
    public function deleteAction(Request $request, General $general)
    {
        $form = $this->createDeleteForm($general);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($general);
            $em->flush();
        }

        return $this->redirectToRoute('general_index');
    }

    /**
     * Creates a form to delete a general entity.
     *
     * @param General $general The general entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(General $general)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('general_delete', array('id' => $general->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
