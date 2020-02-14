<?php

namespace SourceBroker\T3apitranslatr\Domain\Model;

use SourceBroker\T3api\Annotation as T3api;
use SourceBroker\T3api\Filter\ContainFilter;
use SourceBroker\T3apitranslatr\Filter\SearchTranslationFilter;

/**
 * Label
 * @T3api\ApiResource (
 *     collectionOperations={
 *          "get"={
 *              "path"="/translations",
 *          }
 *     },
 * )
 * @T3api\ApiFilter (ContainFilter::class, properties={"tags"})
 * @T3api\ApiFilter (SearchTranslationFilter::class, properties={"language"})
 */
class Label extends \SourceBroker\Translatr\Domain\Model\Label
{
}
