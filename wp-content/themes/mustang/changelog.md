# Mustang Changelog

## 1.6

* **Add**: Beaver Builder compatibility
* **Add**: WooCommerce 2.6+ support
* **Add**: One-click demo content import
* **Update**: Bundled premium plugins removed
* **Update**: 100% passing Theme Check
* **Update**: Theme tags
* **Update**: Supporting `<span>` icons markup
* **Update**: WebMan Amplifier compatibility
* **Update**: Widening mobile menu
* **Update**: Removing Schema.org code in favor of specialized plugins
* **Update**: Not removing Visual Composer native modules
* **Update**: Removing Visual Composer custom templates
* **Update**: Removing custom WooCommerce Visual Composer modules
* **Update**: Recommended plugins list
* **Update**: Admin "Welcome" page
* **Update**: Child themes support
* **Update**: Localization textdomain and texts
* **Update**: Documentation
* **Update**: Demo website and content
* **Fix**: Retina logo display
* **Fix**: Visual Composer column background
* **Fix**: Submenu item "s" suffix
* **Fix**: Comments form fields not accessible
* **Fix**: Headings styles and color
* **Fix**: Boxed layout theme width customizer preview
* **Fix**: Responsive layout
* **Fix**: Blank page template layout
* **Fix**: Child theme update notification
* **Fix**: WooCommerce PHP class name

#### Files changed:

	changelog.md
	functions.php
	header.php
	loop-theme-search.php
	screenshot.jpg
	sidebar-footer.php
	sidebar.php
	style.css
	assets/css/__fallback.css
	assets/css/_custom-styles.php
	/assets/css/_generate-css.php
	/assets/css/_generate-rtl-css.php
	assets/css/beaver-builder-editor.css
	assets/css/beaver-builder.css
	assets/css/content.css
	assets/css/forms.css
	assets/css/header.css
	assets/css/plugins-woocommerce.css
	assets/css/responsive.css
	assets/css/rtl-responsive.css
	assets/css/rtl.css
	assets/css/shortcodes.css
	assets/css/specials.css
	assets/css/typography.css
	assets/img/webman-32x32.png
	assets/js/scripts-global.js
	documentation/documentation.html
	documentation/css/custom.css
	languages/mustang.pot
	languages/readme.md
	library/admin.php
	library/core.php
	library/assets/css/admin.css
	library/assets/css/rtl-admin.css
	library/includes/class-tgm-plugin-activation.php
	library/updater/update-notifier.php
	setup/plugins.php
	setup/setup-beaver-builder.php
	setup/setup-one-click-demo-import.php
	setup/setup-theme-options.php
	setup/setup-webman-amplifier.php
	setup/setup-woocommerce.php
	setup/setup.php
	setup/about/about-custom.css
	setup/about/about.php
	webman-amplifier/content-shortcode-posts-wm_staff.php


## 1.5.4

* **Update**: Plugin updates: Visual Composer 4.7.4, Master Slider 2.20.4

#### Files changed:

	style.css
	setup/plugins.php
	setup/plugins/js_composer.zip
	setup/plugins/masterslider.zip


## 1.5.3

* **Update**: Plugin updates: Visual Composer 4.7.1, LayerSlider 5.6.2, Master Slider 2.20.3

