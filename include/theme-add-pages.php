<?php

/*
	Theme Activation function
	triggered on the request immediately following a theme switch.
*/
function _johnnyword_add_sample_pages() {

    // Create example content page
    //_johnnyword_addFirstPost();
    _johnnyword_addDemoPage();

    // Create privacy page
    _johnnyword_addPrivacyPage();

    // Create contacts page
    _johnnyword_addContactsPage();

    // Create thankyou page
    //_johnnyword_addThankyouPage();

}
add_action( 'after_switch_theme', '_johnnyword_add_sample_pages' );



function _johnnyword_addDemoPage(){

	global $wpdb;

	$page_name = $wpdb->get_var("SELECT ID FROM $wpdb->posts WHERE post_name='demo-page'");

	 if ($page_name == '') {

		global $user_ID;

		$post_content = "";

		$new_post = array(
			'post_title' => 'Demo page',
			'post_content' => $post_content,
			'post_name' => 'demo-page',
			'post_status' => 'publish',
			'post_date' => date('Y-m-d H:i:s'),
			'post_author' => $user_ID,
      'page_template' => 'demo.php',
			'post_type' => 'page'
		);
		$post_id = wp_insert_post($new_post);

	}

}


function _johnnyword_addFirstPost(){

	global $wpdb;

	$page_name = $wpdb->get_var("SELECT ID FROM $wpdb->posts WHERE post_name='sample-page'");

	 if ($page_name == '') {

		global $user_ID;


		$post_content = <<<END

    <div class="row row--demo">
      <div class="column">column</div>
      <div class="column">column</div>
      <div class="column">column</div>
      <div class="column">column</div>
      <div class="column">column</div>
    </div>

		<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
		tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
		quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
		Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
		Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>

		<h1>h1. heading</h1>
		<h2>h2. heading</h2>
		<h3>h3. heading</h3>
		<h4>h4. heading</h4>
		<h5>h5. heading</h5>
		<h6>h6. heading</h6>

		<h1>h1. heading <small>Secondary text</small></h1>
		<h3>h3. heading <small>Secondary text</small></h3>
		<h2>h2. heading <small>Secondary text</small></h2>
		<h4>h4. heading <small>Secondary text</small></h4>
		<h5>h5. heading <small>Secondary text</small></h5>
		<h6>h6. heading <small>Secondary text</small></h6>

		<p>You can use the mark tag to <mark>highlight</mark> text.</p>

		<del>This line of text is meant to be treated as deleted text.</del>

		<s>This line of text is meant to be treated as no longer accurate.</s>

		<ins>This line of text is meant to be treated as an addition to the document.</ins>

		<u>This line of text will render as underlined</u>

		<small>This line of text is meant to be treated as fine print.</small>

		<strong>rendered as bold text</strong>

		<em>rendered as italicized text</em>


		<h2>Abbreviations</h2>
		An abbreviation of the word attribute is <abbr title="attribute">attr</abbr>

		<h2>Initialism</h2>
		<abbr title="HyperText Markup Language" class="initialism">HTML</abbr> is the best thing since sliced bread.

		<h2>Addresses</h2>
		<address>
		  <strong>Twitter, Inc.</strong><br>
		  795 Folsom Ave, Suite 600<br>
		  San Francisco, CA 94107<br>
		  <abbr title="Phone">P:</abbr> (123) 456-7890
		</address>

		<address>
		  <strong>Full Name</strong><br>
		  <a href="mailto:#">first.last@example.com</a>
		</address>


		<h2>Blockquote</h2>
		<blockquote>
		  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
		</blockquote>

		<blockquote>
		  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
		  <footer>Someone famous in <cite title="Source Title">Source Title</cite></footer>
		</blockquote>


		<h2>List</h2>

		<h3>Ul</h3>
		<ul>
			<li>list1</li>
			<li>list2</li>
			<li>list3</li>
			<li>list4</li>
		</ul>

		<h3>Ol</h3>
		<ol>
			<li>list1</li>
			<li>list2</li>
			<li>list3</li>
			<li>list4</li>
		</ol>


		<h2>Description</h2>
		<dl>
		  <dt>Description lists</dt>
		  <dd>A description list is perfect for defining terms.</dd>
		  <dt>Description lists</dt>
		  <dd>Vestibulum id ligula porta felis euismod semper eget lacinia odio sem nec elit.
Donec id elit non mi porta gravida at eget metus.</dd>
		</dl>

		<dl class="dl-horizontal">
		  <dt>Description lists Euismod</dt>
		  <dd>A description list is perfect for defining terms.
Vestibulum id ligula porta felis euismod semper eget lacinia odio sem nec elit.
Donec id elit non mi porta gravida at eget metus.</dd>
		</dl>


		<h2>Buttons</h2>
		<a class="btn btn-default" href="#" role="button">Link</a>
		<button class="btn btn-default" type="submit">Button</button>
		<input class="btn btn-default" type="button" value="Input">
		<input class="btn btn-default" type="submit" value="Submit">

		<h3>Buttons Options</h3>
		<button type="button" class="btn ">Default</button>
		<button type="button" class="btn primary">Primary</button>
		<button type="button" class="btn secondary">Secondary</button>
		<button type="button" class="btn success">Success</button>
		<button type="button" class="btn warning">Warning</button>
		<button type="button" class="btn alert">Alert</button>

		<h3>Buttons Sizes</h3>
		<button type="button" class="btn">Default</button>
		<button type="button" class="btn tiny">Tiny</button>
		<button type="button" class="btn small">Small</button>
		<button type="button" class="btn large">Large</button>
		<button type="button" class="btn expanded">Expanded</button>
		<button type="button" class="btn small expanded">Small expanded</button>

		<h2>Form</h2>
		[form]
END;

		$new_post = array(
			'post_title' => 'Sample page',
			'post_content' => $post_content,
			'post_name' => 'sample-page',
			'post_status' => 'publish',
			'post_date' => date('Y-m-d H:i:s'),
			'post_author' => $user_ID,
			'post_type' => 'page'
		);
		$post_id = wp_insert_post($new_post);

	}

}



