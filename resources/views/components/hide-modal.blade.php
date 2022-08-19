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