<?php
/**
 * WebMan Amplifier plugin setup
 *
 * THEME IMPLEMENTATION
 * Copy this file into your theme's folder and inlude it in the theme's
 * "functions.php" file with "require_once( 'webman-amplifier-setup.php' );"
 * command. Edit the file to your needs.
 *
 * PLUGIN LOCALIZATION
 * Note that custom translation files inside the plugin folder
 * will be removed on plugin updates. If you're creating custom
 * translation files, please use the global WordPress language folder.
 * Just create a "wp-content/languages/wm-amplifier" folder and place
 * your plugin localization files in there.
 *
 * @author     WebMan
 * @copyright  2014 WebMan
 *
 * @since    1.0
 * @version  1.6
 */





/**
 * SET UP THE PLUGIN
 */

	/**
	 * Enabling plugin features
	 *
	 * Please note that your theme must support them. If you enable any of custom
	 * post types, make sure your theme contains the appropriate single post
	 * and archive templates.
	 */
	add_theme_support( 'webman-amplifier', apply_filters( 'wmhook_webman_amplifier_support', array(
			'cp-logos',
			'cp-modules',
			'cp-projects',
			'cp-staff',
			'cp-testimonials',
			'widget-contact',
			'widget-module',
			'widget-posts',
			'widget-subnav',
			'widget-tabbed-widgets',
			'widget-twitter',
			'disable-isotope-notice',
		) ) );

	// WebMan Advanced Metaboxes

		add_filter( 'wmhook_metabox_visual_wrapper_toggle', '__return_true' );

	// Visual Composer text block content filters

		// add_filter( 'wmhook_shortcode_text_block_content', 'wm_default_content_filters', 10 );





	/**
	 * Dequeue RTL stylesheets
	 *
	 * @version  1.1
	 */
	function wm_dequeue_rtl() {
		if (
				is_rtl()
				&& apply_filters( 'wmhook_force_admin_ltr', false )
			) {
			wp_dequeue_style( 'wm-metabox-styles-rtl' );
			wp_dequeue_style( 'wm-shortcodes-generator-rtl' );
			wp_dequeue_style( 'wm-shortcodes-vc-addon-rtl' );
		}
	} // /wm_dequeue_rtl

	add_filter( 'admin_enqueue_scripts', 'wm_dequeue_rtl', 999 );



	/**
	 * Setup the default color calculation treshold
	 *
	 * @version  1.1
	 *
	 * @param  integer $treshold [0,255]
	 */
	function wm_default_color_treshold( $treshold ) {
		//Requirements check
			if ( ! function_exists( 'wm_option' ) ) {
				return $treshold;
			}

		//Preparing output
			$skin_treshold = wm_option( 'skin-text-color-treshold' );
			if ( $skin_treshold ) {
				$treshold = 2.55 * absint( $skin_treshold + 50 );
			}

		//Output
			return absint( $treshold );
	} // /wm_default_color_treshold

	add_filter( 'wmhook_wmamp_color_brightness_treshold', 'wm_default_color_treshold' );





/**
 * WIDGETS
 *
 * @since  1.2.2
 */

	/**
	 * Posts widget modifications
	 */

		/**
		 * Adding custom post types
		 *
		 * @param  array $post_types
		 */
		function wm_widgets_posts_post_types( $post_types = array() ) {
			//Preparing output
				$post_types['wm_projects'] = __( 'Projects', 'mustang' );

			//Output
				return $post_types;
		} // /wm_widgets_posts_post_types

		add_filter( 'wmhook_widgets_wm_posts_widget_form_post_type', 'wm_widgets_posts_post_types' );



		/**
		 * Adding taxonomies
		 *
		 * @param  array $taxonomies
		 */
		function wm_widgets_posts_taxonomies( $taxonomies = array() ) {
			//Preparing output
				$taxonomies['wm_projects'] = array(
						'optgroup'     => __( 'Projects tags', 'mustang' ),
						'all'          => false,
						'hierarchical' => '0',
						'tax_name'     => 'project_tag',
					);

			//Output
				return $taxonomies;
		} // /wm_widgets_posts_taxonomies

		add_filter( 'wmhook_widgets_wm_posts_widget_form_taxonomy', 'wm_widgets_posts_taxonomies' );



		/**
		 * Instance defaults
		 *
		 * @param  array $defaults
		 */
		function wm_widgets_posts_instance_defaults( $defaults = array() ) {
			//Preparing output
				$defaults['layout'] = array(
						'post'        => 'widget',
						'wm_projects' => 'widget',
					);

			//Output
				return $defaults;
		} // /wm_widgets_posts_instance_defaults

		add_filter( 'wmhook_widgets_wm_posts_widget_defaults', 'wm_widgets_posts_instance_defaults' );





