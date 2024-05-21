//for preview the post image
input = document.querySelector("#select_post_img");
input.addEventListener("change", preview);

function preview() {
    var fileobject = this.files[0];
    var filereader = new FileReader();

    // Get the file extension
    var extension = fileobject.name.split('.').pop().toLowerCase();

    // Preview based on file extension
    if (extension == 'jpg' || extension == 'jpeg' || extension == 'png' || extension == 'gif' || extension == 'bmp') {
        filereader.readAsDataURL(fileobject);
        filereader.onload = function () {
            var image_src = filereader.result;
            var image = document.querySelector("#post_img");
            image.setAttribute('src', image_src);
            image.setAttribute('style', 'display:');
        }
    } else if (extension == 'mp4' || extension == 'webm' || extension == 'ogg' || extension == 'MOV' || extension == 'MP4') {
        filereader.readAsDataURL(fileobject);
        filereader.onload = function () {
            var video_src = filereader.result;
            var video = document.querySelector("#post_video");
            video.setAttribute('src', video_src);
            video.setAttribute('style', 'display:');
        }
    } else {
        console.log('Unsupported file type.');
    }
}


//for follow the user

$(".followbtn").click(function () {
    var user_id_v = $(this).data('userId');
    var button = this;
    $(button).attr('disabled', true);

    $.ajax({
        url: 'assets/php/ajax.php?follow',
        method: 'post',
        dataType: 'json',
        data: { user_id: user_id_v },
        success: function (response) {
            console.log(response);
            if (response.status) {
                $(button).data('userId', 0);
                $(button).html('<i class="bi bi-check-circle-fill"></i> شوێنیکەوتی')
            } else {
                $(button).attr('disabled', false);

                alert('something is wrong,try again after some time');
            }
        }
    });
});

$(".acceptbtn").click(function () {
    var user_id_v = $(this).data('userId');
    var button = this;
    $(button).attr('disabled', true);

    $.ajax({
        url: 'assets/php/ajax.php?accept',
        method: 'post',
        dataType: 'json',
        data: { user_id: user_id_v },
        success: function (response) {
            console.log(response);
            if (response.status) {
                $(button).data('userId', 0);
                $(button).html('<i class="bi bi-check-circle-fill"></i>')
            } else {
                $(button).attr('disabled', false);

                alert('something is wrong,try again after some time');
            }
        }
    });
});
$(".declinebtn").click(function () {
    var user_id_v = $(this).data('userId');
    var button = this;
    $(button).attr('disabled', true);

    $.ajax({
        url: 'assets/php/ajax.php?decline',
        method: 'post',
        dataType: 'json',
        data: { user_id: user_id_v },
        success: function (response) {
            console.log(response);
            if (response.status) {
                $(button).data('userId', 0);
                $(button).html('<i class="bi bi-check-circle-fill"></i>')
            } else {
                $(button).attr('disabled', false);

                alert('something is wrong,try again after some time');
            }
        }
    });
});

$(".reqbtn").click(function () {
    var user_id_v = $(this).data('userId');
    var button = this;
    $(button).attr('disabled', true);
    $.ajax({
        url: 'assets/php/ajax.php?request',
        method: 'post',
        dataType: 'json',
        data: { user_id: user_id_v },
        
        success: function (response) {
            console.log(response);
            if (response.status) {
                $(button).data('userId', 0);
                $(button).html('<i class="bi bi-check-circle-fill"></i> داواکاریەکەت نێردرا')
            } else {
                $(button).attr('disabled', false);

                alert('something is wrong,try again after some time');
            }
        }
    });
});


//for cancelling add request
$(".cancelbtn").click(function () {
    var user_id_v = $(this).data('userId');
    var button = this;
    $(button).attr('disabled', true);
    console.log('clicked');
    $.ajax({
        url: 'assets/php/ajax.php?cancelfollow',
        method: 'post',
        dataType: 'json',
        data: { user_id: user_id_v },
        success: function (response) {
            if (response.status) {
                $(button).data('userId', 0);
                $(button).html('<i class="bi bi-check-circle-fill"></i> پاشگەزبوویەوە')
            } else {
                $(button).attr('disabled', false);

                alert('something is wrong,try again after some time');
            }
        }
    });
});
//for unfollow the user

