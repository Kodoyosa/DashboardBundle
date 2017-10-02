<?php

namespace Kodoyosa\DashboardBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class KodoyosaDashboardBundle extends Bundle
{
    public function appName()
    {
        $appName = $this->getDoctrine()
            ->getRepository('KodoyosaDashboardBundle:General')
            ->findOneBy(['active' => true]);

        if($appName != null)
        {
            $result = $appName->getTitle();
        }else{
            $result = 'NoName';
        }

        return $result;
    }
}
