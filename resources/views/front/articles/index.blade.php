@extends('layouts.front')

@section('seo-title', __('messages.articles'))

@section('content')
    <div class="blog">
        <section class="main-header">
            <div class="container">
                <ul class="breadcrumb _white">
                    <li><a href="">Головна</a></li>
                    <li><span>Новини та події </span></li>
                </ul>
                <h1 class="main-header__title">Новини та події </h1>
                <div class="main-header__description">
                    <p>
                        Тут ви знайдете важливі новини з приводу зборів та напрямів діяльності фонду, анонси майбутніх подій та інші матеріали від фонду. Lorem ipsum
                        dolor sit amet consectetur.
                    </p>
                </div>
            </div>
        </section>

        <div class="container">
            <div class="tabs-block">
                <div class="tabs-buttons">
                    <a href="./news.html" class="tab-btn active">Новини</a>
                    <a href="./event.html" class="tab-btn">події</a>
                </div>
                <div class="tab-content">
                    <div class="tab-item active">
                        <div class="blog-cards">
                            @foreach($articles as $article)
                            <a href="{{ route('front.articles.show', $article) }}" class="link-block blog-cart">
                                <span class="icon-link _red"></span>
                                <div class="blog-cart__top">
                                    <p class="blog-cart__type">Новина</p>
                                    <p class="blog-cart__date">{{ $article->publish_date->format('d/m/Y') }}</p>
                                </div>
                                <div class="blog-cart__img">
                                    <picture>
                                        <source srcset="{{ $article->getArticleMainImage(636, 'webp') }}" type="image/webp">
                                        <source srcset="{{ $article->getArticleMainImage(636, 'jpeg') }}" type="image/jpeg">

                                        <img src="{{ $article->getArticleMainImage(636, 'jpeg') }}" loading="lazy" alt="">
                                    </picture>
                                </div>
                                <p class="link-text">
                                    {{ $article->title }}
                                </p>
                            </a>
                            @endforeach
                        </div>

                        <div class="pagination">
                            <button type="button" class="btn-icon icon-loader border-blue reverse btn-more">Більше новин</button>
                            <div class="pagination-elems">
                                @if($articles->onFirstPage())
                                    <span class="pagin-elem arrow arrow-prev disabled">Назад</span>
                                @else
                                    <a href="{{ $articles->previousPageUrl() }}" class="pagin-elem arrow arrow-prev">Назад</a>
                                @endif

                                @foreach($articles->getUrlRange(1, $articles->lastPage()) as $page => $url)
                                    <a href="{{ $url }}" class="pagin-elem @if ($page == $articles->currentPage()) current @endif">{{ $page }}</a>
                                @endforeach

                                @if($articles->hasMorePages())
                                    <a href="{{ $articles->nextPageUrl() }}" class="pagin-elem arrow arrow-next">Вперед</a>
                                @else
                                    <span class="pagin-elem arrow arrow-next disabled">Вперед</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal modal-credentials _js-modal js-modal-bank-transfer" data-overlay >
            <div class="modal-content">
                <button type="button" class="modal-close _js-btn-close-modal"></button>
                <p class="credentials-title">Банківський переказ</p>
                <ul class="credentials-list">
                    <li>
                        <p><strong>Nazwa odbiorcy:</strong> Odrodzimy Dziedzictwo Kulturowe</p>
                    </li>
                    <li>
                        <p><strong>Nazwa banku:</strong> Powszechna Kasa Oszczednosci Bank Polski SA</p>
                    </li>
                    <li>
                        <p><strong>Kod BIC (Swift) banku:</strong> BPKOPLPW</p>
                    </li>
                </ul>

                <div class="credential-cards">
                    <div class="credential-card">
                        <div class="credential-card__top">
                            Numer rachunku odbiorcy <span>Polish Zloty (PLN)</span>
                        </div>
                        <div class="credential-card__bank">
                            PL71 1020 4274 0000 1202 0100 8739
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal modal-credentials _js-modal js-modal-paypal " data-overlay>
            <div class="modal-content">
                <button type="button" class="modal-close _js-btn-close-modal"></button>
                <p class="credentials-title">Paypal</p>
                <div class="credential-cards">
                    <div class="credential-card">
                        <div class="credential-card__bank">mail@gmail.com</div>
                        <div class="credential-card__desc">
                            <p>
                                <strong>Комментар:</strong> Благодійний  внесок
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal modal-credentials _js-modal js-modal-swift" data-overlay>
            <div class="modal-content">
                <button type="button" class="modal-close _js-btn-close-modal"></button>
                <p class="credentials-title">SWIFT перекази</p>
                <ul class="credentials-list">
                    <li>
                        <p>
                            <strong>Beneficiary name:</strong> Odrodzimy Dziedzictwo Kulturowe
                        </p>
                    </li>
                    <li>
                        <p>
                            <strong>Beneficiary bank name:</strong> Powszechna Kasa Oszczednosci Bank Polski SA
                        </p>
                    </li>
                    <li>
                        <p>
                            <strong>Beneficiary bank code:</strong> BPKOPLPW
                        </p>
                    </li>
                    <li>
                        <p>
                            <strong>Możliwe dopiski:</strong> Ah decyduje, pomoc humanitarna, woda, żywność, edukacja lub wybrany kraj naszych działań
                        </p>
                    </li>
                </ul>

                <div class="credential-cards">
                    <div class="credential-card">
                        <div class="credential-card__top">
                            Beneficiary account <span>US Dollar (USD)</span>
                        </div>
                        <div class="credential-card__bank">
                            PL09 1020 4274 0000 1202 0103 8470
                        </div>
                    </div>
                    <div class="credential-card">
                        <div class="credential-card__top">
                            Beneficiary account <span>Euro (EUR)</span>
                        </div>
                        <div class="credential-card__bank">
                            PL76 1020 4274 0000 1002 0100 8747
                        </div>
                    </div>
                    <div class="credential-card">
                        <div class="credential-card__top">
                            Beneficiary account <span>Great Britain Pound (GBP)</span>
                        </div>
                        <div class="credential-card__bank">
                            PL00 0000 0000 0000 0000 0000 0000
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal modal-alert _js-modal js-modal-alert-success" data-overlay>
            <div class="modal-content">
                <button type="button" class="modal-close _js-btn-close-modal"></button>
                <p class="alert-title">Дякуємо</p>
                <p class="alert-subtitle">Ваша заявка на співпрацю прийнята</p>
                <div class="alert-desc">
                    <p>
                        Наша служба турботи зв'яжеться з вами найближчим часом для уточнення деталей.
                    </p>
                </div>
            </div>
        </div>

        <div class="overlay-modal"></div>

        <div class="msg-widget">
            <button type="button" class="widget-show"></button>

            <a href="" class="widget-item _whats-app"></a>
            <a href="" class="widget-item _facebook-messenger"></a>
        </div>
    </div>
@endsection
