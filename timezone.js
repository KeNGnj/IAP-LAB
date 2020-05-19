$(document).ready(function(){

    //Returns the number of minutes ahead or behind green which meridian
    var offset = new Date().getTimezoneOffset();
    /*Return the number of milliseconds since 1970/01/01:*/
    var timestamp = new Date().getTime();

    //We convert out time to UTC
    var utc_timestamp = timestamp + (6000 * offset);

    $('#time_zone_offset').val(offset);//connecting the value of the offset to time_zone_offset
    $('#utc_timestamp').val(utc_timestamp);//connecting the value of the to utc_timestamp variables

});