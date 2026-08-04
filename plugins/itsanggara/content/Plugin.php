<?php namespace ItsAnggara\Content;

use System\Classes\PluginBase;

class Plugin extends PluginBase
{
    public function registerPermissions()
    {
        return [
            'itsanggara.content.manage_news' => [
                'tab'   => 'Content',
                'label' => 'Manage News',
            ],
            'itsanggara.content.manage_categories' => [
                'tab'   => 'Content',
                'label' => 'Manage News Categories',
            ],
        ];
    }

    public function registerNavigation()
    {
        return [
            'content' => [
                'label'       => 'Content',
                'url'         => \Backend\Facades\Backend::url('itsanggara/content/news'),
                'icon'        => 'icon-file-text-o',
                'permissions' => ['itsanggara.content.*'],
                'order'       => 510,

                'sideMenu' => [
                    'news' => [
                        'label'       => 'News',
                        'icon'        => 'icon-newspaper-o',
                        'url'         => \Backend\Facades\Backend::url('itsanggara/content/news'),
                        'permissions' => ['itsanggara.content.manage_news'],
                    ],
                    'categories' => [
                        'label'       => 'Categories',
                        'icon'        => 'icon-tags',
                        'url'         => \Backend\Facades\Backend::url('itsanggara/content/category'),
                        'permissions' => ['itsanggara.content.manage_categories'],
                    ],
                ],
            ],
            'contactsubmissions' => [
                'label'       => 'Pesan Kontak',
                'url'         => \Backend\Facades\Backend::url('itsanggara/content/contactsubmissions'),
                'icon'        => 'icon-envelope-o',
                'permissions' => ['itsanggara.content.manage_news'],
                'order'       => 530,
            ],
        ];
    }

    public function registerComponents()
    {
    }

    public function registerSettings()
    {
    }
}
