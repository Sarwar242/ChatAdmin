@extends('layouts.auth')
    @section('content')
	<button id="chat">Refresh</button>
    <div class="container-fluid h-100">
			<div class="row justify-content-center h-100">
				<div class="col-md-4 col-xl-3 chat"><div class="card mb-sm-3 mb-md-0 contacts_card">
					<div class="card-header">
						<div class="input-group">
							<!-- <input type="text" placeholder="Search..." name="" class="form-control search">
							<div class="input-group-prepend">
								<span class="input-group-text search_btn"><i class="fas fa-search"></i></span>
							</div> -->
						</div>
					</div>
					<div class="card-body contacts_body">
						<ui id="usersss" class="contacts">
                      
						</ui>
					</div>
					<div class="card-footer"></div>
				</div></div>
				<div class="col-md-8 col-xl-6 chat">
					<div class="card">
						<div class="card-header msg_head">
							<div class="d-flex bd-highlight">
								<div class="img_cont">
									<img src="{{asset('img/user.png')}}" class="rounded-circle user_img">
									<span class="online_icon"></span>
								</div>
								<div class="user_info">
									<span id="username">Chat</span>
									<input type="hidden" id="uxd">
									<p>-- Messages</p>
								</div>
								<div class="video_cam">
									
								</div>
							</div>
							
						</div>
						<div id="chat-message-admin" class="card-body msg_card_body">
							
                        </div>
						<div class="card-footer">
							<div class="input-group">
								<div class="input-group-append">
									<span class="input-group-text attach_btn">
										<!-- <i class="fas fa-paperclip"></i> -->
									</span>
								</div>
								<textarea name="messageAdmin" id="messageAdmin" class="form-control type_msg" placeholder="Type your message..."></textarea>
								<div class="input-group-append">
									<span id="sendAdmin" class="input-group-text send_btn"><i class="fas fa-location-arrow"></i></span>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
    @endsection