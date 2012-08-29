function item_setStatus(data, img, file) {
    // Post request
    $.post(file, data,
            function(reponse, textStatus) {
                if (textStatus == 'success') {
                    // Change image src
                    if ($('img#' + img).attr("src") == "../images/ok.png") {
                        $('img#' + img).attr("src", "../images/cancel.png");
                    } else {
                        $('img#' + img).attr("src", "../images/ok.png");
                    }
                }
            });
}

function item_setDefault(data, img, file) {
    // Post request
    $.post(file, data,
            function(reponse, textStatus) {
                if (textStatus == 'success') {
                    $('.xo-defaultimg').attr("src", "../images/cancel.png");
                    // Change image src
                    if ($('img#' + img).attr("src") == "../images/ok.png") {
                        $('img#' + img).attr("src", "../images/cancel.png");
                    } else {
                        $('img#' + img).attr("src", "../images/ok.png");
                    }
                }
            });
}

function display_dialog(id, bgiframe, modal, hide, show, height, width) {
    $(document).ready(function() {
        $("#dialog" + id).dialog({
            bgiframe: bgiframe,
            modal: modal,
            hide: hide,
            show: show,
            height: height,
            width: width,
            autoOpen: false
        });
        $("#dialog" + id).dialog("open");
    });
}