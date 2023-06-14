@foreach ($sortdProducts as $product)
<li style="height: 276px" class="li-product">
    <a href="{{ route('productDetail', $product->slug) }}" title="" class="thumb">
        <img src="{{ url($product->images) }}">
    </a>
    @if ($product->sale_price !== 0.0)
    <div class="discount-product">
        <p class="discount">
            {{ format_discount($product->price, $product->sale_price) }} %
        </p>
        <p class="" style="color: #fff">giảm</p>
    </div>
@endif

<div class="price">
    <span class="new">{{ number_format($product->price, 0, '', '.') }} đ</span>
    @if ($product->sale_price !== 0.0)
        <span class="old">{{ number_format($product->sale_price, 0, '', '.') }}
            đ</span>
    @endif
</div>
    <div class="action clearfix">
        <a href="{{ route('addCart', $product->id) }}" title=""
            data-id="{{ $product->id }}" class="add-cart fl-left">Thêm giỏ hàng</a>
        <a href="{{ route('buyNow', $product->id) }}" title="Mua ngay"
            class="buy-now fl-right">Mua
            ngay</a>
    </div>
</li>
@endforeach
@php
  

function format_discount($price, $sale_price)
{
    if ($price != 0) {
        $discount = (($sale_price - $price) / abs($price)) * 100;
        $discount = round($discount, 2);
        return $discount;
    }
    // Trường hợp giá trị ban đầu là 0, không thể tính phần trăm thay đổi
    return null;
}

@endphp
