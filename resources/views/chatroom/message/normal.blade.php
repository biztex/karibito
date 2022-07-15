<li>
    <div class="img">
        @if(null !== $message->user->userProfile->icon)
            <p style="width: 50px;height: 50px;"  class="head"><img src="{{ asset('/storage/'.$message->user->userProfile->icon) }}" alt="" style="width: 50px;height: 50px;object-fit: cover;"></p>
        @else
            <p style="width: 50px;height: 50px;"  class="head"><img src="/img/mypage/no_image.jpg" alt="" style="width: 50px;height: 50px;object-fit: cover;"></p>
        @endif
        <div class="info">
            <p class="name">{{$message->user->name}}</p>

            <p class="chatroom-text break-word">{!! $message->text !!}</p>
            @if($message->file_name !== null)
                <p class="chatroom-text break-word"><a href="{{ asset('/storage/'.$message->file_path) }}" download="{{ $message->file_name }}"  style="display: inline-flex; vertical-align: center;">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark" viewBox="0 0 16 16">
                    <path d="M14 4.5V14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h5.5L14 4.5zm-3 0A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V4.5h-2z"/>
                </svg>{{ $message->file_name }}
                </a></p>                  
            @endif

        </div>
    </div>
    <p class="time">既読 {{date('Y年m月d日 G:i', strtotime($message->created_at))}}</p>
</li>