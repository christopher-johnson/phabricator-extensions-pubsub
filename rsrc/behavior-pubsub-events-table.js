/**
 * @provides javelin-behavior-pubsub-events-table
 */

JX.behavior('pubsub-events-table', function (config) {
    jQuery( document ).ready(function ($) {
        $('#event-list').DataTable({
            "order": [[ 4, "desc" ]],
            "aoColumnDefs": [
                { "aTargets": [ 0 ], "sWidth": "30%" },
                { "aTargets": [ 1 ], "sWidth": "10%" },
                { "aTargets": [ 2 ], "sWidth": "10%" },
                { "aTargets": [ 3 ], "sWidth": "10%" },
                { "aTargets": [ 4 ], "sWidth": "10%" }
            ],
            "iDisplayLength": 100
        });
    });
});
