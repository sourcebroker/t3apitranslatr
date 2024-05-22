<?php

namespace SourceBroker\T3apitranslatr\Domain\Model;

use SourceBroker\T3api\Annotation as T3api;
use SourceBroker\T3api\Filter\ContainFilter;
use SourceBroker\T3apitranslatr\Filter\SearchTranslationFilter;
use TYPO3\CMS\Extbase\Utility\LocalizationUtility;

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
     * @T3api\Serializer\Groups({
     *     "api_translation_label_get_collection",
     * })
     */
    protected string $ukey;

    /**
     * @T3api\Serializer\Groups({
     *     "api_translation_label_get_collection",
     * })
     */
    protected string $text;

    public function getText(): string
    {
        return LocalizationUtility::translate('LLL:' . $this->llFile . ':' . $this->ukey);
    }
}
