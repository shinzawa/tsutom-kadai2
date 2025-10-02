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
        </div>
        <div class="product-card__frame">
            <div class="product-card__list">
                @foreach($products as $product)
                <div class="product-card__item">
                    <div class="product-card__image">
                        <image src="{{ asset(  'storage/' . $product->image )}}" width="374px" alt="{{ $product->image}}"></image>
                    </div>
                    <div class="product-card__title">
                        <span class="product-cart__tigle-name"> {{ $product->name}}</span>
                        <span class="product-card__title-price">&yen; {{ $product->price}}</span>
                    </div>
                </div>
                @endforeach

            </div>
            <div class="product-card__links">
                {{ $products->links('vendor.pagination.custom') }}
            </div>
        </div>
    </div>
</div>
@endsection