<x-layout>
<body id="setting-page">
<x-parts.post-button/>
	<article>
		<div id="breadcrumb">
                <div class="inner">
				<a href="{{ route('home') }}">ホーム</a>　>　<a href="{{ route('setting.index') }}">会員情報</a>　>　<span>振込口座情報</span>
			</div>
		</div><!-- /.breadcrumb -->
		<x-parts.flash-msg/>
		<div id="contents" class="otherPage">
			<div class="inner02 clearfix">
            <div id="main">
					<div class="configEditWrap">
						<div class="configEditItem">
							<h2 class="subPagesHd">振込口座</h2>
							<div class="configEditBox">
								@if($bank !== null)
									<div class="configEditList" style="margin-bottom:35px;">
										<h3 class="mypageEditHd">現在の登録口座</h3>
											<div class="configEditTable">
												<table>
													<tr>
														<th>金融機関名</th>
														<td>{{ $bank->bank_name }}</td>
													</tr>
                                                    <tr>
														<th>金融機関コード</th>
														<td>{{ $bank->bank_code }}</td>
													</tr>
                                                    <tr>
														<th>支店名</th>
														<td>{{ $bank->branch_name }}</td>
													</tr>
                                                    <tr>
														<th>支店コード</th>
														<td>{{ $bank->branch_code }}</td>
													</tr>
                                                    <tr>
														<th>口座種別</th>
														<td>{{ \App\Models\BankAccount::BANK_TYPE[$bank->type] }}</td>
													</tr>
													<tr>
														<th>口座名義人名</th>
														<td>{{ Crypt::decryptString($bank->name) }}</td>
													</tr>
                                                    <tr>
														<th>口座番号</th>
														<td>{{ Crypt::decryptString($bank->number) }}</td>
													</tr>
												</table>
												<form action="{{ route('setting.bank.destroy') }}" method="post" class="configEditDeleteBtn">
													@csrf @method('delete')
													<button type="submit" onclick='return confirm("削除してもよろしいですか？");'>削除</button>
												</form>
											</div>
									</div>
								@endif
								<form id="form" action="{{ route('setting.bank.update') }}" method="post">
									@csrf
									<div class="configEditList">
									@if($bank === null)
										<h3 class="mypageEditHd">振込口座を登録</h3>
									@else
										<h3 class="mypageEditHd">振込口座情報を変更</h3>
									@endif
										<div class="configEditTable">
											<table>
												<tr>
													<th>金融機関名</th>
													<td>
														@error('bank_name')<div class="alert alert-danger">{{ $message }}</div>@enderror
														<div class="mypageEditInput"><input type="text" name="bank_name" value="{{ old('bank_name') }}"></div>
													</td>
												</tr>
                                                <tr>
													<th>金融機関コード</th>
													<td>
														@error('bank_code')<div class="alert alert-danger">{{ $message }}</div>@enderror
														<div class="mypageEditInput"><input type="text" name="bank_code" value="{{ old('bank_code') }}"></div>
													</td>
												</tr>
                                                <tr>
													<th>支店名</th>
													<td>
														@error('branch_name')<div class="alert alert-danger">{{ $message }}</div>@enderror
														<div class="mypageEditInput"><input type="text" name="branch_name" value="{{ old('branch_name') }}"></div>
													</td>
												</tr>
                                                <tr>
													<th>支店コード</th>
													<td>
														@error('branch_code')<div class="alert alert-danger">{{ $message }}</div>@enderror
														<div class="mypageEditInput"><input type="text" name="branch_code" value="{{ old('branch_code') }}"></div>
													</td>
												</tr>
                                                <tr>
													<th>口座種別</th>
													<td>
														@error('type')<div class="alert alert-danger">{{ $message }}</div>@enderror
														<div class=" radioChoice">
																<input type="radio" name="type" value="{{ App\Models\BankAccount::TYPE_ORDINARY }}" @if(old('type') == App\Models\BankAccount::TYPE_ORDINARY) checked @endif>
																<span class="credit-card-info-number" style="margin-right:80px;">{{ App\Models\BankAccount::BANK_TYPE[App\Models\BankAccount::TYPE_ORDINARY] }}</span>

																<input type="radio" name="type" value="{{ App\Models\BankAccount::TYPE_CURRENT }}" @if(old('type') == App\Models\BankAccount::TYPE_CURRENT) checked @endif>
																<span class="credit-card-info-number">{{ App\Models\BankAccount::BANK_TYPE[App\Models\BankAccount::TYPE_CURRENT] }}</span>
														</div>
													</td>
												</tr>
                                                <tr>
													<th>口座名義人名</th>
													<td>
														@error('bank_account_name')<div class="alert alert-danger">{{ $message }}</div>@enderror
														<div class="mypageEditInput"><input type="text" name="bank_account_name" value="{{ old('bank_account_name') }}"></div>
													</td>
												</tr>
                                                <tr>
													<th>口座番号</th>
													<td>
														@error('bank_account_number')<div class="alert alert-danger">{{ $message }}</div>@enderror
														<div class="mypageEditInput"><input type="tell" name="bank_account_number" value="{{ old('bank_account_number') }}"></div>
													</td>
												</tr>                                    
											</table>
										</div>
									</div>

									<div class="configEditButton">
										<input class="loading-disabled" type="submit" value="登録">
									</div>
								</form>
							</div>
						</div>

					</div>
				</div><!-- /#main -->
				<x-side-menu/>
			</div><!--inner-->
		</div><!-- /#contents -->
	</article>
</x-layout>
