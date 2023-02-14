<x-layout>
    <body id="estimate" class="dm-page-show">
    <x-parts.post-button/>
    <article>
    <x-parts.flash-msg/>
        <div id="contents" class="otherPage">
            <div class="inner02 clearfix">
                <div id="main">
                    <div class="friendsTop">
                        @if($dmroom->from_user_id === Auth::id())
                            <div class="sellerTop">
                                <div class="user">
                                    @if($dmroom->toUser->userProfile->icon === null)
                                        @if(empty($dmroom->toUser->deleted_at))
                                            <a href="{{ route('user.mypage', $dmroom->toUser->id) }}" class="head"><img src="/img/mypage/no_image.jpg" alt=""></a>
                                        @else
                                            <span class="head"><img src="/img/mypage/no_image.jpg" alt=""></span>
                                        @endif
                                    @else
                                        @if(empty($dmroom->toUser->deleted_at))
                                            <a href="{{ route('user.mypage', $dmroom->toUser->id) }}" class="head"><img src="{{ asset('/storage/'.$dmroom->toUser->userProfile->icon) }}" alt=""></a>
                                        @else
                                            <span class="head"><img src="{{ asset('/storage/'.$dmroom->toUser->userProfile->icon) }}" alt=""></span>
                                        @endif
                                    @endif
                                    <div class="info">
                                        <p class="name">{{ $dmroom->toUser->name }}</p>
                                        @if(isset($dmroom->toUser->deleted_at))
                                            <p class="name">このユーザーは退会しました。</p>
                                        @endif
                                    </div>
                                </div>
                                <p class="login">最終ログイン：{{ $dmroom->toUser->latest_login_datetime }}</p>
                            </div>
                        @else
                            <div class="sellerTop">
                                <div class="user">
                                    @if($dmroom->fromUser->userProfile->icon === null)
                                        @if(empty($dmroom->fromUser->deleted_at))
                                            <a href="{{ route('user.mypage', $dmroom->fromUser->id) }}" class="head"><img src="/img/mypage/no_image.jpg" alt=""></a>
                                        @else
                                            <span class="head"><img src="/img/mypage/no_image.jpg" alt=""></span>
                                        @endif
                                    @else
                                        @if(empty($dmroom->fromUser->deleted_at))
                                            <a href="{{ route('user.mypage', $dmroom->fromUser->id) }}" class="head"><img src="{{ asset('/storage/'.$dmroom->fromUser->userProfile->icon) }}" alt=""></a>
                                        @else
                                            <span class="head"><img src="{{ asset('/storage/'.$dmroom->fromUser->userProfile->icon) }}" alt=""></span>
                                        @endif
                                    @endif
                                    <div class="info">
                                        <p class="name">{{ $dmroom->fromUser->name }}</p>
                                        @if(isset($dmroom->fromUser->deleted_at))
                                            <p class="name">このユーザーは退会しました。</p>
                                        @endif
                                    </div>
                                </div>
                                <p class="login">最終ログイン：{{ $dmroom->fromUser->latest_login_datetime }}</p>
                            </div>
                        @endif
                    </div>
                    <h2 class="hdM">DM</h2>
                    <div class="subPagesTab">
                        <div class="chatPages">
                            <div class="item">
                                <div class="warnBox">
                                    <p class="warnBoxTitle" style="color:red;">【注意事項】</p>
                                    <p class="warnBoxText">メッセージのやり取りは、必ず「カリビトチャット」を通じて行ってください。<br>・メールアドレス・LINE・電話など外部連絡先の交換、またそれらを用いてのやり取り<br>・カリビト外での直接取引を促す行為<br>カリビトではこれらの行為を禁止しております。<br>確認した場合、アカウントの停止など、今後のご利用をお断りさせていただくことがございますので、ご注意ください。</p>
                                </div>
                                <ul class="communicate">
                                @foreach($dmroom->dmroomMessages as $message)
                                    <li>
                                        <div class="img">
                                            @if(null !== $message->user->userProfile->icon)
                                                @if(empty($message->user->deleted_at))
                                                    <a href="{{ route('user.mypage', $message->user->id) }}" class="head"><img src="{{ asset('/storage/'.$message->user->userProfile->icon) }}" alt=""></a>
                                                @else
                                                    <span class="head"><img src="{{ asset('/storage/'.$message->user->userProfile->icon) }}" alt=""></span>
                                                @endif
                                            @else
                                                @if(empty($message->user->deleted_at))
                                                    <a href="{{ route('user.mypage', $message->user->id) }}" class="head"><img src="/img/mypage/no_image.jpg" alt=""></a>
                                                @else
                                                    <span class="head"><img src="/img/mypage/no_image.jpg" alt=""></span>
                                                @endif
                                            @endif
                                            <div class="info">
                                                <p class="name">{{$message->user->name}}</p>
                                                @if(isset($message->user->deleted_at))
                                                    <p class="name">このユーザーは退会しました。</p>
                                                @endif
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
                                        <p class="time">@if($message->user_id === Auth::id() && $message->is_view === 1) 既読 @endif {{date('Y年m月d日 G:i', strtotime($message->created_at))}}</p>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        @if(empty($dmroom->fromUser->deleted_at) && empty($dmroom->toUser->deleted_at))
                            <form action="{{ route('dm.message', $dmroom->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                                <div class="item">
                                @error('text')<div class="alert alert-danger">{{ $message }}</div>@enderror
                                    <div class="evaluation">
                                        <textarea name="text" placeholder="本文を入力してください" class="templateText" onclick="ClickShowLength(value);" onkeyup="ShowLength(value);">{{ old('text') }}</textarea>
                                    </div>
                                    <p class="max-string" id="inputlength">{{ mb_strlen(old('text')) }}/3000</p>
                                    @error('file_path')<div class="alert alert-danger">{{ $message }}</div>@enderror
                                    <p class="input-file-name" style='color:#696969;margin-top:10px;'></p>
                                    <div class="btns">
                                        <p class="chatroom_file_input">資料を添付する</p>
                                        <input type="file" name="file_path" id="file_path" style="display:none;">
                                        <input type="hidden" name="file_name" value="">
                                        <a href="javascript:;" class="templateOpen">定型文を使う</a>
                                        <div class="templatePopup">
                                            <div class="templateOverlay"></div>
                                            <div class="templateArea tabSelectArea">
                                                <div class="templateClose"></div>
                                                <h2 class="templateTitle">定型文の挿入</h2>
                                                <div class="templateSelect">
                                                    <select class="tabSelectLinks">
                                                        <option value="#template01">購入前の問い合わせ（購入者）</option>
                                                        <option value="#template02">購入確認のあいさつ（購入者）</option>
                                                        <option value="#template03">購入確認のあいさつ（出品者）</option>
                                                        <option value="#template04">購入後のあいさつ（購入者）</option>
                                                        <option value="#template05">購入後のあいさつ（出品者）</option>
                                                        <option value="#template06">やりとりが滞ってしまったら</option>
                                                        <option value="#template07">キャンセルについて（購入者）</option>
                                                        <option value="#template08">納品完了メール（出品者）</option>
                                                        <option value="#template09">サービス受取時（納品者）</option>
                                                    </select>
                                                </div>
                                                <div class="templateBox tabSelectBox is-active" id="template01">
