@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row bg-light text-dark py-5">
        <div class="col-md-8 offset-md-2">
            <h2 class="fs-1 mb-5 text-center fw-bold">お問い合わせ完了</h2>

            @if (session('success-message'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success-message') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <p>お問い合わせありがとうございます。メッセージは正常に送信されました。</p>
        </div>
    </div>
</div>
@endsection
