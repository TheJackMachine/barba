<?php namespace JackMachine\Barba\Twig;

use Twig\Node\Node as TwigNode;
use Twig\Token as TwigToken;
use Twig\TokenParser\AbstractTokenParser as TwigTokenParser;
use Twig\Error\SyntaxError as TwigErrorSyntax;
use JackMachine\Barba\Twig\BarbaNode;

class BarbaTokenParser extends TwigTokenParser
{

    public function parse(TwigToken $token)
    {
        $stream = $this->parser->getStream();
        $stream->next();

        $body = $this->parser->subparse([$this, 'decideBarbaEnd'], true);
        $stream->expect(TwigToken::BLOCK_END_TYPE);

        return new BarbaNode($body, $token->getLine(), $this->getTag());

    }

    public function getTag()
    {
        return 'barba';
    }

    public function decideBarbaEnd(TwigToken $token)
    {
        return $token->test('endbarba');
    }

}
