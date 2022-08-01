<div class="seaServices">
    <div class="inner">
        <h2 class="hdM"><img class="ico" src="/img/common/ico_folder.svg" alt="">条件からサービスを探す</h2>
        
        <!-- <div class="cate">
            <a href="#" class="cate cate01">カテゴリーから探す</a>
            <a href="#" class="cate cate02">エリアから探す</a>
            <a href="#" class="cate cate03">日付から探す</a>
            <a href="#" class="cate cate04">金額から探す</a>
        </div> -->

        <!-- <div class="search">
            <input type="text" placeholder="サービス名・エリア名など"><input type="submit" class="btn" value="">
        </div> -->

        <form method="get">
            <div class="search">
                <input type="hidden" name="service_flg" value="1">
                <input type="text" name="keyword" @if(isset($keyword)) value="{{$keyword}}" @endif placeholder="キーワードを入力して検索">
                <input type="submit" class="btn" formaction="{{ route('product.search') }}" value="">
            </div>
        </form>

        <!-- <div class="recommend pc">
            <span>おすすめ：</span>
            <a href="#">画像・写真加工</a>
            <a href="#">インテリアデザイン</a>
            <a href="#">資料・企画書作成</a>
            <a href="#">画像・写真加工</a>
            <a href="#">インテリアデザイン</a>
            <a href="#">資料・企画書作成</a>
        </div> -->

    </div>
</div>