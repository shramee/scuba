<?php
/**
 * @package WordPress
 * @subpackage Traveler
 * @since 1.0
 *
 * form new login
 *
 * Created by ShineTheme
 *
 */
wp_enqueue_script( 'user.js' );

$_REQUEST['register_as'] = 'normal';
$_POST['register_as'] = 'normal';

$reset = 'false';
if(!empty($_REQUEST['btn_reg'])){
	$reset = STUser_f::registration_user();
}
$class_form = "";
if(is_page_template('template-login.php')){
	$class_form = 'form-group-ghost';
}
$btn_register = get_post_meta(get_the_ID(),'btn_register',true);
if(empty($btn_register))$btn_register=__("Register",ST_TEXTDOMAIN);
?>

<form  class="register_form" data-reset="<?php echo esc_attr($reset) ?>"  method="post" action="<?php echo esc_url(add_query_arg(array( 'url'=>STInput::request('url') )))?>" >
	<input type="hidden" name="register_as" value="<?php echo $_REQUEST['register_as'] ?>">

	<div class="row mt20 data_field">
		<div class="col-md-6">
			<div class="form-group <?php echo esc_attr($class_form); ?> form-group-icon-left">
				<label for="field-full_name"><?php st_the_language('full_name') ?></label>
				<i class="fa fa-user input-icon input-icon-show"></i>
				<input id="field-full_name" name="full_name" class="form-control" placeholder="<?php _e('e.g. John Doe',ST_TEXTDOMAIN)?>" type="text" value="<?php echo STInput::request('full_name') ?>" />
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group <?php echo esc_attr($class_form); ?> form-group-icon-left">
				<label for="field-email"><?php st_the_language('email') ?><span class="color-red"> (*)</span></label>
				<i class="fa fa-envelope input-icon input-icon-show"></i>
				<input id="field-email" name="email" class="form-control" placeholder="<?php _e('e.g. johndoe@gmail.com',ST_TEXTDOMAIN)?>" type="text" value="<?php echo STInput::request('email') ?>" />
			</div>
		</div>
	</div>

	<div class="row mt20 data_field">
		<div class="col-md-6">
			<div class="form-group <?php echo esc_attr($class_form); ?> form-group-icon-left">
				<label for="field-user_name"><?php _e("User Name",ST_TEXTDOMAIN) ?><span class="color-red"> (*)</span></label>
				<i class="fa fa-user input-icon input-icon-show"></i>
				<input id="field-user_name" name="user_name" class="form-control" placeholder="<?php _e('e.g. johndoe',ST_TEXTDOMAIN)?>" type="text" value="<?php echo STInput::request('user_name') ?>" />
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group <?php echo esc_attr($class_form); ?> form-group-icon-left">
				<label for="field-password"><?php st_the_language('password') ?><span class="color-red"> (*)</span></label>
				<i class="fa fa-lock input-icon input-icon-show"></i>
				<input id="field-password" name="password" class="form-control" type="password" placeholder="<?php _e('my secret password',ST_TEXTDOMAIN)?>" />
			</div>
		</div>
	</div>

	<div class="checkbox st_check_term_conditions mt20">
		<label>
			<input class="i-check term_condition" name="term_condition" type="checkbox" <?php if(STInput::post('term_condition')==1) echo 'checked'; ?>/><?php echo  st_get_language('i_have_read_and_accept_the').'<a target="_blank" href="'.get_the_permalink(st()->get_option('page_terms_conditions')).'"> '.st_get_language('terms_and_conditions').'</a>';?>
		</label>
	</div>
	<?php
	if(STRecaptcha::inst()->_is_check_allow_captcha()){
		?>
		<div class="form-group">
			<label for="field-login_password"><?php echo esc_html__('Captcha', ST_TEXTDOMAIN) ?></label>
			<div class="content-captcha">
				<?php echo do_shortcode(STRecaptcha::inst()->get_captcha()); ?>
			</div>
		</div>
	<?php } ?>
	<div class="text-center mt20">
		<input name="btn_reg" class="btn btn-primary btn-lg" type="hidden" value="register">
		<button class="btn btn-primary btn-lg" type="submit" ><?php echo esc_html($btn_register) ?></button>
	</div>
</form>