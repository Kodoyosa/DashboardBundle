<?php

namespace Kodoyosa\DashboardBundle\Twig;

use Doctrine\ORM\EntityManager;

class AppnameExtension extends \Twig_Extension implements \Twig_Extension_GlobalsInterface
{

    protected $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function getGlobals()
    {
        $appName = $this->em
            ->getRepository('KodoyosaDashboardBundle:General')
            ->findOneBy(['active' => true]);

        if($appName != null)
        {
            $result = $appName->getTitle();
        }else{
            $result = 'NoName';
        }

        return ['appName' => $result];
    }

}