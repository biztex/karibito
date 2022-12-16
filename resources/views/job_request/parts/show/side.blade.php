<aside id="side">
    <div class="box reservate">
        @if(isset($job_request))
            <h3>{{ number_format($job_request->price) }}円</h3>
            <p class="status">応募期限</p>
            <p class="date" style="margin-bottom:10px;height:33.5px;">{{ date('Y/m/d',strtotime($job_request->application_deadline)) }}</p>
            @if(!is_null($job_request->required_date))
                <p class="status">納品希望日</p>
                <p class="date">{{ date('Y/m/d',strtotime($job_request->required_date)) }}</p>
            @endif
            <!-- <div class="calendar"><div id="datepicker"></div></div> -->
        @endif
    </div>
    <div>
        <div class="peace">
            <h3>カリビト安心への取り組み</h3>
            <p>報酬は取引前に事務局に支払われ、評価・完了後に振り込まれます。利用規約違反や少しでも不審な内容のサービスやリクエストやユーザーがあった場合は通報してください。</p>
        </div>
        @if(empty($job_request->user))
            <div class="indexNotice">
                <h3 class="hd">このユーザーは退会しました。</h3>
            </div>
        @elseif($job_request->user->id === Auth::id() )
            <div class="functeBtns">
                <a href="{{ route('job_request.edit', $job_request->id ) }}" class="full orange">編集</a>
            </div>
            <form id="delete-job_request" method="post" action="{{ route('job_request.destroy', $job_request->id ) }}">
                @csrf @method('delete')
                <div class="functeBtns">
                    <input type="button" class="full js-alertModal" style="box-shadow: 0 6px 0 #999999;height: 55px;font-size: 1.8rem;color:white;max-width: 100%;border-radius: 4px;font-weight:700;" value="削除">
                </div>
            </form>
            <x-parts.alert-modal formId="delete-job_request" />
        @elseif ($requested)
            <div class="functeBtns">
                <a tabindex="-1" class="full">交渉画面へ進む</a>
                <span style="font-size: 0.8em;">このサービスは売り切れています。<br>ユーザーにDMでお問い合わせください。</span>
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
        @if(isset($job_request->user))  
            <p class="specialtyBtn share"><span>この情報をシェアする</span></p>
            <form action="{{ route('contact') }}" method="get">
                @csrf
                <input type="hidden" name="job_request_id" value="{{ $job_request->id }}">
                <p class="specialtyBtn"><input type="submit" class="report_btn" value="このサービスを通報する"></p>
            </form>
        @endif
    </div>

    @if(isset($job_request->user))
        <x-parts.box-seller :user='$user'/>
    @endif

</aside>
