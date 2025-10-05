@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/product.css') }}" />
@endsection

@section('content')
<div class="product__alert">
    @if(session('message'))
    <div class="product__alert--success">
        {{ session('message') }}
    </div>
    @endif
    @if($errors->any())
    <div class="product__alert--danger">
        <ul>
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
</div>

<div class="product__content">
    <div class="product__title">
        <div class="product-utilities">
            <span>商品一覧</span>
            <nav>
                <ul class="product-nav">
                    <li class="prudoct-nav__item">
                        <form class="form" action="/products/register" method="get" novalidate>
                            @csrf
                            <button class="product-nav__button">＋商品追加</button>
                        </form>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
    <div class="product-main">
        <div class="product-operation">
            <div class="product-operation__input-search">
                <form action="/products/search" method="get" class="search-form" novalidate>
                    @csrf
                    <input class="search-form__name-input" type="text" name="name" value="{{ request('name')}}" placeholder="  商品名で検索">
                    <div class="search-form__actions">
                        <input class="search-form__search-btn" type="submit" value="検索">
                    </div>
            </div>
            </form>
            <div class="input-operation__sort-form">
                <form class="sort-form" action="/products/search" method="get" novalidate>
                    @csrf
                    <p for="" class="search-form__order-title">価格順で表示</p>
                    <div class="sort-form__price-order">
                        <select class="sort-form__order-select" name="order" value="{{ request('order')}}" onchange="handleSelectChange(this)">
                            <option disabled selected value="">価格で並べ替え</option>
                            <option value="desc">高い順に表示</option>
                            <option value="asc">低い順に表示</option>
                        </select>
                    </div>
                    <div class="sort-form__order-tag">
                        <svg id="ordertag" version="1.2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 130 41" width="130" height="41">
                            <defs>
                                <image width="130" height="41" id="img1" href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAIIAAAApAQMAAADDFmOTAAAAAXNSR0IB2cksfwAAAANQTFRF////p8QbyAAAABNJREFUeJxjZEAHjKMioyLDSAQAP2wAKiqClA8AAAAASUVORK5CYII=" />
                            </defs>
                            <style>
                                .a {
                                    fill: none;
                                    stroke: #f5c800
                                }

                                .b {
                                    fill: #4b4b4b
                                }
                            </style>
                            <use href="#img1" x="0" y="0" />
                            <path fill-rule="evenodd" class="a" d="m113 14c4.1 0 7.5 3.4 7.5 7.5 0 4.1-3.4 7.5-7.5 7.5-4.1 0-7.5-3.4-7.5-7.5 0-4.1 3.4-7.5 7.5-7.5z" />
                            <path class="b" d="m17.4 16.5v-0.3c0-0.3 0-0.6-0.1-0.9h1.1c0 0.3-0.1 0.5-0.1 0.9v0.3h4.4c0.6 0 0.9 0 1.4-0.1v0.9c-0.5 0-0.8 0-1.4 0h-9.4c-0.6 0-1 0-1.4 0v-0.9c0.4 0.1 0.8 0.1 1.4 0.1zm-3.2 3.4v-0.7c0-0.5 0-0.8-0.1-1.1 0.4 0.1 0.8 0.1 1.4 0.1h5.2c0.5 0 0.8 0 1.1-0.1 0 0.4 0 0.6 0 1.1v0.7c0 0.7 0 0.8 0 1.1-0.4 0-0.6 0-1.2 0h-5.2c-0.5 0-0.8 0-1.3 0 0.1-0.3 0.1-0.5 0.1-1.1zm0.8-1v1.4h6v-1.4zm-2.8 7.8v-3.6c0-0.5 0-0.8 0-1.3 0.4 0.1 0.8 0.1 1.4 0.1h8.6c0.7 0 1 0 1.4-0.1 0 0.5-0.1 0.8-0.1 1.3v3.7c0 0.5 0 0.7-0.3 0.9-0.2 0.1-0.4 0.2-1.2 0.2-0.3 0-0.4 0-1.3-0.1 0-0.4 0-0.5-0.2-0.9q0.9 0.2 1.6 0.2c0.5 0 0.6-0.1 0.6-0.4v-4.1h-9.6v4.1c0 0.6 0 0.9 0.1 1.4h-1q0-0.6 0-1.4zm8.5-2.2v0.9c0 0.5 0 0.7 0 1q-0.5-0.1-1.3-0.1h-3.5v0.8h-0.9c0-0.3 0-0.7 0-1.2v-1.4c0-0.4 0-0.7 0-1 0.3 0 0.6 0.1 1.1 0.1h3.4c0.5 0 0.8-0.1 1.2-0.1 0 0.3 0 0.5 0 1zm-4.9-0.2v1.3h4.1v-1.3zm10.9-7.2h1.2c-0.1 0.4-0.1 0.9-0.1 1.7 0 1.5 0.1 3.4 0.3 4.3 0.4 1.4 0.9 2.4 1.5 2.4q0.3 0 0.7-0.7c0.3-0.7 0.5-1.4 0.7-2.4 0.3 0.4 0.4 0.5 0.8 0.8-0.7 2.5-1.3 3.4-2.3 3.4-0.8 0-1.5-0.8-2-2.1-0.5-1.4-0.7-3.2-0.8-6.6 0-0.5 0-0.6 0-0.8zm7.1 1.2l0.8-0.5c0.9 1.1 1.5 2 2 3.2 0.6 1.2 0.8 2.2 1.1 3.8l-1 0.4c-0.3-2.6-1.3-5-2.9-6.9zm14.4-1.6h-1.7c-0.7 0-1 0-1.3 0v-0.9c0.2 0.1 0.6 0.1 1.3 0.1h4.3c0.6 0 1-0.1 1.3-0.1v1c-0.3-0.1-0.7-0.1-1.3-0.1h-1.8c-0.1 0.5-0.3 1.1-0.5 1.5h1.7c0.7 0 1-0.1 1.3-0.1 0 0.4 0 0.7 0 1.3v4.5c0 0.6 0 0.9 0 1.3-0.4 0-0.7 0-1.2 0h-3.4c-0.5 0-0.9 0-1.2 0 0-0.3 0-0.7 0-1.3v-4.5c0-0.5 0-0.9 0-1.3 0.3 0 0.6 0.1 1.2 0.1h0.7q0.4-0.8 0.6-1.5zm-1.7 2.2v1.3h4.1v-1.3zm0 2v1.4h4.1v-1.4zm0 2.1v1.4h4.1v-1.4zm-6.4-7.4h0.9c0 0.4 0 0.7 0 1.4v3.5c0 3.5-0.3 5.5-1.1 7.1-0.4-0.4-0.4-0.5-0.8-0.7 0.5-0.7 0.7-1.4 0.8-2.3 0.2-1.1 0.3-2.6 0.3-4.1v-3.5c0-0.7-0.1-1-0.1-1.4zm1.9 0.4h0.9c-0.1 0.4-0.1 0.6-0.1 1.5v7c0 0.7 0 1 0.1 1.4h-1c0.1-0.4 0.1-0.8 0.1-1.4v-7c0-0.8 0-1.1 0-1.5zm1.8-0.4h0.9c0 0.4-0.1 0.7-0.1 1.7v8.6c0 1 0.1 1.3 0.1 1.7h-0.9c0-0.4 0-0.7 0-1.7v-8.6c0-1 0-1.3 0-1.7zm5.3 10.3l0.7-0.5c0.8 0.9 1.4 1.3 2.7 1.8q-0.3 0.3-0.6 0.8c-1.2-0.7-1.9-1.1-2.8-2.1zm-2-0.5l0.8 0.5c-0.8 1-1.4 1.5-2.6 2.1-0.2-0.3-0.4-0.5-0.6-0.7 1.1-0.5 1.7-1 2.4-1.9zm8.4-9.3l1.1 0.1c-0.2 0.7-0.4 1.3-0.6 2.3-0.3 1.5-0.4 2.7-0.4 4.4 0 1.1 0 1.9 0.1 2.6 0.2-0.9 0.5-1.7 0.9-2.7l0.7 0.3c-0.6 1.4-1.1 3.1-1.1 3.9q0 0 0 0.2l-1.1 0.1c0-0.3 0-0.3 0-0.6-0.3-1.5-0.4-2.5-0.4-4 0-1.9 0.2-3.4 0.6-5.5 0.2-0.7 0.2-0.8 0.2-1.1zm2.9 2.6v-1c0.6 0.2 1.3 0.2 2.4 0.2q2.3 0 3.8-0.3v1q0 0-0.9 0.1c-0.9 0.1-2 0.2-3.1 0.2-0.7 0-1.3-0.1-2.2-0.2zm1 2.8l0.8 0.4q-1.1 1.1-1.1 2 0 1.6 2.7 1.6c1.3 0 2.5-0.2 3.3-0.5l0.1 1.1c-0.2 0-0.2 0-0.5 0q-1.5 0.3-2.9 0.3c-1.6 0-2.6-0.3-3.2-1.1q-0.4-0.5-0.4-1.2c0-0.9 0.4-1.7 1.2-2.6zm11.9 5.2v-2.8c-1.1 0.8-1.8 1.2-3.3 1.8-0.1-0.2-0.3-0.4-0.6-0.8q3.2-1 5.1-3h-3.4q-0.9 0-1.5 0.1v-1c0.3 0.1 0.7 0.1 1.5 0.1h4.2v-1.3h-2.9c-0.8 0-1.2 0-1.5 0v-0.9c0.4 0.1 0.7 0.1 1.5 0.1h2.9v-1.3h-3.7c-0.7 0-1.1 0-1.5 0v-0.9c0.4 0.1 0.9 0.1 1.6 0.1h3.6v-0.3c0-0.6-0.1-0.9-0.1-1.2h1c-0.1 0.3-0.1 0.6-0.1 1.2v0.3h3.9c0.7 0 1.1 0 1.5-0.1v0.9c-0.4 0-0.8 0-1.5 0h-3.9v1.3h3.1c0.8 0 1.2 0 1.5-0.1v0.9c-0.3 0-0.6 0-1.5 0h-3.1v1.3h4.4c0.7 0 1.2 0 1.5-0.1v1q-0.6-0.1-1.5-0.1h-3.9c0.5 1 0.8 1.5 1.4 2.3q1.4-1.1 2.1-2l0.8 0.6c-0.1 0-0.1 0-0.3 0.2q-0.8 0.9-2 1.8c1 0.9 2.1 1.5 3.7 2.1-0.3 0.3-0.4 0.6-0.6 0.9-3.1-1.4-4.8-3.1-6-5.9h-0.1c-0.6 0.6-0.7 0.7-1.4 1.3v3.3c1.1-0.3 1.7-0.4 3.2-0.9v0.9c-1.9 0.5-3.2 0.8-5.2 1.2-0.3 0.1-0.5 0.2-0.7 0.2l-0.2-1c0.6 0 1.2-0.1 2-0.2zm16.2-6.4h-4.2c-0.6 0-1 0.1-1.5 0.1v-1c0.4 0 0.9 0.1 1.5 0.1h9.1c0.6 0 1-0.1 1.4-0.1v1c-0.4 0-0.8-0.1-1.4-0.1h-4v6.3c0 0.9-0.3 1.1-1.5 1.1-0.6 0-1.3 0-1.9-0.1 0-0.4-0.1-0.6-0.2-0.9 0.8 0.1 1.4 0.1 2 0.1 0.6 0 0.7 0 0.7-0.3zm4.9-4.1v1c-0.4-0.1-0.9-0.1-1.4-0.1h-6.4q-0.8 0-1.5 0.1v-1c0.4 0 0.9 0 1.5 0h6.4c0.6 0 1 0 1.4 0zm-7.9 5.3l0.9 0.4c-0.7 2-1.7 3.6-3 4.8-0.3-0.3-0.4-0.4-0.8-0.6 1.3-1.1 2.4-2.8 2.9-4.6zm5.9 0.4l0.8-0.4c0.7 1.5 1.1 2.3 1.9 3.2 0.4 0.5 0.6 0.8 1.1 1.2-0.3 0.2-0.5 0.4-0.8 0.7-1.3-1.5-2-2.6-3-4.7z" />
                            <path fill-rule="evenodd" class="a" d="m21.5 1.5h89c11 0 20 9 20 20 0 11-9 20-20 20h-89c-11 0-20-9-20-20 0-11 9-20 20-20z" />
                        </svg>

                        </svg>
                    </div>
                </form>
            </div>
        </div>
        <div class="product-card__frame">
            <div class="product-card__list">
                @foreach($products as $product)
                <form action="/products/{{ $product->id}}" method="get" class="product-card" novalidate>
                    @csrf
                    <div class="product-card__item">
                        <div class="product-card__image">
                            <input type="image" src="{{ asset(  'storage/' . $product->image )}}" width="374px" height="340px" style="object-fit: cover;" alt="{{ $product->image}}"></input>
                        </div>
                        <div class="product-card__title">
                            <span class="product-cart__tigle-name"> {{ $product->name}}</span>
                            <span class="product-card__title-price">&yen; {{ $product->price}}</span>
                        </div>
                    </div>
                </form>
                @endforeach

            </div>
            <div class="product-card__links">
                {{ $products->appends(request()->query())->links('vendor.pagination.custom') }}
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('/js/product.js') }}"></script>
@endsection