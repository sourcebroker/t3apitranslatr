<?php

namespace SourceBroker\T3apitranslatr\Domain\Model;

use SourceBroker\T3api\Annotation as T3api;
use SourceBroker\T3api\Filter\ContainFilter;
use SourceBroker\T3apitranslatr\Filter\SearchTranslationFilter;

/**
 * @T3api\ApiResource (
 *     collectionOperations={
 *          "get"={
 *              "path"="/translations",
 *              "normalizationContext"={
 *                  "groups"={"api_translation_label_get_collection"}
 *              },
 *          },
 *     },
 *     attributes={
 *          "pagination_items_per_page"=9999,
 *          "maximum_items_per_page"=9999,
 *     },
 * )
 * @T3api\ApiFilter (ContainFilter::class, properties={"tags"})
 * @T3api\ApiFilter (SearchTranslationFilter::class, properties={"language"})
 */
class Label extends \SourceBroker\Translatr\Domain\Model\Label
{
    /**
     * @var string
     *
     * @T3api\Serializer\Groups({
     *     "api_translation_label_get_collection",
     * })
     */
    protected $ukey;

    /**
     * @var string
     *
     * @T3api\Serializer\Groups({
     *     "api_translation_label_get_collection",
     * })
     */
    protected $text;
}
