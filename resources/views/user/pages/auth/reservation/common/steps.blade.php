{{-- ステップ1、ステップ2のような表示を追加 --}}
@push('links')
<link rel="stylesheet" type="text/css" href="/user/assets/css/step.css">
@endpush

<div class="page-header">
    {{-- クラス名にactive、もしくはdisabledを付与しないとうまく色がつかない --}}
    <div class="row bs-wizard p-0">
        <div class="col-3 bs-wizard-step @if($page->isSelectingDate()) active @elseif($page->isSelectingTime() || $page->isConfirming() || $page->isCompleted()) complete @else disabled @endif">
            <div class="text-center bs-wizard-stepnum">Step 1</div>
            <div class="progress">
                <div class="progress-bar"></div>
            </div> <a class="bs-wizard-dot"></a>
            <div class="bs-wizard-info text-center">日付選択</div>
        </div>
        <div class="col-3 bs-wizard-step @if($page->isSelectingTime()) active @elseif($page->isConfirming() || $page->isCompleted()) complete @else disabled @endif">
            <div class="text-center bs-wizard-stepnum">Step 2</div>
            <div class="progress">
                <div class="progress-bar"></div>
            </div> <a class="bs-wizard-dot"></a>
            <div class="bs-wizard-info text-center">時間選択</div>
        </div>
        <div class="col-3 bs-wizard-step @if($page->isConfirming()) active @elseif($page->isCompleted()) complete @else disabled @endif">
            <div class="text-center bs-wizard-stepnum">Step 3</div>
            <div class="progress">
                <div class="progress-bar"></div>
            </div> <a class="bs-wizard-dot"></a>
            <div class="bs-wizard-info text-center">予約確認</div>
        </div>
        <div class="col-3 bs-wizard-step @if($page->isCompleted()) active @else disabled @endif">
            <div class="text-center bs-wizard-stepnum">Step 4</div>
            <div class="progress">
                <div class="progress-bar"></div>
            </div> <a class="bs-wizard-dot"></a>
            <div class="bs-wizard-info text-center">完了</div>
        </div>
    </div>
    <div class="col-12 px-0 pt-1 text-center">
        {{ $page->guideMessage() }}
    </div>
</div>
