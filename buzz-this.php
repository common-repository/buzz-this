<?php
/*
Plugin Name: Buzz this!
Plugin URI: http://en.czepol.info/plugins/buzz-this/
Description: This plugin displays Google Buzz button.
Author: Marcin Szepczyński (czepol)
Version: 1.5
Author URI: http://czepol.info/
*/

function buzz_options() {
	add_menu_page('Buzz', 'Buzz', 8, basename(__FILE__), 'buzz_options_page', WP_PLUGIN_URL.'/'.str_replace(basename( __FILE__),"",plugin_basename(__FILE__)).'img/ico.png');
	add_submenu_page(basename(__FILE__), 'Settings', 'Settings', 8, basename(__FILE__), 'buzz_options_page');
}
function buzz_init(){
    if(function_exists('register_setting')){
        register_setting('buzz-options', 'buzz_lang');
		register_setting('buzz-options', 'buzz_button_type');
    }
}

function buzz_button() {
global $post;
$lang = get_option('buzz_set_lang');
$type = get_option('buzz_button_type');
$url = get_permalink();
$post = get_post(get_the_ID());
$title = $post->post_title;
$title = urlencode($title);
$site_url = get_bloginfo('url');
$site_title = get_bloginfo('name');
if($type=='normal') {
	$img_name = 'buzz-button-'.$lang.'.png';
} else if($type=='mini') {
	$img_name = 'buzz-button-mini-'.$lang.'.png';
}
$img_src = WP_PLUGIN_URL.'/'.str_replace(basename( __FILE__),"",plugin_basename(__FILE__)).'img/'.$img_name;
$buzz_url = 'http://www.google.com/reader/link?url='.$url.'&amp;title='.$title.'&amp;srcUrl='.$site_url.'&amp;srcTitle='.$site_title;
echo '<a href='.$buzz_url.'><img id="buzz" src='.$img_src.' alt="buzz_button" /></a>';
}

if(is_admin()){
    add_action('admin_menu', 'buzz_options');
    add_action('admin_init', 'buzz_init');
	add_option('buzz_set_lang', 'en');
	add_option('buzz_button_type', 'normal');
}

