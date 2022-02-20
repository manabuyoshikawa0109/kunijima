@extends('user.pages.auth.layouts.app')

@section('content')
<div class="main-container">
	<div class="p-sm-3 p-1">
		<div class="card-box p-sm-4 px-2 py-3 mb-4">
            <form action="{{ route('user.auth.sql.insert') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-sm-2 pl-0">
                        <div class="form-group">
                            <label>テーブル名</label>
                            <input type="text" class="form-control-file form-control height-auto" name="table" style="height: 41px;">
                        </div>
                    </div>
                    <div class="col-sm-8 pl-0">
                        <div class="form-group">
                            <label>Excelファイル</label>
                            <input type="file" class="form-control-file form-control height-auto" name="excel">
                        </div>
                    </div>
                    <div class="col-sm-2 pl-0">
                        <div class="form-group">
                            <label>&nbsp;</label>
                            <button type="submit" class="btn btn-sm btn-dark d-block"><i class="fas fa-file-import mr-1"></i>作成</button>
                        </div>
                    </div>
                </div>
            </form>
		</div>
        @isset($sql)
        <div class="card-box p-sm-4 px-2 py-3 mb-4">
            <div class="code-box">
                <div class="clearfix">
                    <a href="javascript:;" class="btn btn-primary btn-sm code-copy pull-right" data-clipboard-target="#copy-pre"><i class="fa fa-clipboard mr-1"></i>Copy SQL</a>
                </div>
                {{-- 改行するとボタンとソース表示エリアの間に空白ができるので改行しない --}}
                <pre><code class="xml copy-pre" id="copy-pre">
{{ $sql }}
                </code></pre>
            </div>
        </div>
        @endisset
	</div>
</div>
@endsection

@push('scripts')
<script type="text/javascript">
$(function(){
    var clipboard = new ClipboardJS('.code-copy');
	clipboard.on('success', function(e) {
		CopyToClipboard('',true, "Copied");
		e.clearSelection();
	});
});
</script>
@endpush
