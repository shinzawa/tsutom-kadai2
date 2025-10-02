@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/register.css') }}" />
@endsection

@section('content')
<div class="register__main">
    <div class="register__content">
        <div class="register-head">
            商品登録
        </div>
        <form class="regiser-form" action="/products/register" method="post">
            @csrf
            <div class="register-form__main">
                <div class="register-form__group">
                    <label class="register-form__label" for="name">
                        商品名<span class="register-form__required">必須</span>
                    </label>
                    <div class="register-form__name-input">
                        <input class="register-form__input register-form__name-input" type="text" name="name" id="name"
                            value="{{ old('name') }}" placeholder="商品名を入力">
                    </div>
                    <div class="register-form__error-message">
                        @error('name')
                        {{ $message }}
                        @enderror
                    </div>
                </div>
                <div class="register-form__group">
                    <label class="register-form__label" for="price">
                        値段<span class="register-form__required">必須</span>
                    </label>
                    <input class="register-form__input" type="text" name="price" id="price" value="{{ old('price') }}"
                        placeholder="値段を入力">
                    <p class="register-form__error-message">
                        @error('price')
                        {{ $message }}
                        @enderror
                    </p>
                </div>

                <div class="register-form__group register-form__image">
                    <label class="register-form__label" for="price">
                        商品画像<span class="register-form__required">必須</span>
                    </label>
                    <label for="imagefile" class="register-form__imagefile">
                        <span class="register-form__imagefile-span">ファイルを選択</span>
                        <input class="register-form__input-file" type="file" name="imagefile" id="imagefile" accept="image/png,image/jpeg" style="display:none">
                    </label>

                    <p class="register-form__error-message">
                        @error('imagefile')
                        {{ $message }}
                        @enderror
                    </p>
                </div>
                <div class="register-form__group">
                    <div class="register-form__seasons">
                        <label class="register-form__label" for="seasons">
                            季節
                            <span class="register-form__required">必須</span>
                            <span class="register-form__many">複数選択可</span>
                        </label>
                        <div class="register-form__checkbox">
                            <input type="checkbox" name="seasons" value="spring" id="1">
                            <label class="register-form__checkbox-label" for="1">春</label>
                            <input type="checkbox" name="seasons" value="spring" id="2">
                            <label class="register-form__checkbox-label" for="2">夏</label>
                            <input type="checkbox" name="seasons" value="spring" id="3">
                            <label class="register-form__checkbox-label" for="3">秋</label>
                            <input type="checkbox" name="seasons" value="spring" id="4">
                            <label class="register-form__checkbox-label" for="4">冬</label>
                        </div>
                    </div>
                </div>
                <div class="register-form__group">
                    <div class="register-form__seasons">
                        <label class="register-form__label" for="seasons">
                            季節
                            <span class="register-form__required">必須</span>
                            <span class="register-form__many">複数選択可</span>
                        </label>
                        <div class="register-form__checkbox">
                            <input type="checkbox" name="seasons" value="spring" id="1">
                            <label class="register-form__checkbox-label" for="1">春</label>
                            <input type="checkbox" name="seasons" value="spring" id="2">
                            <label class="register-form__checkbox-label" for="2">夏</label>
                            <input type="checkbox" name="seasons" value="spring" id="3">
                            <label class="register-form__checkbox-label" for="3">秋</label>
                            <input type="checkbox" name="seasons" value="spring" id="4">
                            <label class="register-form__checkbox-label" for="4">冬</label>
                        </div>
                    </div>
                </div>

                <div class="register-form__group-textarea">
                    <label class="register-form__label" for="description">
                        商品説明
                    </label>
                    <textarea class="register-form__textarea" name="description" id="" cols="30" rows="10"
                        placeholder="商品説明を入力">{{ old('description') }}</textarea>
                    <p class="register-form__error-message">
                        @error('description')
                        {{ $message }}
                        @enderror
                    </p>
                </div>
                <div class="register-form__btn">
                    <div class="register-form__btn-inner">
                        <input class="register-form__back-btn btn" type="submit" value="戻る" name="back">
                        <input class="register-form__store-btn" type="submit" value="登録" name="store">
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection