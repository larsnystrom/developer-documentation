<?php
/**
 * Piwik - Open source web analytics
 *
 * @link    http://piwik.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 */

namespace helpers;

class Environment
{
    private static $piwikVersion = LATEST_PIWIK_DOCS_VERSION;
    private static $urlPrefix = '';

    public static function getUrlPrefix()
    {
        return self::$urlPrefix;
    }

    // this prefix will be used for internal links in Piwik, this way we keep the piwik version in the URL
    public static function setUrlPrefix($urlPrefix)
    {
        self::$urlPrefix = $urlPrefix;
    }

    public static function setPiwikVersion($piwikVersion)
    {
        self::$piwikVersion = (int) $piwikVersion;
    }
    
    public static function completeUrl($path)
    {
        if (strpos($path, '://') !== false) {
            return $path; // we only rewrite internal links
        }

        $urlPrefix = self::getUrlPrefix();

        if ($urlPrefix) {
            return $urlPrefix . $path;
        }

        return $path;
    }

    public static function getPiwikVersion()
    {
        return self::$piwikVersion;
    }

    public static function getPiwikVersionDirectory()
    {
        $piwikVersion = self::getPiwikVersion();

        return $piwikVersion . '.x';
    }

    public static function getBaseDocsPath()
    {
        return __DIR__ . '/../../docs/';
    }

    public static function getVersionedDocsPath()
    {
        $piwikVersion = self::getPiwikVersionDirectory();
        $path = self::getBaseDocsPath();

        return $path . $piwikVersion;
    }

    public static function getPathToGeneratedDocs()
    {
        $path = self::getVersionedDocsPath();

        return $path . '/generated';
    }
}
