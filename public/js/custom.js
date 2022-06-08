$(function(){
		
    // マイページ画面からカバー変更
    $(".update_cover").on('click', function(){
        $("input[class='cover1']").click();
        $("input[class='cover1']").on('change',function(){
            var file = $(this).prop('files')[0];
            $("input[name='submit_cover']").click();
        });
    });
        
    // 身分証登録ポップアップ閉じるボタン
    $('.pop_close').on('click',function(){
        $('.unregisteredP').fadeOut(400);
    })


    // プロフィール編集画面からアイコン変更
		$(".fancyPersonPic p").on('click', function(){
			$("input[name='icon']").on('click', function(e){
				e.stopPropagation();
			});
			$("input[name='icon']").click();
			$("input[name='icon']").on('change',function(e){
				var reader = new FileReader();
				reader.onload = function (e) {
					$("#preview_icon").attr('src', e.target.result);
				}
				reader.readAsDataURL(e.target.files[0]);   
			});
		});

		// プロフィール編集画面からアイコン変更
		$(".mypageCoverUpdate").on('click', function(){
			$("input[class='cover2']").on('click', function(e){
				e.stopPropagation();
			});
			$("input[class='cover2']").click();
			$("input[class='cover2']").on('change',function(e){
				var reader = new FileReader();
				reader.onload = function (e) {
					$("#preview_cover").attr('src', e.target.result);
				}
				reader.readAsDataURL(e.target.files[0]);   
			});
		});

		// モーダル キャンセルボタン
		$('.fancyPersonCancel').click(function(){
			$('.fancybox-overlay').fadeOut();
			$('html').removeClass('fancybox-margin');
			$('html').removeClass('fancybox-lock');
		})

});