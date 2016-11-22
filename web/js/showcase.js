if (typeof halumein == "undefined" || !halumein) {
    var halumein = {};
}

halumein.showcase = {
	init : function() {
		console.log('halumein.showcase inited');

		$showcaseCategoryButton= $('[data-role=showcase-category-button]');
        $showcaseCategory= $('[data-role=showcase-category]');
		$showcaseProduct= $('[data-role=showcase-product]');
        $breadcrumbs = $('[data-role=breadcrumbs]');
        breadcrumbsButton = '[data-role=breadcrumbs-button]';

		$showcaseCategoryButton.on('click', function() {

            var self = this,
                categoryId = $(self).data('category-id'),
                title = $(self).find('.showcase-item-title').text();

			halumein.showcase.hideCurrentSection();
            halumein.showcase.showSection(categoryId);
            halumein.showcase.addBreadcrumb(title, categoryId);
		});

        $showcaseProduct.on('click', function() {
            var self = this,
                productId = $(this).data('product-id');

            // плачу кровавыми слезами c этого
            var $buyButton = $(document).find('.pistol88-cart-buy-button' + productId);

            $buyButton.trigger('click');

        });

        $(document).on('click', breadcrumbsButton,function() {
            var self = this,
                target = $(self).data('target');

            halumein.showcase.hideCurrentSection();
            halumein.showcase.showSection(target);
            $(self).nextAll().remove();
        });

	},

	hideCurrentSection : function() {
		// var width = $(".current-active").width();
		// $(".current-active").animate({'margin-right':width},700);
        $(".current-active").addClass('hidden').removeClass('current-active');
	},

    showSection : function(categoryId) {
        $('[data-category-case-id='+ categoryId +']').removeClass('hidden').addClass('current-active');
    },

    addBreadcrumb : function(title, target) {
        $breadcrumbs.append('<li class="showcase-breadcrumbs" data-role="breadcrumbs-button" data-target="' + target + '">' + title + '</li>');
    }
}

$(function () {
	halumein.showcase.init();
});