$(".unfollowbtn").click(function () {
    var user_id_v = $(this).data('userId');
    var button = this;
    $(button).attr('disabled', true);
    console.log('clicked');
    $.ajax({
        url: 'assets/php/ajax.php?unfollow',
        method: 'post',
        dataType: 'json',
        data: { user_id: user_id_v },
        success: function (response) {
            if (response.status) {
                $(button).data('userId', 0);
                $(button).html('<i class="bi bi-check-circle-fill"></i> لابردرا')
            } else {
                $(button).attr('disabled', false);

                alert('something is wrong,try again after some time');
            }
        }
    });
});




//for like the post



$(".like_btn").click(function () {
    var post_id_v = $(this).data('postId');
    var button = this;
    $(button).attr('disabled', true);
    $.ajax({
        url: 'assets/php/ajax.php?like',
        method: 'post',
        dataType: 'json',
        data: { post_id: post_id_v },
        success: function (response) {
            console.log(response);
            if (response.status) {

                $(button).attr('disabled', false);
                $(button).hide()
                $(button).siblings('.unlike_btn').show();
                $('#likecount' + post_id_v).text($('#likecount' + post_id_v).text() - (-1));
                // location.reload();

            } else {
                $(button).attr('disabled', false);

                alert('something is wrong,try again after some time');

            }


        }
    });
});

$(".like_comment_btn").click(function () {
    var comment_id_v = $(this).data('commentId');
    var button = this;
    $(button).attr('disabled', true);
    $.ajax({
        url: 'assets/php/ajax.php?likeC',
        method: 'post',
        dataType: 'json',
        data: { comment_id: comment_id_v },
        success: function (response) {
            console.log(response);
            if (response.status) {

                $(button).attr('disabled', false);
                $(button).hide()
                $(button).siblings('.unlike_comment_btn').show();
                $('#likecount' + comment_id_v).text($('#likecount' + comment_id_v).text() - (-1));
                // location.reload();

            } else {
                $(button).attr('disabled', false);

                alert('something is wrong,try again after some time');

            }


        }
    });
});

$(".unlike_comment_btn").click(function () {
    var comment_id_v = $(this).data('commentId');
    var button = this;
    $(button).attr('disabled', true);
    $.ajax({
        url: 'assets/php/ajax.php?unlikeC',
        method: 'post',
        dataType: 'json',
        data: { comment_id: comment_id_v },
        success: function (response) {

            if (response.status) {

                $(button).attr('disabled', false);
                $(button).hide()
                $(button).siblings('.like_btn').show();
                // location.reload();
                $('#likecount' + comment_id_v).text($('#likecount' + comment_id_v).text() - 1);

            } else {
                $(button).attr('disabled', false);

                alert('something is wrong,try again after some time');


            }



        }
    });
});

$(".unlike_btn").click(function () {
    var post_id_v = $(this).data('postId');
    var button = this;
    $(button).attr('disabled', true);
    $.ajax({
        url: 'assets/php/ajax.php?unlike',
        method: 'post',
        dataType: 'json',
        data: { post_id: post_id_v },
        success: function (response) {

            if (response.status) {

                $(button).attr('disabled', false);
                $(button).hide()
                $(button).siblings('.like_btn').show();
                // location.reload();
                $('#likecount' + post_id_v).text($('#likecount' + post_id_v).text() - 1);

            } else {
                $(button).attr('disabled', false);

                alert('something is wrong,try again after some time');


            }



        }
    });
});


