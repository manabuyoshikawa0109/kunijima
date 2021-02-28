<div class="header">
    <div class="header-left">
        <div class="menu-icon dw dw-menu"></div>
        <div class="search-toggle-icon dw dw-search2" data-toggle="header_search"></div>
        <div class="header-search">
            {{-- 過去のお知らせを絞り込み検索できるようにする --}}
            <form action="#" method="post">
                @csrf
                <div class="form-group mb-0">
                    <input type="text" class="form-control search-input" name="search" value="{{ old('search') }}" placeholder="お知らせを絞り込み検索">
                    <button type="submit" class="btn search-button">
                        <i class="dw dw-search2 search-icon text-white"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
    <div class="header-right">
        {{-- ここには管理画面で追加した案内事項を表示するようにしたい --}}
        <div class="user-notification">
            <div class="dropdown">
                <a class="dropdown-toggle no-arrow" href="#" role="button" data-toggle="dropdown">
                    <i class="icon-copy dw dw-notification"></i>
                    {{-- ユーザーがまだ確認していないものがあればお知らせ用アイコンを表示 --}}
                    <span class="badge notification-active"></span>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <div class="notification-list mx-h-350 customscroll">
                        <ul>
                            <li>
                                <a href="#">
                                    <i class="fas fa-history"></i>
                                    <h3>営業時間短縮のご案内</h3>
                                    <p>2/7に政府による緊急事態宣言のため...</p>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="user-info-dropdown">
            <div class="dropdown">
                <a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                    <span class="user-icon">
                        <img src="/user/assets/img/no-user.jpg">
                    </span>
                    <span class="user-name">{{ Auth::guard('user')->user()->last_name . Auth::guard('user')->user()->first_name }}</span>
                </a>
                <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                    <a class="dropdown-item" href="#"><i class="dw dw-user1"></i>利用者情報変更</a>
                    <a class="dropdown-item" href="{{ route('user.auth.logout') }}"><i class="dw dw-logout"></i>ログアウト</a>
                </div>
            </div>
        </div>
    </div>
</div>
