function resize()
{
    var heights = window.innerHeight - 150;
    var el = document.getElementsByClassName('chat-message');
    for(var i = 0; i< el.length; i++){
        el[i].style.maxHeight = heights + "px";
        el[i].scrollTop = el[i].scrollHeight;
        }        
}
window.onresize = function() {
    resize();
}; 

$('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
    var target = $(e.target).attr("href") // activated tab
    var conid = $(e.target).attr("con-id") // activated tab'
    var killId = setTimeout(function() {
        for (var i = killId; i > 0; i--) clearInterval(i)
      }, 50);

      var getdata = setInterval(function() {
        $(".open-"+conid).load("api/get_messages.php?c_id="+conid);
   }, 2000);
  });

function getMessages(btnid,convid,sender,receiver){
     var message = $.trim($("#"+btnid).val());
     $('#'+btnid)[0].classList.add('disabled');
     $('.'+btnid)[0].classList.add('disabled');
     //btnid.classList.add("disabled");
     if(message && convid && sender && receiver != null){
        $.ajax({
            type: 'post',
            url: "api/message-api.php?action=p",
            data: {message:message,conversation_id:convid,user_form:sender,user_to:receiver},
            success: function(data){
                resize();
                $(".open-"+convid).load("api/get_messages.php?c_id="+convid);
                //clear the message box
                $("#"+btnid).val("");
                $('#'+btnid)[0].classList.remove('disabled');
                $('.'+btnid)[0].classList.remove('disabled');
            }
        })
     } else {
         console.log('Problem in sending message');
     }
}

$(document).ready(function(){
    
    conversation_id = $.trim($("#conversation_id").val());
    var getdata = setInterval(function() {
        $(".open-"+conversation_id).load("api/get_messages.php?c_id="+conversation_id);
        resize();
   }, 3000);
   resize();
});