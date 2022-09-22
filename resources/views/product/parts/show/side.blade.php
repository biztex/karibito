<aside id="side">
    <div class="box reservate">
        <h3>{{number_format($product->price)}}円</h3>
        <p class="status">所用期間</p>
        <p class="date">{{$product->number_of_day}}日</p>
        <!-- <div class="calendar"><div id="datepicker"></div></div> -->
    </div>
    <div>
        <div class="peace">
            <h3>カリビト安心への取り組み</h3>
            <p>報酬は取引前に事務局に支払われ、評価・完了後に振り込まれます。利用規約違反や少しでも不審な内容のサービスやリクエストやユーザーがあった場合は通報してください。</p>
        </div>
        <p class="specialtyBtn share"><span>この情報をシェアする</span></p>
    </div>

    <x-parts.box-seller :user='$product->user'/>

</aside>