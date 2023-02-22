@auth
    <div id="fancybox_person" class="fancyboxWrap" style="display:none;">
        <form method="POST" action="{{ route('user_profile.update') }}" enctype="multipart/form-data">
        @csrf @method('PUT')
            <p class="fancyboxHd">プロフィールを編集</p>
            <div class="fancyboxCont">

                <div class="mypageCover mypageCoverUpdate">
                    @if(Auth::user()->userProfile->cover === null)
                        <img id="preview_cover" alt="" src="/img/mypage/img_rainbow.png" style="">
                    @else
                        <img id="preview_cover" alt="" src="{{asset('/storage/'.Auth::user()->userProfile->cover) }}" style="">
                    @endif
                        <input type="file" name="cover" class="cover2" accept="image/*" style="display:none;">
                        <a href="#"><img class="center_cam" src="/img/mypage/icon_camera01.svg" alt=""></a>
                </div>

                    <div class="fancyPersonPic">
                        <p class="img">
                            @if(Auth::user()->userProfile->icon === null)
                                <img id="preview_icon" alt=""  src="/img/mypage/no_image.jpg">
                            @else
                                <img id="preview_icon" alt=""  src="{{asset('/storage/'.Auth::user()->userProfile->icon) }}">
                            @endif
                            <input type="file" name="icon" accept="image/*" style="display:none;">
                            <a href="#"><img class="center_cam" src="/img/mypage/icon_camera01.svg" alt=""></a>
                        </p>
                    </div>

                    <div class="fancyImgBtn">
                        <a href="{{route('cover.delete')}}">カバーを削除する</a>
                        <a href="{{route('icon.delete')}}">アイコンを削除する</a>
                    </div> 
                    @error('icon')<div class="alert alert-danger">{{ $message }}</div>@enderror
                    @error('cover')<div class="alert alert-danger">{{ $message }}</div>@enderror

                <div class="fancyPersonTable">	
                    <dl class="">
						<p style="font-size:12px;">※ニックネームは公開されます。</p>
                        <dt>ニックネーム</dt>
                        @error('name')<div class="alert alert-danger">{{ $message }}</div>@enderror
                        <dd><input type="text" name="name" value="{{old('name',\Auth::user()->name)}}"></dd>
                    </dl>
                    <dl></dl>
                    <dl style="margin-bottom:0px">
                        @if($errors->has('first_name'))
                            <div class="alert alert-danger" style="padding-bottom:0;">{{$errors->first('first_name')}}</div>
                        @elseif($errors->has('last_name'))
                            <div class="alert alert-danger" style="padding-bottom:0;">{{$errors->first('last_name')}}</div>
                        @endif
                    </dl>
                    <dl style="margin:0;"><p style="font-size:12px;">※本人認証に利用されるものと同じ姓名でご記入ください。</p></dl>

                    @if(Auth::user()->userProfile->is_identify == 0)
                        <dl class=" inlineFlex">
                            <dt class="hideModalName">姓<span>(本名は非公開です)</span></dt>
                            <dd><input type="text" name="first_name" value="{{old('first_name',Auth::user()->userProfile->first_name)}}"></dd>
                        </dl>
                        <dl class=" inlineFlex">
                            <dt class="hideModalName">名<span>(本名は非公開です)</span></dt>
                            <dd><input type="text" name="last_name" value="{{old('last_name',Auth::user()->userProfile->last_name)}}"></dd>
                        </dl>
                    @else
                        <dl>
                            <dt>姓名<span>(本名は非公開です)</span></dt>
                            <dd>{{ Auth::user()->userProfile->first_name.'  '.Auth::user()->userProfile->last_name }}</dd>
                            <input type="hidden" name="first_name" value="{{ Auth::user()->userProfile->first_name }}">
                            <input type="hidden" name="last_name" value="{{ Auth::user()->userProfile->last_name }}">
                        </dl>
                    @endif

                    <dl>
                        <dt style="display:flex;">性別 @error('gender')<span><div class="alert alert-danger">{{ $message }}</div></span>@enderror</dt>
                        <dd>
                            <select name="gender">
                                <option disabled>選択してください</option>
                                <option value="1" @if('1' == (int)old('gender',Auth::user()->userProfile->gender)) selected @endif>男</option>
                                <option value="2" @if('2' == (int)old('gender',Auth::user()->userProfile->gender)) selected @endif>女</option>
                            </select>
                        </dd>
                    </dl>
                    <dl>
                        <dt>生年月日<span>(年代のみ公開されます)</span></dt>
                        @if(Auth::user()->userProfile->is_identify == 0)
                            @error('birthday')<div class="alert alert-danger">{{ $message }}</div>@enderror
                            <dd>
                                <select class="year" name="year">
                                    <option value="" selected>年</option>
                                    @for ($i = 1900; $i < 2023; $i++ )
                                        <option value="{{$i}}" @if(old('year', Auth::user()->userProfile->birthday) == null)
                                                                @elseif($i == old('year', date("Y",strtotime(Auth::user()->userProfile->birthday)))) selected @endif>{{$i}}</option>
                                    @endfor
                                </select>
                                <select class="month" name="month">
                                    <option value="" selected>月</option>
                                    @for ($i = 1; $i < 13; $i++ )
                                        <option value="{{$i}}" @if(old('month', Auth::user()->userProfile->birthday) == null)
                                                                @elseif($i == old('month', date("n",strtotime(Auth::user()->userProfile->birthday)))) selected @endif>{{$i}}</option>
                                    @endfor
                                </select>
                                <select class="day" name="day" type="day">
                                    <option value="" selected>日</option>
                                    @for ($i = 1; $i < 32; $i++ )
                                        <option value="{{$i}}" @if(old('day', Auth::user()->userProfile->birthday) == null)
                                                                @elseif($i == old('day', date("j",strtotime(Auth::user()->userProfile->birthday)))) selected @endif>{{$i}}</option>
                                    @endfor
                                </select>
                            </dd>
                        @else
                            <dd>{{ date("Y年n月j日",strtotime(Auth::user()->userProfile->birthday)) }}</dd>
                            <input type="hidden" name="year" value="{{ date("Y",strtotime(Auth::user()->userProfile->birthday)) }}">
                            <input type="hidden" name="month" value="{{ date("n",strtotime(Auth::user()->userProfile->birthday)) }}">
                            <input type="hidden" name="day" value="{{ date("j",strtotime(Auth::user()->userProfile->birthday)) }}">
                        @endif
                    </dl>

                    @if(Auth::user()->userProfile->is_identify == 0)
                        <dl>
                            <dt>住所<span>(都道府県のみ表示されます)</span></dt>
                                @error('zip')<div class="alert alert-danger">{{ $message }}</div>@enderror
                            <dd>
                                <p class="addrNumber"><input class="short" type="text" id="zip" name="zip" value="{{old('zip',Auth::user()->userProfile->zip)}}"></p>
                                <div class="addrSelect">
                                    <select class="short" name="prefecture" id="pref1">
                                        <option value="">選択してください</option>
                                        @foreach(App\Models\Prefecture::all() as $prefecture)
                                            <option value="{{$prefecture->id}}" @if($prefecture->id == (int)old('prefecture',Auth::user()->userProfile->prefecture_id)) selected @endif>{{$prefecture->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('address')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                <p><input type="text" name="address" id="address1" placeholder="市区町村" value="{{old('address',Auth::user()->userProfile->address)}}"></p>
                                <p><input type="text" name="address_number" placeholder="番地" value="{{old('address_number',Auth::user()->userProfile->address_number)}}"></p>
                                @error('address_number')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                <p><input type="text" name="apartment" placeholder="(マンション)" value="{{old('apartment',Auth::user()->userProfile->apartment)}}"></p>
                                @error('apartment')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </dd>
                        </dl>
                    @else
                        <dl>
                            <dt>住所<span>(都道府県のみ表示されます)</span></dt>
                            <dd>
                                <p class="addrNumber">〒{{ substr(Auth::user()->userProfile->zip, 0, 3).'-'.substr(Auth::user()->userProfile->zip, 3, 7)}}</p>
                                {{ Auth::user()->userProfile->prefecture->name.Auth::user()->userProfile->address }}
                            </dd>
                            <input type="hidden" name="zip" value="{{ Auth::user()->userProfile->zip }}">
                            <input type="hidden" name="prefecture" value="{{ Auth::user()->userProfile->prefecture_id }}">
                            <input type="hidden" name="address" value="{{ Auth::user()->userProfile->address }}">
                            <input type="hidden" name="address_number" value="{{ Auth::user()->userProfile->address_number }}">
                            <input type="hidden" name="apartment" value="{{ Auth::user()->userProfile->apartment }}">
                        </dl>
                    @endif

                    <div class="specialtyBox">
                        <div class="specialtyItem">
                            <div class="clone">
                                <div class="cloneCustomArea">
                                    <p style="font-weight:bold">得意分野</p>
                                    @error('arr_content')<div class="alert alert-danger">{{ $message }}</div>@enderror
                                    @if(empty(old('profile_content')))
                                        @if(Auth::user()->specialty->isNotEmpty())
                                            @foreach(Auth::user()->specialty as $specialty)
                                                <dl class="specialtyForm">
                                                    <dd>
                                                        <input type="text" name="profile_content[]" value="{{ $specialty->content }}">
                                                    </dd>
                                                </dl>
                                            @endforeach
                                        @else
                                            <dl class="specialtyForm">
                                                <dd>
                                                    <input type="text" name="profile_content[]" value="">
                                                </dd>
                                            </dl>
                                        @endif
                                    @else
                                        @if(count(array_filter(old('profile_content'))) == 0)
                                            <dl class="specialtyForm">
                                                <dd>
                                                    <input type="text" name="profile_content[]" value="">
                                                </dd>
                                            </dl>
                                        @else
                                            @foreach(old('profile_content') as $key => $value)
                                                @if($value !== null)
                                                    <dl class="specialtyForm">
                                                        @error('profile_content.'.$key)<div class="alert alert-danger">{{ $message }}</div>@enderror
                                                        <dd>
                                                            <input type="text" name="profile_content[]" value="{{ $value }}">
                                                        </dd>
                                                    </dl>
                                                @endif
                                            @endforeach
                                        @endif
                                    @endif
                                </div>
                                <p class="specialtyBtnCustom"><span><img src="/img/mypage/icon_add.svg" alt="">得意分野を追加</span></p>
                            </div>
                        </div><p class="taRResume">＊得意分野は１０個まで追加できます。</p>
                    </div>
                    
                    <dl>
                        @error('introduction')<div class="alert alert-danger">{{ $message }}</div>@enderror
                        <dt>自己紹介</dt>
                        <dd><textarea name="introduction">{{old('introduction',Auth::user()->userProfile->introduction)}}</textarea></dd>
                    </dl>
                </div>{{-- /.fancyPersonTable --}}
            </div>{{-- /.fancyboxCont --}}
            <div class="fancyPersonBtn">
                <a href="#" class="fancyPersonCancel">キャンセル</a>
                <button type="submit" class="fancyPersonSign">登録する</button>
            </div>
        </form>
    </div>{{-- /#fancybox_person --}}
@endauth