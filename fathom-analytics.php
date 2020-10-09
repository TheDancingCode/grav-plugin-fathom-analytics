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
        $script_attributes = $this->getScriptAttributes();
        if(empty($site_id)){
            return;
        }
        $script_attributes['site'] = $site_id;
        $this->grav['assets']->addJs($script_url, $script_attributes);
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

    private function getScriptAttributes()
    {
        $config = $this->config->get('plugins.fathom-analytics');
        $attributes = [];

        $loading_attribute = $config['loading_attribute'];
        if(in_array($loading_attribute, ['defer', 'async'])){
            $attributes['loading'] = $loading_attribute;
        }

        $honor_dnt = $config['honor_dnt'];
        if($honor_dnt === true) {
            $attributes['honor-dnt'] = 'true';
        }

        $manual_tracking = $config['manual_tracking'];
        if($manual_tracking === true) {
            $attributes['auto'] = 'false';
        }

        $ignore_canonical = $config['ignore_canonicals'];
        if($ignore_canonical === true) {
            $attributes['canonical'] = 'false';
        }

        $excluded_domains = $config['excluded_domains'];
        if(is_array($excluded_domains)){
            $attributes['excluded-domains'] = implode(',', array_map('trim',$excluded_domains));
        }

        $included_domains = $config['included_domains'];
        if(is_array($included_domains)){
            $attributes['included-domains'] = implode(',',array_map('trim',$included_domains));
        }

        return $attributes;
    }
}
