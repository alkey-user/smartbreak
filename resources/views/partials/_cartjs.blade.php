<?php
/**
 * File:	/resources/views/partials/_cartjs.blade.php
 * @package smartbreak
 * @author  Giovanni Ciriello <giovanni.ciriello.5@gmail.com>
 * @copyright	(c)2021 IISS Colamonico-Chiarulli Acquaviva delle Fonti (BA) Italy
 * Created Date: 	February 14th, 2021 11:16pm
 * -----
 * Last Modified: 	
 * Modified By: 	
 * -----
 * @license	https://www.gnu.org/licenses/agpl-3.0.html AGPL 3.0
 * ------------------------------------------------------------------------------
 * SmartBreak is a School Bar food booking web application 
 * developed during the PON course "The AppFactory" 2020-2021 with teachers 
 * & students of "Informatica e Telecomunicazioni" 
 * at IISS "C. Colamonico - N. Chiarulli" Acquaviva delle Fonti (BA)-Italy
 * Expert dr. Giovanni Ciriello <giovanni.ciriello.5@gmail.com>
 * ----------------------------------------------------------------------------
 * SmartBreak is free software; you can redistribute it and/or modify it under
 * the terms of the GNU Affero General Public License version 3 as published by
 * the Free Software Foundation
 * 
 * SmartBreak is distributed in the hope that it will be useful, but WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS
 * FOR A PARTICULAR PURPOSE.  See the GNU Affero General Public License for more
 * details.
 * You should have received a copy of the GNU Affero General Public License along 
 * with this program; if not, see http://www.gnu.org/licenses or write to the Free
 * Software Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA
 * 02110-1301 USA.
 * 
 * The interactive user interfaces in original and modified versions
 * of this program must display Appropriate Legal Notices, as required under
 * Section 5 of the GNU Affero General Public License version 3.
 * 
 * In accordance with Section 7(b) of the GNU Affero General Public License version 3,
 * these Appropriate Legal Notices must retain the display of the SmartBreak
 * logo and IISS "Colamonico-Chiarulli" copyright notice. If the display of the logo
 * is not reasonably feasible for technical reasons, the Appropriate Legal Notices 
 * must display the words
 * "(C) IISS Colamonico-Chiarulli-https://colamonicochiarulli.it - 2021".
 * 
 * ------------------------------------------------------------------------------
 */

?>
<script>
    const get_cart_route = '{{ route("cart.get") }}';
    const edit_cart_route = '{{ route("cart.edit") }}';
    const empty_cart_route = '{{ route("cart.empty") }}';
    const products = @JSON($products);

    $(function () {
        reloadTotal();
    });

    function emptyCart() {
        $.ajax({
            url: empty_cart_route,
            method: "DELETE",
            success: function () {
                toastr.success("Carrello svuotato con successo");
                $("input.cart-product-items").val(0);
                $(".cart-product-totals").html(formatPrice(0));
                $(".cart-total").html(formatPrice(0));
            },
        });
    }

    function editCart(product_id, quantity) {
        const product_items = $("#product-items-" + product_id);
        const product_total = $("#product-total-" + product_id);

        const result = parseInt(product_items.val() || 0) + quantity;

        if (result >= 0) {
            product_items.val(result);
            product_total.html(formatPrice(result * products[product_id].price));

            $.ajax({
                url: edit_cart_route,
                method: "PUT",
                data: {
                    product_id: product_id,
                    quantity: result,
                },
                success: function () {
                    reloadTotal();
                },
            });
        }
    }

    function reloadTotal() {
        $.get(get_cart_route, function (res) {
            $(".cart-total").html(formatPrice(res.total));
        });
    }

</script>
