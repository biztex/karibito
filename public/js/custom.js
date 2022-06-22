$(function () {

	// マイページ画面からカバー変更
	$(".update_cover").on('click', function () {
		$("input[class='cover1']").click();
		$("input[class='cover1']").on('change', function () {
			var file = $(this).prop('files')[0];
			$("input[name='submit_cover']").click();
		});
	});

	// 身分証登録ポップアップ閉じるボタン
	$('.pop_close').on('click', function () {
		$('.unregisteredP').fadeOut(400);
	})


	// プロフィール編集画面からアイコン変更
	$(".fancyPersonPic p").on('click', function () {
		$("input[name='icon']").on('click', function (e) {
			e.stopPropagation();
		});
		$("input[name='icon']").click();
		$("input[name='icon']").on('change', function (e) {
			var reader = new FileReader();
			reader.onload = function (e) {
				$("#preview_icon").attr('src', e.target.result);
			}
			reader.readAsDataURL(e.target.files[0]);
		});
	});

	// プロフィール編集画面からアイコン変更
	$(".mypageCoverUpdate").on('click', function () {
		$("input[class='cover2']").on('click', function (e) {
			e.stopPropagation();
		});
		$("input[class='cover2']").click();
		$("input[class='cover2']").on('change', function (e) {
			var reader = new FileReader();
			reader.onload = function (e) {
				$("#preview_cover").attr('src', e.target.result);
			}
			reader.readAsDataURL(e.target.files[0]);
		});
	});

	// モーダル キャンセルボタン
	$('.fancyPersonCancel').click(function () {
		$('.fancybox-overlay').fadeOut();
		$('html').removeClass('fancybox-margin');
		$('html').removeClass('fancybox-lock');
	})

	// リクエストのページリンククリック時、リンク先でもリクエストを自動的に表示する
	// URLのハッシュ値が #job-request の場合
	var hash = $(location).prop('hash');
	if (hash == "#job-request") {
		$('#box02').trigger('click');
	}


	
	// 提供登録画像プレビュー / localStorageに画像一時保存
	// 画像に変更あれば'delete'/'insert'のいずれかを配列の番号とともに格納していく
	var image_status = {};
	for (let i = 0; i < 10; i++) {
		$("#product_pic"+i).on('click', function () {
			$("input[name='path["+i+"]']").on('click', function (e) {
				e.stopPropagation();
			});
			$("input[name='path["+i+"]']").click();
			$("input[name='path["+i+"]']").on('change', function (e) {
				var reader = new FileReader();
				reader.onload = function (e) {
					$("#preview_product"+i).attr('src', e.target.result);
					$("input[name='path["+i+"]']").attr('value', e.target.result);
					localStorage.setItem("pic"+i, reader.result);
				}
				reader.readAsDataURL(e.target.files[0]);
				image_status[i] = 'insert';
				$("input[name='image_status']").val(JSON.stringify(image_status));
			});
		});

		// 削除ボタンでクリア
		$("#storage_delete"+i).on('click', function () {
			$("input[name='path["+i+"]']").attr('value', null);

			image_status[i] = 'delete';
			$("input[name='image_status']").val(JSON.stringify(image_status));

			$("#preview_product"+i).attr('src', "/img/service/img_provide.jpg");
			localStorage.removeItem('pic'+i);
		});

		// プレビューページ
		$(function () {
			if (localStorage.getItem("pic"+i)) {
				$("input[name='path["+i+"]']").attr('value', localStorage.getItem("pic"+i));
				$("#preview_product"+i).attr('src', localStorage.getItem("pic"+i));
				$("#preview_slider"+i).attr('src', localStorage.getItem("pic"+i));
				$("#preview_slider"+i+i).attr('src', localStorage.getItem("pic"+i));
			} else {
				$("#preview_slider"+i).remove();
				$("#preview_slider"+i+i).remove();
			}
		});
	};

});
