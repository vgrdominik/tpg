/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/* eslint-disable */

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

import 'semantic-ui-css/components/popup';
import 'semantic-ui-css/components/rating';
import $ from 'jquery';
import 'slick-carousel';

import 'sylius/ui/app';
import 'sylius/ui/sylius-api-login';
import 'sylius/ui/sylius-api-toggle';

import './sylius-add-to-cart';
import './sylius-address-book';
import './sylius-province-field';
import './sylius-variant-images';
import './sylius-variants-prices';

/* Custom imports */
// upath.joinSafe(nodeModulesPath, 'jquery-number/jquery.number.min.js'),
import 'jquery-number/jquery.number.min.js';
// upath.joinSafe(nodeModulesPath, 'animsition/dist/js/animsition.min.js'),
import 'animsition/dist/js/animsition.min.js';
// upath.joinSafe(nodeModulesPath, 'popper/dist/popper.min.js'),
import 'popper/dist/popper.min.js';
// upath.joinSafe(nodeModulesPath, 'bootstrap/js/dist/bootstrap.min.js'),
import 'bootstrap/js/dist/bootstrap.min.js';
// upath.joinSafe(nodeModulesPath, 'select2/dist/js/select2.min.js'),
import 'select2/dist/js/select2.min.js';
// upath.joinSafe(nodeModulesPath, 'daterangepicker/moment.min.js'),
import 'daterangepicker/moment.min.js';
// upath.joinSafe(nodeModulesPath, 'daterangepicker/daterangepicker.js'),
import 'daterangepicker/daterangepicker.js';
// upath.joinSafe(nodeModulesPath, 'magnific-popup/dist/jquery.magnific-popup.min.js'),
import 'magnific-popup/dist/jquery.magnific-popup.min.js';
// upath.joinSafe(nodeModulesPath, 'isotope-layout/dist/isotope.pkgd.min.js'),
// import 'isotope-layout/dist/isotope.pkgd.min.js';
// upath.joinSafe(shopPath, 'private/lib/sweetalert/sweetalert.min.js'),
// import './../lib/sweetalert/sweetalert.min.js';
// upath.joinSafe(nodeModulesPath, 'perfect-scrollbar/dist/perfect-scrollbar.min.js'),
import 'perfect-scrollbar/dist/perfect-scrollbar.min.js';
// upath.joinSafe(nodeModulesPath, 'lightbox2/dist/js/lightbox.js'),
import 'lightbox2/dist/js/lightbox.js';
// upath.joinSafe(shopPath, 'private/lib/cookies/js/privacycookie.js'),
import './../lib/cookies/js/privacycookie.js';
// import main.js
import './main.js';

(function($) {
  $(document).ready(() => {
    $('.popup-js').popup();

    $('.star.rating').rating({
      fireOnInit: true,
      onRate(value) {
        $('[name="sylius_product_review[rating]"]:checked').removeAttr('checked');
        $(`#sylius_product_review_rating_${value - 1}`).attr('checked', 'checked');
      },
    });

    $('#sylius_checkout_address_customer_email').apiToggle({
      dataType: 'json',
      method: 'GET',
      throttle: 1500,

      beforeSend(settings) {
        const email = $('#sylius_checkout_address_customer_email').val();

        if (email.length < 3) {
          return false;
        }

        /* eslint-disable-next-line no-param-reassign */
        settings.data = {
          email,
        };

        return settings;
      },

      successTest(response) {
        return $('#sylius_checkout_address_customer_email').val() === response.username;
      },
    }, $('#sylius-api-login-form'));

    $('#sylius-api-login').apiLogin({
      method: 'POST',
      throttle: 500,
    });

    $('#sylius-product-adding-to-cart').addToCart();

    $('#sylius-shipping-address').addressBook();
    $('#sylius-billing-address').addressBook();
    $(document).provinceField();
    $(document).variantPrices();
    $(document).variantImages();

    $('body').find('input[autocomplete="off"]').prop('autocomplete', 'disable');

    $('.carousel').slick({
      infinite: true,
      slidesToShow: 2,
      slidesToScroll: 1,
      prevArrow: $('.carousel-left'),
      nextArrow: $('.carousel-right'),
      appendArrows: false
    });
  });
})(jQuery);
