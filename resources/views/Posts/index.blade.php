@extends('layout-client.layouts')
@section('style_css')
@endsection
@section('content')
    <div id="main-content-wp" class="clearfix blog-page">
        <div class="wp-inner">
            <div class="secion" id="breadcrumb-wp">
                <div class="secion-detail">
                    <ul class="list-item clearfix">
                        <li>
                            <a href="{{ route('homes') }}" title="">Trang chủ</a>
                        </li>
                        <li>
                            <a href="" title="">Blog</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="main-content fl-right">
                <div class="section" id="list-blog-wp">
                    <div class="section-head clearfix">
                        <h3 class="section-title">Blog</h3>
                    </div>
                    <div class="section-detail">
                        <ul class="list-item">
                            @foreach ($posts as $post)
                                <li class="clearfix">
                                    <a href="{{ route('detailBlog', $post->slug) }}" title="" class="thumb fl-left">
                                        <img src="{{ url($post->images) }}" alt="">
                                    </a>
                                    <div class="info fl-right">
                                        <a href="{{ route('detailBlog', $post->slug) }}" title=""
                                            class="title">{{ $post->title }}</a>
                                        <span class="create-date">{{ $post->created_at }}</span>
                                        <p class="desc"> {{ $post->desc }}
                                        </p>
                                    </div>
                                </li>
                            @endforeach


                        </ul>
                    </div>
                </div>
                <div class="section" id="paging-wp">
                    <div class="section-detail">
                        <ul class="list-item clearfix">
                            {{ $posts->appends(request()->all())->links() }}

                        </ul>
                    </div>
                </div>
            </div>
            <div class="sidebar fl-left">
                <div class="section" id="selling-wp">
                    <div class="section-head">
                        <h3 class="section-title">Sản phẩm bán chạy</h3>
                    </div>
                    <div class="section-detail">
                        <ul class="list-item">

                            @foreach ($bestSellingProducts as $item)
                                <li class="clearfix">
                                    <a href="{{ route('productDetail', $item['slug']) }}" title=""
                                        class="thumb fl-left">
                                        <img src="{{ url($item['images']) }}" alt="">
                                    </a>
                                    <div class="info fl-right">
                                        <a href="{{ route('productDetail', $item['slug']) }}" title=""
                                            class="product-name">{{ $item['name'] }}</a>
                                        <div class="price">
                                            <span class="new">{{ number_format($item['price'], 0, '', '.') }} đ</span>
                                            <span class="old">17.190.000đ</span>
                                        </div>
                                        <a href="{{ route('buyNow', $item['product_id']) }}" title=""
                                            class="buy-now">Mua ngay</a>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="section" id="banner-wp">
                    <div class="section-detail">
                        <a href="?page=detail_blog_product" title="" class="thumb">
                            <img src="{{ asset('/client/public/images/banner.png') }}" alt="">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
