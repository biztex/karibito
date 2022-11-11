$(function () {
	// 身分証明証提出
	$(".fancyRegisterUpload").on('click', function () {
		// 添付ファイルをリセット
		$(".identification-file-name").text("");
		$("input[name='identification_path']").val("");

		$("input[name='identification_path']").on('change', function () {
			let result = $('#identification_file_path').prop('files')[0].name;
			$(".identification-file-name").text("選択ファイル："+result);
		});
	});

	// チャットルーム資料添付・送信

	$(".chatroom_file_input").on('click', function () {
		// 添付ファイルをリセット
		$(".input-file-name").text("");
		$("input[name='file_name']").val("");

		$("input[name='file_path']").click();
		$("input[name='file_path']").on('change', function () {
			let result = $('#file_path').prop('files')[0].name;
			$("input[name='file_name']").val(result);
			$(".input-file-name").text("添付資料："+result);
		});
	});


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
		$('.js-unregisteredP').fadeOut(400);
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

	if (hash == "#job-request" || hash == "#followed" || hash == "#usually" || hash == "#inactive" || hash == "#withdrawal") {



		$('#box02').trigger('click');
	} else if (hash == "#pity") {
		$('#box03').trigger('click');
	}


	// 提供登録画像プレビュー / localStorageに画像一時保存
	// 画像に変更あれば'delete'/'insert'のいずれかを配列の番号とともに格納していく
	for (let i = 0; i < 10; i++) {
		$("#product_pic"+i).on('click', function () {
			$("input[name='paths["+i+"]']").on('click', function (e) {
				e.stopPropagation();
			});
			$("input[name='paths["+i+"]']").click();
			$("input[name='paths["+i+"]']").on('change', function (e) {
				var reader = new FileReader();
				reader.onload = function (e) {
					$("#preview_product"+i).attr('src', e.target.result);
					localStorage.setItem("pic"+i, reader.result);
					$("input[name='base64_text["+i+"]']").val(localStorage.getItem("pic"+i));
				}
				reader.readAsDataURL(e.target.files[0]);
				$("input[name='image_status"+i+"']").val('insert');
				localStorage.setItem('status'+i,"insert");
			});
		});

		// 削除ボタンでクリア
		$("#storage_delete"+i).on('click', function () {
			$("input[name='paths["+i+"]']").val('');
			$("input[name='base64_text["+i+"]']").attr('value', null);

			$("input[name='image_status"+i+"']").val('delete');
			localStorage.setItem('status'+i,"delete");

			$("#preview_product"+i).attr('src', '/img/service/img_provide.jpg');
			localStorage.removeItem('pic'+i);
		});

		$(function () {
			if ($("input[name='image_status"+i+"']").val() === "delete") {
				$("input[name='base64_text["+i+"]']").attr('value', null);
			} else if ($("input[name='image_status"+i+"']").val() === "insert") {
				$("#preview_product"+i).attr('src', localStorage.getItem("pic"+i));
			}
		})

	};
	// 得意分野追加ボタン
	$('.specialtyBtnCustom').click(function () {
		let number_js_specialtyForm = $(".cloneCustomArea").children(".specialtyForm").length;
			if(number_js_specialtyForm < 9){
				$('.cloneCustomArea').append('<dl class="specialtyForm"><input type="text" name="profile_content[]" value=""></dd></dl>');
			} else if(number_js_specialtyForm < 10){
				$('.cloneCustomArea').append('<dl class="specialtyForm"><input type="text" name="profile_content[]" value=""></dd></dl>');
				$('.specialtyBtnCustom').remove();
			}
	});

	// 2重送信防止
	// 適用したいformにid='form' , 送信ボタンにclass='loading-disabled'を指定
	var flag = false;
	$('.loading-disabled').on('click', function () {
		if(flag == false){
			$('#form').submit();
			flag = true;
		} else {
			$(this).prop('disabled', true);
		}
	})

	// トップページ
	// カテゴリをもっと見るボタン
	$('.js-productOtherBtn').on('click', function () {
		$(".js-hide_product_categories").removeClass('hide');
		$(this).closest('.otherBtn').hide();
	})

	$('.js-jobRequestOtherBtn').on('click', function () {
		$(".js-hide_job_request_categories").removeClass('hide');
		$(this).closest('.otherBtn').hide();
	})
    
    //確認モーダル表示
    $('.js-alertModal').on('click', function() {
        $("#overflow").show();
    });
    $('.js-alertCancel').on('click', function() {
        $("#overflow").hide();
    });
});
