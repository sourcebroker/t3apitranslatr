<?php
declare(strict_types=1);

namespace SourceBroker\T3apitranslatr\Filter;

use SourceBroker\T3api\Domain\Model\ApiFilter;
use SourceBroker\T3api\Filter\SearchFilter;
use TYPO3\CMS\Core\Site\Entity\Site;
use TYPO3\CMS\Core\Site\Entity\SiteLanguage;
use TYPO3\CMS\Extbase\Persistence\Exception\InvalidQueryException;
use TYPO3\CMS\Extbase\Persistence\Generic\Exception\UnexpectedTypeException;
use TYPO3\CMS\Extbase\Persistence\Generic\Qom\ConstraintInterface;
use TYPO3\CMS\Extbase\Persistence\QueryInterface;

/**
 * Class SearchTranslationFilter
 * @package SourceBroker\T3apitranslatr\Filter
 */
class SearchTranslationFilter extends SearchFilter
{
    /**
     * @param string $property
     * @param mixed $values
     * @param QueryInterface $query
     * @param ApiFilter $apiFilter
     * @return ConstraintInterface|null
     * @throws InvalidQueryException
     * @throws UnexpectedTypeException
     */
    public function filterProperty(
        $property,
        $values,
        QueryInterface $query,
        ApiFilter $apiFilter
    ): ?ConstraintInterface {
        $defaultLanguageCode = $this->getDefaultLanguageCode();
        $values = array_map(function ($v) use ($defaultLanguageCode) {
            return $v === $defaultLanguageCode ? 'default' : $v;
        }, (array)$values);

        return parent::filterProperty(
            $property,
            $values,
            $query,
            $apiFilter
        );
    }

    /**
     * @return SiteLanguage
     */
    protected function getDefaultLanguageCode(): ?string
    {
        $code = null;
        /** @var Site $site */
        $site = $GLOBALS['TYPO3_REQUEST']->getAttribute('site');
        foreach ($site->getAllLanguages() as $language) {
            if ($language->getTypo3Language() === 'default') {
                $code = $language->getTwoLetterIsoCode();
                break;
            }
        }

        return $code;
    }
}