//for adding comment
$(".add-comment").click(function () {
    var button = this;

    var comment_v = $(button).siblings('.comment-input').val();

    if (comment_v == '') {
        return 0;
    }
    var post_id_v = $(this).data('postId');
    var cs = $(this).data('cs');
    var page = $(this).data('page');


    $(button).attr('disabled', true);
    $(button).siblings('.comment-input').attr('disabled', true);
    $.ajax({
        url: 'assets/php/ajax.php?addcomment',
        method: 'post',
        dataType: 'json',
        data: { post_id: post_id_v, comment: comment_v },
        success: function (response) {
            console.log(response);
            if (response.status) {

                $(button).attr('disabled', false);
                $(button).siblings('.comment-input').attr('disabled', false);
                $(button).siblings('.comment-input').val('');
                $("#" + cs).prepend(response.comment);

                $('.nce').hide();
                if (page == 'wall') {
                    location.reload();
                }

            } else {
                $(button).attr('disabled', false);
                $(button).siblings('.comment-input').attr('disabled', false);

                alert('something is wrong,try again after some time');


            }



        }
    });
});

$(".add-reply").click(function () {
  var button = this;

  var comment_v = $(button).siblings('.reply-input').val();

  if (comment_v == '') {
      return 0;
  }
  var post_id_v = $(this).data('postId');
  var comment_id_v = $(this).data('commentId');
  var cs = $(this).data('cs');
  var page = $(this).data('page');


  $(button).attr('disabled', true);
  $(button).siblings('.reply-input').attr('disabled', true);
  $.ajax({
      url: 'assets/php/ajax.php?addreply',
      method: 'post',
      dataType: 'json',
      data: { post_id: post_id_v,comment_id: comment_id_v, comment: comment_v },
      success: function (response) {
          console.log(response);
          if (response.status) {

              $(button).attr('disabled', false);
              $(button).siblings('.reply-input').attr('disabled', false);
              $(button).siblings('.reply-input').val('');
              $("#" + cs).prepend(response.comment);

              $('.nce').hide();
              if (page == 'wall') {
                  location.reload();
              }

          } else {
              $(button).attr('disabled', false);
              $(button).siblings('.reply-input').attr('disabled', false);

              alert('something is wrong,try again after some time');


          }



      }
  });
});


var sr = false;

$("#search").focus(function () {
    $("#search_result").show();


});



$("#close_search").click(function () {
    $("#search_result").hide();
});

$("#search").keyup(function () {
    var keyword_v = $(this).val();

    $.ajax({
        url: 'assets/php/ajax.php?search',
        method: 'post',
        dataType: 'json',
        data: { keyword: keyword_v },
        success: function (response) {
            console.log(response);
            if (response.status) {
                $("#sra").html(response.users);

            } else {


                $("#sra").html('<p class="text-center text-muted">هیچ بەکارهێنەرێک بەو ناوە نیە</p>');




            }



        }
    });

});

// messages searches
$("#search_m").focus(function () {
    $("#search_result_m").show();


});



$("#close_m_search").click(function () {
    $("#search_result_m").hide();
});

$("#search_m").keyup(function () {
    var keyword_v = $(this).val();

    $.ajax({
        url: 'assets/php/ajax.php?search_m',
        method: 'post',
        dataType: 'json',
        data: { keyword: keyword_v },
        success: function (response) {
            console.log(response);
            if (response.status) {
                $("#sram").html(response.users);

            } else {


                $("#sram").html('<p class="text-center text-muted">هیچ بەکارهێنەرێک بەو ناوە نیە</p>');




            }



        }
    });

});

jQuery(document).ready(function () {
    jQuery("time.timeago").timeago();
});


$("#show_not").click(function () {

    $.ajax({
        url: 'assets/php/ajax.php?notread',
        method: 'post',
        dataType: 'json',
        success: function (response) {

            if (response.status) {
                $(".un-count").hide();
            }
        }
    });

});
$("#show_noti").click(function () {

    $.ajax({
        url: 'assets/php/ajax.php?notiread',
        method: 'post',
        dataType: 'json',
        success: function (response) {

            if (response.status) {
                $(".un-count").hide();
            }
        }
    });

});

$("#show_notb").click(function () {

  $.ajax({
      url: 'assets/php/ajax.php?notbread',
      method: 'post',
      dataType: 'json',
      success: function (response) {

          if (response.status) {
              $(".un-count").hide();
          }
      }
  });

});

