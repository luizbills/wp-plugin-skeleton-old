## Contributing with new features or bug fixes

- Fork this repo
- Clone your fork inside of `wp-content/plugins` folder
- Enable the WordPress Debug mode in your `wp-config.php`:

```php
define( 'WP_DEBUG', true );
define( 'WP_DEBUG_DISPLAY', true );
define( 'WP_DEBUG_LOG', true );
```

- Recommended: create a new git branch
- **Make your changes**
- *create a `src/includes/dev.php` to test your changes (see `src/includes/dev-sample.php`).*
- Open your terminal and run the following commands:

```bash
cd /path/to/your/wp-content/plugins/wp-plugin-skeleton
php bin/install --test
```

- Then, open your WordPress admin panel and active the **`A Skeleton Test`** plugin.
- When you when you are ready, create a Pull Request with all details.
