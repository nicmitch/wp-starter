# Start a new Project
1.  Lanciare il comando: `npm install`
2.  Modificare il file: `settings.json`
  1.  'publicPath' : path rel tema (es. '/wp-content/themes/nometema')
  2.  'devSiteName' : url sito web dev (es. 'http://www.nomesitoweb.test')
2.  Lanciare il comando: `gulp`

### Nel caso in cui il progetto sia un tema wordpress
1. Cambiare il **Theme Name** nello style.css ed eventualmente lo **screenshot**
2. Per comodità tra l'ambiente di sviluppo e l'ambiente di Staging/Deploy si può utilizzare questo wp-config settings https://github.com/nicmitch/multi-wp-config

## Build for staging
1.  Caricare via ftp (previa compilazione del file ftp-settings.json): `gulp deploy`

## Build for production
1.  Caricare via ftp (previa compilazione del file ftp-settings.json): `gulp deploy --mode public`

##### Plugins
Accertarsi di installare e attivare i plugin necessari dal tema:
*  ACF PRO (**obbligatorio per il funzionamento del tema**) -> [link](https://www.advancedcustomfields.com/)
*  Ajax Thumbnail Rebuild -> [link](https://wordpress.org/plugins/ajax-thumbnail-rebuild/)
*  Classic Editor -> [link](https://wordpress.org/plugins/classic-editor/)
*  Intuitive Custom Post Order -> [link](http://hijiriworld.com/web/plugins/intuitive-custom-post-order/)
*  WP Migrate DB -> [link](https://wordpress.org/plugins/wp-migrate-db/)
*  Yoast SEO -> [link](https://yoast.com/wordpress/plugins/seo/#utm_source=yoast-seo&utm_medium=software&utm_campaign=wordpress-general)
*  Smush -> [linl](https://it.wordpress.org/plugins/wp-smushit/) 

##### Backend
Salvare le opzioni globali e definire la pagina della privacy (All'inizio i field sono popolati dinamicamente e salvandoli verranno salvati i dati nel db)

## Versioni Node&Npm
Node v12.16.3<br>
Npm 6.4.1

### Cambiare automaticamente la versione di node

1. Nel file ```~/.bash_profile ```, dopo le righe di inizializzazione di nvm, aggiungere il codice seguente:

	```
		# place this after nvm initialization!
		autoload -U add-zsh-hook
		load-nvmrc() {
		if [[ -f .nvmrc && -r .nvmrc ]]; then
			nvm use
		elif [[ $(nvm version) != $(nvm version default)  ]]; then
			echo "Reverting to nvm default version"
			nvm use default
		fi
		}
		add-zsh-hook chpwd load-nvmrc
		load-nvmrc

	```
2. Nella cartella del tema, aggiungere un file ```.nvmrc``` e inserire il numero di versione di node. Per esempio: 12.16.3


Dopo quessta impostazione il terminale modifica automaticamente la versione di npm quando entra in una cartella con un file .nvmrc.