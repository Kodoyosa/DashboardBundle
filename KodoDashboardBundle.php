<?php

namespace Kodo\DashboardBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class KodoDashboardBundle extends Bundle
{
    public function appName()
    {
        $appName = $this->getDoctrine()
            ->getRepository('KodoDashboardBundle:General')
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
