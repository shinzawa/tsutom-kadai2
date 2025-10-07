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
                    <input type="hidden" name="order" value="{{ request('order')}}">
                    <input class="search-form__name-input" type="text" name="search_name" value="{{ request('search_name')}}" placeholder="  商品名で検索">
                    <div class="search-form__actions" onclick="document.getElementById('submit_button').click();">
                        <input class="search-form__search-btn" id="submit_button" type="submit" value="検索"></input>
                    </div>
                </form>
            </div>
            <div class="input-operation__sort-form">
            <form class="sort-form" action="/products/search" method="get" novalidate>
                @csrf
                <p class="search-form__order-title">価格順で表示</p>
                <div class="sort-form__price-order">
                    <input type="hidden" name="search_name" value="{{ request('search_name')}}">
                    <div class="sort-form__order-select-inner">
                        <select id="sortSelected" class="sort-form__order-select" name="order" onchange="handleSelectChange(this)">
                            <option disable  selected  value="">価格で並べ替え</option>
                            <option  value="desc">高い順に表示</option>
                            <option  value="asc">低い順に表示</option>
                        </select>
                    </div>
                </div>
                <div id="sort-order-tag-desc" class="sort-form__order-tag" @if ($orderP=='desc') style="display: block;" @else style="display:none;" @endif>
                    高い順に表示
                    <a href="/products">
                        <div class="sort-form__order-tag-reset">
                            <span>×</span>
                        </div>
                    </a>
                </div>
                <div id="sort-order-tag-asc" class="sort-form__order-tag" @if ($orderP=='asc') style="display: block" @else style="display:none;" @endif>
                    低い順に表示
                    <a href="/products">
                        <div class="sort-form__order-tag-reset">
                            <span>×</span>
                        </div>
                    </a>
                </div>
            </form>
            </div>
        </div>
        <div class="product-card__frame">
            <div class="product-card__list">
                @foreach($products as $product)
                <a href="/products/{{ $product->id}}" class="product-card" novalidate>
                    <div class="product-card__item">
                        <div class="product-card__image">
                            <input type="image" src="{{ asset(  'storage/' . $product->image )}}" width="374px" height="340px" style="object-fit: cover;" alt="{{ $product->image}}"></input>
                        </div>
                        <div class="product-card__title">
                            <span class="product-cart__tigle-name"> {{ $product->name}}</span>
                            <span class="product-card__title-price">&yen; {{ $product->price}}</span>
                        </div>
                    </div>
                </a>
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