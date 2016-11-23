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
        $amountInput = $('[data-role=showcase-item-amount-input]');
        breadcrumbsButton = '[data-role=breadcrumbs-button]';

		$showcaseCategoryButton.on('click', function() {

            var self = this,
                categoryId = $(self).data('category-id'),
                title = $(self).find('.showcase-item-title').text();

			halumein.showcase.hideCurrentSection();
            halumein.showcase.showSection(categoryId);
            halumein.showcase.addBreadcrumb(title, categoryId);
		});

        $amountInput.on('focus', function() {
            $(this).select();
        });

        $amountInput.keydown(function(e) {
            var code = e.which,
                self = this;
            if(code==13) {
                $thisProductBlock = $(self).closest('[data-role=showcase-product]');
                halumein.showcase.addToCart($thisProductBlock);
            };

        });

        $showcaseProduct.on('click', function(e) {
            if ($(e.target).data('role') === 'showcase-item-amount-input') {
                return false;
            }
            var self = this;
            halumein.showcase.addToCart(this);
        });

        $(document).on('click', breadcrumbsButton,function() {
            var self = this,
                target = $(self).data('target');

            halumein.showcase.hideCurrentSection();
            halumein.showcase.showSection(target);
            $(self).nextAll().remove();
        });

	},

    addToCart : function($productBlock) {

        var self = $productBlock,
            productId = $(self).data('product-id'),
            count = $(self).find('[data-role=showcase-item-amount-input]').val();

        if (count <= 0) {
            $(self).find('[data-role=showcase-item-amount-input]').focus();
            return false;
        }

        // плачу кровавыми слезами c этого
        var $buyButton = $(document).find('.pistol88-cart-buy-button' + productId);
        $buyButton.data('count', count);
        $buyButton.trigger('click');
        

        $(self).find('[data-role=showcase-item-amount-input]').val(1);
    },

	hideCurrentSection : function() {
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
