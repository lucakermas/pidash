$(document).ready(runUpdates);

/**
 * This updates all widgets that have updatable data (ie. weather or cpu temp).
 */
function runUpdates() {
    updateWeather();
}

function updateWeather() {
    console.log('Updating weather...');
    $('.weather-widget').each(function (key, elem) {
        elem = $(elem);

        $.ajax({
            url: elem.data('url'),
            type: 'GET',
            success: function (data) {
                const icon = $(elem.find('i'));
                const tempText = $(elem.find('h3'));

                icon.attr('class', `wi ${data.icon}`);
                tempText.text(`${data.temperature} °${data.tempType}`);
            }
        });
    });

    // Run this function again in 30 minutes.
    setTimeout(updateWeather, (60 * 30) * 1000);
}