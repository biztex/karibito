<!-- 入力エリア -->
@if($service_type === 'Product')
    <form action="{{ route('chatroom.create.product', $service->id) }}" method="POST" enctype="multipart/form-data">
@else <!-- JobRequest-->
    <form action="{{ route('chatroom.create.job_request', $service->id) }}" method="POST" enctype="multipart/form-data">
@endif
        @csrf
        <div class="item">
            @error('text')<div class="alert alert-danger">{{ $message }}</div>@enderror
            <div class="evaluation">
                <textarea name="text" placeholder="依頼する入力してください"></textarea>
            </div>

            @error('file_path')<div class="alert alert-danger">{{ $message }}</div>@enderror
            <p class="input-file-name" style='color:#696969;margin-top:10px;'></p>
            <div class="btns">

                <p class="chatroom_file_input">資料を添付する</p>
                <input type="file" name="file_path" id="file_path" style="display:none;">
                <input type="hidden" name="file_name" value="">

                <a href="#">定型分を使う</a>
                
            </div>
            <div class="about mt25">
                <p class="tit">【資料を添付する】について</p>
                <p>・テキストテキストテキストテキストテキストテキストテキストテキストテキストテキスト<br>・テキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキスト</p>
            </div>
            <div class="cancelTitle">
                <p>送信されたチャットを必要に応じてカリビト確認・削除することに同意し、</p>
            </div>
            <div class="functeBtns">
                <input type="submit" class="orange" value="送信する">
            </div>
        </div>
    </form>