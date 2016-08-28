/**
 * Upsell notice for theme
 */

( function( $ ) {

	// Add Upgrade Message
	if ('undefined' !== typeof realestL10n) {
		upsell = $('<a class="realest-upsell-link"></a>')
			.attr('href', realestL10n.realestURL)
			.attr('target', '_blank')
			.text(realestL10n.realestLabel)
			.css({
				'display' : 'inline-block',
				'background-color' : '#f1572f',
				'color' : '#fff',
				'text-transform' : 'uppercase',
				'margin-top' : '6px',
				'padding' : '10px 10px',
				'font-size': '9px',
				'letter-spacing': '1px',
				'line-height': '1.5',
				'clear' : 'both',
				'width' : '100%'
			})
		;

		setTimeout(function () {
			$('#accordion-section-themes h3').append(upsell);
		}, 200);

		// Remove accordion click event
		$('.realest-upsell-link').on('click', function(e) {
			e.stopPropagation();
		});
	}

} )( jQuery );