function seenChat(chatId) {
    // Send the chat ID plus one to the server
    $.ajax({
      url: "assets/php/ajax.php?chatSeen",
      type: "POST",
      data: {chatId: chatId , res: 1},
      success: function(response) {
        console.log(response); // log the server's response
      },
      error: function(xhr) {
        console.log(xhr.responseText); // log any errors
      }
    });
  }
  

$("body").on("click", "#story_not", function() {
    var user_id_v = $(this).data('userId');
    
    $.ajax({
        url: 'assets/php/ajax.php?read',
        method: 'post',
        dataType: 'json',
        data: { user_id: user_id_v },
        success: function (response) {

            if (response.status) {
                $(".un-count").hide();
            }

        }
    });

});
//
//for deleting searches
function deleteSearches(searchId) {
  
    $.ajax({
      url: 'assets/php/ajax.php?deletesearch',
      method: 'POST',
      data: { search: searchId },
      success: function(response) {
        console.log('Successfully deleted search from database');
        var element = document.getElementById(searchId);
        if (response) {
    // Delete the element if it exists
    if (element) {
      element.parentNode.removeChild(element);
    }
          }
      },
      error: function(jqXHR, textStatus, errorThrown) {
        // Handle errors if any
        console.error(textStatus, errorThrown);
        modalBody.html('<div class="alert alert-danger">Error deleting comment. Please try again later.</div>');
      }
    });
  };

function recentSearches(username,id) {
    $.ajax({
      url: 'assets/php/ajax.php?recentsearch',
      type: 'POST',
      data: { search: username , id: id },
      success: function(data) {
        console.log('Successfully sent username to database');
      },
      error: function(xhr, textStatus, errorThrown) {
        console.error('Error sending username to database:', errorThrown);
      }
      
    });
  }

  // Define a function to send the AJAX request
function checkAuthAndUpdateTime() {
  // Send an AJAX request to the server to check the authentication status
  $.ajax({
    url: "assets/php/ajax.php?onlinestatus",
    type: "POST",
    success: function(data) {
      console.log("Time updated: " + data);
    },
      error: function(xhr, textStatus, errorThrown) {
        console.error('Error sending username to database:', errorThrown);
      }
     
    });
  
}

checkAuthAndUpdateTime();

// Call the checkAuthAndUpdateTime function every 2 minutes
setInterval(() => {
 
  checkAuthAndUpdateTime();

}, 120000);




  //for unblocking a user
$(".unblockbtn").click(function () {
    var user_id_v = $(this).data('userId');
    var button = this;
    $(button).attr('disabled', true);
    console.log('clicked');
    $.ajax({
        url: 'assets/php/ajax.php?unblock',
        method: 'post',
        dataType: 'json',
        data: { user_id: user_id_v },
        success: function (response) {
            console.log(response);
            if (response.status) {
                location.reload();
            } else {
                $(button).attr('disabled', false);

                alert('something is wrong,try again after some time');
            }
        }
    });
});

var chatting_user_id = 0;

$(".chatlist_item").click();

