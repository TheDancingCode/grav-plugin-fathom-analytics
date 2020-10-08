<?php
namespace Grav\Plugin;

use Composer\Autoload\ClassLoader;
use Grav\Common\Plugin;

/**
 * Class FathomAnalyticsPlugin
 * @package Grav\Plugin
 */
class FathomAnalyticsPlugin extends Plugin
{
    public static function getSubscribedEvents()
    {
        return [
            'onPluginsInitialized' => [
                ['autoload', 100000], // TODO: Remove when plugin requires Grav >=1.7
                ['onPluginsInitialized', 0]
            ]
        ];
    }

    public function autoload(): ClassLoader
    {
        return require __DIR__ . '/vendor/autoload.php';
    }

    public function onPluginsInitialized()
    {
        if ($this->isAdmin()) {
            return;
        }

        $this->enable([
            'onTwigSiteVariables' => ['onTwigSiteVariables', 0]
        ]);
    }

    public function onTwigSiteVariables()
    {
        $site_id = $this->getSiteID();
        $script_url = $this->getScriptUrl();
        if(empty($site_id)){
            return;
        }
        $this->grav['assets']->addJs($script_url, ['site' => $site_id, 'loading' => 'defer']);
    }


    private function getSiteID()
    {
        return $this->config->get('plugins.fathom-analytics.site_id');
    }

    private function getScriptUrl()
    {
        $domain = $this->getDomain();
        $url = 'https://' . rtrim(str_replace(array('https://', 'http://'), '', $domain), '/') . '/script.js';
        return $url;
    }

    private function getDomain()
    {
        $default_domain = 'https://cdn.usefathom.com';
        $custom_domain = $this->getCustomDomain();
        return $custom_domain ?? $default_domain;
    }

    private function getCustomDomain()
    {
        return $this->config->get('plugins.fathom-analytics.custom_domain');
    }
}
