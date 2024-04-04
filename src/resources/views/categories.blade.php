@extends('layouts.common')

@section('css')
<link rel="stylesheet" href="{{ asset('css/category.css') }}">
@endsection

@section('content')
<div class="category__alert">
    @if(session('message'))
    <div class="category__alert--success">
        {{ session('message')}}
    </div>
    @endif
</div>

@if(count($errors)>0)
<div class="category__alert--danger">
    <ul>
        @foreach ($errors -> all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<div class="category__content">
    <form class="create-form" action="/category" method="post">
        @csrf
        <div class="create-form__item">
            <input class="create-form__item-input" type="text" name="name">
        </div>
        <div class="create-form__button">
            <button class="create-form__button-submit" type="submit">作成</button>
        </div>
    </form>

    <div class="category-table">
        <table class="category-table__inner">
            <tr class="category-table__row">
                <th class="category-table__header">
                    <p>category</p>
                </th>
            </tr>
            @foreach ($categories as $category)
            <tr class="category-table__row">
                <td class="category-table__item">
                    <form class="update-form" action="/category/{category_id}" method="post">
                        @csrf
                        @method('PATCH')
                        <div class="update-form__item">
                            <input class="update-form__item-input" name="name" type="text" value="{{ $category['name'] }}">
                            {{-- ここでhidden属性を指定してコントローラにidを渡す --}}
                            <input type="hidden" name="id" value="{{ $category['id'] }}">
                        </div>
                        <div class="update-form__button">
                            <button class="update-form__button-submit" type="submit">更新</button>
                        </div>
                    </form>
                </td>

                <td class="category-table__item">
                    <form class="delete-form" action="/category/{category_id}" method="post">
                        @csrf
                        @method('DELETE')
                        <div class="delete-form__button">
                            {{-- ここでhidden属性を指定してコントローラにidを渡す --}}
                            <input type="hidden" name="id" value="{{ $category['id'] }}">
                            <button class="delete-form__button-submit" type="submit">削除</button>
                        </div>
                    </form>
                </td>
            </tr>
            @endforeach
        </table>
    </div>
</div>
@endsection