function popchat(user_id) {
    $("#user_chat").html(`
   <div class="d-flex justify-content-center align-items-center">
    <div class="dot-spinner">
    <div class="dot-spinner__dot"></div>
    <div class="dot-spinner__dot"></div>
    <div class="dot-spinner__dot"></div>
    <div class="dot-spinner__dot"></div>
    <div class="dot-spinner__dot"></div>
    <div class="dot-spinner__dot"></div>
    <div class="dot-spinner__dot"></div>
    <div class="dot-spinner__dot"></div>
</div>
</div>
    <style>
    .dot-spinner {
      --uib-size: 2.8rem;
      --uib-speed: .9s;
      --uib-color: #183153;
      position: relative;
      display: flex;
      align-items: center;
      justify-content: flex-start;
      height: var(--uib-size);
      width: var(--uib-size);
    }
    
    .dot-spinner__dot {
      position: absolute;
      top: 0;
      left: 0;
      display: flex;
      align-items: center;
      justify-content: flex-start;
      height: 100%;
      width: 100%;
    }
    
    .dot-spinner__dot::before {
      content: '';
      height: 20%;
      width: 20%;
      border-radius: 50%;
      background-color: var(--uib-color);
      transform: scale(0);
      opacity: 0.5;
      animation: pulse0112 calc(var(--uib-speed) * 1.111) ease-in-out infinite;
      box-shadow: 0 0 20px rgba(18, 31, 53, 0.3);
    }
    
    .dot-spinner__dot:nth-child(2) {
      transform: rotate(45deg);
    }
    
    .dot-spinner__dot:nth-child(2)::before {
      animation-delay: calc(var(--uib-speed) * -0.875);
    }
    
    .dot-spinner__dot:nth-child(3) {
      transform: rotate(90deg);
    }
    
    .dot-spinner__dot:nth-child(3)::before {
      animation-delay: calc(var(--uib-speed) * -0.75);
    }
    
    .dot-spinner__dot:nth-child(4) {
      transform: rotate(135deg);
    }
    
    .dot-spinner__dot:nth-child(4)::before {
      animation-delay: calc(var(--uib-speed) * -0.625);
    }
    
    .dot-spinner__dot:nth-child(5) {
      transform: rotate(180deg);
    }
    
    .dot-spinner__dot:nth-child(5)::before {
      animation-delay: calc(var(--uib-speed) * -0.5);
    }
    
    .dot-spinner__dot:nth-child(6) {
      transform: rotate(225deg);
    }
    
    .dot-spinner__dot:nth-child(6)::before {
      animation-delay: calc(var(--uib-speed) * -0.375);
    }
    
    .dot-spinner__dot:nth-child(7) {
      transform: rotate(270deg);
    }
    
    .dot-spinner__dot:nth-child(7)::before {
      animation-delay: calc(var(--uib-speed) * -0.25);
    }
    
    .dot-spinner__dot:nth-child(8) {
      transform: rotate(315deg);
    }
    
    .dot-spinner__dot:nth-child(8)::before {
      animation-delay: calc(var(--uib-speed) * -0.125);
    }
    
    @keyframes pulse0112 {
      0%,
      100% {
        transform: scale(0);
        opacity: 0.5;
      }
    
      50% {
        transform: scale(1);
        opacity: 1;
      }
    }
    
    </style>
   
    `);
    chatting_user_id = user_id;
    $("#chatter_name").text('');
    $("#chatter_pic").attr('src', 'assets/images/profile/default_profile.jpg');
    $("#status").text('');  
    $("#sendmsg").attr('data-user-id', user_id);
}