#### Files changed:

	style.css
	setup/plugins.php
	setup/plugins/*.*


## 1.5.2

* **Fix**: Issue when using older version of PHP (pre 5.5)

#### Files changed:

	style.css
	library/skinning.php
	setup/setup.php


## 1.5.1

* **Fix**: Localization loading
* **Fix**: Customizer PHP error

#### Files changed:

	style.css
	languages/readme.md
	languages/xx_XX.pot
	library/skinning.php
	setup/setup.php


## 1.5

* **Add**: WordPress 4.3 support
* **Add**: Touch enabled navigation
* **Update**: Licensed under GPLv3
* **Update**: Admin interface
* **Update**: Removed obsolete files and added new ones
* **Update**: Removed predefined skins - available as Customizer Export / Import plugin preset from now on (downloadable via user manual)
* **Update**: Removing support for Internet Explorer 8
* **Update**: Security improvements
* **Update**: Stylesheet generator improvements
* **Update**: Reorganized and improved Customizer
* **Update**: Improved `style.css` loading in Customizer
* **Update**: Improved CSS minification
* **Update**: Removed option to disable responsiveness
* **Update**: Removed favicons setup (in favour of WordPress 4.3 Site Icon feature)
* **Update**: Demo content XML file (available for download via user manual)
* **Update**: Removed "Theme Options" from WordPress toolbar (admin bar)
* **Update**: Localization file
* **Update**: Updated plugins: WPBakery Visual Composer 4.6.2, LayerSlider 5.5.0, Master Slider Pro 2.18.2
* **Update**: Updated scripts: TGM Plugin Activation 2.5.2, Normalize 3.0.2, jQuery.prettyPhoto 3.1.6
* **Update**: Documentation (user manual)
* **Fix**: Google Fonts URL function subset issue
* **Fix**: Issue with filtered Content Modules
* **Fix**: Issue with filtered Posts (Custom Posts) when changing screen size / orientation
* **Fix**: Styles of updated Contact widget
* **Fix**: WooCommerce styles

#### Files changed:

	functions.php
	license.txt
	readme.md
	style.css
	assets/css/__fallback.css
	assets/css/_custom-styles.php
	assets/css/_generate-css.php
	assets/css/_generate-rtl-css.php
	assets/css/_generate-ve-css.php
	assets/css/borders.css
	assets/css/comments.css
	assets/css/content.css
	assets/css/core.css
	assets/css/forms.css
	assets/css/header.css
	assets/css/high-dpi.css
	assets/css/icons-basic.css
	assets/css/ltr-borders.css
	assets/css/plugins-bbpress.css
	assets/css/plugins-woocommerce.css
	assets/css/plugins.css
	assets/css/prettyphoto.css
	assets/css/reset.css
	assets/css/responsive.css
	assets/css/rtl-borders.css
	assets/css/rtl-plugins-bbpress.css
	assets/css/rtl-plugins-woocommerce.css
	assets/css/rtl.css
	assets/css/shortcodes.css
	assets/css/sidebar.css
	assets/css/specials.css
	assets/css/visual-editor.css
	assets/js/scripts-global.js
	library/admin.php
	library/core.php
	library/skinning.php
	library/assets/css/admin.css
	library/assets/css/theme-customizer.css
	library/includes/controls/class-WM_Customizer_Range.php
	setup/plugins.php
	setup/setup-theme-options.php
	setup/setup.php


## 1.4.7

* UPDATE: Adding text domain to `style.css` file
* UPDATE: Scripts: TGM Plugin Activation 2.4.2
* UPDATE: Plugins: Master Slider 2.14.2, LayerSlider 5.4.0, Visual Composer 4.5.1
* FIX: PHP error when using WordPress SEO and WooCommerce plugin with `[procuct]` shortcode on page
* FIX: Contact widget antispam on email

#### Files changed:

	style.css
	assets/js/scripts-global.js
	library/includes/class-tgm-plugin-activation.php
	setup/plugins.php
	setup/setup-woocommerce.php


## 1.4.6

* UPDATE: TGM Plugin Activation class

#### Files changed:

	library/includes/class-tgm-plugin-activation.php


## 1.4.5

* UPDATE: TGM Plugin Activation class
* FIX: Theme update theme options transfer

#### Files changed:

	library/includes/class-tgm-plugin-activation.php
	setup/setup.php


## 1.4

* ADDED: Compatibility with Customizer Export/Import plugin
* UPDATE: Tightened security
* UPDATE: Improved code
* UPDATE: Compatibility with newest WebMan Amplifier plugin
* UPDATE: Scripts: TGM Plugin Activation 2.4.1, jQuery Appear 0.3.4
* UPDATE: Customizer and styles
* UPDATE: Providing unpacked global scripts file
* UPDATE: Theme upgrade actions
* UPDATE: Plugins: Visual Composer 4.4.4, Master Slider 2.12.0
* FIX: Visual Composer Prettyphoto lightbox collision
* FIX: Flickering sticky header on webkit browsers
* FIX: Minor style issues

#### Files changed:

	functions.php
	single.php
	assets/css/_custom-styles.php
	assets/css/footer.css
	assets/css/header.css
	assets/js/scripts-global.js
	library/admin.php
	library/core.php
	setup/plugins.php
	setup/setup-theme-options.php
	setup/setup-webman-amplifier.php
	setup/setup.php


## 1.3

* UPDATE: Full WooCommerce 2.3+ support
* UPDATE: Full WordPress 4.1 support
* UPDATE: Localization files
* UPDATE: Plugins: Master Slider 2.9.9
* UPDATE: Removed author meta tag in HTML head
* UPDATE: Improved CSS styles code
* UPDATE: Improved responsive menu submenu - indentation added
* FIX: Blog page template display
* FIX: Closing bracket in wm_helper_var()

#### Files changed:

	comments.php
	content.php
	assets/css/_custom-styles.php
	assets/css/forms.css
	assets/css/plugins-woocommerce.css
	assets/css/reset.css
	assets/css/responsive-plugins-woocommerce.css
	assets/css/responsive.css
	assets/css/rtl-plugins-woocommerce.css
	assets/css/rtl-responsive.css
	assets/css/rtl.css
	library/assets/css/rtl-admin-woocommerce.css
	setup/setup-woocommerce.php
	setup/setup.php


## 1.2.9.5

* FIX: WordPress SEO by Yoast 1.7.2+ plugin support improved

#### Files changed:

	library/core.php


## 1.2.9

* FIX: Aplying Customizer settings on frontend

#### Files changed:

	library/skinning.php


## 1.2.8

* UPDATE: Updated plugins: Master Slider 2.9.8, Visual Composer 4.4.2
* UPDATE: Improved website migration process (still has to resave the Customizer after the migration)
* FIX: Demo content XML file image source

#### Files changed:

	library/core.php
	setup/plugins.php
	setup/setup.php


## 1.2.7

* UPDATE: Removed obsolete action hooks and variables
* UPDATE: Customizer fields coding
* UPDATE: Logical issue in `content.php` file
* UPDATE: Posts shortcode date format generated from WordPress settings
* UPDATE: Plugins updates: Master Slider 2.9.2, LayerSlider 5.3.2, Visual Composer 4.3.5
* FIX: Customizer not generating CSS file in WordPress 4.1
* FIX: Output of "custom-js" metafield
* FIX: Default logo dimensions

#### Files changed:

	content.php
	functions.php
	index.php
	library files
	setup/plugins.php
	setup/setup.php
	webman-amplifier/content-shortcode-posts-post.php
	webman-amplifier/content-shortcode-posts-post-widget.php


## 1.2.6

* FIX: Unclosed IF conditional in `functions.php` file

#### Files changed:

	functions.php


## 1.2.5

* FIX: Projects shortcode layout on small screens

#### Files changed:

	assets/css/responsive.css


## 1.2.2

* ADDED: Support for WebMan Amplifier widgets
* UPDATED: Displaying admin notice for "About" page after theme activation
* UPDATED: Code flexibility improvements
* UPDATED: Framework library version 3.4
* UPDATED: Localization files
* FIX: Default fallback footer widgets styles
* REMOVED: All the widgets - they are part of WebMan Amplifier from now on

#### Files removed:

	setup/widgets.php
	setup/widgets/w-contact.php
	setup/widgets/w-module.php
	setup/widgets/w-posts.php
	setup/widgets/w-subnav.php
	setup/widgets/w-tabbed-widgets.php
	setup/widgets/w-twitter.php

#### Files changed:

	functions.php
	sidebar-footer.php
	languages/mustang.pot
	setup/setup.php
	setup/setup-webman-amplifier.php
	setup/about/about.php


## 1.2.1

* UPDATED: Basic icons fully GPL compatible
* UPDATED: Plugins: LayerSlider 5.3.1, Master Slider 2.7.2
* UPDATED: Optimized code
* UPDATED: Framework library version 3.3
* FIX: Removed schema.org attributes from title HTML tag
* FIX: Default sidebars content display when WebMan Amplifier plugin is active (especially for plugins such as WooCommerce)
* FIX: Fixed HTML head according to new Theme Check

#### Files changed:

	header.php sidebar.php
	sidebar-footer.php
	assets/css/content.css
	assets/css/icons-basic.css
	assets/css/prettyphoto.css
	assets/css/rtl.css
	assets/css/shortcodes.css
	assets/css/initial/global.css
	assets/font/basic-icons/*.*
	library/*.*
	setup/plugins.php
	setup/setup.php
	setup/setup-theme-options.php
	setup/widgets.php


## 1.2

* ADDED: WordPress 4.0 support
* ADDED: Text logo font setup
* ADDED: Files content list in unminified stylesheet
* UPDATED: Unminified styles and scripts used with WordPress debug mode
* UPDATED: Framework's library version 3.2
* UPDATED: Minor CSS styles
* UPDATED: Scripts: imagesLoaded 3.1.8, Animate.css
* UPDATED: Plugins: Visual Composer 4.3.4, LayerSlider 5.3.0, Master Slider 2.6.0
* UPDATED: WooCommerce 2.2 support
* FIXED: Support contextual help tab databaze info PHP error
* FIXED: All assets URLs (including the ones inside the stylesheet) are SSL ready
* FIXED: Centered Content Modules mobile view issue
* FIXED: Icon list inside Content Module issue
* FIXED: 100% score with http://themecheck.org/

#### Files changed:

	assets/css/_custom-styles.php
	assets/css/_generate-css.php
	assets/css/_generate-rtl-css.php
	assets/css/_generate-ve-css.php
	assets/css/core.css
	assets/css/high-dpi.css
	assets/css/plugins-woocommerce.css
	assets/css/prettyphoto.css
	assets/css/reset.css
	assets/css/responsive.css
	assets/css/rtl-responsive.css
	assets/css/shortcodes.css
	assets/css/sidebar.css
	assets/css/specials.css
	assets/css/visual-editor.css
	assets/js/scripts.js
	assets/js/dev/scripts.dev.js
	setup/plugins.php
	setup/setup-theme-options.php
	setup/setup.php
	setup/about/about-custom.css


## 1.1.3

* FIXED: Long logo (website title) text wrapping

#### Files changed:

	assets/css/initial/global.css


## 1.1.2

* FIXED: Assets URLs in CSS stylesheet

#### Files changed:

	assets/css/initial/global.css


## 1.1.1

* ADDED: CSS styles for text logo
* UPDATED: Minor CSS styles
* UPDATED: WebMan Amplifier plugin no longer forced to install
* UPDATED: "About" page updated
* UPDATED: Localization texts
* FIXED: Theme works without WebMan Amplifier plugin as a basic blog theme

#### Files added:

	loop-page.php
	loop-post.php
	sidebar-footer.php
	assets/css/initial/global.css

#### Files changed:

	404.php, comments.php
	content-audio.php
	content-gallery.php
	content.php
	home.php
	index.php
	loop-singular.php
	loop-theme-search.php
	page.php
	sidebar.php
	single.php
	assets/css/_custom-styles.php
	assets/css/content.css
	assets/css/header.css
	assets/css/typography.css
	setup/plugins.php
	setup/setup.php
	setup/widgets.php
	setup/about/about-custom.css
	setup/about/about.php


## 1.1

* ADDED: Master Slider plugin!
* ADDED: Styled scrollbar for Webkit browsers (Chrome, Opera, Safari)
* ADDED: Readme.txt file
* ADDED: Custom styles for PrettyPhoto
* ADDED: Custom styles for WordPress media player
* UPDATED: Plugins: Visual Composer 4.3.2, LayerSlider 5.1.2
* UPDATED: WebMan Amplifier setup file fixed to be transferable to other themes
* UPDATED: WebMan Amplifier support enhanced
* UPDATED: Making columns equal height in a row
* UPDATED: Improved flexibility of website header and footer
* UPDATED: Altered `wm_helper_var()` function (removed `$callback` parameter) to improve security
* UPDATED: If custom link is set up on project in projects list, apply this as redirect on single project page
* UPDATED: Scripts: HTML5Shiv.js, Animate.css
* UPDATED: Blank page template uses fullwidth sections page layout now
* UPDATED: Localization texts
* UPDATED: Library update: Theme Update Notifier
* UPDATED: Library update: Added filter to modify logo image attributes
* UPDATED: Library update: Added custom action hook for stylesheet regeneration
* UPDATED: Library update: Renamed `wm_minimize_css()` function to `wm_minify_css()`
* UPDATED: Library update: Skinning System update
* UPDATED: Library update: Fixed WooCommerce colors removing error
* UPDATED: Library update: Adding `wm_get_stylesheet_directory()` function
* UPDATED: Library update: `[gallery]` shortcode modification disabled by default
* UPDATED: Library update: `[caption]` shortcode modification removed
* FIXED: `$create_images` variable error
* FIXED: Minor CSS styles bugs
* FIXED: Open Sans Condensed Google font integration
* FIXED: Fixed header bug when no topbar used
* FIXED: RTL: sub-submenu opening direction
* REMOVED: `head.php`

#### Files changed:

	content-audio.php
	content-video.php
	footer.php
	header.php
	single.php
	assets/css/animate.css
	assets/css/borders.css
	assets/css/core.css
	assets/css/header.css
	assets/css/rtl.css
	assets/css/shortcodes.css
	assets/css/wp-styles.css
	assets/js/scripts.js
	assets/js/dev/scripts.dev.js
	languages/mustang.pot
	library/*.*
	setup/plugins.php
	setup/setup-theme-options.php
	setup/setup-webman-amplifier.php
	setup/setup.php
	setup/about/about.php


## 1.0

* Initial release.
