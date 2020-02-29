<?php namespace JackMachine\Barba\Components;

use Config;
use Cms\Classes\CodeBase;
use Cms\Classes\ComponentBase;
use JackMachine\Barba\Models\Settings;
use Log;
use Lang;

class Barba extends ComponentBase
{

    public static $instance;
    public $barbaNamespace;

    public function __construct(CodeBase $cmsObject = null, array $properties = [])
    {
        parent::__construct($cmsObject, $properties);
        self::$instance = $this;
    }

    public static function instance()
    {
        return self::$instance;
    }

    public function componentDetails()
    {
        return [
            'name' => Lang::get('jackmachine.barba::misc.name'),
            'description' => Lang::get('jackmachine.barba::misc.description')
        ];
    }

    public function defineProperties()
    {
        return [
            'namespace' => [
                'title' => Lang::get('jackmachine.barba::properties.namespace.title'),
                'description' => Lang::get('jackmachine.barba::properties.namespace.description'),
                'type' => 'string',
                'validationPattern' => '^[a-zA-Z0-9-]+$',
                'validationMessage' => Lang::get('jackmachine.barba::properties.namespace.validationMessage')
            ]
        ];
    }

    public function onRun()
    {
        $this->hydrateProperties();
        // Load Barba from CDN
        if (Settings::get('load_cdn', false)) {
            $this->addJs('https://unpkg.com/@barba/core');
        }
        // Load Barba minimale transition
        if (Settings::get('load_minimal_transition', false)) {
            $this->addJs('/plugins/jackmachine/barba/components/assets/js/transition.js');
            $this->addcss('/plugins/jackmachine/barba/components/assets/css/barba.css');
        }
    }

    /**
     * Properties logic to hydrate instance
     */
    public function hydrateProperties()
    {
        // 1 - try to get the property namespace
        $namespace = $this->property('namespace');
        // 2 - if not exist try to get the namspace from the page
        $namespace = $namespace ?? $this->page->{'barba.namespace'};
        // 3 - if not exist load the default namespace form settings
        $namespace = $namespace ?? $namespace = Settings::get('default_namespace');
        // 4 - if not exist load the default from config
        $namespace = $namespace ?? $namespace = Config::get('jackmachine.barba::defaultNamespace', 'stdView');
        // at this time the namespace MUST exist and in worst case is 'stdView'
        $this->barbaNamespace = $namespace;
    }

    /**
     * Build and return the tag with the namespace
     * @return string
     */
    public function getNamespaceTag($forcedNamespace = false): string
    {
        // namespace can be forced
        if ($forcedNamespace != false) {
            return sprintf('data-barba-namespace="%s"', $forcedNamespace);
        } else {
            return sprintf('data-barba-namespace="%s"', $this->barbaNamespace);
        }
    }

    public function getContainerTag(): string
    {
        return 'data-barba="container"';
    }

    public function getWrapperTag(): string
    {
        return 'data-barba="wrapper"';
    }


    /*
     * Return the HTML section
     */
    public function getStartWrapper()
    {
        return $this->renderPartial('@startWrapper');
    }

    public function getEndWrapper()
    {
        return $this->renderPartial('@endWrapper');
    }

    public function getStartContainer()
    {
        return $this->renderPartial('@startContainer');
    }

    public function getEndContainer()
    {
        return $this->renderPartial('@endContainer');
    }

}
