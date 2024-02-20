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
    $(".creditCode .link").mouseenter(function (e) {
        $(".creditCodeBox").css({ 'display': 'block' });
    })

    $(".creditCodeBox").mouseleave(function (e) {
        $(".creditCodeBox").css({ 'display': 'none' });
    })

	// 住所自動入力
	$('#zip').jpostal({
		keyup : '#zip',
		postcode : [
			'#zip'
		],
		address : {
			'#pref1'  : '%3',
			'#address1'  : '%4%5',
		}
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

    function initializeIndexedDB() {
        return new Promise((resolve, reject) => {
            const request = window.indexedDB.open('image_database', 2);

            request.onupgradeneeded = function (event) {
                const db = event.target.result;
                db.createObjectStore('images', { keyPath: 'id', autoIncrement: false });
                db.createObjectStore('statuses', { keyPath: 'id', autoIncrement: false });
            };

            request.onsuccess = function () {
                resolve(request.result);
            };

            request.onerror = function () {
                reject(request.error);
            };
        });
    };


    function addImageToDB(db, id, base64) {
        const transaction = db.transaction(["images", "statuses"], 'readwrite');
        const imageStore = transaction.objectStore('images');
        const statusStore = transaction.objectStore('statuses');
        const imageData = { id: id, base64: base64 };
        const statusData = { id: id, status: 'insert'};

        imageStore.put(imageData);
        statusStore.put(statusData);
    }

    function deleteImageFromDB(db, index) {
        const transaction = db.transaction(["images", "statuses"], 'readwrite');
        const imageStore = transaction.objectStore('images');
        const statusStore = transaction.objectStore('statuses');
        const imageId = index;
        const statusData = { id: imageId, status: 'delete'};

        if (imageId) {
            imageStore.delete(imageId);
            statusStore.put(statusData);
        }
    }
	// 提供登録画像プレビュー / indexedDBに画像一時保存
	// 画像に変更あれば'delete'/'insert'のいずれかを配列の番号とともに格納していく
    initializeIndexedDB().then(db => {
        for (let i = 0; i < 10; i++) {
        $("#product_pic" + i).on('click', function () {
            $("input[name='paths[" + i + "]']").on('click', function (e) {
                e.stopPropagation();
            });
            $("input[name='paths[" + i + "]']").click();
            $("input[name='paths[" + i + "]']").on('change', function (e) {
                const fileInput = e.target;
                const file = fileInput.files[0];

                if (file) {
                    const reader = new FileReader();

                    reader.onload = function (e) {
                        const base64 = e.target.result;
                        $("#preview_product" + i).attr('src', base64);
                        $("input[name='base64_text[" + i + "]']").val(base64);

                        addImageToDB(db, i + 1, base64 );
                    };

                    reader.readAsDataURL(file);
                    $("input[name='image_status" + i + "']").val('insert');
                }
            });
        });

        $("#storage_delete" + i).on('click', function () {
            $("input[name='paths[" + i + "]']").val('');
            $("input[name='base64_text[" + i + "]']").attr('value', null);

            $("input[name='image_status" + i + "']").val('delete');
            deleteImageFromDB(db, i + 1);

            $("#preview_product" + i).attr('src', '/img/service/img_provide.jpg');
        });
        }
    });

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
    //1ページ内に2つ必要な場合はこちらも使う↓（id被り防止）
    $('.js-alertModal-2').on('click', function() {
        $("#overflow2").show();
    });
    $('.js-alertCancel-2').on('click', function() {
        $("#overflow2").hide();
    });
    //3つめ
    $('.js-alertModal-3').on('click', function() {
        $("#overflow3").show();
    });
    $('.js-alertCancel-3').on('click', function() {
        $("#overflow3").hide();
    });
	// スキル削除の際のモーダル
	$('.js-alertModal-skill').on('click', function() {
		var formId = $(this).attr('data-form-id');
		$(`#overflow-skill-${formId}`).show();
	});
	$('[class^="js-alertCancel-skill-"]').on('click', function() {
		var formId = $(this).attr('data-form-id');
		$(`#overflow-skill-${formId}`).hide();
	});
    // クーポンとポイントが併用で使用できないです。
    if ($("input[name='coupon_use']").length > 0) {
        var couponIsSelected = $("input[name='coupon_use']")[0].checked;
        if (couponIsSelected) {
            $("#point_group").hide();
        } else {
            $("#point_group").show();
            var pointIsSelected = !$("input[name='point_use']")[0].checked;
            if (pointIsSelected) {
                $("#coupon_group").hide();
            } else {
                $("#coupon_group").show();
            }
        }
    }

    $("input[name='coupon_use']").on('click', function(e) {
        if (e.target.checked) {
            $("#point_group").hide();
        } else {
            $("#point_group").show();
        }
    });
    $("input[name='point_use']").on('click', function(e) {
        if (e.target.value === "1") {
            $("#coupon_group").hide();
        } else {
            $("#coupon_group").show();
        }
    });
});
