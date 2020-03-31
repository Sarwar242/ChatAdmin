$(function(){
    $("#addClass").click(function () {
              $('#qnimate').addClass('popup-box-on');
                });
              
    $("#removeClass").click(function () {
              $('#qnimate').removeClass('popup-box-on');
                });
    $("#addClass").click(function() {
      var options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric',
       hour: '2-digit', minute: '2-digit' };
       var options2 = { hour: '2-digit', minute: '2-digit' };

    var messages = " ";
    var user_id=$("#user_id").val();
    console.log(user_id);
    //send an ajax req to servers
    $.get("http://127.0.0.1:8000/get-messages/" +
        user_id,
        function(data) {
            var d = JSON.parse(data);
            d.forEach(function(element) {
              //console.log(element);
              var time  = new Date(element.updated_at);
              var d = new Date();
            if(time.getDate()==d.getDate()){
              if(element.is_sent){
                messages += "<div class='d-flex justify-content-start mb-4'>"
            +"<div class='img_cont_msg'> <img src='img/user.png' class='rounded-circle user_img_msg'></div>"
            +"<div class='msg_cotainer'>"+element.message+
            "<span class='msg_time_send'>Today "+time.toLocaleTimeString("en-US", options2)+"</span></div></div>";
            }else{
  
              messages += "<div class='d-flex justify-content-end mb-4'>"
              +"<div class='msg_cotainer_send'>"+element.message+
              "<span class='msg_time_send'>Today "+time.toLocaleTimeString("en-US", options2)+"</span></div>"
              +"<div class='img_cont_msg'>"+
              "<img src='img/admin.png' class='rounded-circle user_img_msg'></div></div>";
             
            }}
            else if(time.getDate()==d.getDate()-1){
              if(element.is_sent){
                messages += "<div class='d-flex justify-content-start mb-4'>"
            +"<div class='img_cont_msg'> <img src='img/user.png' class='rounded-circle user_img_msg'></div>"
            +"<div class='msg_cotainer'>"+element.message+
            "<span class='msg_time_send'>Yesterday "+time.toLocaleTimeString("en-US", options2)+"</span></div></div>";
            }else{
  
              messages += "<div class='d-flex justify-content-end mb-4'>"
              +"<div class='msg_cotainer_send'>"+element.message+
              "<span class='msg_time_send'>Yesterday "+time.toLocaleTimeString("en-US", options2)+"</span></div>"
              +"<div class='img_cont_msg'>"+
              "<img src='img/admin.png' class='rounded-circle user_img_msg'></div></div>";
             
            }}
            else{
              if(element.is_sent){
                messages += "<div class='d-flex justify-content-start mb-4'>"
            +"<div class='img_cont_msg'> <img src='img/user.png' class='rounded-circle user_img_msg'></div>"
            +"<div class='msg_cotainer'>"+element.message+
            "<span class='msg_time_send'>"+time.toLocaleDateString("en-US", options)+"</span></div></div>";
            }else{
  
              messages += "<div class='d-flex justify-content-end mb-4'>"
              +"<div class='msg_cotainer_send'>"+element.message+
              "<span class='msg_time_send'>"+time.toLocaleDateString("en-US", options)+"</span></div>"
              +"<div class='img_cont_msg'>"+
              "<img src='img/admin.png' class='rounded-circle user_img_msg'></div></div>";
             
            }
            }
          });
            $("#chat-message").html(messages);
        });
      });
      

    $("#send").click(function() {
      $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
      var msg = $.trim($("#message").val());
        $.post("/chats/store", {
                msg: msg
            })
            .done(function(data) {
                data = JSON.parse(data);
                if (data.status == 'success') {
                    console.log(data.status);
                    $("#message").val("");
                    $( "#addClass" ).click(); 
                }
            });
    });



    //admin side
    $("#chat").click(function(){
       $("#usersss").html("");
       let xyz=" ";
      $.get("http://127.0.0.1:8000/get-users",
      function(data) {
        //console.log('clicked');
        var d4 =JSON.parse(data);
        console.log(d4);
        for(key in d4)
        {
            xyz += "<li> <div class='d-flex bd-highlight'>"
                + "<div class='img_cont'>"
                 +  "<img src='img/user.png' class='rounded-circle user_img'>"
                  + "<span class='online_icon'></span></div>"    
                 +"<div  class='user_info'>"             
               + "<span class='see_message' style='cursor:pointer'>"+d4[key].user.name+
               "<input type='hidden' id='uid' value='"+d4[key].user_id+"'>"
               +"<input style='display:none' id='uname' value='"+d4[key].user.name+"'></input></span>"
                 +  "<p id='n'> is online</p>"
                 +"</div></div></li>";   
                 //console.log(key);
          }
          $("#usersss").html(xyz);
        });
     });
     $(document).on('click', '.see_message',function(){
      //event.preventDefault();
      // console.log("this.click");
      var uid = $(this).find("#uid").val();
      var username = $(this).find("#uname").val();
      $("#username").html(username);
      $("#uxd").val(uid);
      var options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric',
       hour: '2-digit', minute: '2-digit' };
       var options2 = { hour: '2-digit', minute: '2-digit' };
    
      var messages = " ";
     // console.log(uid);
      //send an ajax req to servers
    $.get("http://127.0.0.1:8000/get-messages/"+
    uid,
    function(data) {
        var d = JSON.parse(data);
        
        d.forEach(function(element) {
            //console.log(element);
            var time  = new Date(element.updated_at);
            var d = new Date();
          if(time.getDate()==d.getDate()){
            if(element.is_sent){
              messages += "<div class='d-flex justify-content-start mb-4'>"
          +"<div class='img_cont_msg'> <img src='img/user.png' class='rounded-circle user_img_msg'></div>"
          +"<div class='msg_cotainer'>"+element.message+
          "<span class='msg_time_send'>Today "+time.toLocaleTimeString("en-US", options2)+"</span></div></div>";
          }else{

            messages += "<div class='d-flex justify-content-end mb-4'>"
            +"<div class='msg_cotainer_send'>"+element.message+
            "<span class='msg_time_send'>Today "+time.toLocaleTimeString("en-US", options2)+"</span></div>"
            +"<div class='img_cont_msg'>"+
            "<img src='img/admin.png' class='rounded-circle user_img_msg'></div></div>";
           
          }}
          else if(time.getDate()==d.getDate()-1){
            if(element.is_sent){
              messages += "<div class='d-flex justify-content-start mb-4'>"
          +"<div class='img_cont_msg'> <img src='img/user.png' class='rounded-circle user_img_msg'></div>"
          +"<div class='msg_cotainer'>"+element.message+
          "<span class='msg_time_send'>Yesterday "+time.toLocaleTimeString("en-US", options2)+"</span></div></div>";
          }else{

            messages += "<div class='d-flex justify-content-end mb-4'>"
            +"<div class='msg_cotainer_send'>"+element.message+
            "<span class='msg_time_send'>Yesterday "+time.toLocaleTimeString("en-US", options2)+"</span></div>"
            +"<div class='img_cont_msg'>"+
            "<img src='img/admin.png' class='rounded-circle user_img_msg'></div></div>";
           
          }}
          else{
            if(element.is_sent){
              messages += "<div class='d-flex justify-content-start mb-4'>"
          +"<div class='img_cont_msg'> <img src='img/user.png' class='rounded-circle user_img_msg'></div>"
          +"<div class='msg_cotainer'>"+element.message+
          "<span class='msg_time_send'>"+time.toLocaleDateString("en-US", options)+"</span></div></div>";
          }else{

            messages += "<div class='d-flex justify-content-end mb-4'>"
            +"<div class='msg_cotainer_send'>"+element.message+
            "<span class='msg_time_send'>"+time.toLocaleDateString("en-US", options)+"</span></div>"
            +"<div class='img_cont_msg'>"+
            "<img src='img/admin.png' class='rounded-circle user_img_msg'></div></div>";
           
          }
          }
        });

        $("#chat-message-admin").html(messages);
        
    });
  });
  
  $("#sendAdmin").click(function() {
    $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });
    var msg = $.trim($("#messageAdmin").val());
    var user_id=$("#uxd").val();
   
      $.post("/chatsAdmin/store", {
              msg: msg,
              user_id:user_id
          })
          .done(function(data) {
              data = JSON.parse(data);
              if (data.status == 'success') {
                  console.log(data.status);
                  $("#messageAdmin").val("");
              }
          });
  });

})