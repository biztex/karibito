<aside id="side">
    <div class="box reservate">
        <h3>{{ number_format($request->price) }}円</h3>
        <p class="status">応募期限</p>
        <p class="date" style="margin-bottom:10px;height:33.5px;">{{ date('Y/m/d',strtotime($request->application_deadline)) }}</p>
        @if(!is_null($request->required_date))
            <p class="status">納品希望日</p>
            <p class="date">{{ date('Y/m/d',strtotime($request->required_date)) }}</p>
        @endif
        <!-- <div class="calendar"><div id="datepicker"></div></div> -->
    </div>
    <div>
        <div class="peace">
            <h3>カリビト安心への取り組み</h3>
            <p>報酬は取引前に事務局に支払われ、評価・完了後に振り込まれます。利用規約違反や少しでも不審な内容のサービスやリクエストやユーザーがあった場合は通報してください。</p>
        </div>
        <div class="functeBtns">
        @if(empty($job_request))
            <input type="submit" class="orange_o" style="color:#EB6A1A;font-weight:700;font-size: 1.8rem;height: 55px;" formaction="{{ route('job_request.post.create') }}" value="編集画面に戻る">
        @else
            <input type="submit" class="orange_o" style="color:#EB6A1A;font-weight:700;font-size: 1.8rem;height: 55px;" formaction="{{ route('job_request.post.edit', $job_request->id) }}" value="編集画面に戻る">
        @endif
        </div>
        <div class="functeBtns">
            <input type="submit" name="regist" class="orange" style="color: #fff;font-weight:700;box-shadow: 0 6px 0 #d85403;height: 55px;font-size: 1.8rem;" value="リクエストを登録する">
        </div>
        <p class="specialtyBtn"><span>この情報をシェアする</span></p>
    </div>
    
    <x-parts.box-seller :user='$user'/>

</aside>
