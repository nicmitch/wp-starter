<?php


// Load Wordpress without theme support
define( 'WP_USE_THEMES', false ); // Don't load theme support functionality
require( '../../../../../wp-load.php' );

if(!$_POST['recipient']){
	header("HTTP/1.0 403 Forbidden",);
	die();
}

/*
	Get smtp settings from backend global fields
*/
$smtp_enabled = get_field('smtp_enabled', 'option');
$smtp_server = get_field('smtp_server', 'option');
$smtp_auth_enabled = get_field('smtp_authentication', 'option');
$smtp_username = get_field('smtp_username', 'option');
$smtp_password = get_field('smtp_password', 'option');
$smtp_secure = get_field('smtp_secure', 'option');
$smtp_port = get_field('smtp_port', 'option');
$mail_template = "johnnyword.mail.html"; // New template based on Foundation Email



/*
	Mail setup
*/
//$mail->addCustomHeader('X-Entity-Ref-ID:'. rand(1000, 10000));
$recipient = $_POST['recipient'];
//	 Aggiunto check sul campo recipient non sempre presente
$recipient_bcc = isset($_POST['recipient_bcc']) ? $_POST['recipient_bcc'] : false;
$subject = $_POST['subject'];
$post_submit_page = $_POST['post_submit_page'];
$sender = get_field( 'form_mail_sender', 'option' );

//	 Aggiunto check singolo sui campi nome e cognome in modo che se manca un campo non và in errore lo script
$sender_name = isset($_POST['Nome']) ? $_POST['Nome'] : $sender;
$sender_name .= isset($_POST['Cognome']) ? " " . $_POST['Cognome'] : "";
$sitename = get_bloginfo('name');
$is_ajax = ($_POST['form_is_ajax'] == 1) ? true : false;
//Inserire il nome file corretto del logo. Gli SVG non sono supportati
$logo = get_field('logo_mail', 'option');
$logo_src = $logo['sizes']['large'];
$mail_color = get_field( 'form_mail_color', 'option' );
$mail_sender = $_POST['Email'];

//Genero un numero random per non far raggruppare le email
$random_number = rand(100000,999999);

if($recipient_bcc){
	$recipient_email = array($recipient, $recipient_bcc);
}else{
	$recipient_email = $recipient;
}

/*
	Mail content
*/
// Mail content header and footer
$mail_header_field = $_POST['mail_message_header'];
$mail_header = $mail_header_field ? str_replace('\n', chr(10), stripslashes($mail_header_field)) . '<br>' : '';
$mail_footer_field = $_POST['mail_message_footer'];
$mail_footer = $mail_footer_field ? '<br>' . str_replace('\n', chr(10), stripslashes($mail_footer_field)) : '';

// Send via Mail only POST fields that starts with uppercase letter
$mail_message = "";
while (list($key, $val) = each($_POST)){
    if(ctype_upper($key[0]) && $key != "HNome"){
        $mail_message .=  $key . ": " . $val . "<br>";
    }
}

// Mail content: compose final mail_header and mail_message; mail_footer goes outside content
$mail_message = $mail_header . $mail_message;

// Html mail content: load template and replace the placeholers inside it
$mail_message_body = file_get_contents($mail_template);
$mail_message_body = str_replace('[MAIL_CONTENT]', $mail_message, $mail_message_body);
$mail_message_body = str_replace('[SITENAME]', $sitename, $mail_message_body);
$mail_message_body = str_replace('[LOGO_SRC]', $logo_src, $mail_message_body);
$mail_message_body = str_replace('[MAIL_COLOR]', $mail_color, $mail_message_body);
$mail_message_body = str_replace('[MAIL_FOOTER]', $mail_footer, $mail_message_body);


if($smtp_enabled){
	add_action( 'phpmailer_init', 'mailer_config', 10, 1);
	function mailer_config(PHPMailer $mailer){
	$mailer->IsSMTP();
	$mailer->Host = $smtp_server;
	$mailer->Port = $smtp_port;
	$mailer->SMTPDebug = 2;
	$mailer->CharSet  = "utf-8";
	$mailer->SMTPAuth = $smtp_auth_enabled;
		if($smtp_auth_enabled){
			$mailer->Username = $smtp_username;
			$mailer->Password = $smtp_password;
		}

		if($smtp_secure != "false"){
			$mailer->SMTPSecure = $smtp_secure;
		}
	}
}


/*
	Setup the mail sending with wp_mail
*/


// Email Sender

add_filter( 'wp_mail_content_type', 'wpdocs_set_html_mail_content_type' );

	$headers = array(
		'Reply-To:' . $mail_sender,
		'Content-Type: text/html; charset=UTF-8',
		'From: '.$sitename.' <'.$sender.'>',
		'X-Entity-Ref-ID: '. $random_number,
		'Location: ' . $post_submit_page,
	  );
	
	$sent = wp_mail($recipient_email, $subject, $mail_message_body, $headers );
	
	// Reset content-type to avoid conflicts -- https://core.trac.wordpress.org/ticket/23578
	remove_filter( 'wp_mail_content_type', 'wpdocs_set_html_mail_content_type' );
	 
	function wpdocs_set_html_mail_content_type() {
		return 'text/html';
	}

	if($sent) {
		if($is_ajax){
			echo "{\"success\": true}";
		}else{
			header("Location:" .$post_submit_page);
		}
		exit();
	}//message sent!
	else  {
		
		if($is_ajax){
			echo "{\"success\": false, \"errormsg\": \"$mail->ErrorInfo\"}";
		}else{
			header('Location: ' . str_replace('?senderror=1', '', $_SERVER['HTTP_REFERER']) . '?senderror=1');
		}
	}//message wasn't sent
?>
