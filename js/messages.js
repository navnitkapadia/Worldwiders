function resize()
{
    var heights = window.innerHeight - 150;
    document.getElementById("conversation").style.height = heights + "px";
    
}
window.onresize = function() {
    resize();
};

$('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
   
    resize();
    var target = $(e.target).attr("href") // activated tab
    var conid = $(e.target).attr("con-id") // activated tab'
   console.log(".open-"+conid);
     console.log(getdata, killId);
    var killId = setTimeout(function() {
        for (var i = killId; i > 0; i--) clearInterval(i)
      }, 50);

      var getdata = setInterval(function() {
        $(".open-"+conid).load("api/get_messages.php?c_id="+conid);
   }, 2000);
   $(".open-"+conid).scrollTop($(".open-"+conid)[0].scrollHeight);

  });

function getMessages(btnid,convid,sender,receiver){
     var message = $.trim($("#"+btnid).val());
     if(message && convid && sender && receiver != null){
        $.ajax({
            type: 'post',
            url: "api/message-api.php?action=p",
            data: {message:message,conversation_id:convid,user_form:sender,user_to:receiver},
            success: function(data){
                //clear the message box
                $("#"+btnid).val("");
            }
        })
     } else {
         console.log('nai thay send');
     }
}

$(document).ready(function(){
    conversation_id = $.trim($("#conversation_id").val());
    var getdata = setInterval(function() {
        $(".open-"+conversation_id).load("api/get_messages.php?c_id="+conversation_id);
   }, 2000);
   $(".open-"+conversation_id).scrollTop($(".open-"+conversation_id)[0].scrollHeight);
});