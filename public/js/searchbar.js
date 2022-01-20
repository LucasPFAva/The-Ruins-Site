var typingTimer;              // Current time.
var doneTypingInterval = 500; // Time in ms, 0.5 seconds.
var elementsAdded = 0;        // Current element index.

$('#searchbar').submit(function (e) { 
    e.preventDefault();
    return window.location.href = '/search/' + document.getElementById('search').value.trim();
});

document.getElementById('search').addEventListener("keyup", function(event) {
    clearTimeout(typingTimer);
    if (document.getElementById('search').value.replace(/\s/g, '').length > 0) { // Checks if the string has an actual letter and not only white spaces.
        typingTimer = setTimeout(search(document.getElementById('search').value.trim()), doneTypingInterval);
    } else {
        document.getElementById('results').innerHTML = '';
    }
});

function search (query) {
    var searchData = query;

    $.ajax({
        type: "POST",
        url: "/ajax.php",
        data: {
            search: searchData,
            displaytype: 0
        },
        success: function(html) {
            $("#results").html(html).show();
        }
    });
}

document.addEventListener('click',function(){
    document.getElementById('results').style.display = 'none';
});
document.getElementById('search').addEventListener('click', function(event) {
    document.getElementById('results').style.display = 'flex';
});