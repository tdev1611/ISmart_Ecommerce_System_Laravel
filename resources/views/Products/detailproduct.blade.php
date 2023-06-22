@extends('layout-client.layouts')
@section('style_css')
    <style>
        .text-danger {
            color: red;
        }

        #main-thumb {
            position: relative;
            padding-bottom: 100%
        }

        #zoom {
            max-width: 100%;
        }

        .buy-nowde {
            display: inline-block;
            padding: 10px 30px;
            font-size: 16px;
            background: #ee5f4a;
            color: #fff;
            border-radius: 5px;
            text-transform: uppercase;
        }

        #detail-product-wp .add-cart:hover {
            background: #ee5f4a;
        }

        #detail-product-wp .add-cart {
            background: gray;
        }

        .section-detail {

            overflow: hidden;
        }

        .section-detail.expanded p {
            height: auto;
        }

        #expandButton {
            display: block;
            color: #fff;
            margin: 0 auto;
            line-height: 50px;
            width: 30%;
            border-radius: 30px;
            text-decoration: none;
            border: 3px #ee5f4a solid;
            background: #ee5f4a;
            opacity: 0.7;
            margin-bottom: 50px;
            text-align: center;
            cursor: pointer;
        }

        #expandButton:hover {
            background: #bc341f;
        }

        /* cmt-reply */
        .comment-section {
            max-width: 600px;
            margin: 0 auto;
        }

        .comment-list {
            margin-top: 20px;
        }

        .comment {
            margin-bottom: 20px;
            padding: 10px;
            border: 1px solid #ddd;
            position: relative;
        }

        .comment-header {
            display: flex;
            justify-content: space-between;
            margin-bottom: 5px;
        }

        .comment-author {
            font-weight: bold;
        }

        .comment-date {
            color: #888;
        }

        .comment-content {
            margin-top: 5px;
        }

        .reply-list {
            margin-top: 10px;
            margin-left: 20px;
            border-left: 1px solid #ddd;
            padding-left: 10px;
        }

        .reply {
            margin-bottom: 10px;
        }

        .reply-header {
            display: flex;
            justify-content: space-between;
            margin-bottom: 5px;
        }

        .reply-author {
            font-weight: bold;
        }

        .reply-date {
            color: #888;
        }

        .reply-content {
            margin-top: 5px;
        }

        .wp-reply-content {
            display: flex;
            justify-content: space-between;
        }

        .comment-form input,
        .comment-form textarea {
            width: 100%;
            margin-bottom: 10px;
        }

        .comment-form button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
        }

        .comment-form button:hover {
            opacity: 0.8;
        }

        .reply-button {
            background-color: #eaeaea;
            color: #888;
            padding: 5px 10px;
            border: none;
            cursor: pointer;
            font-size: 12px;
        }

        .reply-form {
            margin-top: 10px;
        }

        .reply-form input,
        .reply-form textarea {
            width: 100%;
            margin-bottom: 10px;
        }

        .reply-form button {
            background-color: #4CAF50;
            color: white;
            padding: 5px 10px;
            border: none;
            cursor: pointer;
            font-size: 12px;
        }

        .reply-form button:hover {
            opacity: 0.8;
        }

        /* Style cho phần tử phân trang chung */
        .pagination {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        .pagination a,
        .pagination span {
            display: inline-block;
            padding: 8px 12px;
            margin-right: 5px;
            background-color: #f1f1f1;
            color: #333;
            text-decoration: none;
            border-radius: 3px;
        }

        .pagination a:hover {
            background-color: #906e6e;
        }

        .pagination .active {
            background-color: #333;
            color: #fff;
        }

        .pagination .disabled {
            color: #aaa;
        }

        .pagination .previous,
        .pagination .next {
            font-weight: bold;
        }

        .pagination .pagination-link {
            font-weight: bold;
        }

        .pagination .pagination-link.active {
            background-color: #333;
            color: #fff;
        }
    </style>
@endsection
@section('content')
    <div class="wp-inner">
        <div class="secion" id="breadcrumb-wp">
            <div class="secion-detail">
                <ul class="list-item clearfix">
                    <li>
                        <a href="{{ route('homes') }}" title="">Trang chủ</a>
                    </li>
                    <li>
                        <a href="{{ route('productShows') }}" title="">Sản phẩm</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="main-content fl-right">
            {{-- {{ route('cart.add', $product->id) }} --}}
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <div class="section" id="detail-product-wp">
                <div class="section-detail clearfix">
                    <div class="thumb-wp fl-left">
                        <a href="#" title="" id="main-thumb">
                            <img id="zoom" src="{{ url($product->images) }}"
                                data-zoom-image="{{ url($product->images) }}" />
                        </a>
                        <div id="list-thumb">
                            {{-- @foreach ($product as $item)
                                <a href=""
                                    data-image="https://media3.scdn.vn/img2/2017/10_30/BlccRg_simg_ab1f47_350x350_maxb.jpg"
                                    data-zoom-image="https://media3.scdn.vn/img2/2017/10_30/BlccRg_simg_70aaf2_700x700_maxb.jpg">
                                    <img id="zoom"
                                        src="https://media3.scdn.vn/img2/2017/10_30/BlccRg_simg_02d57e_50x50_maxb.jpg" />
                                </a>
                            @endforeach --}}
                            @php
                                $list_images = json_decode($product->list_images, true);
                            @endphp
                            @foreach ($list_images as $item)
                                <a href="" data-image="{{ url(htmlspecialchars($item)) }}"
                                    data-zoom-image="{{ url(htmlspecialchars($item)) }}">
                                    <img id="zoom" src="{{ url(htmlspecialchars($item)) }}" />
                                </a>
                            @endforeach
                        </div>
                    </div>
                    <div class="thumb-respon-wp fl-left">
                        <img src="{{ url($product->images) }}" alt="">
                    </div>
                    <div class="info fl-right">
                        <h3 class="product-name">{{ $product->name }}</h3>

                        <div class="desc">
                            <div id="description">
                                {!! $product->desc !!}
                            </div>
                        </div>
                        <div class="num-product">
                            <span class="title">Sản phẩm: </span>
                            <span class="status">{{ $product->status == 1 ? 'Còn hàng' : 'Hết hàng' }}</span>
                        </div>
                        <p class="price">{{ number_format($product->price, 0, '', '.') }}đ</p>

                        <form action="{{ route('buyNowDetail', $product->id) }}" method="get">
                            <div id="num-order-wp">
                                <a title="" name="num" id="minus"><i class="fa fa-minus"></i></a>
                                {{-- <input type="hidden" name="product_id" value="{{ $product->id }}"> --}}
                                <input type="text" name="num_order" value="1" id="num-order">
                                <a title="" name="num" id="plus"><i class="fa fa-plus"></i></a>
                            </div>
                            <input type="submit" value="Thêm giỏ hàng" name="btn_add_cart" title="Thêm giỏ hàng"
                                data-id="{{ $product->id }}" class="add-cart">
                            <input value="Mua Ngay" type="submit" name="buy_now" class="buy-nowde">
                        </form>
                    </div>
                </div>
            </div>
            <div class="section" id="post-product-wp">
                <div class="section-head">
                    <h3 class="section-title">Mô tả sản phẩm</h3>
                </div>
                <div class="section-detail" style="height: 600px;">
                    <p> {!! $product->detail !!}</p>
                </div>
                <span id="expandButton">Mở rộng</span>
            </div>
            {{-- cmt --}}
            <div class="section">
                <h2>NHẬN XÉT</h2>

                @forelse ($comments as $comment)
                    <div class="comment-list" id="wp-comment{{ $comment->id }}">
                        @if ($comment->parent_id === null)
                            <div class="comment">
                                <div class="comment-header">
                                    <div class="comment-author">{{ $comment->user->name }}</div>
                                    <div class="comment-date">Ngày đăng: <i>{{ $comment->created_at }}</i></div>
                                </div>
                                <div class="wp-reply-content">
                                    <div class="comment-content "> {{ $comment->content }}</div>
                                    @can('roles.delete')
                                        {{-- {{ route('deleteCmt', $comment->id) }} --}}
                                        <a class="cmt-trash" href="" data-id="{{ $comment->id }}">
                                            <i class="fa fa-trash-o" aria-hidden="true"></i>
                                        </a>
                                    @endcan
                                </div>
                                @foreach ($comment->replies as $reply)
                                    <div class="reply-list" id="reply-cmt{{ $reply->id }}">
                                        <div class="reply">
                                            <div class="reply-header">
                                                <div class="reply-author">{{ $reply->user->name }}</div>
                                                <div class="reply-date">{{ $reply->created_at }}</div>
                                            </div>
                                            <div class="wp-reply-content">
                                                <div class="reply-content">{{ $reply->content }}
                                                </div>
                                                @can('roles.delete')
                                                    <div>
                                                        {{-- {{ route('deleteCmt',$reply->id) }} --}}
                                                        <a class="cmt-trash"  href="" data-id="{{ $reply->id }}">
                                                            <i class="fa fa-trash-o" aria-hidden="true"></i>
                                                        </a>
                                                    </div>
                                                @endcan

                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                <button class="reply-button">Trả lời</button>
                                <div class="reply-form" style="display: none;">
                                    <form action="{{ route('relycomment', $comment->id) }}" method="post">
                                        @csrf
                                        <textarea style="resize: none" placeholder="Nội dung trả lời" name="relycomment[{{ $comment->id }}]"></textarea>
                                        @error('relycomment.' . $comment->id)
                                            <p class="text-danger"> {{ $message }}</p>
                                        @enderror
                                        <button type="submit" class="submit-reply">Gửi trả lời</button>
                                    </form>
                                </div>
                            </div>
                        @endif

                    </div>
                @empty
                    {{-- <div class="comment-list">
                        <div class="comment">
                            <div class="comment-header">
                                <div class="comment-author">
                                    Chưa có nhận xét nào về sản phẩm
                                </div>
                            </div>
                        </div>

                    </div> --}}
                @endforelse


                <form class="comment-form" method="POST" action="{{ route('comment', $product) }}">
                    @csrf
                    <textarea rows="4" placeholder="Nội dung bình luận sản phẩm" name="comment" style="resize: none"></textarea>
                    @error('comment')
                        <p class="text-danger"> {{ $message }}</p>
                    @enderror
                    <button type="submit">Gửi bình luận</button>
                </form>
                <div class="pagination">
                    {{ $comments->appends(request()->all())->links() }}

                </div>

            </div>


            {{-- end-cmt --}}
            <div class="section" id="same-category-wp">
                <div class="section-head">
                    <h3 class="section-title">Cùng chuyên mục</h3>
                </div>
                <div class="section-detail">
                    <ul class="list-item">
                        @foreach ($relatedProducts as $item)
                            <li style="height: 276px">
                                <a href="{{ route('productDetail', $item->slug) }}" title="" class="thumb">
                                    <img src="{{ url($item->images) }}">
                                </a>
                                <a href="{{ route('productDetail', $item->slug) }}" title=""
                                    class="product-name">{{ $item->name }}</a>
                                <div class="price">
                                    <span class="new">{{ number_format($item->price, 0, '', '.') }}đ</span>
                                    <span class="old">20.900.000đ</span>
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
                    </ul>
                </div>
            </div>
        </div>
        <div class="sidebar fl-left">
            <div class="section" id="category-product-wp">
                <div class="section-head">
                    <h3 class="section-title">Danh mục sản phẩm</h3>
                </div>
                <div class="secion-detail">
                    <ul class="list-item">
                        {!! $renderMenu !!}
                    </ul>
                </div>
            </div>
            <div class="section" id="banner-wp">
                <div class="section-detail">
                    <a href="" title="" class="thumb">
                        <img src="public/images/banner.png" alt="">
                    </a>
                </div>
            </div>
        </div>
    </div>
    <style>
        #notification {
            display: none;
            position: fixed;
            top: 10px;
            right: 10px;
            padding: 2.5rem 1.25rem;
            background-color: rgba(0, 0, 0, .7);
            color: white;
            font-size: 1.0625rem;
            min-width: 18.75rem;
            z-index: 9999;
            border-radius: 15px;
            opacity: 0.8;
        }

        .checkmark {
            display: inline-block;
            width: 20px;
            height: 25px;
            font-size: 37px;
            margin-right: 10px;
            vertical-align: middle;
            color: #0F9D58;
        }
    </style>
    <div id="notification">
        Sản phẩm đã được thêm vào giỏ hàng thành công
        <span class="checkmark">&#10004;</span>
    </div>

    <script>
        $(document).on('click', '.add-cart', function(event) {
            event.preventDefault();
            var productId = $(this).attr('data-id');
            var qty = $('#num-order').val();
            $.ajax({
                url: "{{ route('cart.addDetailajax') }}",
                method: 'post',
                data: {
                    'product_id': productId,
                    'qty': qty,
                    // product_id: $request->input controller gửi qua  - productId lấy ở trên,
                    '_token': '{{ csrf_token() }}'
                },
                dataType: 'json',
                success: function(response) {

                    $('.qtys').text(response.cartCount); // Tổng gio hang layouts
                    // $('#qty_per').text(response.qty_per)  // số lượng của mỗi sản phẩm layouts
                    $('.total-price-lo').text(response.cartTotal);
                    // show listcart
                    var list_cart = response.list_cart;
                    $('#show-dropcart').empty()
                    $('#show-dropcart').append(list_cart)
                    $('#notification').show()
                    // $('.list-cart').show()
                    setTimeout(function() {
                        $('#notification').fadeOut('slow');
                    }, 1000);
                },
                error: function(xhr) {
                    alert('Error: ' + xhr.responseText);
                },
            });
        });
    </script>

    <script>
        $(document).ready(function() {

            $('#expandButton').click(function() {
                $(this).toggleClass('expand');
                if ($(this).hasClass('expand')) {
                    $(this).prev().removeAttr('style')
                    $(this).text('Thu gọn');
                } else {
                    $(this).text('Mở rộng');
                    $(this).prev().css('height', '600px')
                }

            });
        });
    </script>

    <script>
        // Lấy tất cả các nút "Trả lời"
        const replyButtons = document.querySelectorAll('.reply-button');

        // Lặp qua từng nút và thêm sự kiện nhấp vào
        replyButtons.forEach(button => {
            button.addEventListener('click', () => {
                // Lấy phần tử "reply-form" tương ứng với nút được nhấp vào
                const replyForm = button.nextElementSibling;
                // Kiểm tra trạng thái hiển thị của form
                if (replyForm.style.display === 'none') {
                    replyForm.style.display = 'block';
                } else {
                    replyForm.style.display = 'none';
                }
            });
        });
    </script>

    {{-- //delete cmt  --}}
    <script>
        $(document).ready(function() {            
            $('.cmt-trash').click(function(e) {
                e.preventDefault()
                let cmtId = $(this).attr('data-id');
                
                if(confirm("Bạn có chắc chắn muốn xóa bình luận này?")) {
                    $.ajax({
                    url: "{{ route('deleteCmt', ':cmtId') }}".replace(':cmtId', cmtId),
                    // url: "{{ route('deleteCmt', '"cmtId"') }}",
                    type: 'DELETE',
                    data: {
                        // id: cmtId,
                        _token: '{{ csrf_token() }}'
                    },
                    dataType: 'json',
                    success: function(response) {
                        $('#wp-comment' + cmtId).remove();
                        $('#reply-cmt' + cmtId).remove();
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        // alert(xhr.status);
                        // alert(thrownError);
                    }
                })
                }
             

            })


        })
    </script>
@endsection
