<aside id="side">
    <div class="box reservate">
        <h3>{{ number_format($job_request->price) }}円</h3>
        <p class="status">応募期限</p>
        <p class="date" style="margin-bottom:10px;height:33.5px;">{{ date('Y/m/d',strtotime($job_request->application_deadline)) }}</p>
        @if(!is_null($job_request->required_date))
            <p class="status">納品希望日</p>
            <p class="date">{{ date('Y/m/d',strtotime($job_request->required_date)) }}</p>
        @endif
        <!-- <div class="calendar"><div id="datepicker"></div></div> -->
    </div>
    <div>
        <div class="peace">
            <h3>カリビト安心への取り組み</h3>
            <p>報酬は取引前に事務局に支払われ、評価・完了後に振り込まれます。利用規約違反や少しでも不審な内容のサービスやリクエストやユーザーがあった場合は通報してください。</p>
        </div>
        @if($job_request->user->id === Auth::id() )
            <div class="functeBtns">
                <a href="{{ route('job_request.edit', $job_request->id ) }}" class="full orange">編集</a>
            </div>
            <form method="post" action="{{ route('job_request.destroy', $job_request->id ) }}">
                @csrf @method('delete')
                <div class="functeBtns">
                    <input type="submit" class="full" style="box-shadow: 0 6px 0 #999999;height: 55px;font-size: 1.8rem;color:white;max-width: 100%;border-radius: 4px;font-weight:700;" value="削除">
                </div>
            </form>
        @elseif ($requested)
            <div class="functeBtns">
                <a tabindex="-1" class="full">交渉画面へ進む</a>
                <span style="font-size: 0.8em;">この商品は売り切れています。<br>ユーザーにDMでお問い合わせください。</span>
            </div>
        @elseif ($today->gt($deadline))
            <div class="functeBtns">
                <a tabindex="-1" class="full" style="margin-bottom: 4px">交渉画面へ進む</a>
                <span style="font-size: 0.8em;">期限切れのリクエストです。<br>ユーザーにDMでお問い合わせください。</span>
            </div>
        @else
            <div class="functeBtns">
                <a href="{{ route('chatroom.new.job_request', $job_request->id ) }}" class="orange full">交渉画面へ進む</a>
            </div>
        @endif
        <p class="specialtyBtn share"><span>この情報をシェアする</span></p>
    </div>

    <x-parts.box-seller :user='$user'/>

</aside>
<x-parts.share-modal/>