/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */


(function($) {
    $(document).ready(function () {
        $('.cart.button')
            .popup({
                popup: $('.cart.popup'),
                on: 'click',
            })
        ;

        $('.star.rating').rating({
            fireOnInit: true,
            onRate: function(value) {
                $("[name='sylius_product_review[rating]']:checked").removeAttr('checked');
                $("#sylius_product_review_rating_"+(value-1)).attr('checked', 'checked');
            }
        });

        const syliusCheckoutAddressCustomerEmail = $('#sylius_checkout_address_customer_email')
        if (syliusCheckoutAddressCustomerEmail && typeof syliusCheckoutAddressCustomerEmail.apiToggle === 'function') {
          syliusCheckoutAddressCustomerEmail.apiToggle({
            dataType: 'json',
            method: 'GET',
            throttle: 1500,

            beforeSend: function (settings) {
              var email = $('#sylius_checkout_address_customer_email').val();

              if (email.length < 3) {
                return false;
              }

              settings.data = {
                email: email
              };

              return settings;
            },

            successTest: function (response) {
              return $('#sylius_checkout_address_customer_email').val() === response.username;
            }
          }, $('#sylius-api-login-form'));
        }

        const syliusApiLogin = $('#sylius-api-login')
        if (syliusApiLogin && typeof syliusApiLogin.apiLogin === 'function') {
          syliusApiLogin.apiLogin({
            method: 'POST',
            throttle: 500
          });
        }

        const syliusCartRemoveButton = $('.sylius-cart-remove-button')
        if (syliusCartRemoveButton && typeof syliusCartRemoveButton.removeFromCart === 'function') {
          syliusCartRemoveButton.removeFromCart();
        }
        const syliusProductAddingToCart = $('#sylius-product-adding-to-cart')
        if (syliusProductAddingToCart && typeof syliusProductAddingToCart.addToCart === 'function') {
          syliusProductAddingToCart.addToCart();
        }

        const syliusShippingAddress = $('#sylius-shipping-address')
        if (syliusShippingAddress && typeof syliusShippingAddress.addressBook === 'function') {
          syliusShippingAddress.addressBook();
        }
        const syliusBillingAddress = $('#sylius-billing-address')
        if (syliusBillingAddress && typeof syliusBillingAddress.addressBook === 'function') {
          $('#sylius-billing-address').addressBook();
        }
        if (typeof $(document).provinceField === 'function') {
          $(document).provinceField();
        }
        if (typeof $(document).variantPrices === 'function') {
          $(document).variantPrices();
        }
        if (typeof $(document).variantImages === 'function') {
          $(document).variantImages();
        }
    });
})(jQuery);
