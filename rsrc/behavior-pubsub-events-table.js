/**
 * @provides javelin-behavior-pubsub-events-table
 */

JX.behavior('pubsub-events-table', function (config) {
    jQuery( document ).ready(function ($) {
        $('#event-list').DataTable({
            "order": [[ 4, "desc" ]],
            "iDisplayLength": 100
        });
    });
});
