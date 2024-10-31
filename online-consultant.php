<?php
/*
Plugin Name: Online-Consultant
Description: Онлайн косультант для вашего сайта.  
Author: Saint739 
Author URI: https://online-consultant.biz/
Version: 0.1.4
License: GPLv2
 */
register_activation_hook( __FILE__, 'onlineconsultantbiz_plugin_activate' );
function onlineconsultantbiz_plugin_activate() {
	add_option('onlineconsultantbiz_icode','');
}

function onlineconsultantbiz_admin_link()
{
 add_menu_page( "Online-Consultant", "Online-Consultant", 'manage_options','onlineconsultantbiz_admin_page.php', 'onlineconsultantbiz_admin','dashicons-cloud', 90 );
}

function onlineconsultantbiz_admin() {
	onlineconsultantbiz_add_icode();
	onlineconsultantbiz_plugintext_1();
	onlineconsultantbiz_form_icode();
	onlineconsultantbiz_plugintext_2();
	onlineconsultantbiz_textarea_iscript();
	}

function onlineconsultantbiz_plugintext_1(){
	?><h2>Online-Consultant</h2><hr>
	<p>Бесплатный онлайн-чат для вашего сайта,бизнеса, интернет-магазина.</p>
	<hr><?php
}
function onlineconsultantbiz_plugintext_2(){
	?><p><b>Установка:</b></p>
	<p>1) Зарегистрируйтесь на сайте <a href="https://online-consultant.biz/" target="_blank">online-consultant.biz</a> </p>
	<p>2) Добавьте ваш сайт</p>
	<p>3) Скопируйте ID из меню интеграции, вставьте в поле и нажмите сохранить</p>
	<p>4) Обновите страницу сайта</p>
	<hr>
	<p><b>Если чат на сайте не появился или не работает:</b></p>
	<p>1) Проверьте правильность введённого ID </p>
	<p>2) Обратитесь в службу технической поддержки.<br>
	Актуальные контакты на нашем сайте <a href="https://online-consultant.biz/" target="_blank">online-consultant.biz</a></p><?php
}

function onlineconsultantbiz_add_icode(){
	if (isset($_POST['onlineconsultantbiz_form_icode_btn']))
	{
		$onlineconsultantbiz_icode = preg_replace('/[^A-Za-z0-9]/', '', $_POST['onlineconsultantbiz_icode']);
		update_option('onlineconsultantbiz_icode', $onlineconsultantbiz_icode);
	}
}

function onlineconsultantbiz_form_icode(){
?><form name='oc_form_id' method='post' action='admin.php?page=onlineconsultantbiz_admin_page.php' >
		<p><b>Введите ID вашего сайта в системе Online-Consultant:</b></p>
		<p><input type='text' name='onlineconsultantbiz_icode' value=' <?php echo get_option('onlineconsultantbiz_icode')?> '  size='35'> <input type='submit' name='onlineconsultantbiz_form_icode_btn' value='Сохранить'></p>
	</form><?php
}

function onlineconsultantbiz_textarea_iscript(){
?><hr><p><b>Устанавливаемый код:</b></p>
<textarea cols='100' readonly	rows='7' style='resize : none; overflow : auto;' >
<?php onlineconsultantbiz_iscript();?>
</textarea><?php
}

function onlineconsultantbiz_iscript(){
?><!-- Online-consultant.biz -->
<script async src="//widget.online-consultant.biz/js/oc.js?id=<?php echo "".get_option('onlineconsultantbiz_icode')."";?>"></script>
<script>
window.oc = window.oc || function (){(window.oc.a=window.oc.a||[]).push(arguments);}
</script>
<!-- Online-consultant.biz --><?php
}
add_action( 'admin_menu', 'onlineconsultantbiz_admin_link' );
add_action( 'wp_footer', 'onlineconsultantbiz_iscript' );