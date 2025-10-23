<?php

if (!defined('_PS_VERSION_')) {
    exit;
}
require_once _PS_MODULE_DIR_.'mymodule'.DIRECTORY_SEPARATOR.'vendor'.DIRECTORY_SEPARATOR.'autoload.php';

class Mymodule extends Module
{
    protected $config_form = false;

    public function __construct()
    {
        $this->name = 'mymodule';
        $this->version = '1.0.0';

        $this->author = 'bwlab'; //TODO edit
        $this->need_instance = 0;


        parent::__construct();

        $this->displayName = $this->trans('Test Admin Controller Module', [], 'Modules.Mymodule.Admin');
        $this->description = $this->trans('Test how to create an admin controller', [], 'Modules.Mymodule.Admin');
        $this->confirmUninstall = $this->trans('Are you sure?', [], 'Modules.Mymodule.Admin');

        $this->ps_versions_compliancy = array('min' => '9.0.0', 'max' => '9.0.1');
    }

    public function getContent()
    {
        Tools::redirectAdmin(
            $this->context->link->getAdminLink(
                'AdminMymodule',
                true,
                ['route' => 'admin_mymodule_configuration']
            )
        );

    }

    public function install()
    {

        return parent::install();
    }

    public function isUsingNewTranslationSystem()
    {
        return true;
    }

    public function uninstall()
    {

        return parent::uninstall();
    }
}
