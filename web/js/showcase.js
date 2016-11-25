if (typeof halumein == "undefined" || !halumein) {
    var halumein = {};
}

halumein.showcase = {
	init : function() {
		console.log('halumein.showcase inited');

        $quickSearchInput = $('[data-role=quick-search]');
        $searchBlock = $('[data-role=search-block]');
        $productsForSearch = $searchBlock.find('[data-role=showcase-product]');

		$showcaseCategoryButton= $('[data-role=showcase-category-button]');
        $showcaseCategory= $('[data-role=showcase-category]');
		$showcaseProduct= $('[data-role=showcase-product]');
        $breadcrumbs = $('[data-role=breadcrumbs]');
        $amountInput = $('[data-role=showcase-item-amount-input]');
        breadcrumbsButton = '[data-role=breadcrumbs-button]';

        /* для дебага */
        $showAllProductsButton = $('[data-role=show-all]');

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

        $showAllProductsButton.on('click', function() {
            halumein.showcase.showAllProducts();
            halumein.showcase.hideCurrentSection();
            halumein.showcase.showSection('search');
            halumein.showcase.addBreadcrumb('Все товары', 'search-block');

        });



        // для поиска, что бы не часто срабатывал
        delay = (function(){
            var timer = 0;
            return function(callback, ms){
                clearTimeout (timer);
                timer = setTimeout(callback, ms);
            };
        })();

        // быстрый поиск
        $quickSearchInput.keyup(function(e) {
            var self = this;
            var $currentSection = $('.current-active');
            if($(self).val().length >= 3) {
                if ($currentSection.data('role') !== 'search-block') {
                    halumein.showcase.hideCurrentSection();
                    halumein.showcase.showSection('search');
                    halumein.showcase.addBreadcrumb('Результаты поиска', 'search');
                }

                delay(function() {
                    halumein.showcase.searchByName($(self).val());
                }, 350);
            }
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
            $quickSearchInput.val('');
            $(self).nextAll().remove();
        });


        var $imgContainers = $('[data-role=image-container]');

        time = 0;
        $.each($imgContainers, function(key, val) {
            var self = this,
            url = $(val).data('img-src');
            if (url !== '') {
                time += 500;
                setTimeout( function(){
                    halumein.showcase.renderImg(url, self);
                }, time);
            } else {
                halumein.showcase.renderImg(false, self);
            }
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
    },

    searchByName : function(queryString) {
        if (queryString != '') {
            $.each($productsForSearch, function(index, productBlock) {
                if ($(productBlock).data('product-name').toLowerCase().indexOf(queryString.toLowerCase()) >=0) {
                    $(productBlock).removeClass('hidden');
                } else {
                    $(productBlock).addClass('hidden');
                }
            });
        }
    },
    showAllProducts : function() {
        $.each($productsForSearch, function(index, productBlock) {
            $(productBlock).removeClass('hidden');
        });
    },

    renderImg : function(url, $block) {
        console.log('render img - ' + url);
        if (url) {
            $($block).empty().append($('<img src="' + url + '" alt="product-image"/>').fadeIn());
        } else {
            $($block).empty().append($('<img src="/images/placeholder_2.png" alt="product-image"/>').fadeIn());
        }
    }

}



$(function () {
	halumein.showcase.init();
});
