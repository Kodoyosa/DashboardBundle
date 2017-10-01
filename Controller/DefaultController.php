<?php

namespace Kodo\DashboardBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('KodoDashboardBundle:Default:index.html.twig');
    }

    public function sidemenuAction($route)
    {
        $router = $this->container->get('router');

        $sections = $this->getDoctrine()
            ->getRepository('KodoDashboardBundle:Sectionmenu')
            ->getSectionmenus();

        foreach($sections as &$section){
            $items = $this->getDoctrine()
                ->getRepository('KodoDashboardBundle:Itemmenu')
                ->getItemsbySectionId($section);


            /*
             * Check if route exists or excludes it from section
             */
            foreach($items as $key => &$itemmenu) {
                if ($router->getRouteCollection()->get($itemmenu->getRoutename()) === null) {
                    unset($items[$key]);
                }
            }

            $section->items = $items;
        }





        /*foreach($sections as $key => &$itemmenu) {
            if ($router->getRouteCollection()->get($itemmenu->getRoutename()) === null) {
                unset($sections[$key]);
            }
        }
        var_dump($sections);die();*/

        return $this->render(
            'KodoDashboardBundle:Default:sidemenu.html.twig',
            [
                'sections' => $sections,
                'route' => $route
            ]);
    }
}
