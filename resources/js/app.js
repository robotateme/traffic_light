import './bootstrap';

$('table').dataTable({
    paging: false,
    ajax: '/api/traffic-light/log',
    class: '',
    searching: false,
    columns: [
        { data: 'id' },
        { data: 'message' },
        { data: 'created_at' },
    ],
});

$('#button_start').click(function () {
    axios.get('/api/traffic-light/start')
        .then((response) => {
            $('table#log_table').DataTable().ajax.reload();
            console.log(response.data);
            console.log(response.status);
            console.log(response.statusText);
            console.log(response.headers);
            console.log(response.config);
        });

});

function shutdownLights() {
    $(document).find('span.active').each(function (index) {
        $(this).removeClass('active');
    });
}

function switchLightTo(light) {
    shutdownLights();
    $(document).find('span.' + light + '_light').addClass('active');
}

Echo.channel('traffic-light')
    .listen('.light-switched', (e) => {
        console.log(e.data);
        switchLightTo(e.data.current_light);
    });



