=== Buzz This ===
Contributors: czepol
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=MDWYYSNEJMJWA
Tags: buzz, google, social, share, google buzz, button
Requires at least: 2.7.2 
Tested up to: 2.9.2
Stable tag: 1.5

== Description ==

This plug-in is used for displaying a button which let users to add links of your blog posts to Google Buzz. 
The button is delivered in two modes, being suitable for two languages: English ("buzz it") and Polish ("buzznij"). 
It lets you use either small or big type of Google Buzz button. You can post this button anywhere you want to, just 
using &lt;?php if(function_exists('buzz_button') { echo buzz_button(); } ?&gt; in source code of your template.
== Installation ==

Follow the steps below to install the plugin.

1. Upload the buzz-this directory to the /wp-content/plugins/ directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Go to "Buzz" option, configure and paste this code: <pre lang="php">&lt;?php if(function_exists('buzz_button') { echo buzz_button(); } ?&gt;</pre>

== Screenshots ==

== Help ==

For help please <a href="http://en.czepol.info/contact/">contact me</a>. 

== Changelog == 

<p>1.5 Added param 'srcTitle'.</p>
<p>1.3 Images are not now transparent.</p> 
<p>1.2 All images are now transparent.</p>
<p>1.1 Fixed display of images on a custom installations of wordpress (on installations which have not been installed in the root directory).</p>
<p>1.0 The first release of plugin <em>Buzz this</em>.</p>
