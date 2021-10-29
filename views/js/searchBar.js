$(document).ready(() => {
    $("#InputSearch").keypress(function(e) {
        if(e.which == 13) {
            var text = $("#InputSearch").val();
            window.location.href="search.php?search=" + text;
        }
    });
})