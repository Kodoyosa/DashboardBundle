<?php

namespace Kodo\DashboardBundle\Controller;

use Kodo\DashboardBundle\Entity\Itemmenu;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Itemmenu controller.
 *
 */
class ItemmenuController extends Controller
{
    /**
     * Lists all itemmenu entities.
     *
     */
    public function indexAction()
    {

        $em = $this->getDoctrine()->getManager();

        $itemmenus = $em->getRepository('KodoDashboardBundle:Itemmenu')->findAll();


        /*$router = $this->container->get('router');

        foreach($itemmenus as $key => &$itemmenu) {
            if ($router->getRouteCollection()->get($itemmenu->getRoutename()) === null) {
                unset($itemmenus[$key]);
            }
        }*/
        //var_dump($itemmenus);die();
        /*if ($router->getRouteCollection()->get('hmepage') === null) {
            var_dump('non');die();
        }else {
            var_dump('oui');die();
        }*/

        return $this->render('KodoDashboardBundle:itemmenu:index.html.twig', array(
            'itemmenus' => $itemmenus,
        ));
    }

    /**
     * Creates a new itemmenu entity.
     *
     */
    public function newAction(Request $request)
    {
        $sectionmenu = $this->getDoctrine()
            ->getRepository('KodoDashboardBundle:Sectionmenu')
            ->findBy([],['position' => 'ASC']);

        $itemmenu = new Itemmenu($sectionmenu);

        $form = $this->createForm('Kodo\DashboardBundle\Form\ItemmenuType', $itemmenu);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($itemmenu);
            $em->flush();

            return $this->redirectToRoute('itemmenu_show', array('id' => $itemmenu->getId()));
        }

        return $this->render('KodoDashboardBundle:itemmenu:new.html.twig', array(
            'itemmenu' => $itemmenu,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a itemmenu entity.
     *
     */
    public function showAction(Itemmenu $itemmenu)
    {
        $deleteForm = $this->createDeleteForm($itemmenu);

        return $this->render('KodoDashboardBundle:itemmenu:show.html.twig', array(
            'itemmenu' => $itemmenu,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing itemmenu entity.
     *
     */
    public function editAction(Request $request, Itemmenu $itemmenu)
    {
        $sectionmenu = $this->getDoctrine()
            ->getRepository('KodoDashboardBundle:Sectionmenu')
            ->findBy([],['position' => 'ASC']);

        $itemmenu->sectionmenu = $sectionmenu;

        $deleteForm = $this->createDeleteForm($itemmenu);
        $editForm = $this->createForm('Kodo\DashboardBundle\Form\ItemmenuType', $itemmenu);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('itemmenu_edit', array('id' => $itemmenu->getId()));
        }

        return $this->render('KodoDashboardBundle:itemmenu:edit.html.twig', array(
            'itemmenu' => $itemmenu,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a itemmenu entity.
     *
     */
    public function deleteAction(Request $request, Itemmenu $itemmenu)
    {
        $form = $this->createDeleteForm($itemmenu);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($itemmenu);
            $em->flush();
        }

        return $this->redirectToRoute('itemmenu_index');
    }

    /**
     * Creates a form to delete a itemmenu entity.
     *
     * @param Itemmenu $itemmenu The itemmenu entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Itemmenu $itemmenu)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('itemmenu_delete', array('id' => $itemmenu->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
