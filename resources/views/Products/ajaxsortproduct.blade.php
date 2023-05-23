@foreach ($sortdProducts as $product)
    <li style="height: 276px">
        <a href="{{ route('productDetail', $product->slug) }}" title="" class="thumb">
            <img src="{{ url($product->images) }}">
        </a>
        <a href="{{ route('productDetail', $product->slug) }}" title="" class="product-name">{{ $product->name }}</a>
        <div class="price">
            <span class="new">{{ number_format($product->price, 0, '', '.') }} đ</span>
            <span class="old">8.990.000đđ</span>
        </div>
        <div class="action clearfix">
            <a href="{{ route('addCart', $product->id) }}" title="Thêm giỏ hàng" data-id="{{ $product->id }}"
                class="add-cart fl-left">Thêm giỏ
                hàng</a>
            <a href="{{ route('buyNow', $product->id) }}" title="Mua ngay" class="buy-now fl-right">Mua ngay</a>
        </div>
    </li>
@endforeach

