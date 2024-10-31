=== Random Post Name ===
Contributors: pressmaninc, hiroshisekiguchi, kazunao, muraokashotaro
Tags: pressman, post, post_name, slug, ramdom, blog
Requires PHP: 7.1.24
License: GNU General Public License, v2 or higher
License URI: http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
Stable tag: 1.0
Requires at least: 5.4
Tested up to: 5.4

Auto-generate a unique random string and set it to post_name.

= Customization with hooks =
Use of filter hooks is at your own risk.

* You can change post_type to be applied by an array. Deafult is 'post' only.

<pre>
add_filter( 'random_post_name_post_types', 'hoge' );
function hoge(){
    return ['post', 'page'];
}
</pre>

* You can change the number of characters in the post_name. Deafult is 10.

<pre>
add_filter( 'random_post_name_digits', 'hoge' );
function hoge(){
    return 20;
}
</pre>

* You can change the variation of characters. Deafult is '0123456789abcdefghijklmnopqrstuvwxyz'. Do not include multibyte chars.

<pre>
add_filter( 'random_post_name_choices', 'hoge' );
function hoge(){
    return '0123456789abcdefghijkmnpqrstuvwxyz_-';
}
</pre>

== Precautions ==
Too few characters and too few character variations can cause unexpected problems.

== Installation ==
1. Upload the plugin package to the plugins directory.
2. Activate the plugin through the \'Plugins\' menu in WordPress.

== Screenshots ==

== Changelog ==
= 1.0 =
* first version.