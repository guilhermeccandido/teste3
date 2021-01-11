/**
 * @license Copyright (c) 2003-2017, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

// Register a templates definition set named "default".
CKEDITOR.addTemplates( 'default', {
	// The name of sub folder which hold the shortcut preview images of the
	// templates.
	imagesPath: CKEDITOR.getUrl( CKEDITOR.plugins.getPath( 'templates' ) + 'templates/images/' ),

	// The templates definitions.
	templates: [ {
		title: 'Imagem e Título',
		image: 'template1.gif',
		description: 'Definição.',
		html:  
               '<div class="col-md-6">' +
               '	<img  src=" " alt=""  class="img-responsive" height="200" width="400" >' +
               '</div>' +
               '<div class="col-md-6">' +
               '	<p>Enim velit Duis eu voluptate do tempor non irure nisi ad occaecat dolore aliqua laboris amet aute minim qui et Excepteur ide cupidatat Duis laborum id nulla in mollit consectetur animal Ut veniam magna ut exercitation ex sint sint ex sit est pariatur non nisi eu est magna ullamco minim nulla aliquip reprehenderit Lorem ipsum Minim Ut in nulla labore sint nostrud commodo. Lorem ipsum dolor sit amet, consectetur adipisicing elit. In beatae pariatur expedita quibusdam non adipisci doloribus sit iusto esse ad.</p>' +
               '	<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cumque, enim, molestias officia ipsam harum ratione iusto laborum veritatis velit nam vero sapiente repudiandae ipsum recusandae laudantium adipisci iure eos unde animi ab tenetur odio consequuntur. Doloremque error reprehenderit consequuntur mollitia adipisci doloribus sit iusto.</p>' +
               '</div>'
	},
	{
		title: 'Strange Template',
		image: 'template2.gif',
		description: 'A template that defines two columns, each one with a title, and some text.',
		html: '<table cellspacing="0" cellpadding="0" style="width:100%" border="0">' +
			'<tr>' +
				'<td style="width:50%">' +
					'<h3>Titulo 2000</h3>' +
				'</td>' +
				'<td></td>' +
				'<td style="width:50%">' +
					'<h3>Title 2</h3>' +
				'</td>' +
			'</tr>' +
			'<tr>' +
				'<td>' +
					'Text 1' +
				'</td>' +
				'<td></td>' +
				'<td>' +
					'Text 2' +
				'</td>' +
			'</tr>' +
			'</table>' +
			'<p>' +
			'More text goes here.' +
			'</p>'
	},
	{
		title: 'Text and Table',
		image: 'template3.gif',
		description: 'A title with some text and a table.',
		html: '<div style="width: 80%">' +
			'<h3>' +
				'Title goes here' +
			'</h3>' +
			'<table style="width:150px;float: right" cellspacing="0" cellpadding="0" border="1">' +
				'<caption style="border:solid 1px black">' +
					'<strong>Table title</strong>' +
				'</caption>' +
				'<tr>' +
					'<td>&nbsp;</td>' +
					'<td>&nbsp;</td>' +
					'<td>&nbsp;</td>' +
				'</tr>' +
				'<tr>' +
					'<td>&nbsp;</td>' +
					'<td>&nbsp;</td>' +
					'<td>&nbsp;</td>' +
				'</tr>' +
				'<tr>' +
					'<td>&nbsp;</td>' +
					'<td>&nbsp;</td>' +
					'<td>&nbsp;</td>' +
				'</tr>' +
			'</table>' +
			'<p>' +
				'Type the text here' +
			'</p>' +
			'</div>'
	} ]
} );
