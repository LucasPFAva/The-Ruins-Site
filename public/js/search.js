var typingTimer;              // Current time.
var doneTypingInterval = 500; // Time in ms, 0.5 seconds.
var elementsAdded = 0;        // Current element index.

$('#filtersearchbar').submit(function (e) { 
    e.preventDefault();
    return window.location.href = '/search/' + document.getElementById('filtersearch').value.trim() + '?t=' + $('#type').val();
});

document.getElementById('filtersearch').addEventListener("keyup", function(event) {
    clearTimeout(typingTimer);
    if (document.getElementById('filtersearch').value.replace(/\s/g, '').length > 0) { // Checks if the string has an actual letter and not only white spaces.
        typingTimer = setTimeout(filtersearch(document.getElementById('filtersearch').value.trim()), doneTypingInterval);
    } else {
        $("#container tbody").html('');
    }
});

$('#type').change(function (e) { 
    e.preventDefault();
    if (document.location.pathname.split('/')[2]) {
        if (document.getElementById('filtersearch').value.trim())
            filtersearch(document.getElementById('filtersearch').value.trim());
        else
            filtersearch(document.location.pathname.split('/')[2])
    }
    else if (document.getElementById('filtersearch').value.trim())
        filtersearch(document.getElementById('filtersearch').value.trim());
});

function filtersearch (query) {
    var searchData = query;

    var type = $('#type').val();

    $.ajax({
        type: "POST",
        url: "/ajax.php",
        data: {
            search: searchData,
            displaytype: 1,
            type: type
        },
        success: function(html) {
            $("#container tbody").html(html).show();
        }
    });
}

var getUrlParameter = function getUrlParameter(sParam) {
    var sPageURL = window.location.search.substring(1),
        sURLVariables = sPageURL.split('&'),
        sParameterName,
        i;

    for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split('=');

        if (sParameterName[0] === sParam) {
            return typeof sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
        }
    }
    return false;
};

$(()=>{
    if (document.location.pathname.split('/')[2]) {
        if (getUrlParameter('t'))
            $('#type').val(getUrlParameter('t'));
        filtersearch(document.location.pathname.split('/')[2])
    }
});