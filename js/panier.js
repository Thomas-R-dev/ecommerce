/* Set values + misc */
var promoCode;
var promoPrice;
var fadeTime = 300;

/* Assign actions */
$('.quantite input').change(function() {
    updateQuantity(this);
});

$('.suppr button').click(function() {
    removeItem(this);
});

$(document).ready(function() {
    updateSumItems();
});

$('.codereduc-btn').click(function() {

    promoCode = $('#codereduc').val();

    if (promoCode == '10off' || promoCode == '10OFF') {
        //If promoPrice has no value, set it as 10 for the 10OFF promocode
        if (!promoPrice) {
            promoPrice = 10;
        } else if (promoCode) {
            promoPrice = promoPrice * 1;
        }
    } else if (promoCode != '') {
        alert("Invalid Promo Code");
        promoPrice = 0;
    }
    //If there is a promoPrice that has been set (it means there is a valid promoCode input) show promo
    if (promoPrice) {
        $('.recap-reduc').removeClass('cache');
        $('.reduc-valeur').text(promoPrice.toFixed(2));
        recalculateCart(true);
    }
});

/* Recalculate cart */
function recalculateCart(onlyTotal) {
    var subtotal = 0;

    /* Sum up row totals */
    $('.conteneur_article').each(function() {
        subtotal += parseFloat($(this).children('.soustotal').text());
    });

    /* Calculate totals */
    var total = subtotal;

    //If there is a valid promoCode, and subtotal < 10 subtract from total
    var promoPrice = parseFloat($('.reduc-valeur').text());
    if (promoPrice) {
        if (subtotal >= 10) {
            total -= promoPrice;
        } else {
            alert('Order must be more than £10 for Promo code to apply.');
            $('.recap-reduc').addClass('cache');
        }
    }

    /*If switch for update only total, update only total display*/
    if (onlyTotal) {
        /* Update total display */
        $('.total-valeur').fadeOut(fadeTime, function() {
            $('#panier-total').html(total.toFixed(2));
            $('.total-valeur').fadeIn(fadeTime);
        });
    } else {
        /* Update summary display. */
        $('.valeur-final').fadeOut(fadeTime, function() {
            $('#panier-soustotal').html(subtotal.toFixed(2));
            $('#panier-total').html(total.toFixed(2));
            if (total == 0) {
                $('.paiement-go').fadeOut(fadeTime);
            } else {
                $('.paiement-go').fadeIn(fadeTime);
            }
            $('.valeur-final').fadeIn(fadeTime);
        });
    }
}

/* Update quantity */
function updateQuantity(quantityInput) {
    /* Calculate line price */
    var productRow = $(quantityInput).parent().parent();
    var price = parseFloat(productRow.children('.prix').text());
    var quantity = $(quantityInput).val();
    var linePrice = price * quantity;

    /* Update line price display and recalc cart totals */
    productRow.children('.soustotal').each(function() {
        $(this).fadeOut(fadeTime, function() {
            $(this).text(linePrice.toFixed(2));
            recalculateCart();
            $(this).fadeIn(fadeTime);
        });
    });

    productRow.find('.article-quantite').text(quantity);
    updateSumItems();
}

function updateSumItems() {
    var sumItems = 0;
    $('.quantite input').each(function() {
        sumItems += parseInt($(this).val());
    });
    $('.total-articles').text(sumItems);
}

/* Remove item from cart */
function removeItem(removeButton) {
    /* Remove row from DOM and recalc cart total */
    var productRow = $(removeButton).parent().parent();
    productRow.slideUp(fadeTime, function() {
        productRow.remove();
        recalculateCart();
        updateSumItems();
    });
}