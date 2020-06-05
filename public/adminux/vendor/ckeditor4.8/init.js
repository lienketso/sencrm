/**
 * Created by Admin on 1/25/2018.
 */
CKEDITOR.replace( 'ckeditor', {
	language : 'en',
	height : 300,
	toolbarCanCollapse : true,
	toolbarGroups : [
		'/',
		{ name: 'document', groups: [ 'mode', 'document', 'doctools' ] },
		{ name: 'clipboard', groups: [ 'clipboard', 'undo' ] },
		{ name: 'editing', groups: [ 'find', 'selection', 'spellchecker', 'editing' ] },
		{ name: 'forms', groups: [ 'forms' ] },
		'/',
		{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
		{ name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi', 'paragraph' ] },
		{ name: 'links', groups: [ 'links' ] },
		{ name: 'insert', groups: [ 'insert' ] },
		'/',
		{ name: 'styles', groups: [ 'styles' ] },
		{ name: 'colors', groups: [ 'colors' ] },
		{ name: 'tools', groups: [ 'tools' ] },
		{ name: 'others', groups: [ 'others' ] },
		{ name: 'about', groups: [ 'about' ] }
	],

	removeButtons : 'About,Flash,Language,Scayt',

	filebrowserImageBrowseUrl: '/cdn-filemanager?type=Images',
	filebrowserImageUploadUrl: '/cdn-filemanager/upload?type=Images&_token=',
	filebrowserBrowseUrl: '/cdn-filemanager?type=Files',
	filebrowserUploadUrl: '/cdn-filemanager/upload?type=Files&_token='
} );

CKEDITOR.replace( 'ckeditors', {
    language : 'en',
    height : 400,
    toolbarCanCollapse : true,
    toolbarGroups : [
        '/',
        { name: 'document', groups: [ 'mode', 'document', 'doctools' ] },
        { name: 'clipboard', groups: [ 'clipboard', 'undo' ] },
        { name: 'editing', groups: [ 'find', 'selection', 'spellchecker', 'editing' ] },
        { name: 'forms', groups: [ 'forms' ] },
        '/',
        { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
        { name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi', 'paragraph' ] },
        { name: 'links', groups: [ 'links' ] },
        { name: 'insert', groups: [ 'insert' ] },
        '/',
        { name: 'styles', groups: [ 'styles' ] },
        { name: 'colors', groups: [ 'colors' ] },
        { name: 'tools', groups: [ 'tools' ] },
        { name: 'others', groups: [ 'others' ] },
        { name: 'about', groups: [ 'about' ] }
    ],

    removeButtons : 'About,Flash,Language,Scayt',

    filebrowserImageBrowseUrl: '/cdn-filemanager?type=Images',
    filebrowserImageUploadUrl: '/cdn-filemanager/upload?type=Images&_token=',
    filebrowserBrowseUrl: '/cdn-filemanager?type=Files',
    filebrowserUploadUrl: '/cdn-filemanager/upload?type=Files&_token='
} );