/**
 * CUSTOM METABOXES
 */

	if ( function_exists( 'wma_add_meta_box' ) ) {

		/**
		 * Post metaboxex
		 */

			/**
			 * Post formats info metafields
			 *
			 * @param   array $fields Array of predefined metafields
			 *
			 * @return  array Modified $fields array
			 */
			function wm_post_formats_metafields( $fields = array() ) {

				$fields[20] = array(
						'id'          => 'post-format-audio',
						'type'        => 'html',
						'content'     => '<div class="box blue">' . __( '<h2>Audio post format</h2>Displays audio player to play your audio files. Could be used for Podcasting. Please place the <code>[wm_audio]</code> shortcode as the first thing in post content. The audio description text can follow on next line.', 'mustang' ) . '</div>',
						'conditional' => array(
								'option'       => array(
										'tag'  => 'input',
										'name' => 'post_format',
										'type' => 'radio',
									),
								'option_value' => array( 'audio' ),
								'operand'      => 'IS',
							),
					);

				$fields[25] = array(
						'id'          => 'post-format-gallery',
						'type'        => 'html',
						'content'     => '<div class="box blue">' . __( '<h2>Gallery post format</h2>A standard post with a gallery of images in post content. Slideshow will be displayed on blog page from the first gallery found in post content. If no gallery found, featured image is displayed.<br />You can insert a <code>&#91;gallery]</code> shortcode anywhere in the post. This shortcode will not be stripped out from the post content on the single post page.', 'mustang' ) . '</div>',
						'conditional' => array(
								'option'       => array(
										'tag'  => 'input',
										'name' => 'post_format',
										'type' => 'radio',
									),
								'option_value' => array( 'gallery' ),
								'operand'      => 'IS',
							),
					);

				$fields[30] = array(
						'id'          => 'post-format-link',
						'type'        => 'html',
						'content'     => '<div class="box blue">' . __( '<h2>Link post format</h2>Promotes interesting URL links. You can set the link anywhere in the post content. The link will be emphasized when post is displayed.', 'mustang' ) . '<br />' . __( 'Post title will not be displayed.', 'mustang' ) . '</div>',
						'conditional' => array(
								'option'       => array(
										'tag'  => 'input',
										'name' => 'post_format',
										'type' => 'radio',
									),
								'option_value' => array( 'link' ),
								'operand'      => 'IS',
							),
					);

				$fields[35] = array(
						'id'          => 'post-format-quote',
						'type'        => 'html',
						'content'     => '<div class="box blue">' . __( '<h2>Quote post format</h2>A quotation. Please place the actual quote (blockquote) directly into post content. To set a quote source use a <code>&lt;cite></code> HTML tag.', 'mustang' ) . '<br />' . __( 'Post title will not be displayed.', 'mustang' ) . '</div>',
						'conditional' => array(
								'option'       => array(
										'tag'  => 'input',
										'name' => 'post_format',
										'type' => 'radio',
									),
								'option_value' => array( 'quote' ),
								'operand'      => 'IS',
							),
					);

				$fields[40] = array(
						'id'          => 'post-format-status',
						'type'        => 'html',
						'content'     => '<div class="box blue">' . __( '<h2>Status post format</h2>A short status update, similar to a Twitter status update. Please place the actual status text directly into post content area.', 'mustang' ) . '<br />' . __( 'Post title will not be displayed.', 'mustang' ) . '</div>',
						'conditional' => array(
								'option'       => array(
										'tag'  => 'input',
										'name' => 'post_format',
										'type' => 'radio',
									),
								'option_value' => array( 'status' ),
								'operand'      => 'IS',
							),
					);

				$fields[45] = array(
						'id'          => 'post-format-video',
						'type'        => 'html',
						'content'     => '<div class="box blue">' . __( '<h2>Video post format</h2>A single video. Please place the <code>[wm_video]</code> shortcode as the first thing in post content. The video description text can follow on next line.', 'mustang' ) . '</div>',
						'conditional' => array(
								'option'       => array(
										'tag'  => 'input',
										'name' => 'post_format',
										'type' => 'radio',
									),
								'option_value' => array( 'video' ),
								'operand'      => 'IS',
							),
					);

				/**
				 * For more form fields options please check the PHP files inside
				 * the "wm-amplifier/includes/metabox/fields/" folder.
				 */

				return $fields;
			} // /wm_post_formats_metafields



			/**
			 * Post metabox metafields
			 *
			 * @version  1.1
			 *
			 * @param   array $fields Array of predefined metafields
			 *
			 * @return  array Modified $fields array
			 */
			function wm_post_metafields( $fields = array() ) {
				//Helper variables
					$helper = array(
							'sidebars' => ( ! function_exists( 'wm_helper_var' ) ) ? ( array( '' => __( 'Default', 'mustang' ) ) ) : ( wm_helper_var( 'layouts', 'sidebars' ) ),
						);

					if ( isset( $helper['sidebars']['sections'] ) ) {
						unset( $helper['sidebars']['sections'] );
					}

				//"Settings" tab
					$fields[100] = array(
							'type'  => 'section-open',
							'id'    => 'page-options-section',
							'title' => __( 'Settings', 'mustang' ),
						);

						$fields[120] = array(
								'type'        => 'checkbox',
								'id'          => 'disable-heading',
								'label'       => __( 'Disable main heading', 'mustang' ),
								'description' => __( 'Hide main heading section', 'mustang' ),
							);

						$fields[140] = array(
								'type'        => 'select',
								'id'          => 'sidebar',
								'label'       => __( 'Sidebar position', 'mustang' ),
								'description' => __( 'Select a sidebar position', 'mustang' ),
								'options'     => $helper['sidebars'],
							);

					$fields[1000] = array(
							'type' => 'section-close',
						);
				// /"Settings" tab

				/**
				 * For more form fields options please check the PHP files inside
				 * the "wm-amplifier/includes/metabox/fields/" folder.
				 */

				return $fields;
			} // /wm_post_metafields



			wma_add_meta_box( array(
					// Meta fields function callback (should return array of fields).
					// The function callback is used for to use a WordPress globals
					// available during the metabox rendering, such as $post.
					'fields' => 'wm_post_metafields',

					// Meta box id, unique per meta box.
					'id' => 'post-metabox',

					// Post types.
					'pages' => array( 'post' ),

					// Meta box title.
					'title' => __( 'Post options', 'mustang' ),

					// Function callback of form fields displayed immediately after
				 	// visual editor on 1st tab.
				 	'visual-wrapper-add' => 'wm_post_formats_metafields',
				) );



		/**
		 * Page metabox
		 */

			/**
			 * Page metabox metafields
			 *
			 * @version  1.6
			 *
			 * @param   array $fields Array of predefined metafields
			 *
			 * @return  array Modified $fields array
			 */
			function wm_page_metafields( $fields = array() ) {
				//Helper variables
					global $post_id;

					$wm_layouts = ( ! function_exists( 'wm_helper_var' ) ) ? ( array( 'sidebars' => array(), 'website' => array() ) ) : ( wm_helper_var( 'layouts' ) );

					$menus  = get_terms( 'nav_menu', array( 'hide_empty' => true ) );
					$helper = array(
							'menus'    => array( '' => __( 'Default', 'mustang' ) ),
							'sidebars' => $wm_layouts['sidebars'],
							'website'  => $wm_layouts['website'],
						);

					if (
							is_array( $menus )
							&& ! empty( $menus )
						) {
						foreach ( $menus as $item ) {
							if ( isset( $item->name ) && isset( $item->slug ) ) {
								$helper['menus'][ $item->slug ] = $item->name;
							}
						}
					}

				//"Settings" tab
					$fields[100] = array(
							'type'  => 'section-open',
							'id'    => 'page-options-section',
							'title' => __( 'Settings', 'mustang' ),
							'page'  => array(
									'templates' => array( 'page-template/blank.php' ),
									'operand'   => 'IS_NOT'
								),
						);

						$fields[120] = array(
								'type'        => 'checkbox',
								'id'          => 'disable-heading',
								'label'       => __( 'Disable main heading', 'mustang' ),
								'description' => __( 'Hide main heading section', 'mustang' ),
							);

						$fields[140] = array(
								'type'        => 'select',
								'id'          => 'sidebar',
								'label'       => esc_html__( 'Page layout', 'mustang' ),
								'description' => esc_html__( 'Select a sidebar position or enable fullwidth sections.', 'mustang' ) . '<br>' . esc_html__( 'Fullwidth sections page layout is suitable for use with page builders.', 'mustang' ),
								'options'     => $helper['sidebars'],
							);

						$fields[160] = array(
								'type'        => 'select',
								'id'          => 'layout',
								'label'       => __( 'Website layout', 'mustang' ),
								'description' => __( 'Select a website layout for this page', 'mustang' ),
								'options'     => $helper['website'],
							);

						$fields[180] = array(
								'type'        => 'select',
								'id'          => 'footer',
								'label'       => __( 'Footer layout', 'mustang' ),
								'description' => __( 'Select a footer layout', 'mustang' ),
								'options'     => array(
										''        => __( 'Widgets and credits', 'mustang' ),
										'widgets' => __( 'Widgets only', 'mustang' ),
										'credits' => __( 'Credits only', 'mustang' ),
										'none'    => __( 'No footer', 'mustang' ),
									),
							);

					$fields[1000] = array(
							'type' => 'section-close',
						);
				// /"Settings" tab

				//"Slider" tab
					$fields[2000] = array(
							'type'  => 'section-open',
							'id'    => 'page-slider-section',
							'title' => __( 'Slider', 'mustang' ),
							'page'  => array(
									'templates' => array( 'page-template/blank.php' ),
									'operand'   => 'IS_NOT'
								),
						);

						$fields[2020] = array(
								'type'    => 'html',
								'content' => '<tr class="option padding-20"><td colspan="2"><div class="box blue">' . __( '<strong>Please note that this is a special slider section setup.</strong><br />This slider will be displayed above the website header area. For standard sliders please use the shortcodes directly in the page content.', 'mustang' ) . '</div></td></tr>',
							);

						$fields[2040] = array(
								'type'        => 'select',
								'id'          => 'slider',
								'label'       => __( 'Set special slider', 'mustang' ),
								'description' => __( 'Select a slider type used as a special slider above the website header', 'mustang' ),
								'options'     => array(
										''       => __( 'No special slider', 'mustang' ),
										'custom' => __( 'Custom slider (use shortcode)', 'mustang' ),
										'static' => __( 'Featured image', 'mustang' ),
									),
							);

						$fields[2060] = array(
								'type'        => 'text',
								'id'          => 'slider-shortcode',
								'label'       => __( 'Slider shortcode', 'mustang' ),
								'description' => __( 'Set the custom slider shortcode', 'mustang' ),
								'conditional' => array(
										'option'       => array(
												'tag'  => 'select',
												'name' => 'wm-slider',
												'type' => '',
											),
										'option_value' => array( 'custom' ),
										'operand'      => 'IS',
									),
							);

						$fields[2080] = array(
								'type'        => 'select',
								'id'          => 'slider-static',
								'label'       => __( 'Image caption position', 'mustang' ),
								'description' => __( 'Featured image will be displayed in the special slider section.<br />Set the image caption (you can use shortcodes) and set the image caption position here.', 'mustang' ) . '<br /><a href="#" class="button-primary button-set-featured-image" style="margin-top: .5em">' . __( 'Set featured image', 'mustang' ) . '</a>',
								'options'     => array(
										'center' => __( 'Center', 'mustang' ),
										'left'   => __( 'Left', 'mustang' ),
										'right'  => __( 'Right', 'mustang' ),
									),
								'conditional' => array(
										'option'       => array(
												'tag'  => 'select',
												'name' => 'wm-slider',
												'type' => '',
											),
										'option_value' => array( 'static' ),
										'operand'      => 'IS',
									),
							);

					$fields[3000] = array(
							'type' => 'section-close',
						);
				// /"Slider" tab

				//"Blog" tab
					$fields[4000] = array(
							'type'  => 'section-open',
							'id'    => 'page-blog-section',
							'title' => __( 'Blog', 'mustang' ),
							'page'  => array(
									'templates' => array( 'home.php' ),
									'operand'   => 'IS'
								),
						);

						$fields[4020] = array(
								'type'        => 'slider',
								'id'          => 'blog-posts-count',
								'label'       => __( 'Number of posts', 'mustang' ),
								'description' => __( 'Sets the number of posts listed on this blog page only. Other archives will display posts according to WordPress settings.<br />Value of "-1" will display all posts. When you set the value of "0", WordPress settings are applied.', 'mustang' ),
								'default'     => 0,
								'min'         => -1,
								'max'         => 25,
								'step'        => 1,
								'zero'        => true,
							);

						//Categories multi field
						$category_fields = array();
						$category_fields[] = array(
								'type'    => 'select',
								'id'      => 'category',
								'label'   => __( 'Category', 'mustang' ),
								'options' => wma_taxonomy_array(),
							);
						$fields[4040] = array(
								'type'        => 'repeater',
								'id'          => 'blog-categories',
								'label'       => __( 'Posts categories', 'mustang' ),
								'description' => __( 'You can choose to display all posts or posts from a specific categories only. Press [+] button to add a category and select the category name from dropdown list.', 'mustang' ),
								'fields'      => $category_fields,
							);

						$fields[4060] = array(
								'type'        => 'radio',
								'id'          => 'blog-categories-action',
								'label'       => __( 'Categories action', 'mustang' ),
								'description' => __( 'Exclude or use the above categories?', 'mustang' ),
								'default'     => 'category__in',
								'options'     => array(
										'category__in'     => __( 'Posts just from these categories', 'mustang' ),
										'category__not_in' => __( 'Exclude posts from these categories', 'mustang' ),
									),
							);

					$fields[5000] = array(
							'type' => 'section-close',
						);
				// /"Blog" tab

				//"One page" tab
					if (
							! class_exists( 'WooCommerce' )
							|| ! (
								class_exists( 'WooCommerce' )
								&& $post_id
								&& $post_id == wc_get_page_id( 'shop' )
							)
						) {

						$fields[6000] = array(
								'type'  => 'section-open',
								'id'    => 'page-one-section',
								'title' => __( 'One page', 'mustang' ),
								'page'  => array(
										'templates' => array( 'page-template/one-page.php' ),
										'operand'   => 'IS'
									),
							);

							$fields[6020] = array(
									'type'    => 'html',
									'content' => '<tr class="option padding-20"><td colspan="2"><div class="box blue">' . __( 'Use this page template to place most (or all) of your website content on a single page. Set the ID for each section of the page (apply on row shortcode) and use them in custom navigation as anchors. You can set a navigation for this page below. Once you click the navigation link, the page will scroll to the section of a specific anchor ID.', 'mustang' ) . '</div></td></tr>',
								);

							$fields[6040] = array(
									'type'        => 'select',
									'id'          => 'navigation',
									'label'       => __( 'Anchor navigation', 'mustang' ),
									'description' => __( 'Set a special anchor navigation for this page', 'mustang' ),
									'options'     => $helper['menus'],
								);

						$fields[7000] = array(
								'type' => 'section-close',
							);

					}
				// /"One page" tab

				/**
				 * For more form fields options please check the PHP files inside
				 * the "wm-amplifier/includes/metabox/fields/" folder.
				 */

				return $fields;
			} // /wm_page_metafields



			wma_add_meta_box( array(
					// Meta fields function callback (should return array of fields).
					// The function callback is used for to use a WordPress globals
					// available during the metabox rendering, such as $post.
					'fields' => 'wm_page_metafields',

					// Meta box id, unique per meta box.
					'id' => 'page-metabox',

					// Post types.
					'pages' => array( 'page' ),

					// Meta box title.
					'title' => __( 'Page options', 'mustang' ),
				) );



		/**
		 * Staff metabox
		 */

			/**
			 * Staff metabox fields alteration
			 *
			 * @param   array $fields Array of predefined metafields
			 * @param   array $fonticons Array of icons names/classes
			 *
			 * @return  array Modified $fields array
			 */
			function wm_staff_contact_fields( $fields = array(), $fonticons = array() ) {
				//Preparing output
					$fields = array();

					if ( ! empty( $fonticons ) ) {
						$fields[] = array(
								'type'    => 'select',
								'id'      => 'icon',
								'label'   => __( 'Icon', 'mustang' ),
								'options' => $fonticons,
							);
					}
					$fields[] = array(
							'type'  => 'text',
							'id'    => 'title',
							'label' => __( 'Hover title', 'mustang' ),
						);
					$fields[] = array(
							'type'  => 'text',
							'id'    => 'link',
							'label' => __( 'URL link', 'mustang' ),
						);

				//Output
					return $fields;
			} // /wm_staff_contact_fields

			add_filter( 'wmhook_wmamp_cp_metafields_wm_staff_contact_fields', 'wm_staff_contact_fields', 10, 2 );



		/**
		 * Projects metabox
		 */

			/**
			 * Projects metabox fields alteration
			 *
			 * @version  1.6
			 *
			 * @param   array $fields Array of predefined metafields
			 *
			 * @return  array Modified $fields array
			 */
			function wm_project_metafields( $fields = array() ) {
				//Preparing output
					$fields[1000]['title'] = __( 'Settings', 'mustang' );
					$fields[1010] = array(
							'type'        => 'select',
							'id'          => 'sidebar',
							'label'       => __( 'Page layout', 'mustang' ),
							'description' => esc_html__( 'Select a sidebar position or enable fullwidth sections.', 'mustang' ) . '<br>' . esc_html__( 'Fullwidth sections page layout is suitable for use with page builders.', 'mustang' ),
							'options'     => ( ! function_exists( 'wm_helper_var' ) ) ? ( array( '' => __( 'Default', 'mustang' ) ) ) : ( wm_helper_var( 'layouts', 'sidebars' ) ),
						);

					$fields[1015] = array(
							'type'        => 'text',
							'id'          => 'slider',
							'label'       => __( 'Custom preview slider', 'mustang' ),
							'description' => __( 'This slider will be displayed on projects list only, instead of featured image. Please enter the slider shortcode.', 'mustang' ),
						);

					$fields[1040]['options'][''] = '';
					unset( $fields[1040]['options']['1OPTGROUP'] );
					unset( $fields[1040]['options']['1/OPTGROUP'] );

				//Output
					return $fields;
			} // /wm_project_metafields

			add_filter( 'wmhook_wmamp_cp_metafields_wm_projects', 'wm_project_metafields', 10 );

	} // /wma_add_meta_box function check