function _johnnyword_addPrivacyPage(){

	global $wpdb;

	$page_name = $wpdb->get_var("SELECT ID FROM $wpdb->posts WHERE post_name='privacy'");

	 if ($page_name == '') {

		global $user_ID;


		$post_content = <<<END

		  <p>In questa pagina si descrivono le modalità e le logiche del trattamento dei dati personali degli utenti (di seguito Utenti) che consultano il sito: <a href="#">www.evostudios.it</a>. La validità dell’informativa contenuta nella presente pagina è limitata al presente sito e non si estende ad altri siti web eventualmente consultabili mediante collegamento ipertestuale.</p>
		  <h4>Il titolare del trattamento</h4>
		  <p>Il Titolare del trattamento per i dati raccolti attraverso il Sito è:</p>
		  <p>EVO Studios di Raimondo Alessandro<br>
		  <p>Via G. Villeneuve, 22 - 25080 Muscoline (BS)<br>
		  Email: <a href="mailto:info@evostudios.it">info@evostudios.it</a></p>

		  <h4>Incaricati, responsabili e sedi del trattamento dei dati</h4>
		  <p>I dati saranno trattati da personale del Titolare, previa nomina dei dipendenti e dei collaboratori interessati ad Incaricati del trattamento. Eventuali soggetti terzi ai quali i dati potrebbero essere comunicati per l’esecuzione di operazioni di trattamento connesse con le finalità specificate nella presente informativa, saranno preventivamente designati dal Titolare quali Responsabili del trattamento ai sensi dell’art. 29 del Codice in materia di protezione dei dati personali. I dati non formeranno oggetto di diffusione. Tutti i dati raccolti saranno trattati presso la sede del Titolare.</p>

		  <h4>Tipologia di dati raccolti</h4>
		  <p><strong>Dati di navigazione</strong></p>
		  <p>I sistemi informatici e le procedure software preposte al funzionamento di questo sito web acquisiscono, nel corso del loro normale esercizio, alcuni dati personali la cui trasmissione è implicita nell'uso dei protocolli di comunicazione di Internet. Si tratta di informazioni che non sono raccolte per essere associate a interessati identificati, ma che per loro stessa natura potrebbero, attraverso elaborazioni ed associazioni con dati detenuti da terzi, permettere di identificare gli utenti. In questa categoria di dati rientrano gli indirizzi IP o i nomi a dominio dei computer utilizzati dagli utenti che si connettono al sito, gli indirizzi in notazione URI (Uniform Resource Identifier) delle risorse richieste, l'orario della richiesta, il metodo utilizzato nel sottoporre la richiesta al server, la dimensione del file ottenuto in risposta, il codice numerico indicante lo stato della risposta data dal server (buon fine, errore, ecc.) ed altri parametri relativi al sistema operativo e all'ambiente informatico dell'utente. Questi dati vengono utilizzati al solo fine di ricavare informazioni statistiche anonime sull'uso del sito e per controllarne il corretto funzionamento e vengono cancellati immediatamente dopo l'elaborazione. I dati potrebbero essere utilizzati per l'accertamento di responsabilità in caso di ipotetici reati informatici ai danni del sito: salva questa eventualità, allo stato i dati sui contatti web non persistono per più di sette giorni. </p>
		  <p><strong>Dati forniti volontariamente dall’utente </strong></p>
		  <p>L'invio facoltativo, esplicito e volontario di posta elettronica agli indirizzi indicati su questo sito, in modo diretto e tramite moduli di contatto o di iscrizione alla newsletter, comporta la successiva acquisizione dell’indirizzo email del mittente, necessario per rispondere alle richieste o per fornire i servizi richiesti, nonché degli eventuali altri dati personali inseriti nella comunicazione.</p>

		  <h4>Cookies</h4>
		  <p>I cookies sono piccoli file di testo che i siti visitati inviano al terminale dell'Utente, dove vengono memorizzati, per poi essere ritrasmessi agli stessi siti alla visita successiva. Il Sito utilizza cookies tecnici per salvare le preferenze di navigazione e migliorare l’esperienza d’uso del sito. Possono rientrare in questa categoria i cookies che gestiscono eventuali autenticazioni o impostazioni dell’utente. Il sito utilizza inoltre cookies di terze parti, tecnici, di analytics o di profilazione, con le seguenti finalità:</p>
		  <ul>
			  <li><strong>Statistica e analisi</strong>: per permettere al Titolare di monitorare e analizzare i dati di traffico sul sito e analizzare i comportamenti dell’Utente, al fine di migliorare il servizio svolto. Tali dati sono raccolti rendendo anonimo l’indirizzo IP dell’Utente.</li>
			  <li><strong>Integrazione di contenuti esterni</strong>: per visualizzare e interagire con eventuali contenuti ospitati su siti terzi e integrati nel sito (mappe, video, ecc.).</li>
		  </ul>
		  <p><strong>Riferimenti alle privacy policy di terze parti </strong></p>
		  <p>Google Analytics - Luogo del trattamento: USA - <a href="https://www.google.com/intl/it/policies/privacy/" target="_blank">Privacy policy</a> </p>
		  <p>Google Maps - Luogo del trattamento: USA - <a href="https://www.google.com/intl/it/policies/privacy/" target="_blank">Privacy policy</a></p>

		  <p><strong>Abilitare o disabilitare i cookies </strong></p>
		  <p>L’Utente può scegliere di abilitare o disabilitare i cookies intervenendo sulle impostazioni del proprio browser di navigazione secondo le istruzioni rese disponibili dai relativi fornitori. La disabilitazione dei cookies di sessione può comportare l’impossibilità per l’Utente di fruire correttamente di tutte le funzionalità del sito. Ulteriori modalità per la gestione dei cookies di terze parti:</p>
		  <ul>
			  <li>Attraverso il sito dell’associazione EDAA: <a href="www.youronlinechoices.com" target="_blank">www.youronlinechoices.com</a></li>
			  <li>Direttamente nelle sezioni Privacy Policy delle rispettive terze parti</li>
		  </ul>

		  <h4>Facoltatività del conferimento dei dati</h4>
		  <p>A parte quanto specificato per i dati di navigazione, il conferimento dei dati attraverso i form e gli indirizzi email presenti sul sito ovvero le comunicazioni trasmesse su base volontaria dallo stesso Utente, ha sempre natura facoltativa; tuttavia, in caso di mancato conferimento dei dati contrassegnati come obbligatori all’interno dei moduli di richiesta, non sarà possibile fornire all’Utente il servizio di volta in volta richiesto.</p>

		  <h4>Modalità del trattamento</h4>
		  <p>I dati personali sono trattati con strumenti automatizzati per il tempo strettamente necessario a conseguire gli scopi per cui sono stati raccolti. Il Titolare adotta tutte le misure di sicurezza previste dal Codice privacy per proteggere i dati raccolti, al fine di scongiurare i rischi di perdita o furto dei dati, accessi non autorizzati, usi illeciti e non corretti.</p>

		  <h4>Diritti degli interessati</h4>
		  <p>Gli Utenti possono esercitare in qualsiasi momento i diritti previsti dall’art. 7 del Codice privacy, al fine di ottenere la conferma dell'esistenza o meno dei loro dati personali e di conoscerne il contenuto e l'origine, verificarne l'esattezza o chiederne l'integrazione o l'aggiornamento, oppure la rettificazione. Ai sensi della medesima disposizione l’Utente potrà inoltre chiedere la cancellazione, la trasformazione in forma anonima o il blocco dei dati trattati in violazione di legge, nonché opporsi in ogni caso, per motivi legittimi, al loro trattamento. Le richieste vanno rivolte al Titolare.</p>

		  <h4>Aggiornamenti</h4>
		  <p>La privacy policy di questo sito può essere soggetta ad aggiornamenti. Gli Utenti sono pertanto invitati a verificarne periodicamente il contenuto.</p>
		  
		END;

		$new_post = array(
			'post_title' => 'Privacy',
			'post_content' => $post_content,
			'post_name' => 'privacy',
			'post_status' => 'publish',
			'post_date' => date('Y-m-d H:i:s'),
			'post_author' => $user_ID,
			'post_type' => 'page'
		);
		$post_id = wp_insert_post($new_post);

	}

}



