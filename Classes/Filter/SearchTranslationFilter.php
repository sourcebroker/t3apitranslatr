<?php
declare(strict_types=1);

namespace SourceBroker\T3apitranslatr\Filter;

use SourceBroker\T3api\Domain\Model\ApiFilter;
use SourceBroker\T3api\Filter\SearchFilter;
use TYPO3\CMS\Extbase\Persistence\Exception\InvalidQueryException;
use TYPO3\CMS\Extbase\Persistence\Generic\Exception\UnexpectedTypeException;
use TYPO3\CMS\Extbase\Persistence\Generic\Qom\ConstraintInterface;
use TYPO3\CMS\Extbase\Persistence\QueryInterface;

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
        string $property,
        $values,
        QueryInterface $query,
        ApiFilter $apiFilter
    ): ?ConstraintInterface {
        // get all labels for default language as they will be localized by LocalizationUtility::translate() in Label model
        return parent::filterProperty(
            $property,
            'default',
            $query,
            $apiFilter
        );
    }
}
