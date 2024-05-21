<?php /*echo '<pre>';
 echo print_r($_SERVER);
 echo '</pre>';*/ ?>
  <div class="container col-md-10 col-sm-12 col-lg-12 rounded-1 d-flex justify-content-between bg-white" style="position:relative;">

      <section class="discussions col-lg-4 col-sm-0 overflow-hidden">
      <div class="discussion search"> 
        <form class="d-flex" id="searchform">
          <div class="searchbar">
            <i class="fa fa-search" aria-hidden="true"></i>
            <input class="form-control me-2" type="search" id="search_m" placeholder="...گەڕان " style="text-align:right;font-family:Arial, FontAwesome;"
                        aria-label="Search" autocomplete="off">
                        <div class="bg-white text-end rounded col-lg-4 py-3 px-4 mt-5" style="display:none;position:absolute;z-index:+99; top: 6%;  left:1%;" id="search_result_m" data-bs-auto-close="true">
<button type="button" class="btn-close" aria-label="Close" id="close_m_search"></button>
<div id="sram" class="text-start">
<p class="text-center text-muted">ناو یان ناوی بەکارهێنەر بنووسە</p>
</div>
</div>
          </div> </form>
        </div>
        <div id="chatlistt">

        </div>
        
      </section>

      
      <section class="chat col-md-8 col-sm-12" style="position:absolute; left: 35%; top:0;">
      <div class="chat_container">
      <a href="" id="cplinkk" class="text-decoration-none text-dark"> <div class="header-chat">
         <img src="assets/images/profile/default_profile.jpg" id="chatter_picc" style=" width: 50px;
                height: 50px;
                border-radius:50%;
                object-fit: cover;
                margin-left:3%;" >
                <span id="chatter_namee" class="name" ></span>

          <small style ="position:absolute; top:58%; left:11%; font-size:small" class="text-muted" id="statuss">

       </small>
          <i class="icon clickable fa fa-ellipsis-h right" aria-hidden="true"></i>

        </div>
 </a>       
        <div class="modal-dialog-scrollable messages-chat">
        <div class="modal-body d-flex flex-column-reverse gap-2" id="user_chatt">
     <span style="margin-left:30%; font-size:25px; font-weight:bold;" >  </span>

        </div>
      </div>
      </section>
<section class="input_section col-md-8 col-sm-12">
<p class="p-2 text-danger mx-auto" id="blerror" style="position: relative; top:90%; left:30%; font-size:20px; font-weight:bold;" > 
                  <i class="bi bi-x-octagon-fill"></i> ناتوانی نامە بۆ ئەم بەکارهێنەرە بنێری چیتر
          </p>
<div class="footer-chat" id="msgsender">
          <i class="icon fa fa-smile-o clickable" style="font-size:25pt;" aria-hidden="true"></i>
          <input type="text" class="write-message" id="msginput" placeholder="...شتێک بڵێ"
                            style="text-align: right; margin-right:5px;"  aria-label="Recipient's username" aria-describedby="button-addon2"></input>
          <button class="btn btn-outline-primary rounded-0 border-0 clickable" id="sendmsg" data-user-id="0" type="button"
                                >ناردن <i class="uil uil-message"></i></button>
        </div>
</div>
</section>


<style>

.discussions {
  width: 35%;
  height: 90vh;
  overflow: auto;
  background-color: white;
  display: inline-block;
}

.discussions .discussion {
  width: 100%;
  height: 90px;
  background-color: #FAFAFA;
  border-bottom: solid 1px #E0E0E0;
  display:flex;
  align-items: center;
  cursor: pointer;
}

.discussions .search {
  display:flex;
  align-items: center;
  justify-content: center;
  color: #E0E0E0;
}

.discussions .search .searchbar {
  height: 40px;
  background-color: #FFF;
  width: 70%;
  padding: 0 20px;
  border-radius: 50px;
  border: 1px solid #EEEEEE;
  display:flex;
  align-items: center;
  cursor: pointer;
}

.discussions .search .searchbar input {
  margin-left: 15px;
  height:38px;
  width:100%;
  border:none;
}

.discussions .search .searchbar *::-webkit-input-placeholder {
    color: #E0E0E0;
}
.discussions .search .searchbar input *:-moz-placeholder {
    color: #E0E0E0;
}
.discussions .search .searchbar input *::-moz-placeholder {
    color: #E0E0E0;
}
.discussions .search .searchbar input *:-ms-input-placeholder {
    color: #E0E0E0;
}

.discussions .message-active {
  width: 100%;
  height: 80px;
  background-color: #FFF;
  border-bottom: solid 1px #E0E0E0;
}

