ed.require(['edq', 'easydiscuss'], function($, EasyDiscuss) {

	window.insertColorCode = function(colorCode, caretPosition, textarea, selection) {
		var tag = '[color=' + colorCode + ']' + selection + '[/color]';
		var contents = textarea.val();
		var contentsExist = contents.length;

		// If this is at the first position, we don't want to do anything here.
		// Avoid some cases if user insert these code at the first line, the rest content will went missing
		if (caretPosition == 0 && contentsExist == 0) {
			$(textarea).val(tag);
			return true;
		}

		var newContents = contents.substring(0, caretPosition) + tag + contents.substring(caretPosition + selection.length, contents.length);

		$(textarea).val(newContents);

		// Reset the temporary function
		window.easydiscussInsertColor = null;
	};

	window.insertVideoCode = function(videoURL, caretPosition, elementId, contents, dialogRecipient, editorUuid) {

		if (videoURL.length == 0) {
			return false;
		}

		var tag = '[video]' + videoURL + '[/video]';

		// If this is coming from dialog composer, we need to reload back the dialog
		if (dialogRecipient > 0) {
			var newContents = tag;
			
			if (caretPosition != 0 || contents.length > 0) {
				newContents = contents.substring(0, caretPosition) + tag + contents.substring(caretPosition, contents.length);
			}

			renderComposer(dialogRecipient, newContents);
			return true;
		}

		var textarea = $('textarea[name=' + elementId + ']' + '[data-ed-editor-uuid=' + editorUuid + ']');
		var contents = $(textarea).val();
		var contentsExist = contents.length;

		// If this is at the first position, we don't want to do anything here.
		// Avoid some cases if user insert these code at the first line, the rest content will went missing
		if (caretPosition == 0 && contentsExist == 0) {

			$(textarea).val(tag);
			EasyDiscuss.dialog().close();
			return true;
		}

		$(textarea).val(contents.substring(0, caretPosition) + tag + contents.substring(caretPosition, contents.length));
	};

	window.insertPhotoCode = function(photoURL, caretPosition, elementId, contents, dialogRecipient, editorUuid) {

		if (photoURL.length == 0) {
			return false;
		}
		
		var tag = '[img]' + photoURL + '[/img]';

		// If this is coming from dialog composer, we need to reload back the dialog
		if (dialogRecipient > 0) {
			var newContents = tag;
			
			if (caretPosition != 0 || contents.length > 0) {
				newContents = contents.substring(0, caretPosition) + tag + contents.substring(caretPosition, contents.length);
			}

			renderComposer(dialogRecipient, newContents);
			return true;
		}

		var textarea = $('textarea[name=' + elementId + ']' + '[data-ed-editor-uuid=' + editorUuid + ']');
		var contents = $(textarea).val();
		var contentsExist = contents.length;

		// If this is at the first position, we don't want to do anything here.
		// Avoid some cases if user insert these code at the first line, the rest content will went missing
		if (caretPosition == 0 && contentsExist == 0) {

			$(textarea).val(tag);
			EasyDiscuss.dialog().close();
			return true;
		}

		$(textarea).val(contents.substring(0, caretPosition) + tag + contents.substring(caretPosition, contents.length));
	};

	window.insertLinkCode = function(linkURL, linkTitle, caretPosition, elementId, contents, dialogRecipient, editorUuid) {

		if (linkURL.length == 0) {
			return false;
		}

		if (linkTitle.length == 0) {
			linkTitle = 'Title';
		}

		var tag = '[url=' + linkURL + ']'+ linkTitle +'[/url]';

		// If this is coming from dialog composer, we need to reload back the dialog
		if (dialogRecipient > 0) {
			var newContents = tag;
			
			if (caretPosition != 0 || contents.length > 0) {
				newContents = contents.substring(0, caretPosition) + tag + contents.substring(caretPosition, contents.length);
			}

			renderComposer(dialogRecipient, newContents);
			return true;
		}

		var textarea = $('textarea[name=' + elementId + ']' + '[data-ed-editor-uuid=' + editorUuid + ']');
		var contents = $(textarea).val();
		var contentsExist = contents.length;

		// If this is at the first position, we don't want to do anything here.
		// Avoid some cases if user insert these code at the first line, the rest content will went missing
		if (caretPosition == 0 && contentsExist == 0) {

			$(textarea).val(tag);
			EasyDiscuss.dialog().close();
			return true;
		}

		$(textarea).val(contents.substring(0, caretPosition) + tag + contents.substring(caretPosition, contents.length));
	};

	window.insertArticleCode = function(articleId, contentType, caretPosition, elementId, contents, dialogRecipient, editorUuid) {

		if (articleId.length == 0) {
			return false;
		}

		var tag = '[article type=' + contentType + ']'+ articleId +'[/article]';

		// If this is coming from dialog composer, we need to reload back the dialog
		if (dialogRecipient > 0) {
			var newContents = tag;
			
			if (caretPosition != 0 || contents.length > 0) {
				newContents = contents.substring(0, caretPosition) + tag + contents.substring(caretPosition, contents.length);
			}

			renderComposer(dialogRecipient, newContents);
			return true;
		}

		var textarea = $('textarea[name=' + elementId + ']' + '[data-ed-editor-uuid=' + editorUuid + ']');
		var contents = $(textarea).val();
		var contentsExist = contents.length;

		// If this is at the first position, we don't want to do anything here.
		// Avoid some cases if user insert these code at the first line, the rest content will went missing
		if (caretPosition == 0 && contentsExist == 0) {

			$(textarea).val(tag);
			EasyDiscuss.dialog().close();
			return true;
		}

		$(textarea).val(contents.substring(0, caretPosition) + tag + contents.substring(caretPosition, contents.length));
	};

	renderComposer = function(dialogRecipient, contents) {
		EasyDiscuss.dialog({
			content: EasyDiscuss.ajax('site/views/conversation/compose', {
				"id": dialogRecipient,
				"contents": contents
			}),
			bindings: {
				"init": function() {
				}
			}
		});
	};
});