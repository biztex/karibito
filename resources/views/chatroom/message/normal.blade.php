<li>
    <div class="img">
        @include('chatroom.message.parts.icon')
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
    @include('chatroom.message.parts.time')
</li>