<div class="left-side-bar">
    <div class="brand-logo">
        <a href="{{ route('user.auth.top.show') }}">
            <span>くにじまスポーツ</span><br>
            <span>パデルワンくにじま</span><br>
            <span>くにじまテニスコート</span>
        </a>
        <div class="close-sidebar" data-toggle="left-sidebar-close">
            <i class="ion-close-round"></i>
        </div>
    </div>
    <div class="menu-block customscroll">
        <div class="sidebar-menu">
            <ul id="accordion-menu">
                <li class="@if(request()->route()->named('user.auth.top.show')) nav-active @endif">
                    <a href="{{ route('user.auth.top.show') }}" class="dropdown-toggle no-arrow">
                        <span class="micon dw dw-house-1"></span><span class="mtext">お知らせ</span>
                    </a>
                </li>
                <li class="@if(request()->route()->named('user.auth.reservation.*')) nav-active @endif">
                    <a href="{{ route('user.auth.reservation.select.date') }}" class="dropdown-toggle no-arrow">
                        <span class="micon dw dw-calendar-1"></span><span class="mtext">施設通常予約</span>
                    </a>
                </li>
                <li class="@if(request()->route()->named('user.auth.drawing.reservation.*')) nav-active @endif">
                    <a href="#" class="dropdown-toggle no-arrow">
                        <span class="micon dw dw-calendar1"></span><span class="mtext">施設抽選予約</span>
                    </a>
                </li>
                <li class="@if(request()->route()->named('user.auth.check.annual.contract.*')) nav-active @endif">
                    <a href="#" class="dropdown-toggle no-arrow">
                        <span class="micon dw dw-time-management"></span><span class="mtext">年間契約</span>
                    </a>
                </li>
                <li class="@if(request()->route()->named('user.auth.check.reservation.status.*')) nav-active @endif">
                    <a href="#" class="dropdown-toggle no-arrow">
                        <span class="micon dw dw-checked"></span><span class="mtext">予約状況確認</span>
                    </a>
                </li>
                <li class="dropdown @if(request()->route()->named('user.auth.user.*')) nav-active @endif">
                    <a href="javascript:;" class="dropdown-toggle">
                        <span class="micon dw dw-user1"></span><span class="mtext">利用者情報</span>
                    </a>
                    <ul class="submenu">
                        <li><a href="#" class="d-flex align-items-center"><i class="dw dw-eye mr-4"></i>利用者情報詳細</a></li>
                        <li><a href="#" class="d-flex align-items-center"><i class="dw dw-edit2 mr-4"></i>利用者情報変更</a></li>
                    </ul>
                </li>

                <li>
                    <div class="dropdown-divider"></div>
                </li>

                <li class="@if(request()->route()->named('user.auth.policy.*')) nav-active @endif">
                    <a href="#" class="dropdown-toggle no-arrow">
                        <span class="micon dw dw-deal"></span><span class="mtext">使用規定</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('user.auth.logout') }}" class="dropdown-toggle no-arrow">
                        <span class="micon dw dw-logout1"></span>
                        <span class="mtext">ログアウト</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
