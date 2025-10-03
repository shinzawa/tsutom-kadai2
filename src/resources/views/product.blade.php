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
                            <button class="product-nav__button">＋商品追加</button>
                        </form>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
    <div class="product-main">
        <div class="product-oparation">
            <form action="/products/search" method="pos" class="search-form"></form>
                @csrf
                <input class="search-form__name-input" type="text" name="name" placeholder="商品名で検索">
                <div class="search-form__actions">
                    <input class="search-form__search-btn btn" type="submit" value="検索">
                </div>
            </form>
            <form class="sort-form" action="/products/sort" method="get">
                <p for="" class="search-form__price-order-title">価格順で表示</p>
                <div class="sort-form__price-order">
                    <select class="sort-form__price-order-select" name="price-order">
                        <option value="1">高い順に表示</option>
                        <option value="2">低い順に表示</option>
                    </select>
                </div>
            </form>
        </div>
        <div class="product-card__frame">
            <div class="product-card__list">
                @foreach($products as $product)
                <form action="/products/{{ $product->id}}" class="product-card">
                    <div class="product-card__item">
                        <div class="product-card__image">
                            <input type="image" src="{{ asset(  'storage/' . $product->image )}}" width="374px" alt="{{ $product->image}}"></input>
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
                {{ $products->links('vendor.pagination.custom') }}
            </div>
        </div>
    </div>
</div>
@endsection