if (typeof halumein == "undefined" || !halumein) {
    var halumein = {};
}

halumein.showcase = {
    init: function () {
        console.log('halumein.showcase inited');

        $quickSearchInput = $('[data-role=quick-search]');
        $searchBlock = $('[data-role=search-block]');
        $orderForm = $('[data-role=order-form]');
        $showcaseCategoryButton = $('[data-role=showcase-category-button]');
        $showcaseProduct = $('[data-role=showcase-product]');
        $breadcrumbs = $('[data-role=breadcrumbs]');
        $amountInput = $('[data-role=showcase-item-amount-input]');
        $addElementBtn = $('[data-role=add-element-btn]');
        breadcrumbsButton = '[data-role=breadcrumbs-button]';

        $buyByCodeInput = $('[data-role=barcode-scaner-input]');
        $buyByCodeInput.select();

        $showcaseItems = $('.showcase-item');


        $(document).on('mouseenter', '.service-prices-table td', this.renderCross);

        $(document).on('mouseleave', '.service-prices-table td', function () {
            $('.service-prices-table td').removeClass('hover');
        });


        /* для дебага */
        $showAllProductsButton = $('[data-role=show-all]');

        $showcaseCategoryButton.on('click', function () {
            var self = this,
                categoryId = $(self).data('category-id'),
                title = $(self).find('.showcase-item-title').text();

            // console.log(categoryId);
            halumein.showcase.renderTargetContent(categoryId);
            halumein.showcase.addBreadcrumb(title, categoryId);
        });

        $amountInput.on('focus', function () {
            $(this).select();
        });

        $amountInput.keydown(function (e) {
            var code = e.which,
                self = this;
            if (code == 13) {
                $thisProductBlock = $(self).closest('[data-role=showcase-product]');
                halumein.showcase.addToCart($thisProductBlock);
                $(self).blur();
                return false;
            }
        });

        $showAllProductsButton.on('click', function () {
            halumein.showcase.showAllProducts();
            halumein.showcase.addBreadcrumb('Все товары', 'search-block');

        });


        // для поиска, что бы не часто срабатывал
        delay = (function () {
            var timer = 0;
            return function (callback, ms) {
                clearTimeout(timer);
                timer = setTimeout(callback, ms);
            };
        })();

        // быстрый поиск
        $quickSearchInput.keyup(function (e) {
            var self = this;
            if ($(self).val().length >= 3) {
                delay(function () {
                    halumein.showcase.searchByName($(self).val());
                }, 350);
            }
        });

        $addElementBtn.on('click', function () {
            var self = this,
                url = $(self).data('url'),
                itemModelName = $(self).data('model'),
                itemId = $(self).data('product-id'),
                itemCount = 1,
                itemPrice = $(self).siblings('[data-role=service-price]').text().trim(),
                itemOptions = {};

            // сильная связанность - плохо
            pistol88.cart.addElement(itemModelName, itemId, itemCount, itemPrice, itemOptions, url);
        });

        $showcaseProduct.on('click', function (e) {
            if ($(e.target).data('role') === 'showcase-item-amount-input') {
                return false;
            }
            var self = this;
            halumein.showcase.addToCart(this);
        });

        $buyByCodeInput.on('keypress', function(e) {
            var $self = $(this);
            if(e.which == 13 && $self.val().length > 0) {
                $product = halumein.showcase.searchByCode($self.val());

                if ($product.length > 0) {
                    halumein.showcase.addToCart($product.first());
                    halumein.showcase.clearBuyByCode();
                } else {
                    // TODO написать уже модулёк нотификаций
                    alert('продукт не найден');
                    halumein.showcase.clearBuyByCode();
                }
            }
        });

        $(document).on('click', breadcrumbsButton, function () {
            var self = this,
                target = $(self).data('target');

            halumein.showcase.renderTargetContent(target);
            $quickSearchInput.val('');
            $(self).nextAll().remove();
        });


        var $imgContainers = $('[data-role=showcase-item-image-containter]');

        time = 0;
        $.each($imgContainers, function (key, val) {
            var self = this,
                url = $(val).data('img-src');
            if (url !== '') {
                time += 500;
                setTimeout(function () {
                    halumein.showcase.renderImg(url, self);
                }, time);
            } else {
                halumein.showcase.renderImg(false, self);
            }
        });

    },

    clearBuyByCode : function() {
        $buyByCodeInput.val('');
    },

    renderTargetContent: function (categoryId) {
        $.each($showcaseItems, function (index, itemBlock) {
            if ($(itemBlock).data('parent-id') === categoryId) {
                $(itemBlock).removeClass('hidden');
            } else {
                $(itemBlock).addClass('hidden');
            }
        });
    },

    addToCart: function ($productBlock) {

        var self = $productBlock,
            productId = $(self).data('product-id'),
            count = $(self).find('[data-role=showcase-item-amount-input]').val();

        if (count <= 0) {
            $(self).find('[data-role=showcase-item-amount-input]').focus();
            return false;
        }
        price = $(self).find('[data-role=showcase-item-price]').data('default-price');
        if ($(self).find('[data-role=showcase-item-price-input]').length > 0) {
            price = $(self).find('[data-role=showcase-item-price-input]').val();
        }
        var url = $(self).data('url'),
            itemModelName = $(self).data('model'),
            itemId = $(self).data('product-id'),
            itemCount = count,
            itemPrice = price,
            itemOptions = {};

        pistol88.cart.addElement(itemModelName, itemId, itemCount, itemPrice, itemOptions, url);

        $(self).find('[data-role=showcase-item-amount-input]').val(1);
    },
    addBreadcrumb: function (title, target) {
        $breadcrumbs.append('<li class="showcase-breadcrumbs" data-role="breadcrumbs-button" data-target="' + target + '">' + title + '</li>');
    },

    searchByName: function (queryString) {
        $.each($showcaseCategoryButton, function (index, block) {
            $(block).addClass('hidden');
        });
        if (queryString != '') {
            $.each($showcaseProduct, function (index, productBlock) {
                // если есть артикул то ищем в имени или артикуле
                if ($(productBlock).data('product-code')) {
                    if (($(productBlock).data('product-name').toLowerCase().indexOf(queryString.toLowerCase()) >= 0) || ($(productBlock).data('product-code').toLowerCase().indexOf(queryString.toLowerCase()) >= 0)) {
                        $(productBlock).removeClass('hidden');
                    } else {
                        $(productBlock).addClass('hidden');
                    }
                } else {
                    // либо только в имени
                    if ($(productBlock).data('product-name').toLowerCase().indexOf(queryString.toLowerCase()) >= 0) {
                        $(productBlock).removeClass('hidden');
                    } else {
                        $(productBlock).addClass('hidden');
                    }
                }
            });
        }
    },

    searchByCode: function (queryString) {
        if (queryString != '') {
            $product = $('#arm-code-' + queryString);
            if ($product.length > 0) {
                return $product;
            } else {
                return false;
            }
        }
    },
    showAllProducts: function () {
        $.each($showcaseCategoryButton, function (index, categoryBlock) {
            $(categoryBlock).addClass('hidden');
        });

        $.each($showcaseProduct, function (index, productBlock) {
            $(productBlock).removeClass('hidden');
        });
    },

    renderImg: function (url, $block) {
        if (url) {
            $($block).empty().append($('<img src="' + url + '" alt="product-image"/>').fadeIn());
        } else {
            $($block).empty().append($('<img src="/backend/web/gallery/images/image-by-item-and-alias?item=&dirtyAlias=placeHolder.png" alt="product-image"/>').fadeIn());
        }
    },

    renderCross: function () {
        var tr = $(this).parent('tr');
        var Col = tr.find('td').index(this);

        tr.find('td').addClass('hover');
        $('.service-prices-table tr').find('td:eq(' + Col + ')').addClass('hover');
    },

}


$(function () {
    halumein.showcase.init();
});
