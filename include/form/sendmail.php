<?php
// Require PHPMailer
require 'PHPMailer/PHPMailerAutoload.php';

// Load Wordpress without theme support
define( 'WP_USE_THEMES', false ); // Don't load theme support functionality
require( '../../../../../wp-load.php' );



/*
	Attachment settings
*/
$uploaded_file = false;
$file_input_name = 'formfile';
$file_max_size = 3145728; // 3 MB
$file_allowed_types = array(
	'image/png',
	'image/jpg',
	'image/jpeg',
	'application/pdf'
);



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



/*
	Handle file upload and send as attachment
*/
if( isset($_FILES[$file_input_name]['tmp_name']) ){

	$uploaded_file = $_FILES[$file_input_name]['tmp_name'];
	$uploaded_file_name = trim(str_replace(" ", "-", $_FILES[$file_input_name]['name']));

	if(is_uploaded_file($uploaded_file)){
		// Check size
		$uploaded_file_size = $_FILES[$file_input_name]['size'];
		if($uploaded_file_size > $file_max_size){
			// error
			if($is_ajax){
				echo "{\"success\": false, \"errormsg\": \"Upload size limit error\"}";
			}else{
				//echo "Upload size limit error";
				header ('Location: ' . str_replace('?senderror=1', '', $_SERVER['HTTP_REFERER']) . '?senderror=2');
			}

			exit();
		}

		// Check file type
		$uploaded_file_type = $_FILES[$file_input_name]['type'];
		if(!in_array($uploaded_file_type, $file_allowed_types)){
			// error
			if($is_ajax){
				echo "{\"success\": false, \"errormsg\": \"Upload type error\"}";
			}else{
				//echo "Upload type error ($uploaded_file_type)";
				header ('Location: ' . str_replace('?senderror=1', '', $_SERVER['HTTP_REFERER']) . '?senderror=2.1');
			}

			exit();
		}
	}
}



/*
	Setup the mail sending with PHPMailer
*/
$mail = new PHPMailer;
//$mail->SMTPDebug = 2;

$mail->CharSet = 'UTF-8';
$mail->setFrom($sender, $sitename);
$mail->AddAddress($recipient);
if ($recipient_bcc){
	$mail->AddBCC($recipient_bcc);
}

$mail->IsHTML(true);
$mail->Subject = $subject;
$mail->Body = $mail_message_body;

//Aggiungo parametro random per non permettere il raggruppamento
$mail->addCustomHeader('X-Entity-Ref-ID: '. $random_number);

//Address to which recipient will reply
$mail->ClearReplyTos();
$mail->addReplyTo( $mail_sender , $sender_name);

// also send plain text mail
$mail_message_plain = str_replace("<br>", "\r\n", $mail_message);
$mail->AltBody = $mail_message_plain;

// Handle sending via SMTP
if($smtp_enabled){
	$mail->isSMTP();
	$mail->Host = $smtp_server;
	$mail->Port = $smtp_port;

	// Handle SMTP authentication
	$mail->SMTPAuth = $smtp_auth_enabled;
	if($smtp_auth_enabled){
		$mail->Username = $smtp_username;
		$mail->Password = $smtp_password;
	}

	if($smtp_secure != "false"){
		$mail->SMTPSecure = $smtp_secure;
	}
}

// handle attachment
if(is_uploaded_file($uploaded_file)){
	if(!$mail->AddAttachment($uploaded_file, $uploaded_file_name)){
		if($is_ajax){
			echo "{\"success\": false, \"errormsg\": \"Add attachment error\"}";
		}else{
			//echo "Add attachment error";
			header ('Location: ' . str_replace('?senderror=1', '', $_SERVER['HTTP_REFERER']) . '?senderror=2.2');
		}
	}
}



/*
	Send the Mail
*/
if(!$mail->Send()){
	// Mail sending error
	if($is_ajax){
		echo "{\"success\": false, \"errormsg\": \"$mail->ErrorInfo\"}";
	}else{
		header('Location: ' . str_replace('?senderror=1', '', $_SERVER['HTTP_REFERER']) . '?senderror=1');
	}
}else{
	// Mail sending ok
	if($is_ajax){
		echo "{\"success\": true}";
	}else{
		header('Location: ' . $post_submit_page);
	}
}
?>
