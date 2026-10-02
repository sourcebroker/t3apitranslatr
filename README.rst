TYPO3 Extension ``t3apitranslatr``
##################################

  .. image:: https://poser.pugx.org/sourcebroker/t3apitranslatr/v/stable
    :target: https://packagist.org/packages/sourcebroker/t3apitranslatr

  .. image:: https://poser.pugx.org/sourcebroker/t3apitranslatr/license
    :target: https://packagist.org/packages/sourcebroker/t3apitranslatr

.. contents:: :local:


What does it do?
****************

This extension allows to get language labels from ext:translatr as JSON.

Installation
************

Use composer:

::

  composer require sourcebroker/t3apitranslatr

After installing the labels are accessible by following endpoint:
``/_api/translations``

To narrow the number of labels fetch you can use tags on ext:translator and get only those tags that are needed on page.

``/_api/translations?tags[]=general&tags[]=user``

Development
***********

The ddev environment installs TYPO3 13 and 14 with the extension, a site with en / pl / de languages and the test
labels of ``.ddev/test-content/test_labels`` (tags ``general`` and ``user``).

::

  ddev start
  ddev install-all        # or ddev install-v13 / ddev install-v14
  ddev test-api 14        # calls /_api/translations in all languages with and without tags
  ddev ci                 # php-cs-fixer, rector, phpstan
  ddev fix                # applies the fixes of rector and php-cs-fixer

URLs: https://t3apitranslatr.ddev.site/, https://v13.t3apitranslatr.ddev.site/typo3/,
https://v14.t3apitranslatr.ddev.site/typo3/ (admin / Joh316!!)

Changelog
*********

See https://github.com/sourcebroker/t3apitranslatr/blob/master/CHANGELOG.rst
