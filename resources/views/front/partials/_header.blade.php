<header data-lp>
    <div class="container">
        <a href="./home.html" class="header-logo">
            <picture>
                <source srcset="{{ asset('front/img/components/logo-text.webp') }}" media="(min-width: 768px)"/>
                <source srcset="{{ asset('front/img/components/logo-text.png') }}" media="(min-width: 768px)"/>

                <source srcset="{{ asset('front/img/components/logo.webp') }}"/>
                <source srcset="{{ asset('front/img/components/logo.png') }}"/>

                <img src="{{ asset('front/img/components/logo.png') }}" alt="" />
            </picture>
        </a>

        <div class="header-main">
            <nav>
                <ul>
                    <li>
                        <a href="./about.html">Про фонд</a>
                    </li>
                    <li>
                        <a href="./projects.html">Проекти</a>
                    </li>
                    <li>
                        <a href="{{ route('front.articles.index') }}">Новини та події</a>
                    </li>
                    <li>
                        <a href="">Донори</a>
                    </li>
                    <li>
                        <a href="">Контакти</a>
                    </li>
                </ul>
            </nav>

            <div class="lang-switcher">
                <div class="lang-switcher__selected">
                    @if(session('lang_code') == 'pl')
                        PL
                    @elseif(session('lang_code') == 'uk')
                        UK
                    @elseif(session('lang_code') == 'en')
                        EN
                    @endif
                </div>
                <ul class="lang-switcher__list">
                    @foreach($languages as $lang)
                        <li>
                            <a href="{{ route('change_lang', $lang) }}" class="lang-link" id="{{ $lang }}">
                                {{ strtoupper($lang) }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>

        <div class="header-btns">
            <a href="/donation.html" class="btn-icon bg-red icon-link" data-text="Підтримати фонд">Підтримати</a>
            <div class="burger">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>

        <div class="header-overflow"></div>
    </div>
</header>
