/**
 $( function() {
    $(".datepicker").datepicker({
        "dateFormat": "yy-mm-dd",
    });
} );
*/

/**
 * Reinstall resources after Angular Template is loaded
 * @see https://stackoverflow.com/questions/12304291/angularjs-how-to-run-additional-code-after-angularjs-has-rendered-a-template
 */
function reinstall_resources()
{
    $(".datepicker").datepicker({
        "dateFormat": "yy-mm-dd",
        "changeYear": true,
    });
}