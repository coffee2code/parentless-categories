# Parentless Categories

A plugin for WordPress that provides a template tag like `the_category()` to list categories assigned to a post except those that have a child category also assigned to the post.

This plugin is available in the WordPress Plugin Directory: https://wordpress.org/plugins/parentless-categories/


## Installation

1. Install via the built-in WordPress plugin installer. Or install the plugin code inside the plugins directory for your site (typically `/wp-content/plugins/`).
2. Activate the plugin through the 'Plugins' admin menu in WordPress.
3. Optional: Add filters for 'c2c_parentless_categories_list' to filter parentless category listing.
4. Use the template tag `<?php c2c_parentless_categories(); ?>` in a theme template somewhere inside "the loop".


## Additional Documentation

* See [readme.txt](https://github.com/coffee2code/parentless-categories/blob/master/readme.txt) for additional usage information.
* See [DEVELOPER-DOCS.md](DEVELOPER-DOCS.md) for developer-related documentation on hooks and template tags.
* See [CHANGELOG.md](CHANGELOG.md) for the list of changes for each release.


## Support

Commercial support and custom development are not presently available. You can raise an [issue](https://github.com/coffee2code/parentless-categories/issues) on GitHub or post in the [plugin's support forum on WordPress.org](https://wordpress.org/support/plugin/parentless-categories/).

If the plugin has been of benefit to you, how about [submitting a review](https://wordpress.org/support/plugin/parentless-categories/reviews/) for it in the WordPress Plugin Directory or considering a [donation](https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=6ARCFJ9TX3522)?


## License

This plugin is free software; you can redistribute it and/or modify it under the terms of the [GNU General Public License](https://www.gnu.org/licenses/gpl-2.0.html) as published by the Free Software Foundation; either version 2 of the License, or (at your option) any later version.