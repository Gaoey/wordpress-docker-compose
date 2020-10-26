( function( api ) {

	// Extends our custom "catmandu" section.
	api.sectionConstructor['catmandu'] = api.Section.extend( {

		// No events for this type of section.
		attachEvents: function () {},

		// Always make the section active.
		isContextuallyActive: function () {
			return true;
		}
	} );

} )( wp.customize );
