@extends('layout-client.layouts')
@section('style_css')
@endsection
@section('content')
    <div id="main-content-wp" class="clearfix detail-blog-page">
        <div class="wp-inner">
            <div class="secion" id="breadcrumb-wp">
                <div class="secion-detail">
                    <ul class="list-item clearfix">
                        <li>
                            <a href="{{ route('homes') }}" title="">Trang chủ</a>
                        </li>
                        <li>
                            <a href="" title="">Giới thiệu</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="main-content fl-right">

                @foreach ($pages as $item)
                    <div class="section" id="detail-blog-wp">
                        <div class="section-head clearfix">
                            <h3 class="section-title">{{ $item->title }}</h3>
                        </div>
                        <div class="section-detail">
                            <span class="create-date">{{ $item->created_at }}</span>
                            <div class="detail">
                                <p>{!! $item->content  !!}</p>
                            </div>
                        </div>
                    </div>
                @endforeach

                {{-- <div class="section" id="social-wp">
                        <div class="section-detail">
                            <div class="fb-like" data-href="" data-layout="button_count" data-action="like"
                                data-size="small" data-show-faces="true" data-share="true"></div>
                            <div class="g-plusone-wp">
                                <div class="g-plusone" data-size="medium"></div>
                            </div>
                            <div class="fb-comments" id="fb-comment" data-href="" data-numposts="5"></div>
                        </div>
                    </div> --}}

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
                        <a href="?page=detail_product" title="" class="thumb">
                            <img src="public/images/banner.png" alt="">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
