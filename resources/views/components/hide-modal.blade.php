<x-app>		
@auth
	<div class="hide">

		{{-- 身分証明証提出モーダル --}}
		@include('components.hide-modal.identification')

		{{-- プロフィール編集モーダル --}}
		@include('components.hide-modal.profile')
		
		{{-- 履歴書作成モーダル --}}
		@include('components.hide-modal.resume')
			
	</div>

@endauth
</x-app>
@if(isset($errors))
<script>
	$(function(){

		// バリデーションエラーの際、モーダルを最初から表示する
        if (@json($errors->has('identification_path'))){
                $('.fancybox_register').trigger('click');
                $('html').addClass('fancybox-margin');
                $('html').addClass('fancybox-lock');
                $('.fancybox-wrap').wrap('<div class="fancybox-overlay fancybox-overlay-fixed" style="width:auto; height: auto; display: block;"></div>');
        } else if (@json($errors->has('name') || $errors->has('first_name') || $errors->has('last_name') || $errors->has('gender') || $errors->has('birthday') || $errors->has('prefecture') || $errors->has('zip') || $errors->has('address') || $errors->has('introduction') || $errors->has('icon') || $errors->has('cover') || $errors->has('content') || $errors->has('arr_content') )) {
					$('.fancybox').trigger('click');
                    $('html').addClass('fancybox-margin fancybox-lock');
                    $('.fancybox-wrap').wrap('<div class="fancybox-overlay fancybox-overlay-fixed" style="width:auto; height: auto; display: block;"></div>');
		}
	})
</script>
@endif