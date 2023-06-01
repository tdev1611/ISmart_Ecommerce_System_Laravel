@if (Cart::count())
<ul class="list-cart">
    @foreach (Cart::content() as $item)
        <li class="clearfix">
            <a href="{{ route('productDetail', $item->options->slug) }}"
                title="" class="thumb fl-left">
                <img src="{{ url($item->options->images) }}" alt="">
            </a>
            <div class="info fl-right">
                <a href="{{ route('productDetail', $item->options->slug) }}"
                    title=""
                    class="product-name">{{ $item->name }}</a>
                <p class="price">
                    {{ number_format($item->price, 0, '', '.') }}đ
                </p>
                <p class="qty">Số lượng:
                    <span
                    id="qty_per">{{ $item->qty }}</span>
                </p>
            </div>
        </li>
    @endforeach
</ul>
<div class="total-price clearfix">
    <p class="title fl-left">Tổng:</p>
    <p class="price fl-right total-price-lo">{{ Cart::total() }}đ</p>
</div>
<div class="action-cart clearfix">
    <a href="{{ route('cartshow') }}" title="Giỏ hàng"
        class="view-cart fl-left">Giỏ hàng</a>
    <a href="{{ route('showCheckCount') }}" title="Thanh toán"
        class="checkout fl-right">Thanh
        toán</a>
</div>
@else
<img src="https://bizweb.dktcdn.net/100/440/012/themes/839260/assets/empty_cart.png?1653287637639"
    alt="Trống giỏ hàng">
<span class="mess-order-header">Hãy thêm các sản phẩm vào giỏ hàng của
    bạn!!!</span>
@endif
