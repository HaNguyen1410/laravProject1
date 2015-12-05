/*
Copyright (c) 2003-2012, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

CKEDITOR.editorConfig = function( config )
{
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
        // cấu hình ngôn ngữ tiếng việt
        config.language = 'vi';
        // bỏ thẻ p mỗi khi nhập liệu ckeditor
        config.enterMode = CKEDITOR.ENTER_BR;
//        config.enterMode = CKEDITOR.ENTER_DIV;
//        config.enterMode = CKEDITOR.ENTER_P;
        config.allowedContent = true;
       //config.allowedContent = 'div(nd)';
};