/**
 * SHORTCODES
 */

	/**
	 * Supported shortcodes version
	 *
	 * Use this to declare the plugin version that your theme supports.
	 * It is possible that in future versions of the plugin there will be more
	 * shortcodes added and your theme might not suppot them out of the box.
	 * Setting this version number will make sure only the shortcodes included
	 * with the specific plugin version will be available to your theme users.
	 *
	 * To use this function just uncomment the "add_filter" below
	 */
	function wm_supported_shortcode_until_version() {
		return '1.0.9'; //Set the plugin version your theme supports
	} // /wm_supported_shortcode_until_version

	add_filter( 'wmhook_shortcode_supported_version', 'wm_supported_shortcode_until_version' );



	/**
	 * Posts shortcode default image size
	 *
	 * @version  1.1
	 */
	function wm_shortcode_image_size() {
		//Requirements check
			if ( ! function_exists( 'wm_option' ) ) {
				return $size;
			}

		//Output
			return 'mobile-' . wm_option( 'skin-image-posts' );
	} // /wm_shortcode_image_size

	add_filter( 'wmhook_shortcode_posts_image_size', 'wm_shortcode_image_size' );



	/**
	 * Slideshow shortcode default image size
	 */
	function wm_slideshow_image_size() {
		return 'content-width';
	} // /wm_slideshow_image_size

	add_filter( 'wmhook_shortcode_slideshow_image_size', 'wm_slideshow_image_size' );



	/**
	 * Staff posts default image size
	 */
	function wm_staff_posts_image_size() {
		return 'admin-thumbnail';
	} // /wm_staff_posts_image_size

	add_filter( 'wmhook_shortcode_posts_image_size_wm_staff', 'wm_staff_posts_image_size' );



	/**
	 * Products posts default image size
	 *
	 * @since    1.6
	 * @version  1.6
	 */
	function wm_product_posts_image_size() {
		return 'shop_catalog';
	} // /wm_product_posts_image_size

	add_filter( 'wmhook_shortcode_posts_image_size_product', 'wm_product_posts_image_size' );



	/**
	 * Content Module shortcode modifications
	 */

		/**
		 * Content Module shortcode default layout
		 *
		 * Removing "morelink" and setting layout element for banner only.
		 *
		 * @param  array $layouts
		 * @param  array $atts
		 */
		function wm_shortcode_content_module_layout( $layouts, $atts ) {
			//Preparing output
				$layouts['wm_modules'] = array( 'image', 'title', 'content' );

				if ( false !== strpos( $atts['class'], 'banner' ) ) {
					$layouts['wm_modules'] = array( 'image', 'content' );
				}

			//Output
				return $layouts;
		} // /wm_shortcode_content_module_layout

		add_filter( 'wmhook_shortcode_content_module_layouts', 'wm_shortcode_content_module_layout', 10, 2 );



		/**
		 * Content Module shortcode layout elements
		 *
		 * @param  array  $layout_elements
		 * @param  absint $post_id
		 * @param  array  $helpers
		 * @param  array  $atts
		 */
		function wm_shortcode_content_module_layout_elements( $layout_elements, $post_id, $helpers, $atts ) {
			//Preparing output
				if ( false !== strpos( $atts['class'], 'banner' ) ) {
					$content = wpautop( get_the_content() );

					if ( $helpers['link'] ) {
						$content = '<a' . $helpers['link'] . ' class="banner-cell">' . $content . '</a>';
					} else {
						$content = '<div class="banner-cell">' . $content . '</div>';
					}

					$layout_elements['content'] = do_shortcode( '<div class="wm-content-module-element wm-html-element content"><div class="banner-table custom-font-color">' . $content . '</div></div>' );
				}

			//Output
				return $layout_elements;
		} // /wm_shortcode_content_module_layout_elements

		add_filter( 'wmhook_shortcode_content_module_layout_elements', 'wm_shortcode_content_module_layout_elements', 10, 4 );



	/**
	 * Section (row) and column shortcode modifications
	 */

		/**
		 * Additional shortcode default attributes
		 */
		function wm_modify_shortcode_defaults( $atts, $shortcode ) {
			//Preparing output
				switch ( $shortcode ) {
					case 'row':
					case 'vc_row':

						$atts['disable_container'] = false;
						$atts['video_url']         = '';
						if ( 'sections' == wma_meta_option( 'sidebar' ) ) {
							$atts['behaviour'] = 'section';
						}

					break;

					case 'column':
					case 'vc_column':

						$atts['bg_image'] = '';

					break;

					default:
					break;
				}

			//Output
				return $atts;
		} // /wm_modify_shortcode_defaults

		add_filter( 'wmhook_shortcode__defaults', 'wm_modify_shortcode_defaults', 10, 2 );



		/**
		 * Modify section/row styles
		 */
		function wm_section_styles( $attributes, $atts ) {
			//Modify styles
				if ( $atts['bg_color'] ) {
					$attributes['style'] .= ' border-color: ' . esc_attr( wma_contrast_color( $atts['bg_color'], 19 ) ) . ';';
				}

			//Output
				return $attributes;
		} // /wm_section_styles

		add_filter( 'wmhook_shortcode_row_html_attributes',    'wm_section_styles', 10, 2 );
		add_filter( 'wmhook_shortcode_vc_row_html_attributes', 'wm_section_styles', 10, 2 );



		/**
		 * Shortcode markup: section (row)
		 */
		function wm_section_markup( $output, $atts ) {
			//Helper variables
				$prepend = $append = $sections_layout = '';

				$video_formats = array( 'mp4', 'm4v', 'webm', 'ogv', 'wmv', 'flv' );

				if ( 'sections' == wma_meta_option( 'sidebar' ) ) {
					$sections_layout = true;
				}

				//video_url
					$atts['video_url'] = array_filter( explode( ',', str_replace( ' ', '', $atts['video_url'] ) ) );
					if ( ! empty( $atts['video_url'] ) ) {
						if ( 1 === count( $atts['video_url'] ) ) {
							$atts['video_url'] = array( 'src="' . esc_url( $atts['video_url'][0] ) . '"' );
						} else {
							foreach ( $atts['video_url'] as $key => $url ) {
								foreach ( $video_formats as $format ) {
									if ( stripos( $url, '.' . $format ) ) {
										$atts['video_url'][ $key ] = $format . '="' . esc_url( $url ) . '"';
									}
								}
							}
						}
						$atts['video_url'] = do_shortcode( apply_filters( 'wm_section_markup_video_url', '<div class="wm-row-video">[wm_video ' . implode( ' ', $atts['video_url'] ) . ' loop="on" autoplay="on" /]<div class="overlay"></div></div>' ), $atts );
					} else {
						$atts['video_url'] = '';
					}

				//Modify class
					if ( $atts['font_color'] ) {
						$atts['class'] .= ' custom-font-color';
					}

			//Section markup
				if ( $sections_layout ) {
					//Modify class
						if ( $atts['padding'] ) {
							$atts['class'] .= ' no-wrap-inner-padding';
						}

					//Section HTML wrapper
						$prepend .= "\r\n\r\n" . '<div class="wm-section {class}"{attributes}>' . "\r\n\r\n" . $atts['video_url'];
						$append  .= "\r\n\r\n" . '</div> <!-- /wm-section -->' . "\r\n\r\n";

					//Apply default theme section inner wrappers
						if ( ! $atts['disable_container'] ) {
							$prepend .= apply_filters( 'wmhook_section_inner_wrappers', '' );
							$append   = apply_filters( 'wmhook_section_inner_wrappers_close', '' ) . $append;
						}
				}

			//Output
				$replacements = array(
						'{attributes}' => implode( ' ', $atts['attributes'] ),
						'{class}'      => $atts['class'],
						'{content}'    => $atts['content'],
					);
				$output = strtr( $prepend . $atts['html'][ $atts['behaviour'] ] . $append, $replacements );

				return $output;
		} // /wm_section_markup

		add_filter( 'wmhook_shortcode_row_output',    'wm_section_markup', 10, 2 );
		add_filter( 'wmhook_shortcode_vc_row_output', 'wm_section_markup', 10, 2 );



		/**
		 * Shortcode markup: column
		 *
		 * @version  1.6
		 */
		function wm_column_markup( $output, $atts ) {

			// Helper variables

				$atts['bg_image'] = trim( $atts['bg_image'] );


			// Requirements check

				if ( ! $atts['bg_image' ] ) {
					return $output;
				}


			// Processing

				$atts['attributes']['style'] = '';

				$atts['class'] .= ' match-height';

				if ( is_numeric( $atts['bg_image'] ) ) {
					$image_size = apply_filters( 'wmhook_shortcode_column_image_size', 'full' );
					$image      = wp_get_attachment_image_src( absint( $atts['bg_image'] ), $image_size );

					if ( is_array( $image ) && isset( $image[0] ) && $image[0] ) {
						$atts['attributes']['style'] .= ' background-image: url(' . esc_url( $image[0] ) . ');';
					}
				} elseif ( $atts['bg_image'] ) {
					$atts['attributes']['style'] .= ' background-image: url(' . esc_url( $atts['bg_image'] ) . ');';
				}

				$atts['attributes']['style'] .= ' background-repeat: repeat;';
				$atts['attributes']['style'] .= ' background-position: 50% 50%;';
				$atts['attributes']['style'] .= ' background-size: cover;';

				$atts['attributes']['style'] = ' style="' . esc_attr( $atts['attributes']['style'] ) . '"';


			// Output

				return '<div class="' . esc_attr( $atts['class'] ) . '"' . implode( ' ', $atts['attributes'] ) . '>' . $atts['content'] . '</div>';

		} // /wm_column_markup

		add_filter( 'wmhook_shortcode_column_output',    'wm_column_markup', 10, 2 );
		add_filter( 'wmhook_shortcode_vc_column_output', 'wm_column_markup', 10, 2 );



	/**
	 * Modifying page builder parameters
	 *
	 * @version  1.6
	 */
	function wm_modify_shortcodes_definitions( $definitions ) {

		// Processing

			// Beaver Builder

				// Content Module

					unset( $definitions['content_module']['bb_plugin']['form']['general']['sections']['multiple']['fields']['filter'] );
					unset( $definitions['content_module']['bb_plugin']['form']['general']['sections']['multiple']['fields']['pagination'] );
					unset( $definitions['content_module']['bb_plugin']['form']['description'] );
					unset( $definitions['content_module']['bb_plugin']['form']['others']['sections']['general']['fields']['no_margin'] );
					unset( $definitions['content_module']['bb_plugin']['form']['others']['sections']['general']['fields']['image_size'] );
					unset( $definitions['content_module']['bb_plugin']['form']['others']['sections']['general']['fields']['layout'] );

				// Posts

					unset( $definitions['posts']['bb_plugin']['form']['description'] );
					unset( $definitions['posts']['bb_plugin']['form']['others']['sections']['general']['fields']['filter_layout'] );
					unset( $definitions['posts']['bb_plugin']['form']['others']['sections']['general']['fields']['related'] );
					unset( $definitions['posts']['bb_plugin']['form']['others']['sections']['general']['fields']['image_size'] );

					// Adding "layout" parameter

						$definitions['posts']['bb_plugin']['output'] = str_replace( '[PREFIX_posts', '[PREFIX_posts{{layout}}', (string) $definitions['posts']['bb_plugin']['output'] );
						$definitions['posts']['bb_plugin']['params'] = array_merge( array( 'layout' ), (array) $definitions['posts']['bb_plugin']['params'] );

						$definitions['posts']['bb_plugin']['form']['others']['sections']['general']['fields']['layout'] = array(
								'type' => 'select',
								//description
								'label' => esc_html__( 'Layout', 'mustang' ),
								//type specific
								'options' => array(
									''       => esc_html__( 'Default layout', 'mustang' ),
									'simple' => esc_html__( 'Simple posts or projects layout', 'mustang' ),
								),
								//preview
								'preview' => array( 'type' => 'refresh' ),
							);

				// Testimonials

					unset( $definitions['testimonials']['bb_plugin']['form']['description'] );
					unset( $definitions['testimonials']['bb_plugin']['form']['others']['sections']['general']['fields']['no_margin'] );

			// Visual Composer

				if ( function_exists( 'wma_is_active_vc' ) && wma_is_active_vc() ) {

					foreach ( $definitions as $key => $atts ) {
						if (
								! in_array( $key, array( 'vc_row', 'vc_row_inner' ) )
								&& isset( $atts['vc_plugin'] )
							) {
							$definitions[ $key ]['vc_plugin']['category'] = esc_html__( 'Theme Modules', 'mustang' );
							$definitions[ $key ]['vc_plugin']['icon']     = wm_get_stylesheet_directory_uri( 'assets/img/webman-32x32.png' );
						}
					}

					// Posts

						$definitions['posts']['vc_plugin']['params'][30]['value'] = array(
								1 => 1,
								2 => 2,
								3 => 3,
								4 => 4,
								5 => 5,
								6 => 6,
								7 => 7,
								8 => 8,
								9 => 9,
							);

						$definitions['posts']['vc_plugin']['params'][145] = array(
								'heading'     => __( 'Output layout', 'mustang' ),
								'description' => __( 'Set optional output layout name. You can use <code>simple</code> with <em>Posts</em> and <em>Projects</em> posts.', 'mustang' ),
								'type'        => 'textfield',
								'param_name'  => 'layout',
								'value'       => '',
								'holder'      => 'hidden',
								'class'       => '',
								'group'       => __( 'Layout', 'mustang' ),
							);

					// Row

						$definitions['vc_row']['vc_plugin']['params'][5] = array(
								'heading'     => __( 'Remove section inner container', 'mustang' ),
								'description' => __( 'This is only relevant when using "Fullwidth sections" page layout.', 'mustang' ),
								'type'        => 'checkbox',
								'param_name'  => 'disable_container',
								'value'       => '',
								'value'       => array(
										__( 'Remove the inner Section container to make the content fill the whole section without any paddings.', 'mustang' ) => 1,
									),
								'holder'      => 'hidden',
								'class'       => '',
							);
						$definitions['vc_row']['vc_plugin']['params'][90] = array(
								'heading'     => __( 'Section background video URL', 'mustang' ),
								'description' => __( 'Set optional section background video URL. Video will be played automatically in a loop.', 'mustang' ),
								'type'        => 'textfield',
								'param_name'  => 'video_url',
								'value'       => '',
								'holder'      => 'hidden',
								'class'       => '',
								'group'       => __( 'Styling', 'mustang' ),
							);

					// Column

						$definitions['vc_column']['vc_plugin']['params'][5] = array(
								'heading'     => __( 'Background image', 'mustang' ),
								'description' => __( 'The image will cover the column background', 'mustang' ),
								'type'        => 'attach_image',
								'param_name'  => 'bg_image',
								'value'       => '',
								'holder'      => 'hidden',
								'class'       => '',
							);

					// Slideshow

						$definitions['slideshow']['vc_plugin']['params'][20]['value'] = array(
								__( 'Just Next/Prev button', 'mustang' )  => '',
								__( 'Next/Prev + Pagination', 'mustang' ) => 'pagination',
								//Removed custom thumbnail pagination as we are using Owl Carousel (@todo Make custom thumbnail pagination work with Owl Carousel too.)
							);

					// bbPress

						if ( class_exists( 'bbPress' ) ) {
							//Forum index
								$definitions['bbp-forum-index'] = array(
										'vc_plugin' => array(
											'name'                    => __( 'Forums Index', 'mustang' ),
											'base'                    => 'bbp-forum-index',
											'class'                   => 'wm-shortcode-vc-bbp-forum-index',
											'category'                => __( 'Forum', 'mustang' ),
											'show_settings_on_create' => false,
											'params'                  => array(
													10 => array(
														'heading'     => '<a href="http://codex.bbpress.org/shortcodes/" target="_blank"><strong>' . __( 'bbPress Shortcode', 'mustang' ) . '</strong></a>',
														'description' => __( 'This will display your entire forum index. No parameters to be set.', 'mustang' ),
														'type'        => 'wm_html',
														'param_name'  => 'forums',
														'value'       => '',
														'holder'      => 'hidden',
														'class'       => '',
													),
												)
										)
									);
						}

				}


		// Output

			return $definitions;

	} // /wm_modify_shortcodes_definitions

	add_filter( 'wmhook_shortcode_definitions', 'wm_modify_shortcodes_definitions', 10 );



	/**
	 * Prefix page builder modules names
	 *
	 * @since    1.6
	 * @version  1.6
	 *
	 * @param  array  $output
	 * @param  string $shortcode
	 */
	function wm_page_builder_module_name_prefix( $output, $shortcode ) {

		// Processing

			if ( '-' !== $output['name'] ) {
				$output['name'] = 'WM ' . $output['name'];
			}


		// Output

			return $output;

	} // /wm_page_builder_module_name_prefix

	add_filter( 'wmhook_shortcode_wma_bb_shortcode_def_output', 'wm_page_builder_module_name_prefix', 10, 2 );



	/**
	 * Shortcodes attributes: forced
	 *
	 * @since    1.6
	 * @version  1.6
	 *
	 * @param  array  $atts
	 * @param  string $shortcode
	 */
	function wm_shortcode_attributes( $atts, $shortcode ) {

		// Processing

			switch ( $shortcode ) {

				case 'content_module':
				case 'posts':

					// Isotope - force masonry layout (default is `fitRows`)

						$atts['filter_layout'] = 'masonry';

				break;

				default:
				break;

			}


		// Output

			return $atts;

	} // /wm_shortcode_attributes

	add_filter( 'wmhook_shortcode__attributes', 'wm_shortcode_attributes', 10, 2 );
