// public/js/search.js
$(document).ready(function() {
    $('#search-form').on('submit', function(event) {
        event.preventDefault();
        var query = $('#search-input').val();
        $.ajax({
            url: '/search',
            method: 'GET',
            data: { q: query },
            success: function(response) {
                var resultsHtml = '';
                for (var i = 0; i < response.length; i++) {
                    resultsHtml += '<div>' + response[i].title + '</div>';
                }
                $('#search-results').html(resultsHtml);
            }
        });
    });
});
