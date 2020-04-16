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

Changelog
*********

See https://github.com/sourcebroker/t3apitranslatr/blob/master/CHANGELOG.rst
