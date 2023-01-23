<x-layout>
<script src="{{ asset('js/tinymce/tinymce.min.js') }}"></script>
    <x-parts.post-button/>
    <div id="blog">
        <div id="breadcrumb">
            <div class="inner">
                <a href="{{ route('home') }}">ホーム</a>　>　<span>ブログ</span>
            </div>
        </div><!-- /.breadcrumb -->
        <x-parts.ban-msg/>
        <x-parts.flash-msg/>
		<div id="contents" class="otherPage">
			<div class="inner02 clearfix">
				<div id="main">
					<div class="blogWrap">
						<p class="mypageHd02"><span>ブログ</span></p>
						<form action="{{ route('blog.update', $blog) }}" method="post" idform enctype="multipart/form-data">
							@csrf
							@method('PATCH')
							<div class="mypageEditBox">
								<div class="mypageEditList">
									<p class="mypageEditHd">タイトル</p>
									@error('title')<div class="alert alert-danger">{{ $message }}</div>@enderror
									<div class="mypageEditInput">
										<input type="text" name="title" placeholder="タイトルを入力してください" value="{{ old('title', $request->title ?? "") }}{{ $blog->title }}" required>
									</div>
								</div>
								<div class="mypageEditList">
									<p class="mypageEditHd">投稿する内容をご記入ください</p>
									@error('content')<div class="alert alert-danger">{{ $message }}</div>@enderror
									<div class="mypageEditInput">
										<textarea name="content" placeholder="投稿する内容を入力してください" required>
											{!! old('content', $request->content ?? "") !!}{!! $blog->content !!}
										</textarea>
									</div>
								</div>
								<div class="mypageEditList">
									<p class="mypageEditHd">出品サービス</p>
									@error('product_id')<div class="alert alert-danger">{{ $message }}</div>@enderror
									<div class="mypageEditInput">
										<select class="middle_ipt" name="product_id" required>
											<option value="">選択してください</option>
											@foreach (App\Models\Product::loginUsers()->notDraft()->orderBy('created_at', 'desc')->get() as $product)
												<option value="{{$product->id}}" @if( old('product_id', $blog->product_id ?? "") == $product->id ) selected @endif>
													{{ $product->title }}
												</option>
											@endforeach
										</select>
									</div>
								</div>
								<div class="fancyPersonBtn">
									<a href="{{ route('blog.index') }}" class="fancyPersonCancel">キャンセル</a>
									<button class="fancyPersonSign loading-disabled">更新する</button>
								</div>
							</div>
						</form>
					</div>
				</div><!-- /#main -->
				<x-side-menu/>
			</div><!--inner-->
		</div><!--contents-->
	<x-hide-modal/>
</x-layout>
<script type='text/javascript'>
	tinymce.init({
		selector : 'textarea',
		plugins : [
			'advlist anchor autolink autoresize autosave charmap code colorpicker',
			'contextmenu directionality emoticons hr image imagetools importcss insertdatetime image legacyoutput link lists',
			'media nonbreaking noneditable pagebreak paste preview save searchreplace stickytoolbar',
			'tabfocus table textcolor textpattern toc visualblocks visualchars wordcount',
			'autolink',
			'link',
			'image'
		],
		default_link_target: '_blank',
		toolbar : 'formatselect bold italic underline forecolor backcolor| alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
		menubar : false,
		element_format : 'html',
		relative_urls : false,
		branding: false,
		images_reuse_filename: true,
		automatic_uploads: true,
		images_upload_url: '/blog_image?_token={{csrf_token()}}',
		file_picker_types: 'image',
		file_picker_callback: function(cb, value, meta) {
			var input = document.createElement('input');
			input.setAttribute('type', 'file');
			input.setAttribute('accept', 'image/*');
			input.onchange = function() {
				var file = this.files[0];

				var reader = new FileReader();
				reader.readAsDataURL(file);
				reader.onload = function () {
					var id = 'blobid' + (new Date()).getTime();
					var blobCache = tinymce.activeEditor.editorUpload.blobCache;
					var base64 = reader.result.split(',')[1];
					var blobInfo = blobCache.create(id, file, base64);
					blobCache.add(blobInfo);
					cb(blobInfo.blobUri(), { title: file.name });
				};
			};
			input.click();
		}
	});
</script>