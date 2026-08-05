<?php namespace ItsAnggara\Crud;

use System\Classes\PluginBase;

class Plugin extends PluginBase
{
   public function registerPermissions()
{
    return [
        'itsanggara.crud.manage_projects' => [
            'tab'   => 'CRUD',
            'label' => 'Manage Projects',
        ],
        'itsanggara.crud.manage_categories' => [
            'tab'   => 'CRUD',
            'label' => 'Manage Project Categories',
        ],
        'itsanggara.crud.manage_contacts' => [
            'tab'   => 'CRUD',
            'label' => 'Manage Contacts',
        ],
    ];
}

public function registerNavigation()
{
    return [
        'crud' => [
            'label'       => 'Projects',
            'url'         => \Backend\Facades\Backend::url('itsanggara/crud/projects'),
            'icon'        => 'icon-folder',
            'permissions' => ['itsanggara.crud.*'],
            'order'       => 500,

            'sideMenu' => [
                'projects' => [
                    'label'       => 'Projects',
                    'icon'        => 'icon-list',
                    'url'         => \Backend\Facades\Backend::url('itsanggara/crud/projects'),
                    'permissions' => ['itsanggara.crud.manage_projects'],
                ],
                'projectcategories' => [
                    'label'       => 'Categories',
                    'icon'        => 'icon-tags',
                    'url'         => \Backend\Facades\Backend::url('itsanggara/crud/projectcategories'),
                    'permissions' => ['itsanggara.crud.manage_categories'],
                ],
                'contacts' => [
                    'label'       => 'Contacts',
                    'icon'        => 'icon-envelope',
                    'url'         => \Backend\Facades\Backend::url('itsanggara/crud/contact'),
                    'permissions' => ['itsanggara.crud.manage_contacts'],
                ],
            ],
        ],
    ];
}
}
