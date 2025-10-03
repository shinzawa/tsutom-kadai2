@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/update.css') }}" />
@endsection

@section('content')
<div class="update__main">
    <div class="update__content">
        <form action="/products/{{ $product->id}}/update" method="post" class="update-form" novalidate>
            @method('PATCH')
            @csrf
            <div class="update-form__main">
                <div class="update-form__upper">
                    <div class="update-form__left">
                        <div class="update-form__group update-form__image">
                            <label class="update-form__label" for="price">
                                商品画像<span class="update-form__required">必須</span>
                            </label>
                            <image src="{{ asset(  'storage/' . old('image',isset($product) ? $product->image : '') )}}" width="374px" alt="{{ old('image', isset($product) ? $product->image : '')}}" id="preview"></image>
                            <input class="update-form__input-file" type="file" name="image" id="image" accept="image/png,image/jpeg" onchange="previewFile(this);"></input>
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
                                    <input type="checkbox" name="seasons[]" value="1" {{ in_array('1', $sa) ? 'checked' :'' }} id="1">
                                    <label class="update-form__checkbox-label" for="1">春</label>
                                    <input type="checkbox" name="seasons[]" value="2" {{in_array('2', $sa) ? 'checked' :'' }}id="2">
                                    <label class="update-form__checkbox-label" for="2">夏</label>
                                    <input type="checkbox" name="seasons[]" value="3" {{in_array('3', $sa) ? 'checked' :'' }} id="3">
                                    <label class="update-form__checkbox-label" for="3">秋</label>
                                    <input type="checkbox" name="seasons[]" value="4" {{in_array('4', $sa) ? 'checked' :'' }} id="4">
                                    <label class="update-form__checkbox-label" for="4">冬</label>
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
                        <input class="update-form__back-btn btn" type="submit" value="戻る" name="back">
                        <input class="update-form__store-btn" type="submit" value="登録" name="store">
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