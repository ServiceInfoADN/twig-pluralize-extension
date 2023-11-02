<?php

namespace Adn\Twig;

use Exception;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class Pluralize extends AbstractExtension
{
    /**
     * @return TwigFunction[]
     */
    public function getFunctions(): array
    {
        return [
            new TwigFunction(
                'pluralize',
                [$this, 'getPluralizedString']
            )
        ];
    }

    /**
     * Get a plural variation of a string
     *
     * @param  int     $count The count that forms the basis of the
     *                               pluralizer. Passed into sprintf
     * @param  string       $one   The string to display when the count
     *                               is 1. Use sprintf syntax, if desired
     * @param  string       $many  The string to display when the count
     *                               is not 1 or 0. Use sprintf syntax,
     *                               if desired
     * @param  string|null  $none  The string to display when the count
     *                               is 0. Use sprintf syntax, if desired
     * @return string
     * @throws Exception
     */
    public function getPluralizedString(int $count, string $one, string $many, ?string $none = null): string
    {
        // Make sure $count is a numeric value
        if (!is_numeric($count)) {
            throw new Exception('$count must be numeric.');
        }

        // If the option for $none is null, use the option for $many
        $none = $none ?? $many;

        // Choose the correct string
        switch($count) {
            case 0:
                $string = $none;
                break;
            case 1:
                $string = $one;
                break;
            default:
                $string = $many;
                break;
        }

        // Return the result
        return sprintf($string, $count);
    }
}
