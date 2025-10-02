@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/update.css') }}" />
@endsection

@section('content')
<div class="update__main">
    <div class="update__content">
        <form action="/products/update" method="post" class="update-form" novalidate>
            @csrf
            <div class="update-form__main">
                <div class="update-form__upper">
                    <div class="update-form__left">
                        <div class="update-form__group update-form__image">
                            <label class="update-form__label" for="price">
                                商品画像<span class="update-form__required">必須</span>
                            </label>
                            <image src="{{ asset(  'storage/' . $product->image )}}" width="374px" alt="{{ $product->image}}"></image>
                            <input class="update-form__input-file" type="file" name="image" id="image" accept="image/png,image/jpeg" value="{{ $product['image'] }}">{{ $product['image'] }}</input>
                            <p class="update-form__error-message">
                                @error('imagefile')
                                {{ $message }}
                                @enderror
                            </p>
                        </div>
                    </div>
                    <div class="update-form__right">
                        <div class="update-form__group">
                            <label class="update-form__label" for="name">
                                商品名<span class="update-form__required">必須</span>
                            </label>
                            <div class="update-form__name-input">
                                <input class="update-form__input update-form__name-input" type="text" name="name" id="name"
                                    value="{{ $product['name'] }}" placeholder="商品名を入力">
                            </div>
                            <div class="update-form__error-message">
                                @error('name')
                                {{ $message }}
                                @enderror
                            </div>
                        </div>
                        <div class="update-form__group">
                            <label class="update-form__label" for="price">
                                値段<span class="update-form__required">必須</span>
                            </label>
                            <input class="update-form__input" type="text" name="price" id="price" value="{{ $product['price'] }}"
                                placeholder="値段を入力">
                            <p class="update-form__error-message">
                                @error('price')
                                {{ $message }}
                                @enderror
                            </p>
                        </div>
                        <div class="update-form__group">
                            <div class="update-form__seasons">
                                <label class="update-form__label" for="seasons">
                                    季節
                                    <span class="update-form__required">必須</span>
                                    <span class="update-form__many">複数選択可</span>
                                </label>
                                <div class="update-form__checkbox">
                                    <input type="checkbox" name="seasons" value="spring" id="1">
                                    <label class="update-form__checkbox-label" for="1">春</label>
                                    <input type="checkbox" name="seasons" value="spring" id="2">
                                    <label class="update-form__checkbox-label" for="2">夏</label>
                                    <input type="checkbox" name="seasons" value="spring" id="3">
                                    <label class="update-form__checkbox-label" for="3">秋</label>
                                    <input type="checkbox" name="seasons" value="spring" id="4">
                                    <label class="update-form__checkbox-label" for="4">冬</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="update-form__lower">
                    <div class="update-form__group-textarea">
                        <label class="update-form__label" for="description">
                            商品説明
                        </label>
                        <textarea class="update-form__textarea" name="description" id="" cols="30" rows="10"
                            placeholder="商品説明を入力">{{ $product['description'] }}</textarea>
                        <p class="update-form__error-message">
                            @error('description')
                            {{ $message }}
                            @enderror
                        </p>
                    </div>
                </div>
                <div class="update-form__btn">
                    <div class="update-form__btn-inner">
                        <input class="update-form__back-btn btn" type="submit" value="戻る" name="back">
                        <input class="update-form__store-btn" type="submit" value="登録" name="store">
                    </div>
                </div>

            </div>
        </form>

    </div>
</div>
@endsection