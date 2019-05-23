## WP Plugin Skeleton

## Requirements

- [PHP](http://php.net/) v5.6+
- [Git](https://git-scm.com/)
- [Composer](https://getcomposer.org/) (globally installed as `composer`)

## Install

Execute this script below in your `wp-content/plugins` to generate a new plugin boilerplate:

```bash
git clone https://github.com/luizbills/wp-plugin-skeleton-old.git _skeleton \
&& cd $_ \
&& php bin/install && sleep .1 \
&& cd ../$(cat ../.tmp_wp_plugin_dir) \
&& rm -f ../.tmp_wp_plugin_dir \
&& rm -rf ../_skeleton \
&& ls -Apl
```

## Contributing

- For features or bug fixes, follow the [CONTRIBUTING guide](CONTRIBUTING.md).
- Or create an issue for suggestions and other reports.

## LICENSE

GPL v3
