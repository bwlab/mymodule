<?php

namespace MyModule\Controller;

if (!defined('_PS_VERSION_')) {
    exit;
}

use PrestaShopBundle\Controller\Admin\PrestaShopAdminController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

class ExampleController extends PrestaShopAdminController
{
    public function yourAction(
        Request $request,
        // To use Twig, you have to inject it. You cannot use controller helper method
        #[Autowire(service: 'twig')] Environment $twig,
    ): Response {


        $versionInstalled = $this->getConfiguration()->get('PS_INSTALL_VERSION');

        //------>  ERROR:  this is the prestashop helper method in PrestaShopAdminController
        // The "PrestaShop\PrestaShop\Core\Context\LanguageContext" service or alias
        // has been removed or  inlined when the container was compiled. You should either make it public, or stop using the container directly and use dependency injection instead.
        $languageCode = $this->getLanguageContext()->getLanguageCode();

        return new Response(
            $twig->render(
                '@Modules/mymodule/views/templates/admin/controller/examplecontroller_controller.html.twig',
                [
                    'versionInstalled' => $versionInstalled,
                    'languageCode' => $languageCode,
                ]
            )
        );

        //------>ERROR:
        //  You cannot use the "render" method if the Twig Bundle is not available.
        // return $this->render(
        //   '@Modules/mymodule/views/templates/admin/controller/examplecontroller_controller.html.twig',
        //     [
        //        'versionInstalled' => $versionInstalled,
        //               'languageCode'=>$languageCode,
        //             ]
        //          );
    }

}
