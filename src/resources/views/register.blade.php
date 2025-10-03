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
                    <image src="{{ asset(  'storage/' . old('image') )}}" width="374px" alt="{{ old('image')}}" id="preview"></image>
                    <div class="product-card__image">
                        <label type="image" src="{{ asset(  'storage/' . old('image') )}}" width="374px" alt="{{ old('image')}}"></label>
                    </div>
                    <label for="image" class="register-form__imagefile">
                        <span class="register-form__imagefile-span">ファイルを選択</span>
                        <input class="register-form__input-file" type="file" name="image" id="image" accept="image/png,image/jpeg" onchange="previewFile(this);" style="display:none">
                    </label>

                    <p class="register-form__error-message">
                        @error('image')
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
                            <input type="hidden" name="seasons" id="0">
                            <input type="checkbox" name="seasons[]" value="1" id="1">
                            <label class="register-form__checkbox-label" for="1">春</label>
                            <input type="checkbox" name="seasons[]" value="2" id="2">
                            <label class="register-form__checkbox-label" for="2">夏</label>
                            <input type="checkbox" name="seasons[]" value="3" id="3">
                            <label class="register-form__checkbox-label" for="3">秋</label>
                            <input type="checkbox" name="seasons[]" value="4" id="4">
                            <label class="register-form__checkbox-label" for="4">冬</label>
                        </div>
                        <p class="register-form__error-message">
                            @error('seasons')
                            {{ $message }}
                            @enderror
                        </p>
                    </div>
                </div>
                <div class="register-form__group-textarea">
                    <label class="register-form__label" for="description">
                        商品説明
                        <span class="register-form__required">必須</span>
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
<script>
    function previewFile(item) {
        var fr = new FileReader();
        fr.onload = (function() {
            document.getElementById('preview').src = fr.result;
        });
        fr.readAsDataURL(item.files[0]);
    }
</script>
@endsection