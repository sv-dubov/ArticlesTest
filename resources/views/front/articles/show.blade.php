@extends('layouts.front')

@section('seo-title', $article->seo->exists() ? $article->seo->title : $article->title)
@section('seo-description', $article->seo->exists() ? $article->seo->description : null)

@section('content')
    <div class="single-page single-blog">
        <div class="container">
            <ul class="breadcrumb">
                <li><a href="">Головна</a></li>
                <li><a href="{{ route('front.articles.index') }}">Новини та події</a></li>
                <li><span>Новина</span></li>
            </ul>

            <div class="single-page-content have-sidebar">
                <article class="single-main">
                    <div class="blog-info">
                        <div class="blog-type">Новина</div>
                        <div class="blog-date">Дата публікації: {{ $article->publish_date->format('d/m/Y') }}</div>
                    </div>
                    <h1 class="h1 main-title">{{ $article->title }}</h1>
                    <div class="blog-photo">
                        {{--<div class="blog-photo__title">
                            <a href="" class="_link">Якась Крута Велика Фортеця</a>
                        </div>--}}
                        <div class="blog-photo__img">
                            <picture>
                                <source srcset="./img/delete/project-img.webp" type="image/webp">
                                <source srcset="./img/delete/project-img.jpg" type="image/jpeg">

                                <img src="./img/delete/project-img.jpg" loading="lazy" alt="">
                            </picture>
                        </div>
                    </div>

                    <div class="editor">
                        <h2>
                            {{ $article->subtitle }}
                        </h2>

                        @if($texts->count() > 0)
                            @foreach($texts as $text)
                                {!! $text->content !!}
                            @endforeach
                        @endif

                        {{--<ul>
                            <li>
                                <p>Історія фонду</p>
                            </li>
                            <li>
                                <p>Місія та цілі</p>
                            </li>
                            <li>
                                <p>Дані Національного судового реєстру, Статут, звіти</p>
                            </li>
                            <li>
                                <p>Інструкції використання веб-сайту BIP</p>
                            </li>
                            <li>
                                <p>Майно фонду</p>
                            </li>
                            <li>
                                <p>Як ми допомогаємо 1,2,3,4</p>
                            </li>
                            <li>
                                <p>Пожертвувати 1,5% від вашого податку</p>
                            </li>
                            <li>
                                <p>Онлайн внесок через Hotpay.pl</p>
                            </li>
                            <li>
                                <p>Соціально відповідальний бізнес</p>
                            </li>
                            <li>
                                <p>Інші форми підтримки</p>
                            </li>
                        </ul>--}}

                        {{--<a href="" class="download-link">Какой-то файл с каким-то названием (pdf)</a>
                        <a href="" class="download-link">Еще один файл (pdf)</a>
                        <a href="" class="download-link">И еще один (pdf)</a>--}}

                        @if($videos->count() > 0)
                            @foreach($videos as $video)
                                <div class="video-youtube">
                                    <iframe width="560" height="315" src="{{ $video->link }}" title="YouTube video player"
                                            frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                            allowfullscreen></iframe>
                                </div>
                            @endforeach
                        @endif

                        <div class="gallery-swiper__wrapper">
                            <div class="gallery-swiper__top">
                                <p class="gallery-swiper__title">Lorem ipsum dolor sit amet consectetur. </p>

                                <div class="swiper-arrows">
                                    <div class="swiper-arrow swiper-button-prev _color-blue btn-prev-gallery"></div>
                                    <div class="swiper-arrow swiper-button-next _color-blue btn-next-gallery"></div>
                                </div>
                            </div>
                            <div class="swiper gallery-swiper">
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide _js-btn-show-modal" data-modal="gallery">
                                        <picture>
                                            <source srcset="./img/delete/gallery-img-1.webp" type="image/webp">
                                            <source srcset="./img/delete/gallery-img-1.jpg" type="image/jpeg">

                                            <img src="./img/delete/gallery-img-1.jpg" loading="lazy" alt="">
                                        </picture>
                                    </div>
                                    <div class="swiper-slide _js-btn-show-modal" data-modal="gallery">
                                        <picture>
                                            <source srcset="./img/delete/gallery-img-2.webp" type="image/webp">
                                            <source srcset="./img/delete/gallery-img-2.jpg" type="image/jpeg">

                                            <img src="./img/delete/gallery-img-2.jpg" loading="lazy" alt="">
                                        </picture>
                                    </div>
                                    <div class="swiper-slide _js-btn-show-modal" data-modal="gallery">
                                        <picture>
                                            <source srcset="./img/delete/gallery-img-3.webp" type="image/webp">
                                            <source srcset="./img/delete/gallery-img-3.jpg" type="image/jpeg">

                                            <img src="./img/delete/gallery-img-3.jpg" loading="lazy" alt="">
                                        </picture>
                                    </div>
                                    <div class="swiper-slide _js-btn-show-modal" data-modal="gallery">
                                        <picture>
                                            <source srcset="./img/delete/gallery-img-4.webp" type="image/webp">
                                            <source srcset="./img/delete/gallery-img-4.jpg" type="image/jpeg">

                                            <img src="./img/delete/gallery-img-4.jpg" loading="lazy" alt="">
                                        </picture>
                                    </div>

                                    <div class="swiper-slide _js-btn-show-modal" data-modal="gallery">
                                        <picture>
                                            <source srcset="./img/delete/gallery-img-4.webp" type="image/webp">
                                            <source srcset="./img/delete/gallery-img-4.jpg" type="image/jpeg">

                                            <img src="./img/delete/gallery-img-4.jpg" loading="lazy" alt="">
                                        </picture>
                                    </div>
                                    <div class="swiper-slide _js-btn-show-modal" data-modal="gallery">
                                        <picture>
                                            <source srcset="./img/delete/gallery-img-3.webp" type="image/webp">
                                            <source srcset="./img/delete/gallery-img-3.jpg" type="image/jpeg">

                                            <img src="./img/delete/gallery-img-3.jpg" loading="lazy" alt="">
                                        </picture>
                                    </div>
                                    <div class="swiper-slide _js-btn-show-modal" data-modal="gallery">
                                        <picture>
                                            <source srcset="./img/delete/gallery-img-2.webp" type="image/webp">
                                            <source srcset="./img/delete/gallery-img-2.jpg" type="image/jpeg">

                                            <img src="./img/delete/gallery-img-2.jpg" loading="lazy" alt="">
                                        </picture>
                                    </div>
                                    <div class="swiper-slide _js-btn-show-modal" data-modal="gallery">
                                        <picture>
                                            <source srcset="./img/delete/gallery-img-1.webp" type="image/webp">
                                            <source srcset="./img/delete/gallery-img-1.jpg" type="image/jpeg">

                                            <img src="./img/delete/gallery-img-1.jpg" loading="lazy" alt="">
                                        </picture>
                                    </div>

                                    <div class="swiper-slide _js-btn-show-modal" data-modal="gallery">
                                        <picture>
                                            <source srcset="./img/delete/gallery-img-1.webp" type="image/webp">
                                            <source srcset="./img/delete/gallery-img-1.jpg" type="image/jpeg">

                                            <img src="./img/delete/gallery-img-1.jpg" loading="lazy" alt="">
                                        </picture>
                                    </div>
                                    <div class="swiper-slide _js-btn-show-modal" data-modal="gallery">
                                        <picture>
                                            <source srcset="./img/delete/gallery-img-2.webp" type="image/webp">
                                            <source srcset="./img/delete/gallery-img-2.jpg" type="image/jpeg">

                                            <img src="./img/delete/gallery-img-2.jpg" loading="lazy" alt="">
                                        </picture>
                                    </div>
                                    <div class="swiper-slide _js-btn-show-modal" data-modal="gallery">
                                        <picture>
                                            <source srcset="./img/delete/gallery-img-3.webp" type="image/webp">
                                            <source srcset="./img/delete/gallery-img-3.jpg" type="image/jpeg">

                                            <img src="./img/delete/gallery-img-3.jpg" loading="lazy" alt="">
                                        </picture>
                                    </div>
                                    <div class="swiper-slide _js-btn-show-modal" data-modal="gallery">
                                        <picture>
                                            <source srcset="./img/delete/gallery-img-4.webp" type="image/webp">
                                            <source srcset="./img/delete/gallery-img-4.jpg" type="image/jpeg">

                                            <img src="./img/delete/gallery-img-4.jpg" loading="lazy" alt="">
                                        </picture>
                                    </div>

                                    <div class="swiper-slide _js-btn-show-modal" data-modal="gallery">
                                        <picture>
                                            <source srcset="./img/delete/gallery-img-4.webp" type="image/webp">
                                            <source srcset="./img/delete/gallery-img-4.jpg" type="image/jpeg">

                                            <img src="./img/delete/gallery-img-4.jpg" loading="lazy" alt="">
                                        </picture>
                                    </div>
                                    <div class="swiper-slide _js-btn-show-modal" data-modal="gallery">
                                        <picture>
                                            <source srcset="./img/delete/gallery-img-3.webp" type="image/webp">
                                            <source srcset="./img/delete/gallery-img-3.jpg" type="image/jpeg">

                                            <img src="./img/delete/gallery-img-3.jpg" loading="lazy" alt="">
                                        </picture>
                                    </div>
                                    <div class="swiper-slide _js-btn-show-modal" data-modal="gallery">
                                        <picture>
                                            <source srcset="./img/delete/gallery-img-2.webp" type="image/webp">
                                            <source srcset="./img/delete/gallery-img-2.jpg" type="image/jpeg">

                                            <img src="./img/delete/gallery-img-2.jpg" loading="lazy" alt="">
                                        </picture>
                                    </div>
                                    <div class="swiper-slide _js-btn-show-modal" data-modal="gallery">
                                        <picture>
                                            <source srcset="./img/delete/gallery-img-1.webp" type="image/webp">
                                            <source srcset="./img/delete/gallery-img-1.jpg" type="image/jpeg">

                                            <img src="./img/delete/gallery-img-1.jpg" loading="lazy" alt="">
                                        </picture>
                                    </div>

                                    <div class="swiper-slide _js-btn-show-modal" data-modal="gallery">
                                        <picture>
                                            <source srcset="./img/delete/gallery-img-1.webp" type="image/webp">
                                            <source srcset="./img/delete/gallery-img-1.jpg" type="image/jpeg">

                                            <img src="./img/delete/gallery-img-1.jpg" loading="lazy" alt="">
                                        </picture>
                                    </div>
                                    <div class="swiper-slide _js-btn-show-modal" data-modal="gallery">
                                        <picture>
                                            <source srcset="./img/delete/gallery-img-2.webp" type="image/webp">
                                            <source srcset="./img/delete/gallery-img-2.jpg" type="image/jpeg">

                                            <img src="./img/delete/gallery-img-2.jpg" loading="lazy" alt="">
                                        </picture>
                                    </div>
                                    <div class="swiper-slide _js-btn-show-modal" data-modal="gallery">
                                        <picture>
                                            <source srcset="./img/delete/gallery-img-3.webp" type="image/webp">
                                            <source srcset="./img/delete/gallery-img-3.jpg" type="image/jpeg">

                                            <img src="./img/delete/gallery-img-3.jpg" loading="lazy" alt="">
                                        </picture>
                                    </div>
                                    <div class="swiper-slide _js-btn-show-modal" data-modal="gallery">
                                        <picture>
                                            <source srcset="./img/delete/gallery-img-4.webp" type="image/webp">
                                            <source srcset="./img/delete/gallery-img-4.jpg" type="image/jpeg">

                                            <img src="./img/delete/gallery-img-4.jpg" loading="lazy" alt="">
                                        </picture>
                                    </div>

                                    <div class="swiper-slide _js-btn-show-modal" data-modal="gallery">
                                        <picture>
                                            <source srcset="./img/delete/gallery-img-4.webp" type="image/webp">
                                            <source srcset="./img/delete/gallery-img-4.jpg" type="image/jpeg">

                                            <img src="./img/delete/gallery-img-4.jpg" loading="lazy" alt="">
                                        </picture>
                                    </div>
                                    <div class="swiper-slide _js-btn-show-modal" data-modal="gallery">
                                        <picture>
                                            <source srcset="./img/delete/gallery-img-3.webp" type="image/webp">
                                            <source srcset="./img/delete/gallery-img-3.jpg" type="image/jpeg">

                                            <img src="./img/delete/gallery-img-3.jpg" loading="lazy" alt="">
                                        </picture>
                                    </div>
                                    <div class="swiper-slide _js-btn-show-modal" data-modal="gallery">
                                        <picture>
                                            <source srcset="./img/delete/gallery-img-2.webp" type="image/webp">
                                            <source srcset="./img/delete/gallery-img-2.jpg" type="image/jpeg">

                                            <img src="./img/delete/gallery-img-2.jpg" loading="lazy" alt="">
                                        </picture>
                                    </div>
                                    <div class="swiper-slide _js-btn-show-modal" data-modal="gallery">
                                        <picture>
                                            <source srcset="./img/delete/gallery-img-1.webp" type="image/webp">
                                            <source srcset="./img/delete/gallery-img-1.jpg" type="image/jpeg">

                                            <img src="./img/delete/gallery-img-1.jpg" loading="lazy" alt="">
                                        </picture>
                                    </div>
                                </div>

                                <div class="swiper-pagination swiper-pagination__gallery _horizontal"></div>
                            </div>
                        </div>
                    </div>
                </article>
                <div class="sidebar sidebar-cards">
                    <div class="sidebar-card">
                        <p class="sidebar-card__title">Я хочу допомогти</p>

                        <ul class="list-link">
                            <li><a href="">Онлайн внесок через Hotpay.pl</a></li>
                            <li><a href="">Соціально відповідальний бізнес</a></li>
                            <li><a href="">Інші форми підтримки</a></li>
                        </ul>
                    </div>
                    <div class="sidebar-card">
                        <p class="sidebar-card__title">Підтримати проект</p>
                        <div class="sidebar-card__img">
                            <picture>
                                <source srcset="/img/delete/project-img.webp" type="image/webp">
                                <source srcset="/img/delete/project-img.jpg" type="image/jpeg">

                                <img src="/img/delete/project-img.jpg" loading="lazy" alt="">
                            </picture>
                        </div>

                        <p class="sidebar-card__subtitle">Якась Крута Велика Фортеця</p>

                        <div class="sidebar-card__desc">
                            <p>Подивіться, варіанти як ви можете допомогти нам у цьому проекті</p>
                        </div>
                        <a href="" class="btn-icon icon-link bg-blue">Підтримати проект</a>


                    </div>
                    <div class="sidebar-card">
                        <p class="sidebar-card__title">Стати партнером</p>

                        <div class="sidebar-card__desc">
                            <p>Соціально відповідальні компанії постійно співпрацюють з нашим Фондом</p>
                        </div>
                        <a href="" class="btn-icon icon-link bg-blue">Стати партнером</a>
                    </div>
                    <div class="sidebar-card">
                        <p class="sidebar-card__title">Новина фонду</p>
                        <div class="sidebar-card__img">
                            <picture>
                                <source srcset="/img/delete/project-img.webp" type="image/webp">
                                <source srcset="/img/delete/project-img.jpg" type="image/jpeg">

                                <img src="/img/delete/project-img.jpg" loading="lazy" alt="">
                            </picture>
                        </div>

                        <p class="sidebar-card__subtitle">Шось дуже круте у фонді трапилось, скоріш біжи читай </p>

                        <a href="" class="btn-icon icon-link bg-blue">Підтримати проект</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal modal-gallery _js-modal js-modal-gallery" data-overlay>
        <div class="modal-content">
            <button type="button" class="modal-close _js-btn-close-modal"></button>
            <div class="gallery-zoom__swiper swiper">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <picture>
                            <source srcset="./img/delete/gallery-img-1.webp" type="image/webp">
                            <source srcset="./img/delete/gallery-img-1.jpg" type="image/jpeg">

                            <img src="./img/delete/gallery-img-1.jpg" loading="lazy" alt="">
                        </picture>
                    </div>
                    <div class="swiper-slide">
                        <picture>
                            <source srcset="./img/delete/gallery-img-2.webp" type="image/webp">
                            <source srcset="./img/delete/gallery-img-2.jpg" type="image/jpeg">

                            <img src="./img/delete/gallery-img-2.jpg" loading="lazy" alt="">
                        </picture>
                    </div>
                    <div class="swiper-slide">
                        <picture>
                            <source srcset="./img/delete/gallery-img-3.webp" type="image/webp">
                            <source srcset="./img/delete/gallery-img-3.jpg" type="image/jpeg">

                            <img src="./img/delete/gallery-img-3.jpg" loading="lazy" alt="">
                        </picture>
                    </div>
                    <div class="swiper-slide">
                        <picture>
                            <source srcset="./img/delete/gallery-img-4.webp" type="image/webp">
                            <source srcset="./img/delete/gallery-img-4.jpg" type="image/jpeg">

                            <img src="./img/delete/gallery-img-4.jpg" loading="lazy" alt="">
                        </picture>
                    </div>
                    <div class="swiper-slide">
                        <picture>
                            <source srcset="./img/delete/gallery-img-4.webp" type="image/webp">
                            <source srcset="./img/delete/gallery-img-4.jpg" type="image/jpeg">

                            <img src="./img/delete/gallery-img-4.jpg" loading="lazy" alt="">
                        </picture>
                    </div>
                    <div class="swiper-slide">
                        <picture>
                            <source srcset="./img/delete/gallery-img-3.webp" type="image/webp">
                            <source srcset="./img/delete/gallery-img-3.jpg" type="image/jpeg">

                            <img src="./img/delete/gallery-img-3.jpg" loading="lazy" alt="">
                        </picture>
                    </div>
                    <div class="swiper-slide">
                        <picture>
                            <source srcset="./img/delete/gallery-img-2.webp" type="image/webp">
                            <source srcset="./img/delete/gallery-img-2.jpg" type="image/jpeg">

                            <img src="./img/delete/gallery-img-2.jpg" loading="lazy" alt="">
                        </picture>
                    </div>
                    <div class="swiper-slide">
                        <picture>
                            <source srcset="./img/delete/gallery-img-1.webp" type="image/webp">
                            <source srcset="./img/delete/gallery-img-1.jpg" type="image/jpeg">

                            <img src="./img/delete/gallery-img-1.jpg" loading="lazy" alt="">
                        </picture>
                    </div>
                    <div class="swiper-slide">
                        <picture>
                            <source srcset="./img/delete/gallery-img-1.webp" type="image/webp">
                            <source srcset="./img/delete/gallery-img-1.jpg" type="image/jpeg">

                            <img src="./img/delete/gallery-img-1.jpg" loading="lazy" alt="">
                        </picture>
                    </div>
                    <div class="swiper-slide">
                        <picture>
                            <source srcset="./img/delete/gallery-img-2.webp" type="image/webp">
                            <source srcset="./img/delete/gallery-img-2.jpg" type="image/jpeg">

                            <img src="./img/delete/gallery-img-2.jpg" loading="lazy" alt="">
                        </picture>
                    </div>
                    <div class="swiper-slide">
                        <picture>
                            <source srcset="./img/delete/gallery-img-3.webp" type="image/webp">
                            <source srcset="./img/delete/gallery-img-3.jpg" type="image/jpeg">

                            <img src="./img/delete/gallery-img-3.jpg" loading="lazy" alt="">
                        </picture>
                    </div>
                    <div class="swiper-slide">
                        <picture>
                            <source srcset="./img/delete/gallery-img-4.webp" type="image/webp">
                            <source srcset="./img/delete/gallery-img-4.jpg" type="image/jpeg">

                            <img src="./img/delete/gallery-img-4.jpg" loading="lazy" alt="">
                        </picture>
                    </div>
                    <div class="swiper-slide">
                        <picture>
                            <source srcset="./img/delete/gallery-img-4.webp" type="image/webp">
                            <source srcset="./img/delete/gallery-img-4.jpg" type="image/jpeg">

                            <img src="./img/delete/gallery-img-4.jpg" loading="lazy" alt="">
                        </picture>
                    </div>
                    <div class="swiper-slide">
                        <picture>
                            <source srcset="./img/delete/gallery-img-3.webp" type="image/webp">
                            <source srcset="./img/delete/gallery-img-3.jpg" type="image/jpeg">

                            <img src="./img/delete/gallery-img-3.jpg" loading="lazy" alt="">
                        </picture>
                    </div>
                    <div class="swiper-slide">
                        <picture>
                            <source srcset="./img/delete/gallery-img-2.webp" type="image/webp">
                            <source srcset="./img/delete/gallery-img-2.jpg" type="image/jpeg">

                            <img src="./img/delete/gallery-img-2.jpg" loading="lazy" alt="">
                        </picture>
                    </div>
                    <div class="swiper-slide">
                        <picture>
                            <source srcset="./img/delete/gallery-img-1.webp" type="image/webp">
                            <source srcset="./img/delete/gallery-img-1.jpg" type="image/jpeg">

                            <img src="./img/delete/gallery-img-1.jpg" loading="lazy" alt="">
                        </picture>
                    </div>
                    <div class="swiper-slide">
                        <picture>
                            <source srcset="./img/delete/gallery-img-1.webp" type="image/webp">
                            <source srcset="./img/delete/gallery-img-1.jpg" type="image/jpeg">

                            <img src="./img/delete/gallery-img-1.jpg" loading="lazy" alt="">
                        </picture>
                    </div>
                    <div class="swiper-slide">
                        <picture>
                            <source srcset="./img/delete/gallery-img-2.webp" type="image/webp">
                            <source srcset="./img/delete/gallery-img-2.jpg" type="image/jpeg">

                            <img src="./img/delete/gallery-img-2.jpg" loading="lazy" alt="">
                        </picture>
                    </div>
                    <div class="swiper-slide">
                        <picture>
                            <source srcset="./img/delete/gallery-img-3.webp" type="image/webp">
                            <source srcset="./img/delete/gallery-img-3.jpg" type="image/jpeg">

                            <img src="./img/delete/gallery-img-3.jpg" loading="lazy" alt="">
                        </picture>
                    </div>
                    <div class="swiper-slide">
                        <picture>
                            <source srcset="./img/delete/gallery-img-4.webp" type="image/webp">
                            <source srcset="./img/delete/gallery-img-4.jpg" type="image/jpeg">

                            <img src="./img/delete/gallery-img-4.jpg" loading="lazy" alt="">
                        </picture>
                    </div>
                    <div class="swiper-slide">
                        <picture>
                            <source srcset="./img/delete/gallery-img-4.webp" type="image/webp">
                            <source srcset="./img/delete/gallery-img-4.jpg" type="image/jpeg">

                            <img src="./img/delete/gallery-img-4.jpg" loading="lazy" alt="">
                        </picture>
                    </div>
                    <div class="swiper-slide">
                        <picture>
                            <source srcset="./img/delete/gallery-img-3.webp" type="image/webp">
                            <source srcset="./img/delete/gallery-img-3.jpg" type="image/jpeg">

                            <img src="./img/delete/gallery-img-3.jpg" loading="lazy" alt="">
                        </picture>
                    </div>
                    <div class="swiper-slide">
                        <picture>
                            <source srcset="./img/delete/gallery-img-2.webp" type="image/webp">
                            <source srcset="./img/delete/gallery-img-2.jpg" type="image/jpeg">

                            <img src="./img/delete/gallery-img-2.jpg" loading="lazy" alt="">
                        </picture>
                    </div>
                    <div class="swiper-slide">
                        <picture>
                            <source srcset="./img/delete/gallery-img-1.webp" type="image/webp">
                            <source srcset="./img/delete/gallery-img-1.jpg" type="image/jpeg">

                            <img src="./img/delete/gallery-img-1.jpg" loading="lazy" alt="">
                        </picture>
                    </div>
                </div>
                <div class="swiper-arrow swiper-button-prev _color-blue btn-prev-zoom"></div>
                <div class="swiper-arrow swiper-button-next _color-blue btn-next-zoom"></div>
                <div class="swiper-pagination swiper-pagination__zoom-gallery _fraction"></div>
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
@endsection
