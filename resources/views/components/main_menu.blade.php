<div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
    <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
        <li>
            <a href="{{ route('cards.index') }}" class="nav-link px-3 link-dark hstack gap-1">
                <x-feathericon-layout class="main-menu-icon"/>
                Resume
            </a>
        </li>
        <li>
            <a href="{{ route('cards.index') }}" class="nav-link px-3 link-dark hstack gap-1">
                <x-feathericon-credit-card class="main-menu-icon"/>
                Cards
            </a>
        </li>
        <li>
            <a href="{{ route('investments.index') }}" class="nav-link px-3 link-dark hstack gap-1">
                <x-feathericon-trending-up class="main-menu-icon"/>
                Investments
            </a>
        </li>
        <li>
            <a href="{{ route('crypto.index') }}" class="nav-link px-3 link-dark hstack gap-1">
                <x-feathericon-bold class="main-menu-icon"/>
                Crypto
            </a>
        </li>
        <li>
            <a href="{{ route('cards.index') }}" class="nav-link px-3 link-dark hstack gap-1">
                <x-feathericon-file-text class="main-menu-icon"/>
                Reports
            </a>
        </li>
        <li>
            <a href="{{ route('categories.index') }}" class="nav-link px-3 link-dark hstack gap-1">
                <x-feathericon-align-justify class="main-menu-icon"/>
                Categories
            </a>
        </li>
    </ul>
</div>