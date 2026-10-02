#!/bin/bash
# Shared installer used by install-v13 / install-v14.
# Usage: install-version.sh <major>   e.g. install-version.sh 14

set -e

MAJOR=$1
VERSION=v${MAJOR}
DIR=/var/www/html/$VERSION
SITE_URL="https://${VERSION}.${DDEV_SITENAME}.ddev.site/"
TEST_CONTENT=/mnt/ddev_config/test-content
export COMPOSER_ROOT_VERSION=1.0.0

rm -rf "${DIR:?}"/* "$DIR"/.[!.]* 2>/dev/null || true
mkdir -p "$DIR"
echo "{}" > "$DIR/composer.json"
composer config name sourcebroker/t3apitranslatr-$VERSION -d "$DIR"
composer config minimum-stability dev -d "$DIR"
composer config prefer-stable true -d "$DIR"
composer config extra.typo3/cms.web-dir public -d "$DIR"
composer config repositories.$EXTENSION_KEY path ../../$EXTENSION_KEY -d "$DIR"
composer config repositories.test-labels path $TEST_CONTENT/test_labels -d "$DIR"
composer config --no-plugins allow-plugins.typo3/cms-composer-installers true -d "$DIR"
composer config --no-plugins allow-plugins.typo3/class-alias-loader true -d "$DIR"

PACKAGES=("typo3/minimal:^${MAJOR}" "typo3/cms-install:^${MAJOR}" "typo3/cms-tstemplate:^${MAJOR}" "$PACKAGE_NAME:*@dev" "sourcebroker/test-labels:*@dev")

# EXT:translatr 7.1.0 is the first version supporting TYPO3 14
PACKAGES+=("sourcebroker/translatr:^7.1")
if [ "$MAJOR" = "14" ]; then
    # @todo Remove when sourcebroker/t3api 5.0.0 with TYPO3 14 support is released. The inline alias makes the branch
    #       satisfy the "^5.0" constraint of the extension. Any branch can be tested this way, e.g. "dev-main as 4.99.0".
    PACKAGES+=("sourcebroker/t3api:dev-release/5.0.0 as 5.0.0")
fi
composer req "${PACKAGES[@]}" --no-progress -n -d "$DIR"

cd "$DIR"

mysql -h db -u root -proot -e "DROP DATABASE IF EXISTS ${VERSION}; CREATE DATABASE ${VERSION};"

vendor/bin/typo3 setup -n --force --dbname=$VERSION --password=$TYPO3_DB_PASSWORD \
    --create-site="$SITE_URL" --admin-user-password="$TYPO3_SETUP_ADMIN_PASSWORD"

# Core has no "configuration:set" command (that is typo3-console), so dev settings go to additional.php
mkdir -p config/system
cat > config/system/additional.php <<'PHP'
<?php
$GLOBALS['TYPO3_CONF_VARS']['BE']['debug'] = true;
$GLOBALS['TYPO3_CONF_VARS']['FE']['debug'] = true;
$GLOBALS['TYPO3_CONF_VARS']['SYS']['devIPmask'] = '*';
$GLOBALS['TYPO3_CONF_VARS']['SYS']['displayErrors'] = 1;
$GLOBALS['TYPO3_CONF_VARS']['SYS']['trustedHostsPattern'] = '.*';
$GLOBALS['TYPO3_CONF_VARS']['SYS']['features']['security.backend.enforceReferrer'] = false;
// "typo3 setup" enables cHash enforcement, which answers API filter requests (e.g. ?tags[]=general) with 404,
// as EXT:t3api excludes only its own "t3apiResource" parameter from the cHash calculation
$GLOBALS['TYPO3_CONF_VARS']['FE']['cacheHash']['enforceValidation'] = false;
PHP

# Site with en / pl / de and the t3api route enhancer (see .ddev/test-content/)
sed "s#\#\#\#BASE\#\#\##${SITE_URL}#" $TEST_CONTENT/config.yaml > config/sites/main/config.yaml
cp $TEST_CONTENT/setup.typoscript config/sites/main/setup.typoscript
cp $TEST_CONTENT/page.tsconfig config/sites/main/page.tsconfig
# TYPO3 13 "setup --create-site" also creates a sys_template record which overrides the site TypoScript above;
# TYPO3 14 does not. Remove it so both versions behave the same.
mysql -h db -u root -proot $VERSION -e "DELETE FROM sys_template;"

vendor/bin/typo3 extension:setup
# Index the labels of EXT:test_labels and set their tags (EXT:test_labels/Configuration/Translation/Configuration.yaml)
vendor/bin/typo3 translatr:import:configuration
vendor/bin/typo3 cache:flush

echo ""
echo "✅ TYPO3 $VERSION installed with EXT:$EXTENSION_KEY"
echo "   Frontend: $SITE_URL"
echo "   API:      ${SITE_URL}_api/translations?tags[]=general"
echo "   Backend:  ${SITE_URL}typo3/  (admin / $TYPO3_SETUP_ADMIN_PASSWORD)"
echo "   Test:     ddev test-api $MAJOR"