function _johnnyword_addContactsPage(){
	global $wpdb;

	$page_name = $wpdb->get_var("SELECT ID FROM $wpdb->posts WHERE post_name='contacts-page'");
	if ($page_name == '') {
		global $user_ID;

		$post_content = <<<END
END;

		$new_post = array(
			'post_title' => 'Contatti',
			'post_content' => $post_content,
			'post_name' => 'contatti',
			'post_status' => 'publish',
			'post_date' => date('Y-m-d H:i:s'),
			'post_author' => $user_ID,
			'post_type' => 'page',
			'page_template' => 'template-contatti.php'
		);
		$post_id = wp_insert_post($new_post);

	}
}



function _johnnyword_addThankyouPage(){
	global $wpdb;

	$page_name = $wpdb->get_var("SELECT ID FROM $wpdb->posts WHERE post_name='thankyou-page'");
	if ($page_name == '') {
		global $user_ID;

		$post_content = <<<END
		<p>Richiesta inviata con successo.</p>
END;

		$new_post = array(
			'post_title' => 'Richiesta inviata correttamente',
			'post_content' => $post_content,
			'post_name' => 'richiesta-inviata-correttamente',
			'post_status' => 'publish',
			'post_date' => date('Y-m-d H:i:s'),
			'post_author' => $user_ID,
			'post_type' => 'page'
		);
		$post_id = wp_insert_post($new_post);

	}
}
