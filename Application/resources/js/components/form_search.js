import eventBus from '../vue/eventBus';
import 'devbridge-autocomplete';

// Client Search
(() => {
    const clients = $('#client-search');
    const clientID = $('#client-id');

    if(!clients)
        return;

    const clientsURL = clients.data('ajax-url');

    clients.autocomplete({
        lookup: function (query, done) {
            $.getJSON(clientsURL, { q: query }, function (data) {
                const suggestions = data.map(item => ({
                    value: item.name,
                    data: item.id
                }));
                done({ suggestions });
            });
        },
        dataType: 'text',
        minChars: 0,
        onSelect: function (suggestion) {
            clients.val(suggestion.value);
            clientID.val(suggestion.data);
        }
    });
})();

// Vue - Service Search
(() => {
    eventBus.on('add-service-modal-loaded', () => {
        const services = $('#service-name');

        if(!services)
            return;

        const servicesURL = services.data('ajax-url');

        services.autocomplete({
            lookup: function (query, done) {
                $.getJSON(servicesURL, { q: query }, function (data) {
                    const suggestions = data.map(item => ({
                        value: item.name,
                        data: item
                    }));
                    done({ suggestions });
                });
            },
            dataType: 'text',
            minChars: 0,
            onSelect: function (suggestion) {
                eventBus.emit('service-modal-selected', { ...suggestion.data});
            }
        });
    });
})();