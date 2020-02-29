<?php namespace JackMachine\Barba\Twig;

use Twig\Node\Node as TwigNode;
use Twig\Compiler as TwigCompiler;

/**
 * Represents a placeholder node
 *
 * @package october\cms
 * @author Alexey Bobkov, Samuel Georges
 */
class BarbaNode extends TwigNode
{
    public function __construct($body, $lineno, $tag = 'barba')
    {

        $nodes['body'] = $body;
        $attributes['name'] = 'barba';

        parent::__construct($nodes, $attributes, $lineno, $tag);
    }

    /**
     * Compiles the node to PHP.
     *
     * @param TwigCompiler $compiler A TwigCompiler instance
     */
    public function compile(TwigCompiler $compiler)
    {
        $compiler->write('echo JackMachine\Barba\Components\Barba::instance()->getStartWrapper();');
        $compiler->write('echo JackMachine\Barba\Components\Barba::instance()->getStartContainer();');

        $compiler
            ->addDebugInfo($this)
            ->subcompile($this->getNode('body'));

        $compiler->write('echo JackMachine\Barba\Components\Barba::instance()->getEndContainer();');
        $compiler->write('echo JackMachine\Barba\Components\Barba::instance()->getEndWrapper();');
    }

}
