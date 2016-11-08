# Notes on the JJIE theme

This theme requires that github.com/inn/largo be in wp-content/themes/largo-dev and checked out at 0.4 or later.

This theme requires the following plugins:

- Advanced Custom Fields plugin for the function get_fields.
- ACF Repeater
- ACF Options Page

If you need them for development work, you may be able to copy them from staging's `wp-content/plugins` folder with an FTP client.

# Post-0.5-migration checklist

- [ ] enable custom LESS to CSS in Appearance > Theme Options > Advanced
- [ ] Set custom LESS link color to #9c0001
- [ ] clean up menus

# Major differences in the post-0.5 theme:

- Largo now uses a single-column bost page by default. You may want to change this back to the two-column template in Theme Options > Layout Options > Single Article Template