.discussions .discussion .photo {
    margin-left:20px;
    display: block;
    width: 45px;
    height: 45px;
    background: #E6E7ED;
    -moz-border-radius: 50px;
    -webkit-border-radius: 50px;
    background-position: center;
    background-size: cover;
    background-repeat: no-repeat;
}

.chat_container{
position: relative;
left:3%;
overflow-y: scroll; /* enable vertical scrolling */
height: 90vh;
}
.chat-container::-webkit-scrollbar-thumb {
  background-color: #ccc;
  border-radius: 10px;
}

/* style the track */
.chat-container::-webkit-scrollbar-track {
  background-color: #f2f2f2;
}
.online {
  position: relative;
  top: 30px;
  left: 35px;
  width: 13px;
  height: 13px;
  background-color: #8BC34A;
  border-radius: 13px;
  border: 3px solid #FAFAFA;
}

.desc-contact {
  height: 43px;
  width:50%;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
}

.discussions .discussion .name {
  margin: 0 0 0 20px;
  font-family:'Montserrat', sans-serif;
  font-size: 11pt;
  color:#515151;
}

.discussions .discussion .message {
  margin: 6px 0 0 20px;
  font-size: 9pt;
  color:#515151;
}

.timer {
  margin-left: 15%;
  font-family:'Open Sans', sans-serif;
  font-size: 11px;
  padding: 3px 8px;
  color: #BBB;
  background-color: #FFF;
  border: 1px solid #E5E5E5;
  border-radius: 15px;
}

.chat {
  width: calc(65% - 15px);
}

.header-chat {
  background-color: #FFF;
  height: 90px;
  box-shadow: 0px 3px 2px rgba(0,0,0,0.100);
  display:flex;
  align-items: center;
  position: relative;
left:-2%;
}

.chat .header-chat .icon {
  margin-left: 30px;
  color:#515151;
  font-size: 14pt;
}

.chat .header-chat .name {
  margin: 0 0 0 20px;
  text-transform: uppercase;
  font-size: 13pt;
  color:#515151;
}

.chat .header-chat .right {
  position: absolute;
  right: 40px;
}

.chat .messages-chat {
  padding: 25px 35px;
  
}

.chat .messages-chat .message {
  display:flex;
  align-items: center;
  margin-bottom: 8px;
}

.chat .messages-chat .message .photo {
    display: block;
    width: 45px;
    height: 45px;
    background: #E6E7ED;
    -moz-border-radius: 50px;
    -webkit-border-radius: 50px;
    background-position: center;
    background-size: cover;
    background-repeat: no-repeat;
}

.chat .messages-chat .text {
  margin: 0 35px;
  background-color: #f6f6f6;
  padding: 15px;
  border-radius: 12px;
}

.text-only {
  margin-left: 45px;
}

.time {
  font-size: 10px;
  color:lightgrey;
  margin-bottom:10px;
  margin-left: 85px;
}

.response-time {
  float: right;
  margin-right: 40px !important;
}

.response {
  float: right;
  margin-right: 0px !important;
  margin-left:auto; /* flexbox alignment rule */
}

.response .text {
  background-color: #e3effd !important;
}

.footer-chat {
  width: calc(66% - 15px);
  height: 11%;
  display:flex;
  align-items: center;
  position:absolute;
  bottom: 0;
  left:calc(37% - 20px);;
  background-color: white;
  border-top: 2px solid #EEE;
  
}

.input_section .footer-chat .icon {
  margin-left: 30px;
  color:#C0C0C0;
  font-size: 14pt;
}

.input_section .footer-chat .send {
  color:#fff;
  background-color: #4f6ebd;
  position: absolute;
  right: 50px;
  padding: 12px 12px 12px 12px;
  border-radius: 50px;
  font-size: 14pt;
}

.input_section .footer-chat .name {
  margin: 0 0 0 20px;
  text-transform: uppercase;
  font-family:'Montserrat', sans-serif;
  font-size: 13pt;
  color:#515151;
}

.input_section .footer-chat .right {
  position: absolute;
  right: 40px;
}

.write-message {
  border:none !important;
  width:60%;
  height: 50px;
  margin-left: 20px;
  padding: 10px;
}

.footer-chat *::-webkit-input-placeholder {
  color: #C0C0C0;
  font-size: 13pt;
}
.footer-chat input *:-moz-placeholder {
  color: #C0C0C0;
  font-size: 13pt;
}
.footer-chat input *::-moz-placeholder {
  color: #C0C0C0;
  font-size: 13pt;
  margin-left:5px;
}
.footer-chat input *:-ms-input-placeholder {
  color: #C0C0C0;
  font-size: 13pt;
}

.clickable {
  cursor: pointer;
}
</style>