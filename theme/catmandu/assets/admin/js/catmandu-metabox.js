jQuery(function ($) {

	var CatmanduAdminMetaBox = {
		init: function () {
			this.cacheAll();
			this.eventListeners();
		},

		cacheAll: function () {
			this.topHeader = $('.enable-top-header');
			this.topHeaderColors = $('.show-top-header-color');
			this.transparentHeaderValue = $('.enable-disable-transparent-header');
			this.transparentHeaderColorSelector = $('.show-transparent-header-color');
			this.nonTransparentHeaderColorSelector = $('.show-non-transparent-header-color');
			this.pageColorEnable = $('.page_colors_enable');
			this.pageColor = $('.show-page-colorpicker');

			$("#catmandu-metabox-tabs").tabs().addClass("ui-tabs-vertical ui-helper-clearfix");
			$("#catmandu-metabox-tabs li").removeClass("ui-corner-top").addClass("ui-corner-left");
		},

		eventListeners: function () {
			$(this.transparentHeaderValue).on('change', this.showTransparentColorSelector.bind(this));
			$(this.topHeader).on('change', this.showTopHeaderColorSelector.bind(this));
			$(this.pageColorEnable).on('change', this.showPageColorPicker.bind(this));
		},

		showTransparentColorSelector: function (e) {
			var value = $(e.currentTarget).val();
			if (value === "enable") {
				$(this.transparentHeaderColorSelector).show();
				$(this.nonTransparentHeaderColorSelector).hide();
			} else if (value === "global") {
				$(this.nonTransparentHeaderColorSelector).hide();
			} else {
				$(this.transparentHeaderColorSelector).hide();
				$(this.nonTransparentHeaderColorSelector).show();
			}
		},

		showTopHeaderColorSelector: function (e) {
			var value = $(e.currentTarget).val();
			if (value === "enable") {
				$(this.topHeaderColors).show();
			} else {
				$(this.topHeaderColors).hide();
			}
		},

		showPageColorPicker: function (e) {
			var value = $(e.currentTarget).val();
			if (value === "enable") {
				$(this.pageColor).show();
			} else {
				$(this.pageColor).hide();
			}
		}
	}

	CatmanduAdminMetaBox.init();
});