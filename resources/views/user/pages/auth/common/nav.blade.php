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
                <li>
                    <a href="{{ route('user.auth.top.show') }}" class="dropdown-toggle no-arrow">
                        <span class="micon dw dw-house-1"></span><span class="mtext">お知らせ</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="dropdown-toggle no-arrow">
                        <span class="micon dw dw-calendar-1"></span><span class="mtext">施設通常予約</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="dropdown-toggle no-arrow">
                        <span class="micon dw dw-calendar1"></span><span class="mtext">施設抽選予約</span>
                    </a>
                </li>
                <li class="dropdown">
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

                <li>
                    <div class="sidebar-small-cap"></div>
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
