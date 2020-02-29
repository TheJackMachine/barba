<?php namespace JackMachine\Barba;

use Lang;
use Config;
use System\Classes\PluginBase;

/**
 * Barba Plugin
 *
 * A Simple plugin to bootstrap and manage barba namespaces
 * First piece of the incredible JackMachine system
 *
 * Musical support :
 * Boris Brejcha - Miss Monique
 *
 * I do that
 * Because I love that
 * And I love you
 * Hope this help
 *
 * Actif, déraisonnable, et inspirant pour un monde meilleur.
 *
 */
class Plugin extends PluginBase
{
    /**
     * Returns information about this plugin.
     *
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name'        => 'jackmachine.barba::misc.name',
            'description' => 'jackmachine.barba::misc.description',
            'author'      => 'Jean-Jacques Dejter',
            'icon'        => 'icon-spinner'
        ];
    }

    /**
     * Registers any front-end components implemented in this plugin.
     *
     * @return array
     */
    public function registerComponents()
    {
        return [
            'JackMachine\Barba\Components\Barba' => 'barba',
        ];
    }

    /**
     * Registers any back-end permissions used by this plugin.
     *
     * @return array
     */
    public function registerPermissions()
    {
        return [
            'jackmachine.barba.access_settings' => [
                'tab' => 'jackmachine.barba::settings.namespace.category',
                'label' => 'jackmachine.barba::settings.strings.permission.label'
            ],
        ];
    }

    /**
     * Registers all the settings.
     *
     * @return array
     */
    public function registerSettings()
    {
        return [
            'namespace' => [
                'label' => 'jackmachine.barba::settings.namespace.label',
                'description' => 'jackmachine.barba::settings.namespace.description',
                'category' => 'jackmachine.barba::settings.namespace.category',
                'icon' => 'icon-spinner',
                'order' => Config::get('jackmachine.barba::settingsOrder', 500),
                'keywords' => 'jackmachine.barba::settings.namespace.keywords',
                'class' => 'JackMachine\Barba\Models\Settings',
                'permissions' => ['jackmachine.barba.access_settings']
            ]
        ];
    }


    /**
     * Registers TWIG tags, filter, and token.
     *
     * @return array
     */
    public function registerMarkupTags()
    {
        return [
            'tokens' => [
                'barba' => new Twig\BarbaTokenParser(),
            ]
        ];
    }

}
