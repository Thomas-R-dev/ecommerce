// Barre de Recherche
$(document).ready(function () {
    $('#recherche').autocomplete({
        source: "functions/liste.php?term",
        minLength: 0,
        select: function (event, ui) {
            location.href = "index.php?page=pagearticle_v2&id=" + ui.item.value;
        }
    });
});

$(function () {
    var randomnumber = Math.floor(Math.random() * 11)
    $('input.recherche[type="text"]').attr("placeholder1", randomnumber);
});

$("#thumbnail-container img").click(function () {
    $("#thumbnail-container img").css("border", "1px solid #ccc");
    var src = $(this).attr("src");
    $("#preview-enlarged img").attr("src", src);
    $(this).css("border", "#fbb20f 2px solid");
});

// /* FORMULAIRE CARTE DE CREDIT EN JQUERY */
// function cc_format(value) {
//     var v = value.replace(/\s+/g, '').replace(/[^0-9]/gi, '')
//     var matches = v.match(/\d{4,16}/g);
//     var match = matches && matches[0] || ''
//     var parts = []
//     for (i = 0, len = match.length; i < len; i += 4) {
//         parts.push(match.substring(i, i + 4))
//     }
//     if (parts.length) {
//         return parts.join(' ')
//     } else {
//         return value
//     }
// }

// onload = function() {
//         document.getElementById('card').oninput = function() {
//             this.value = cc_format(this.value)
//         }
//     }
// /* FIN */