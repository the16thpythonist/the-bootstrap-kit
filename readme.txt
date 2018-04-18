=== The Bootstrap ===
Contributors:		Karlsruhe Institute of Technology
Tags:			black, blue, white, light, two-columns, left-sidebar, right-sidebar, flexible-width, custom-header, custom-background, threaded-comments, translation-ready, microformats, custom-menu, post-formats, sticky-posts
Donate link:		
Requires at least:	3.3.0
Tested up to:		3.5.0
Stable tag:		1.1

A WordPress theme based on Bootstrap, adopted to the KIT corporate design.

== Description ==

The child theme is based on the The Bootstrap theme for workpress from Konstantin Obenland. It included CSS instructions from the KIT web page. For the usage as 
publication database furhther modifications of the original theme are included. 
In order to use the KIT scheme also for other applications both functionalities 
should be split later.

The theme reimplements functions of the parent theme in functions.php. One function 
in the parent theme is removed in the child before it is called. Certain 
key words are replaced by string function in the rendered html.

Implementation details: 

The function to display author and date are foreseen to be re-implemented in a child theme. 
To enable this feature in the parent theme the function is only defined, if the function 
not already existing.

Example: Display of post details 

```
inc/template-tags.php: (parent)

if ( ! function_exists( 'the_bootstrap_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author,
* comment and edit link
*
* @author       Konstantin Obenland
* @since        1.0.0 - 05.02.2012
*
* @return       void
*/
function the_bootstrap_posted_on() {
        printf( __( '<span class="sep">Posted on </span><a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s" pubdate>%4$s</time></a><span class="by-author"> <span class="sep"> by </span> <span class="author vcard"><a class="url fn n" href="%5$s" title="%6$s" rel="author">%7$s</a></span></span>', 'the-bootstrap' ),
                        esc_url( get_permalink() ),
                        esc_attr( get_the_time() ),
                        esc_attr( get_the_date( 'c' ) ),
                        esc_html( get_the_date() ),
                        esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
                        esc_attr( sprintf( __( 'View all posts by %s', 'the-bootstrap' ), get_the_author() ) ),
                        get_the_author()
        );
        if ( comments_open() AND ! post_password_required() ) { ?>
                <span class="sep"> | </span>
                <span class="comments-link">
                        <?php comments_popup_link( '<span class="leave-reply">' . __( 'Leave a reply', 'the-bootstrap' ) . '</span>', __( '<strong>1</strong> Reply', 'the-bootstrap' ), __( '<strong>%</strong> Replies', 'the-bootstrap' ) ); ?>
                </span>
                <?php
        }
        edit_post_link( __( 'Edit', 'the-bootstrap' ), '<span class="sep">&nbsp;</span><span class="edit-link label">', '</span>' );
}
endif;

```

```
functions.php: (child)

/** Remove the posted notification - it's not necessary for publications that
  * all come with it's own date.
  */
function the_bootstrap_posted_on() {
}


```

Functions that are not foreseen for replacement need to be remove by the child theme.

Example: Notifications on discussion status

```
functions.php: (parent)

add_action( 'comment_form_comments_closed', 'the_bootstrap_comments_list', 1 );
```


```
functions.php: (child)

/** Comment are only added by scripts; manual action is not activated, so the
  * indication is not necessary. Warning: The function in the parent class needs
  * to be removed before exection.
  */
function the_bootstrap_kit_comments_closed() {
        remove_action( 'comment_form_comments_closed', 'the_bootstrap_comments_closed' );
}
add_action( 'comment_form_comments_closed', 'the_bootstrap_kit_comments_closed', 5 );

```

Spacing is adjusted in style.css. Look up html tag names, id and classes in the generated html code and specify this required properties.  In order to adjust the display properties for the mobil version use the ``@media``` pragms. 

Warning: In order to overwrite the bootstrap top margin defined in ```style.min.css``` it is not sufficient to specifay ```.container```. But the full specification ```div.container``` works as intended. 

```
style.min.css: (parent)
    body > .container {
       margin: 0px auto;
    }

```


```
style.css: (child)

@media(max-width:767px) {
    div.container {
        margin: 0px auto;
        padding: 0 0px;
    }
    #page {
        margin-top: 0px;
        padding: 0 10px;
    }
    div#head {
        margin-top: 0px;
        padding: 0px;
    }
}

```






= License =
Unless otherwise specified, all the theme files, scripts and images are licensed under GNU General Public Licemse.
The exceptions to this license are as follows:
* Bootstrap by Twitter and the Glyphicon set are licensed under the GPL-compatible [http://www.apache.org/licenses/LICENSE-2.0 Apache License v2.0]
* html5shiv is licensed under MIT
* Respond.js: Copyright 2011: Scott Jehl, scottjehl.com. Dual licensed under the MIT or GPL Version 2 licenses.
* Twitter Icon: [https://twitter.com/about/resources/logos]


= Translations =

The theme is currently only used with English language.


== Installation ==

1. Download or clone the Bootstrap KIT child theme from the git repository
2. Unzip the folder into the `/wp-content/themes/` directory
3. Activate the Theme through the 'Appearance' menu in WordPress


== Changelog ==

= 1.1 =
* Remove author / date line for all posts and comments
* Replaced the standard naming convention to better match the display of publications
* Removed shaded frame in the smalest resolution (for mobile phones)


= 1.0 =
* Initial version of a child theme for KIT



