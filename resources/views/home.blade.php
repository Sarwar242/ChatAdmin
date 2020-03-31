@extends('layouts.auth')

@section('content')
<input style="display:none;" id="user_id" type="number" value="{{Auth::id()}}">
<div class="container text-center">
	<div class="row">
		<h2>Open in chat (popup-box chat-popup)</h2><br>
		<hr>
        <h4>Click Here</h4>
        <div class="round hollow text-center">
        <a href="#" id="addClass"><span class="glyphicon glyphicon-comment"></span> Open in chat </a>
        </di>
         <hr> 
	</div>
</div>


<div class="popup-box chat-popup" id="qnimate">
    <div class="popup-head">
		<div class="popup-head-left pull-left"><img src="{{asset('img/admin.png')}}" alt="iamgurdeeposahan"> Admin</div>
			<div class="popup-head-right pull-right">			
				<button data-widget="remove" id="removeClass" class="chat-header-button pull-right" type="button">
					<svg class="bi bi-x-circle-fill" width="1.5em" height="1.5em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  						<path fill-rule="evenodd" d="M16 8A8 8 0 110 8a8 8 0 0116 0zm-4.146-3.146a.5.5 0 00-.708-.708L8 7.293 4.854 4.146a.5.5 0 10-.708.708L7.293 8l-3.147 3.146a.5.5 0 00.708.708L8 8.707l3.146 3.147a.5.5 0 00.708-.708L8.707 8l3.147-3.146z" clip-rule="evenodd"/>
					</svg>
				</button>
            </div>
		</div>
		<div class="popup-messages">	
			<div id="chat-message" class="card-body msg_card_body">
				
			</div>
		</div>
		<div class="card-footer">
			<div class="input-group">
				<div class="input-group-append">
					<span id ="scroll" class="input-group-text attach_btn"><!-- <i class="fas fa-paperclip"></i> --></span>
				</div>
				<textarea id="message" name="message" class="form-control type_msg" placeholder="Type your message..."></textarea>
				<div class="input-group-append">
					<span class="input-group-text send_btn" id="send"><i class="fas fa-location-arrow"></i></span>
				</div>
			</div>					
		</div>
	</div>
</div>

<script>       
		$("#addClass").click(function() {
			$('.popup-box').scrollTop( $('.popup-box').height() );
        
        });
</script>
@endsection