$("#sendmsg").click(function () {
    var user_id = chatting_user_id;
    var msg = $("#msginput").val();
    console.log(user_id);
    if (!msg) return;

    $("#sendmsg").attr("disabled", true);
    $("#msginput").attr("disabled", true);
    $.ajax({
        url: 'assets/php/ajax.php?sendmessage',
        method: 'post',
        dataType: 'json',
        data: { user_id: user_id, msg: msg },
        success: function (response) {
            if (response.status) {
                $("#sendmsg").attr("disabled", false);
                $("#msginput").attr("disabled", false);
                $("#msginput").val('');
            } else {
                alert('someting went wrong, try again after some time');
            }



        }
    });

});


  
function deleteComment(comment_id){
    $.ajax({
        url: 'assets/php/ajax.php?deletecomment',
        method: 'POST',
        data: { comment: comment_id },
        success: function(response) {
          console.log('Successfully deleted search from database');
          var element = document.getElementById(comment_id);
          if (response) {
      // Delete the element if it exists
      if (element) {
        element.parentNode.removeChild(element);
      }
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
          // Handle errors if any
          console.error(textStatus, errorThrown);
          modalBody.html('<div class="alert alert-danger">Error deleting comment. Please try again later.</div>');
        }
      });
    };

function hideChat(chat_id){
  
    $.ajax({
      url: 'assets/php/ajax.php?hidemessages',
      method: 'POST',
      data: { chat: chat_id },
      success: function(response) {
        console.log('Successfully deleted search from database');
        var element = document.getElementById(chat_id);
        if (response) {
    // Delete the element if it exists
    if (element) {
      element.parentNode.removeChild(element);
    }
          }
      },
      error: function(jqXHR, textStatus, errorThrown) {
        // Handle errors if any
        console.error(textStatus, errorThrown);
        modalBody.html('<div class="alert alert-danger">Error deleting comment. Please try again later.</div>');
      }
    });
  };

  function showTime(last_login) {
    let datetime = new Date(last_login);
    let now = new Date();
    let diff = Math.abs(now - datetime);
  
    let minute = 60 * 1000;
    let hour = 60 * minute;
    let day = 24 * hour;
    let week = 7 * day;
    let month = 30 * day;
    let year = 365 * day;
    if (diff < 2 * minute) {
        return "چاڵاکە";
      } else if (diff < hour) {
      let mins = Math.floor(diff / minute);
      return mins + " خولەک پێش ئێستا ";
    } else if (diff < day) {
      var hours = Math.floor(diff / hour);
      return "کاتژمێر پێش ئێستا" + hours;
    } else if (diff < week) {
      var days = Math.floor(diff / day);
      return "رۆژ پێش ئێستا" + days;
    } else if (diff < month) {
      var weeks = Math.floor(diff / week);
      return weeks + " هەفتە پێش ئێستا" ;
    } else if (diff < year) {
      var months = Math.floor(diff / month);
      return months + " مانگ پێش ئێستا";
    } else {
      var years = Math.floor(diff / year);
      return years + " year";
    }
  }


  function synmsg() {
    $.ajax({
        url: 'assets/php/ajax.php?getmessages',
        method: 'post',
        dataType: 'json',
        data: { chatter_id: chatting_user_id },
        success: function (response) {
            console.log(response);
            $("#chatlist").html(response.chatlist);
            if (response.newmsgcount == 0) {
                $("#msgcounter").hide();
                $("#msgcounterwall").hide();
            } else {
                $("#msgcounter").show();
                $("#msgcounterwall").show();
                $("#msgcounter").html("<small>" + response.newmsgcount + "</small>");
                $("#msgcounterwall").html("<small>" + response.newmsgcount + "</small>");
            }
            if (response.blocked) {
                $("#msgsender").hide();
                $("#blerror").show();
            } else {
                $("#msgsender").show();
                $("#blerror").hide();
            }
            if (chatting_user_id != 0) {
                // loop through each message and check if it's an audio tag with data-refresh="false"
                $("#user_chat").find("audio").each(function() {
                    if ($(this).attr("data-refresh") == "false") {
                        return; // skip refreshing this element
                    }
                });
                $("#user_chat").html(response.chat.msgs);
                $("#chatter_username").text(response.chat.userdata.username);
                $("#cplink").attr('href', '?u=' + response.chat.userdata.username);
                $("#chatter_name").text(response.chat.userdata.first_name + ' ' + response.chat.userdata.last_name);
                $("#chatter_pic").attr('src', 'assets/images/profile/' + response.chat.userdata.profile_pic);
                $("#chatter_pic").attr('src', 'assets/images/profile/' + response.chat.userdata.profile_pic);
                $("#status").html(showTime(response.chat.userdata.last_login));  
            }
        }
    });
}

synmsg();

setInterval(() => {
    synmsg();
}, 1000);


// for messenger
function synmsgg() {

  $.ajax({
      url: 'assets/php/ajax.php?getmessenger',
      method: 'post',
      dataType: 'json',
      data: { chatter_id: chatting_user_id },
      success: function (response) {
          console.log(response);
          $("#chatlistt").html(response.chatlist);
          if (response.newmsgcount == 0) {
              $("#msgcounter").hide();
              $("#msgcounterwall").hide();
          } else {
              $("#msgcounter").show();
              $("#msgcounterwall").show();
              $("#msgcounter").html("<small>" + response.newmsgcount + "</small>");
              $("#msgcounterwall").html("<small>" + response.newmsgcount + "</small>");
          }
          if (response.blocked) {
              $("#msgsender").hide();
              $("#blerror").show();

          } else {
              $("#msgsender").show();
              $("#blerror").hide();
          }

          if (chatting_user_id != 0) {
              $("#user_chatt").html(response.chat.msgs);
              $("#cplinkk").attr('href', '?u=' + response.chat.userdata.username);
              $("#chatter_namee").text(response.chat.userdata.first_name + ' ' + response.chat.userdata.last_name);
              $("#chatter_picc").attr('src', 'assets/images/profile/' + response.chat.userdata.profile_pic);
              $("#statuss").html(showTime(response.chat.userdata.last_login));  
           
          }

         
      }
  });
}
 
  
synmsgg();

setInterval(() => {
  synmsgg();

}, 1000);



var chatting_user_id = 0;

$(".chatlist_itemm").click();

function popchatt(user_id) {
  $("#user_chatt").html(`
  <div class="d-flex justify-content-center align-items-center">
    <div class="dot-spinner">
    <div class="dot-spinner__dot"></div>
    <div class="dot-spinner__dot"></div>
    <div class="dot-spinner__dot"></div>
    <div class="dot-spinner__dot"></div>
    <div class="dot-spinner__dot"></div>
    <div class="dot-spinner__dot"></div>
    <div class="dot-spinner__dot"></div>
    <div class="dot-spinner__dot"></div>
</div>
</div>
    <style>
    .dot-spinner {
      --uib-size: 2.8rem;
      --uib-speed: .9s;
      --uib-color: #183153;
      position: relative;
      display: flex;
      align-items: center;
      justify-content: flex-start;
      height: var(--uib-size);
      width: var(--uib-size);
    }
    
    .dot-spinner__dot {
      position: absolute;
      top: 0;
      left: 0;
      display: flex;
      align-items: center;
      justify-content: flex-start;
      height: 100%;
      width: 100%;
    }
    
    .dot-spinner__dot::before {
      content: '';
      height: 20%;
      width: 20%;
      border-radius: 50%;
      background-color: var(--uib-color);
      transform: scale(0);
      opacity: 0.5;
      animation: pulse0112 calc(var(--uib-speed) * 1.111) ease-in-out infinite;
      box-shadow: 0 0 20px rgba(18, 31, 53, 0.3);
    }
    
    .dot-spinner__dot:nth-child(2) {
      transform: rotate(45deg);
    }
    
    .dot-spinner__dot:nth-child(2)::before {
      animation-delay: calc(var(--uib-speed) * -0.875);
    }
    
    .dot-spinner__dot:nth-child(3) {
      transform: rotate(90deg);
    }
    
    .dot-spinner__dot:nth-child(3)::before {
      animation-delay: calc(var(--uib-speed) * -0.75);
    }
    
    .dot-spinner__dot:nth-child(4) {
      transform: rotate(135deg);
    }
    
    .dot-spinner__dot:nth-child(4)::before {
      animation-delay: calc(var(--uib-speed) * -0.625);
    }
    
    .dot-spinner__dot:nth-child(5) {
      transform: rotate(180deg);
    }
    
    .dot-spinner__dot:nth-child(5)::before {
      animation-delay: calc(var(--uib-speed) * -0.5);
    }
    
    .dot-spinner__dot:nth-child(6) {
      transform: rotate(225deg);
    }
    
    .dot-spinner__dot:nth-child(6)::before {
      animation-delay: calc(var(--uib-speed) * -0.375);
    }
    
    .dot-spinner__dot:nth-child(7) {
      transform: rotate(270deg);
    }
    
    .dot-spinner__dot:nth-child(7)::before {
      animation-delay: calc(var(--uib-speed) * -0.25);
    }
    
    .dot-spinner__dot:nth-child(8) {
      transform: rotate(315deg);
    }
    
    .dot-spinner__dot:nth-child(8)::before {
      animation-delay: calc(var(--uib-speed) * -0.125);
    }
    
    @keyframes pulse0112 {
      0%,
      100% {
        transform: scale(0);
        opacity: 0.5;
      }
    
      50% {
        transform: scale(1);
        opacity: 1;
      }
    }
    
    </style>
    `);
    chatting_user_id = user_id;
    $("#chatter_namee").text('');
    $("#chatter_picc").attr('src', 'assets/images/profile/default_profile.jpg');
    $("#statuss").text('');  
    $("#sendmsg").attr('data-user-id', user_id);
}