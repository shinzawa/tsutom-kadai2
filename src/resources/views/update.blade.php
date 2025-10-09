@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/update.css') }}" />
@endsection

@section('content')
<div class="update__main">
    <div class="update__content">
        <form id="ProductForm" action="/products/{{ $product->id}}/update" method="post" enctype="multipart/form-data" class="update-form" novalidate>
            <!-- @method('PATCH') -->
            @csrf
            <div class="update-form__main">
                <div class="update-form__upper">
                    <div class="update-form__left">
                        <div class="update-form__group update-form__image">
                            <label class="update-form__label" for="price">
                                商品画像<span class="update-form__required">必須</span>
                            </label>
                            <image src="{{ asset(  'storage/' . old('image',isset($product) ? $product->image : '') )}}" width="374px" height="281px" style="object-fit:cover;" alt="{{ old('image', isset($product) ? $product->image : '')}}" id="preview"></image>
                            <label for="image" class="update-form__imagefile">
                                <span class="update-form__imagefile-span">ファイルを選択</span>
                                <span id="fileNameDisplay">{{ old('image',isset($product) ? $product->image : '')}}</span>
                                <input class="update-form__input-file" type="file" name="image" id="image" accept="image/png,image/jpeg" onchange="previewFile(this);" style="display:none">
                            </label>
                            <!-- <input class="update-form__input-file" type="file" name="image" id="imageInput" accept="image/png,image/jpeg" onchange="previewFile(this);"></input> -->
                            <p class="update-form__error-message">
                                @error('image')
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
                                    value="{{ old('name', isset($product) ? $product['name'] : '') }}" placeholder="商品名を入力">
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
                            <input class="update-form__input" type="text" name="price" id="price" value="{{ old('price', isset($product) ? $product['price'] : '') }}"
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
                                    <!-- <input type="hidden" name="seasons" id="0"> -->
                                    @php
                                    foreach($seasons as $season) {$sa[]=$season->id;}
                                    @endphp
                                    @if (old('seasons')=='')
                                    <input type="checkbox" name="seasons[]" value="1" {{ in_array('1', $sa) ? 'checked' :'' }} id="1">
                                    <label class="update-form__checkbox-label" for="1">春</label>
                                    <input type="checkbox" name="seasons[]" value="2" {{ in_array('2', $sa) ? 'checked' :'' }} id="2">
                                    <label class="update-form__checkbox-label" for="2">夏</label>
                                    <input type="checkbox" name="seasons[]" value="3" {{ in_array('3', $sa) ? 'checked' :'' }} id="3">
                                    <label class="update-form__checkbox-label" for="3">秋</label>
                                    <input type="checkbox" name="seasons[]" value="4" {{ in_array('4', $sa) ? 'checked' :'' }} id="4">
                                    <label class="update-form__checkbox-label" for="4">冬</label>
                                    @else
                                    <input type="checkbox" name="seasons[]" value="1" {{ in_array('1', old('seasons')) ? 'checked' :'' }} id="1">
                                    <label class="update-form__checkbox-label" for="1">春</label>
                                    <input type="checkbox" name="seasons[]" value="2" {{ in_array('2', old('seasons')) ? 'checked' :'' }} id="2">
                                    <label class="update-form__checkbox-label" for="2">夏</label>
                                    <input type="checkbox" name="seasons[]" value="3" {{ in_array('3', old('seasons')) ? 'checked' :'' }} id="3">
                                    <label class="update-form__checkbox-label" for="3">秋</label>
                                    <input type="checkbox" name="seasons[]" value="4" {{ in_array('4', old('seasons')) ? 'checked' :'' }} id="4">
                                    <label class="update-form__checkbox-label" for="4">冬</label>
                                    @endif
                                </div>
                                <p class="update-form__error-message">
                                    @error('seasons')
                                    {{ $message }}
                                    @enderror
                                </p>
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
                            placeholder="商品説明を入力">{{ old('descrption', isset($product) ? $product['description']:'') }}</textarea>
                        <p class="update-form__error-message">
                            @error('description')
                            {{ $message }}
                            @enderror
                        </p>
                    </div>
                </div>
                <div class="update-form__btn">
                    <div class="update-form__btn-inner">
                        <input class="update-form__back-btn btn" type="submit" onclick="submitForm('/products','get')" value="戻る" name="back">
                        <input class="update-form__store-btn" type="submit" onclick="submitForm('/products/{{ $product->id}}/update','post')" value="登録" name="store">

                        <svg version="1.2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 21 23" width="21" height="23" class="update-form__delete-btn" onclick="submitForm('/products/{{ $product->id }}/delete','post')">
                            <defs>
                                <image width="21" height="23" id="img1" href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABUAAAAXAQMAAADeEZbeAAAAAXNSR0IB2cksfwAAAANQTFRF////p8QbyAAAAA9JREFUeJxjZGBgYKQRBgAErAAYCKmlPwAAAABJRU5ErkJggg==" />
                            </defs>
                            <style>
                                .a {
                                    fill: #fd0707
                                }
                            </style>
                            <use href="#img1" x="0" y="0" />
                            <path class="a" d="m19 4.3h-1.3v-1.3c0-1.5-1.2-2.7-2.7-2.7h-9.3c-1.5 0-2.7 1.2-2.7 2.7v1.3h-1.3c-0.8 0-1.4 0.6-1.4 1.4 0 0.7 0.6 1.3 1.4 1.3v10.7c0 2.9 2.4 5.3 5.3 5.3h6.7c2.9 0 5.3-2.4 5.3-5.3v-10.7c0.7 0 1.3-0.6 1.3-1.3 0-0.8-0.6-1.4-1.3-1.4zm-13.3-1.3h9.3v1.3h-9.3zm10.6 14.7c0 1.5-1.2 2.7-2.6 2.7h-6.7c-1.5 0-2.7-1.2-2.7-2.7v-10.7h12zm-10-8.6c-0.3 0-0.6 0.3-0.6 0.6v8c0 0.4 0.3 0.7 0.6 0.7 0.4 0 0.7-0.3 0.7-0.7v-8c0-0.3-0.3-0.6-0.7-0.6zm2.7 0c-0.4 0-0.7 0.3-0.7 0.6v8c0 0.4 0.3 0.7 0.7 0.7 0.4 0 0.7-0.3 0.7-0.7v-8c0-0.3-0.3-0.6-0.7-0.6zm2.7 0c-0.4 0-0.7 0.3-0.7 0.6v8c0 0.4 0.3 0.7 0.7 0.7 0.3 0 0.6-0.3 0.6-0.7v-8c0-0.3-0.3-0.6-0.6-0.6zm2.6 0c-0.3 0-0.6 0.3-0.6 0.6v8c0 0.4 0.3 0.7 0.6 0.7 0.4 0 0.7-0.3 0.7-0.7v-8c0-0.3-0.3-0.6-0.7-0.6z" />
                        </svg>
                    </div>
                </div>

            </div>
        </form>

    </div>
</div>
<script src="{{ asset('/js/main.js') }}"></script>
@endsection