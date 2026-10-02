<?php

declare(strict_types=1);

namespace SourceBroker\T3apitranslatr\Domain\Model;

use Psr\Http\Message\ServerRequestInterface;
use SourceBroker\T3api\Annotation as T3api;
use SourceBroker\T3api\Filter\ContainFilter;
use SourceBroker\T3apitranslatr\Filter\SearchTranslationFilter;
use TYPO3\CMS\Core\Localization\LanguageServiceFactory;
use TYPO3\CMS\Core\Site\Entity\SiteLanguage;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * @T3api\ApiResource(
 *     collectionOperations={
 *         "get": {
 *             "path": "/translations",
 *             "normalizationContext": {
 *                 "groups": {"api_translation_label_get_collection"}
 *             },
 *         },
 *     },
 *     attributes={
 *         "pagination_items_per_page": 9999,
 *         "maximum_items_per_page": 9999,
 *     },
 * )
 * @T3api\ApiFilter(ContainFilter::class, properties={"tags"})
 * @T3api\ApiFilter(SearchTranslationFilter::class, properties={"language"})
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

    /**
     * The label is translated with the LanguageService directly, as LocalizationUtility::translate() on TYPO3 14
     * reads the "_LOCAL_LANG" TypoScript of the extension, which is not available in the cached frontend scope
     */
    public function getText(): string
    {
        $request = $GLOBALS['TYPO3_REQUEST'] ?? null;
        $siteLanguage = $request instanceof ServerRequestInterface ? $request->getAttribute('language') : null;
        $languageServiceFactory = GeneralUtility::makeInstance(LanguageServiceFactory::class);
        $languageService = $siteLanguage instanceof SiteLanguage
            ? $languageServiceFactory->createFromSiteLanguage($siteLanguage)
            : $languageServiceFactory->create('default');

        return $languageService->sL('LLL:' . $this->llFile . ':' . $this->ukey);
    }
}