<textarea readonly> {{--表示が崩れるためインデント無視--}}
はじめまして。〇〇と申します。
▲▲様が出品されている「□□□」のサービスをお願いしたいと考えております。
購入にあたり、下記内容をご確認の程よろしくお願い致します。
（＊購入後のトラブル防止のため、気になることはしっかりと確認しましょう。）
お忙しいところ大変お手数ではございますが、どうぞ宜しくお願い致します。
</textarea>
                                                </div>
                                                <div class="templateBox tabSelectBox" id="template02">
<textarea readonly>
はじめまして。
〇〇と申します。　
▲▲様が出品されている「□□□」のサービスを購入したいと思いますので、「サービスの提供」通知を送っていただけますでしょうか。
届き次第、購入手続きをさせていただきたいと思います。
どうぞよろしくお願い致します。
</textarea>
                                                </div>
                                                <div class="templateBox tabSelectBox" id="template03">
<textarea readonly>
この度は、数多くあるサービスの中からご連絡いただきまして誠にありがとうございます。
さっそく「サービス提供」通知をお送りしましたので、購入手続きをお願いいたします。　
お取引完了まで、どうぞよろしくお願い致します。
</textarea>
                                                </div>
                                                <div class="templateBox tabSelectBox" id="template04">
<textarea readonly>
先ほどサービスを購入させていただきました〇〇です。　
とても楽しみにしていますので、お取引完了までどうぞよろしくお願い致します。
</textarea>
                                                </div>
                                                <div class="templateBox tabSelectBox" id="template05">
