<?php

use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Config\Loader\LoaderInterface;

class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = [
            new Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
            new Symfony\Bundle\SecurityBundle\SecurityBundle(),
            new Symfony\Bundle\TwigBundle\TwigBundle(),
            new Symfony\Bundle\MonologBundle\MonologBundle(),
            new Symfony\Bundle\SwiftmailerBundle\SwiftmailerBundle(),
            new Doctrine\Bundle\DoctrineBundle\DoctrineBundle(),
            new Sensio\Bundle\FrameworkExtraBundle\SensioFrameworkExtraBundle(),
            new AppBundle\AppBundle(),
            new Home\ReclamationBundle\HomeReclamationBundle(),
            new Home\ReservationBundle\HomeReservationBundle(),
            new Home\NotificationBundle\HomeNotificationBundle(),
            new Home\AvisBundle\HomeAvisBundle(),
            new Home\BadgeBundle\HomeBadgeBundle(),
            new Home\NewslettersBundle\HomeNewslettersBundle(),
            new Home\AnnonceBundle\HomeAnnonceBundle(),
            new Home\BoutiqueBundle\HomeBoutiqueBundle(),
            new Home\LivraisonBundle\HomeLivraisonBundle(),
            new Home\FavorisBundle\HomeFavorisBundle(),
            new Home\UserBundle\HomeUserBundle(),
            new FOS\UserBundle\FOSUserBundle(),
            new Home\EntityBundle\HomeEntityBundle(),
            new FOS\JsRoutingBundle\FOSJsRoutingBundle(),
            new Knp\Bundle\PaginatorBundle\KnpPaginatorBundle(),
            new Ob\HighchartsBundle\ObHighchartsBundle(),
            new blackknight467\StarRatingBundle\StarRatingBundle(),
            new Knp\Bundle\SnappyBundle\KnpSnappyBundle(),
            new JMS\Payment\CoreBundle\JMSPaymentCoreBundle(),
            new JMS\Payment\PaypalBundle\JMSPaymentPaypalBundle(),
        ];

        if (in_array($this->getEnvironment(), ['dev', 'test'], true)) {
            $bundles[] = new Symfony\Bundle\DebugBundle\DebugBundle();
            $bundles[] = new Symfony\Bundle\WebProfilerBundle\WebProfilerBundle();
            $bundles[] = new Sensio\Bundle\DistributionBundle\SensioDistributionBundle();
            $bundles[] = new Sensio\Bundle\GeneratorBundle\SensioGeneratorBundle();
        }

        return $bundles;
    }

    public function getRootDir()
    {
        return __DIR__;
    }

    public function getCacheDir()
    {
        return dirname(__DIR__).'/var/cache/'.$this->getEnvironment();
    }

    public function getLogDir()
    {
        return dirname(__DIR__).'/var/logs';
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load($this->getRootDir().'/config/config_'.$this->getEnvironment().'.yml');
    }
}
