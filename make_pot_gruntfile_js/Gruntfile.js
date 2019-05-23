module.exports = function(grunt) {

	require('load-grunt-tasks')(grunt);
	
	// Project configuration.
	grunt.initConfig({
		pkg: grunt.file.readJSON('package.json'),

		makepot: {
			target: {
				options: {
					domainPath: '/languages/',             // Where to save the POT file.
//					mainFile: 'style.css',                 // Main project file.
					potFilename: 'miprimerplugin-grunt.pot',              // Name of the POT file.
					type: 'wp-plugin',                      // Type of project (wp-plugin or wp-theme).
					exclude: ['file-1.php', 'file-2.php'], // List of files or directories to ignore.
					processPot: function( pot, options ) {
						pot.headers['report-msgid-bugs-to'] = 'https://beziercode.com.co';
						pot.headers['plural-forms'] = 'nplurals=2; plural=n != 1;';
						pot.headers['last-translator'] = 'Gilbert Rodríguez <webmaster@beziercode.com.co>\n';
						pot.headers['language-team'] = 'Gilbert Rodríguez <webmaster@beziercode.com.co>\n';
						pot.headers['x-poedit-basepath'] = '.\n';
						pot.headers['x-poedit-language'] = 'Spanish\n';
						pot.headers['x-poedit-country'] = 'COLOMBIA\n';
						pot.headers['x-poedit-sourcecharset'] = 'utf-8\n';
						pot.headers['x-poedit-keywordslist'] = '__;_e;_x;esc_html_e;esc_html__;esc_attr_e;esc_attr__;_ex:1,2c;_nx:4c,1,2;_nx_noop:4c,1,2;_x:1,2c;_n:1,2;_n_noop:1,2;__ngettext_noop:1,2;_c,_nc:4c,1,2;\n';
						pot.headers['x-textdomain-support'] = 'yes\n';
						return pot;
					}
				}
			}
		},
	
		exec: {
			update_po_tx: { // Update Transifex translation - grunt exec:update_po_tx
				cmd: 'tx pull -a --minimum-perc=100'
			},
			update_po_wti: { // Update WebTranslateIt translation - grunt exec:update_po_wti
				cmd: 'wti pull',
				cwd: 'languages/',
			}
		},
	
		po2mo: {
			files: {
				src: 'languages/*.po',
				expand: true,
			},
		}
	
	});
	
	// Default task(s).
	grunt.registerTask( 'default', [ 'makepot', 'exec', 'po2mo' ] );

};