<textarea readonly>
この度はサービスをご購入いただき、誠にありがとうございます。
お取引完了まで、どうぞよろしくお願い致します。　
早速ですが、ご依頼内容の詳細を確認させていただきたいので、下記内容を教えてください。
よろしくお願い致します。
（＊サービス提供に必要な情報をしっかりとすり合わせましょう。）
</textarea>
                                                </div>
                                                <div class="templateBox tabSelectBox" id="template06">
<textarea readonly>
●日に送らせていただきましたご連絡について、まだご返信をいただけておりませんのでご連絡をさせていただきました。
現在の状況等、お早目にご連絡をいただければ幸いです。
お忙しいところ恐縮ではございますが、どうぞよろしくお願い致します。
</textarea>
                                                </div>
                                                <div class="templateBox tabSelectBox" id="template07">
<textarea readonly>
大変申し上げにくいのですが、今回のご依頼の件はキャンセルをお願いしたく存じます。
キャンセル申請にも記述しておりますが、理由としましては（＊必ず理由を明記する）でございます。
申請のご確認をお願いします。
</textarea>
                                                </div>
                                                <div class="templateBox tabSelectBox" id="template08">
<textarea readonly>
サービスを納品させていただきますので、ご確認の程よろしくお願い致します。
修正箇所や何か確認したい点がございましたら、お手数をおかけしますが「リトライ」を選択し、ご連絡をお願い致します。
問題がないようでしたら、「承認」を選択していただき、評価にお進みいただけますでしょうか？
よろしくお願い致します。
</textarea>
                                                </div>
                                                <div class="templateBox tabSelectBox" id="template09">
<textarea readonly>
サービスの確認をさせていただきました。
こちらで問題ございませんので、「承認」とさせて頂きます。
どうもありがとうございます。
</textarea>
                                                </div>
                                                <div class="templateButton"><button type="button" class="templateInput">挿入する</button></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="cancelTitle">
                                        <p>送信されたチャットを必要に応じてカリビトが確認・削除することに同意します。</p>
                                    </div>
                                    <div class="functeBtns">
                                        <input type="submit" class="orange" value="送信する">
                                    </div>
                                </div>
                            </form>
                        @endif
                        </div>
                    </div>
                </div><!-- /#main -->
                <x-side-menu/>
            </div><!--inner-->
        </div><!-- /#contents -->
    </article>
</x-layout>
    
<script>
    // 打ち込んだ文字数の表示
    function ShowLength( str ) {
        document.getElementById("inputlength").innerHTML = str.length + "/3000";
    }

        // フィールドをクリックしたら文字数の表示
    function ClickShowLength( str ) {
        document.getElementById("inputlength").innerHTML = str.length + "/3000";
    }
</script>
