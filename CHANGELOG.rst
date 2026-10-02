Changelog
---------

4.0.0
------

1) [BREAKING] Drop support for TYPO3 11 and 12. Add support for TYPO3 14.
2) [TASK] Extend dependency to sourcebroker/t3api 5.0.
3) [TASK] Add rector, php-cs-fixer and phpstan (level 6).
4) [BUGFIX] Translate labels with the LanguageService of the site language. LocalizationUtility::translate() on TYPO3 14
   reads the TypoScript setup, which is not available in the cached frontend scope.
5) [TASK] Add ddev testing envs for TYPO3 13 and 14.

3.2.0
------

1) [TASK] Add support for TYPO3 13

3.1.0
------

1) [TASK] Extend dependency to sourcebroker/t3api 4.0.

3.0.0
------

1) [BREAKING] Drop support for TYPO3 ^9.5, ^10.4. Add support for TYPO3 12.


2.6.0
~~~~~

1) [TASK] Extend compatibility with sourcebroker/translatr ^5.0.

2.5.0
~~~~~

1) [TASK] Extend compatibility for sourcebroker/t3api to ^2.0.


2.4.0
~~~~~

1) [TASK] Add ddev.
2) [TASK] Set compatibility with TYPO3 11 and with sourcebroker/translatr 4.0

2.3.0
~~~~~

1) [TASK] Extend compatibility with sourcebroker/translatr 3.0

2.2.0
~~~~~

1) [TASK] Extend compatibility for sourcebroker/t3api to ^1.0.

2.1.0
~~~~~

1) [TASK] Set compatibility with TYPO3 10 and with sourcebroker/translatr 2.0

2.0.0
~~~~~

1) [TASK][BREAKING] Drop possibility to choose language for labels from GET language parameter. The language for labels is
   set in header of API request (X-Locale).
2) [FEATURE] Add support for fallback using standard TYPO3 fallback mechanism for labels.

1.0.0
~~~~~

1) [TASK] Init version.
