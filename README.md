## WP Plugin Skeleton

## Requirements

- [PHP](http://php.net/) v5.6+
- [Git](https://git-scm.com/)
- [Composer](https://getcomposer.org/) (globally installed as `composer`)

## Install

```
git clone https://github.com/luizbills/wp-plugin-skeleton.git \
&& cd $(basename $_ .git) \
&& php create-plugin && sleep .1 \
&& cd .. \
&& cd $(cat .tmp_wp_plugin_dir) \
&& rm -f ../.tmp_wp_plugin_dir \
&& rm -rf ../wp-plugin-skeleton \
&& ls -Apl
```

## LICENSE

GPL v3
