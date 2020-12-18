# Fathom Analytics Plugin

The **Fathom Analytics** Plugin is an extension for [Grav CMS](http://github.com/getgrav/grav) to add the Fathom tracking snippet to your site.

## Installation

Installing the Fathom Analytics plugin can be done in one of three ways: The GPM (Grav Package Manager) installation method lets you quickly install the plugin with a simple terminal command, the manual method lets you do so via a zip file, and the admin method lets you do so via the Admin Plugin.

### GPM Installation (Preferred)

To install the plugin via the [GPM](http://learn.getgrav.org/advanced/grav-gpm), through your system's terminal (also called the command line), navigate to the root of your Grav-installation, and enter:

    bin/gpm install fathom-analytics

This will install the Fathom Analytics plugin into your `/user/plugins`-directory within Grav. Its files can be found under `/your/site/grav/user/plugins/fathom-analytics`.

### Manual Installation

To install the plugin manually, download the zip-version of this repository and unzip it under `/your/site/grav/user/plugins`. Then rename the folder to `fathom-analytics`. You can find these files on [GitHub](https://github.com/the-dancing-code/grav-plugin-fathom-analytics) or via [GetGrav.org](http://getgrav.org/downloads/plugins#extras).

You should now have all the plugin files under

    /your/site/grav/user/plugins/fathom-analytics
	
> NOTE: This plugin is a modular component for Grav which may require other plugins to operate, please see its [blueprints.yaml-file on GitHub](https://github.com/the-dancing-code/grav-plugin-fathom-analytics/blob/master/blueprints.yaml).

### Admin Plugin

If you use the Admin Plugin, you can install the plugin directly by browsing the `Plugins`-menu and clicking on the `Add` button.

## Configuration

Before configuring this plugin, you should copy the `user/plugins/fathom-analytics/fathom-analytics.yaml` to `user/config/plugins/fathom-analytics.yaml` and only edit that copy.

Here is the default configuration and an explanation of available options:

```yaml
enabled: true
site_id:
custom_domain:
loading_attribute: defer
honor_dnt: false
manual_tracking: false
ignore_canonicals: false
excluded_domains:
included_domains:
```

### site_id
This is the unique Tracking ID for your site.

### custom_domain
Your [custom domain](https://usefathom.com/support/custom-domains) if you use one.

### loading_attribute
How the page should load the tracking script: `defer`, `async`, or normal.

### honor_dnt
Don't track visitors with DNT turned on.

### manual_tracking
By default, Fathom tracks a page view automatically every time a visitor loads a page. Use this option to track manually.

### ignore_canonicals
Use the current page URL even if there's a canonical one.

### exclude_domains
The Fathom tracker will track things on every domain, except the ones excluded.

### include_domains
Only track stats on a specific domain.

## Referall

If you're not on Fathom Analytics yet but would like to try it out, consider using my referral link: [https://usefathom.com/ref/FBADDO](https://usefathom.com/ref/FBADDO). You'll get a $10 discount on your first invoice.