function buzz_options_page() {
if($_POST) {
	$new_lang = $_POST['buzz_set_lang'];
	$new_button_type = $_POST['buzz_button_type'];
	update_option('buzz_set_lang', $new_lang);
	update_option('buzz_button_type', $new_button_type);
}
?>
    <div class="wrap">
    <div class="icon32" id="icon-options-general"><br/></div><h2><?php $lang=get_option('buzz_set_lang'); if($lang=='en') { echo "Buzz settings"; } else if($lang=='pl') { echo "Ustawienia buzza"; }?></h2>
    <p>
		<?php
		$message['pl']['1'] = 'To jest bardzo prosta wtyczka, w której można ustawić język i typ przycisku. Dzięki temu, będziesz mógł za pomocą poniższego kodu umieścić na swoim blogu przycisk do Buzza:';
    	$message['en']['1'] = 'This is a very simple plugin. Set a language, type of button and paste this code in a place where you want to display the Buzz button:';
		$message['other']['1'] = $message['en']['1'];		
		echo $message[$lang]['1'];
		?>
		<br />
		<code>&lt;?php if(function_exists('buzz_button')) { buzz_button(); } ?&gt;</code>
	</p>
	<table class="form-table">
	<?php
		$message['pl']['2'] = 'Aktualny język: ';
		$message['en']['2'] = 'Current language: ';
		$message['other']['2'] = $message['en']['2'];        
		$message['pl']['3'] = 'Dostępne języki:';
		$message['en']['3'] = 'Available languages:';
		$message['other']['3'] = $message['en']['3'];
		$message['pl']['4'] = 'Wygląd przycisku:';
		$message['en']['4'] = 'Button appearance:';
		$message['other']['4'] = $message['en']['4'];
		$message['pl']['5'] = 'Normalny';
		$message['en']['5'] = 'Standard';
		$message['other']['5'] = $message['en']['5'];
		$message['pl']['6']= 'Mini';
		$message['en']['6']= 'Mini';
		$message['other']['6']= $message['en']['6'];
		$message['pl']['7']= 'Masz jakieś uwagi, propozycje? Skontaktuj się ze mną: <a href="mailto:szepczynski@gmail.com">szepczynski@gmail.com</a>';
		$message['en']['7']= 'If you want contact with me, the best way is email: <a href="mailto:szepczynski@gmail.com">szepczynski@gmail.com</a>';
		$message['other']['7']= $message['en']['7'];
	?>
	<form method="post" action="">
		<tr>
		    <th scope="row">
                <?php echo $message[$lang]['2']; ?>
            </th>
			<td>
				<?php if($lang=='en') { echo "English"; } else if($lang=='pl') { echo "Polski"; }	else if($lang=='other') { echo "Other language"; } ?>
			</td>		
		</tr>
		<tr>
			<th scope="row">
				<?php echo $message[$lang]['3']; ?>
			</th>
			<td>
				<select name='buzz_set_lang'>
					<option <?php if(get_option('buzz_set_lang')=='pl') { echo 'selected="selected"'; }?> value='pl'>Polski</option>
					<option <?php if(get_option('buzz_set_lang')=='en') { echo 'selected="selected"'; }?> value='en'>English</option>
					<option <?php if(get_option('buzz_set_lang')=='other') { echo 'selected="selected"'; }?> value='other'>Other</option>
				</select>
			</td>
		</tr>	
		<tr>
			<th>
				<?php echo $message[$lang]['4']; ?>
			</th>
			<td>
				<table>
					<tr>
						<th>
							<input type="radio" id="buzz_button_type_1" name="buzz_button_type" value="normal" <?php if (get_option('buzz_button_type') == 'normal') echo 'checked="checked"'; ?>/>
							<label for="buzz_button_type_1"><?php echo $message[$lang]['5']; ?></label>
						</th>
						<td>
							<a href="#standard_button"><img id="standard_button" src="<?php echo WP_PLUGIN_URL.'/'.str_replace(basename( __FILE__),"",plugin_basename(__FILE__)); ?>img/buzz-button-<?php echo $lang; ?>.png" /></a>
						</td>
					</tr>
					<tr>			
						<th>					
							<input type="radio" id="buzz_button_type_2" name="buzz_button_type" value="mini" <?php if (get_option('buzz_button_type') == 'mini') echo 'checked="checked"'; ?>/>
							<label for="buzz_button_type_2"><?php echo $message[$lang]['6']; ?></label>
						</th>
						<td>						
							<a href="#mini_button"><img id="mini_button" src="<?php echo WP_PLUGIN_URL.'/'.str_replace(basename( __FILE__),"",plugin_basename(__FILE__)); ?>img/buzz-button-mini-<?php echo $lang; ?>.png" /></a>	
						</td>
					</tr>
				</table>					
			</td>			
		</tr>
		
        <tr>
		<td><p class="submit">
            <input type="submit" name="Submit" value="<?php _e('Save Changes') ?>" />
        </p>
		</td>
		</tr>
	</form>
	</table>
	<p>
		<?php echo $message[$lang]['7'];?>
	</p>
	<p>
		<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
		<input type="hidden" name="cmd" value="_s-xclick">
		<input type="hidden" name="hosted_button_id" value="MDWYYSNEJMJWA">
		<input type="image" src="https://www.paypal.com/en_US/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
		<img alt="" border="0" src="https://www.paypal.com/pl_PL/i/scr/pixel.gif" width="1" height="1">
		</form>
	</p>
	<p>
		<code>IMPORTANT! If you chose a other language, you must copy/create image to /wp-content/plugins/buzz-this/img/buzz-button-other.png and /wp-content/plugins/buzz-this/img/buzz-button-mini-other.png.</code>
	</p>
<?php } ?>
