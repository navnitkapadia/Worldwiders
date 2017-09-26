<?php 
require 'db_config.php';
$sql = "SELECT start_date FROM event"; 
$result = $mysqli->query($sql);
echo "<script>\n var eventDates = {};\n";
while($row = $result->fetch_assoc()){
    extract($row);
    $formated =  date("m-d-y", strtotime($start_date));
    echo "eventDates[ new Date( '$formated' )] = new Date( '$formated' ) \n";
}
echo "
$('#datepicker').datepicker({
    onSelect: function(dateText) {
        $('.eventlist').load('api/filterEvent.php?date-select=' + dateText);
    },
    beforeShowDay: function(date) {
        var highlight = eventDates[date];
        
        if( highlight ) {
             return [true, 'event', 'Tooltip text'];
        } else {
             return [true, '', ''];
        }
    }
}); \n";
echo "</script>"
?>