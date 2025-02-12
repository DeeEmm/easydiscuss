ed.require(['edq', 'easydiscuss'], function($, EasyDiscuss) {

var copyButton = $('[data-copy-cron]');

copyButton.on('click', function() {

	// change tooltip display word
	$(this).attr('data-original-title', '<?php echo JText::_('COM_ED_COPIED_TOOLTIP')?>').tooltip('show');

	// retrieve the input id
	var text = $(this).siblings('input[type=text]');

	text.select();
	document.execCommand("Copy");
});

// change back orginal value after mouse out
copyButton.on('mouseout', function() {

	// change tooltip display word
	$(this).attr('data-original-title', '<?php echo JText::_('COM_ED_COPY_TOOLTIP')?>').tooltip('show');
});


});