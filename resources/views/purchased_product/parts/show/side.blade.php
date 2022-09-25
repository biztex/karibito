<aside id="side">
    <div class="box reservate">
        <h3>{{ number_format($product->price) }}円</h3>
        <p class="status">応募期限</p>
        <p class="date" style="margin-bottom:10px;height:33.5px;">{{ date('Y/m/d',strtotime($product->application_deadline)) }}</p>
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
    </div>

    {{-- <x-parts.box-seller :user='$user'/> --}}

</aside>