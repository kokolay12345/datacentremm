@extends('frontend.layout.layout')

@section('content')
    <div class="container  pb-5 mb-2 mb-md-4">
        <div class="row">

            <section class="col-lg-8">
                <!-- Post meta-->
                <div class="row">
                    <div class=" col-md-4 ">
                        <a class="product-list-thumb" href="{{ route('dc.detail', $detail->id) }}"
                            id="movie-product-list-thumb">
                            <img src="{{ !empty($detail->photo) ? url('upload/product_images/' . $detail->photo) : url('upload/blog_images.png') }}"
                                alt="Product" id="movie_list">
                        </a>
                    </div>
                    <div class=" col-md-8 mt-2">

                        <h5 class="product-title">
                            <a href="{{ route('dc.detail', $detail->id) }}" id="mname_{{ $detail->id }}">
                                {{ $detail->title }}
                            </a>
                        </h5>



                        <a class="btn-tag mt-2 mb-2" id="h-a" href="#">
                            {{ $detail->rating }}
                        </a>

                        <div class="star-rating ml-2">
                            @php
                                $rating = $detail->rating; // Get the rating value from your model
                                $maxRating = 10; // Assuming a maximum rating of 5 stars

                                // Loop through and display stars (full, half, or empty) based on the rating value
                                for ($i = 1; $i <= $maxRating; $i++) {
                                    if ($rating >= $i) {
                                        echo '<i class="sr-star czi-star-filled active"></i>';
                                    } else {
                                        echo '<i class="sr-star czi-star"></i>';
                                    }
                                }
                            @endphp
                        </div>

                        <h5 class="product-title text-primary mt-2">

                            Price - {{ $detail->selling_price }}Ks

                        </h5>

                        <div>
                            <a class="product-meta font-size-sm pb-1" id="h-a"
                                href="{{ route('dc.movies.years', ['release_date' => $detail->release_date]) }}">
                                Release Date : {{ $detail->release_date }}
                            </a>
                        </div>

                        <div>
                            @if ($detail->type == 'movie')
                                <a class="product-meta font-size-sm pb-1 text-white">
                                    Category :
                                </a>
                                @foreach ($detail->categories as $category)
                                    <a class="product-meta font-size-sm pb-1" id="h-a"
                                        href="{{ route('dc.movies.categories', ['id' => $category->id]) }}">
                                        {{ $category->name }},
                                    </a>
                                @endforeach
                            @elseif ($detail->type == 'serie')
                                <a class="product-meta font-size-sm pb-1 text-white">
                                    Category :
                                </a>
                                @foreach ($detail->series_categories as $category)
                                    <a class="product-meta font-size-sm pb-1" id="h-a"
                                        href="{{ route('dc.series.categories', ['id' => $category->id]) }}">
                                        {{ $category->name }},
                                    </a>
                                @endforeach
                            @endif
                        </div>
                        <div>

                            @if ($detail->type == 'movie')
                                <a class="product-meta font-size-sm pb-1 text-white">
                                    Genres :
                                </a>
                                @foreach ($detail->genres as $genre)
                                    <a class="product-meta font-size-sm pb-1" id="h-a"
                                        href="{{ route('dc.movies.genres', ['id' => $genre->id]) }}">
                                        {{ $genre->name }},
                                    </a>
                                @endforeach
                            @elseif ($detail->type == 'serie')
                                <a class="product-meta font-size-sm pb-1 text-white">
                                    Genres :
                                </a>
                                @foreach ($detail->series_genres as $serieGenre)
                                    <a class="product-meta font-size-sm pb-1" id="h-a"
                                        href="{{ route('dc.series.genres', ['id' => $serieGenre->id]) }}">
                                        {{ $serieGenre->name }},
                                    </a>
                                @endforeach
                            @elseif ($detail->type == 'game')
                                <a class="product-meta font-size-sm pb-1 text-white">
                                    Genres :
                                </a>
                                @foreach ($detail->games_genres as $gameGenre)
                                    <a class="product-meta font-size-sm pb-1" id="h-a"
                                        href="{{ route('dc.games.genres', ['id' => $gameGenre->id]) }}">
                                        {{ $gameGenre->name }},
                                    </a>
                                @endforeach
                            @endif


                        </div>
                        <div class="font-size-sm text-white">
                            Runtime : {{ $detail->runtime }}

                        </div>
                        <div class="font-size-sm text-white">
                            Video Format : {{ $detail->video_format }}
                        </div>

                        <div class="font-size-sm text-white">
                            Release Date : {{ $detail->release_date }}
                        </div>

                        <br class="">

                        <div>
                            <input type="hidden" class="movie_id" value="{{ $detail->id }}">
                            <input type="hidden" class="qty" value="1">
                            <button type="button" class="btn btn-primary btn-sm mb-2"
                                onclick="addToCartDetails({{ $detail->id }})">
                                <i class="czi-cart font-size-sm mr-1"></i>Add to Cart</button>

                            <a type="button" class="btn btn-secondary btn-sm mb-2 nav-link-style font-size-ms"
                                href="#quick-view" data-toggle="modal">
                                <i class="czi-eye align-middle mr-1"></i>Trailer</a>

                        </div>


                    </div>
                </div>
                <!-- Nav tabs-->
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link p-4 active" href="#details" data-toggle="tab" role="tab">
                            Description
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link p-4" href="#reviews" data-toggle="tab" role="tab">
                            Casts
                        </a>
                    </li>
                </ul>
                <div class="tab-content pt-2">
                    <!-- Movie details tab-->
                    <div class="tab-pane fade show active" id="details" role="tabpanel">
                        <div class="row">
                            <div class="col-lg-12">
                                <p>
                                <div id="movie_des">
                                    {!! html_entity_decode($detail->description) !!}
                                </div>
                                </p>
                            </div>
                        </div>
                    </div>
                    <!-- Cast tab-->
                    <div class="tab-pane fade" id="reviews" role="tabpanel">
                        <div class="row pt-4">
                            @foreach ($casts as $cast)
                                <div class="col-md-2 col-4 mb-1">
                                    <div class="card" id="custom-card">
                                        <a class="blog-entry-thumb gallery-item"
                                            href="{{ route('dc.casts.detail', $cast->id) }}">
                                            <img class="card-img-top"
                                                src="{{ !empty($cast->photo) ? url('upload/cast_images/' . $cast->photo) : url('upload/profile.jpg') }}"
                                                alt="Post">
                                        </a>
                                        <div class="card-body">
                                            <h6 class="blog-entry-title" style="font-size: 13px" id="h-a">
                                                <div class="movie-title">
                                                    {{ $cast->name }}
                                                </div>
                                            </h6>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class=" my-lg-3 py-5">
                    <div class="container pt-md-2">
                        <hr class="mt-4 pb-4 mb-3">
                        <div class="row">

                            <!-- Reviews list-->
                            <div class="col-md-12">
                                <!-- Review-->
                                @foreach ($comments as $comment)
                                    <div class="product-review pb-4 mb-4 border-bottom">
                                        <div class="d-flex mb-3">
                                            <div class="media media-ie-fix align-items-center mr-4 pr-2">
                                                @if ($comment->user)
                                                    <a href="#">
                                                        <img class="rounded-circle" width="50"
                                                            src="{{ !empty($comment->user->photo) ? url('upload/admin_images/' . $comment->user->photo) : url('upload/profile.jpg') }}"
                                                            alt="Laura Willson" />
                                                    </a>
                                                @else
                                                    <img class="rounded-circle" width="50"
                                                        src="{{ !empty($comment->user->photo) ? url('upload/admin_images/' . $comment->user->photo) : url('upload/profile.jpg') }}"
                                                        alt="Laura Willson" />
                                                @endif
                                                <div class="media-body pl-3">
                                                    <h6 class="font-size-sm mb-0 text-white">
                                                        @if ($comment->user)
                                                            {{ $comment->user->name }}
                                                        @endif
                                                    </h6>
                                                    <span
                                                        class="font-size-ms text-white">{{ date('F j', strtotime($comment['created_at'])) }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <p class="font-size-md mb-1 text-white">
                                            {!! html_entity_decode($comment->content) !!}
                                        </p>
                                    </div>
                                @endforeach

                                <div class="text-center">
                                    @if (Auth::check())
                                        <!-- Comment form for authenticated users -->

                                        <div class="media pt-4">
                                            <img class="rounded-circle" width="50"
                                                src="{{ !empty($adminData->photo) ? url('upload/user_images/' . $adminData->photo) : url('upload/profile.jpg') }}"
                                                alt="Mary Alice" />
                                            <form action="{{ route('dc.movies.comment') }}" method="post"
                                                class="media-body needs-validation ml-3" novalidate>
                                                @csrf
                                                <input type="hidden" name="product_id" value="{{ $detail->id }}">
                                                <div class="form-group">
                                                    <textarea class="form-control text-white" rows="4" placeholder="Write comment..." required
                                                        style="background-color: #0f2133;" name="content" id="comment-content"></textarea>
                                                    <div class="invalid-feedback">Please write your comment.</div>
                                                </div>
                                                <button class="btn btn-primary btn-sm" type="submit">Post
                                                    comment</button>
                                            </form>
                                        </div>
                                    @else
                                        <!-- Display a message and login button for non-authenticated users -->
                                        <div class="alert alert-info">
                                            You must be logged in to post a comment.
                                        </div>
                                        <a href="{{ route('login') }}" class="btn btn-primary">Log In</a>
                                    @endif
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </section>

            <aside class="col-lg-4">
                <!-- Sidebar-->
                <div class="cz-sidebar rounded-lg box-shadow-lg ml-lg-auto" id="shop-sidebar"
                    style="background-color: #233a50;">
                    <div class="cz-sidebar-header box-shadow-sm">
                        <button class="close ml-auto" type="button" data-dismiss="sidebar" aria-label="Close"><span
                                class="d-inline-block font-size-xs font-weight-normal align-middle">Close
                                sidebar</span><span class="d-inline-block align-middle ml-2"
                                aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="cz-sidebar-body" data-simplebar data-simplebar-auto-hide="true">
                        <!-- Movie Series Genre-->
                        <ul class="nav nav-tabs nav-fill" role="tablist">
                            <li class="nav-item"><a class="nav-link  active" href="#details" data-toggle="tab"
                                    role="tab">Movies</a></li>
                            <li class="nav-item"><a class="nav-link " href="#reviews" data-toggle="tab"
                                    role="tab">Series</a>
                            </li>
                        </ul>

                        <div class="tab-content pt-2">
                            <!-- Movie details tab-->
                            <div class="tab-pane fade show active" id="details" role="tabpanel">
                                <div class="widget widget-categories mb-4 pb-4 border-bottom">
                                    <div class="accordion mt-n1" id="shop-categories">
                                        <!-- Movie-->
                                        <div class="card">
                                            <div class="collapse show" id="Movie" data-parent="#shop-categories">
                                                <div class="card-body">
                                                    <div class="widget widget-links cz-filter">
                                                        <div class="input-group-overlay input-group-sm mb-2">
                                                            <input
                                                                class="cz-filter-search form-control form-control-sm appended-form-control"
                                                                type="text" placeholder="Search">
                                                            <div class="input-group-append-overlay"><span
                                                                    class="input-group-text"><i
                                                                        class="czi-search"></i></span>
                                                            </div>
                                                        </div>
                                                        <ul class="widget-list cz-filter-list pt-1" style="height: 12rem;"
                                                            data-simplebar data-simplebar-auto-hide="false">
                                                            @foreach ($genres->sortBy('name') as $genre)
                                                                {{-- Movies --}}
                                                                @if ($genre->type == 'movie' && $genre->movies()->count() > 0)
                                                                    <li class="widget-list-item cz-filter-item">
                                                                        <a class="widget-list-link d-flex justify-content-between align-items-center"
                                                                            href="{{ route('dc.movies.genres', ['id' => $genre->id]) }}"
                                                                            id="h-a">
                                                                            <span
                                                                                class="cz-filter-item-text">{{ $genre->name }}
                                                                            </span>
                                                                            <span
                                                                                class="font-size-xs text-muted ml-3">{{ $genre->movies->count() }}</span>
                                                                        </a>
                                                                    </li>
                                                                @endif
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <!-- Cast tab-->
                            <div class="tab-pane fade" id="reviews" role="tabpanel">
                                <div class="widget widget-categories mb-4 pb-4 border-bottom">
                                    <div class="accordion mt-n1" id="shop-categories">
                                        <!-- series-->
                                        <div class="card">
                                            <div class="collapse show" id="Movie" data-parent="#shop-categories">
                                                <div class="card-body">
                                                    <div class="widget widget-links cz-filter">
                                                        <div class="input-group-overlay input-group-sm mb-2">
                                                            <input
                                                                class="cz-filter-search form-control form-control-sm appended-form-control"
                                                                type="text" placeholder="Search">
                                                            <div class="input-group-append-overlay"><span
                                                                    class="input-group-text"><i
                                                                        class="czi-search"></i></span>
                                                            </div>
                                                        </div>
                                                        <ul class="widget-list cz-filter-list pt-1" style="height: 12rem;"
                                                            data-simplebar data-simplebar-auto-hide="false">
                                                            @foreach ($genres->sortBy('name') as $genre)
                                                                {{-- Series --}}
                                                                @if ($genre->type == 'serie' && $genre->series()->count() > 0)
                                                                    <li class="widget-list-item cz-filter-item">
                                                                        <a class="widget-list-link d-flex justify-content-between align-items-center"
                                                                            href="{{ route('dc.series.genres', ['id' => $genre->id]) }}"
                                                                            id="h-a">
                                                                            <span
                                                                                class="cz-filter-item-text">{{ $genre->name }}</span>
                                                                            <span
                                                                                class="font-size-xs text-muted ml-3">{{ $genre->series->count() }}</span>
                                                                        </a>
                                                                    </li>
                                                                @endif
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="widget mb-grid-gutter pb-grid-gutter border-bottom">
                            <h3 class="widget-title">Trending posts</h3>
                            @foreach ($posts as $blog)
                                <div class="media align-items-center mb-3">
                                    <a href="{{ route('dc.blogs.detail', $blog->id) }}">
                                        <img class="rounded"
                                            src="{{ !empty($blog->photo) ? url('upload/blog_images/' . $blog->photo) : url('upload/blog_images.png') }}"
                                            width="64" alt="Post image"></a>
                                    <div class="media-body pl-3">
                                        <h6 class="blog-entry-title font-size-sm mb-0">
                                            <a href="{{ route('dc.blogs.detail', $blog->id) }}">{{ $blog->title }}</a>
                                        </h6>
                                        <span class="font-size-ms text-muted">by
                                            <a href='{{ route('dc.user.blogs', ['id' => $blog->user->id]) }}'
                                                class='blog-entry-meta-link'>{{ $blog->user->name }}</a>
                                        </span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </aside>
        </div>
    </div>

    <!-- Quick View Modal-->
    <div class="modal-quick-view modal fade" id="quick-view" tabindex="-1">
        <div class="modal-dialog modal-xl">
            <div class="modal-content" style="background-color: #0f2133;border: 0px">

                <div class="modal-header">
                    <h4 class="modal-title">
                        <a href="{{ route('dc.detail', $detail->id) }}" id="h-a">
                            {{ $detail->title }}
                            <i class="czi-arrow-right font-size-lg ml-2"></i></a>
                    </h4>
                    <button class="close text-light" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @if ($youtubeLink == null)
                        <iframe width="100%" height="500" src=""></iframe>
                    @else
                        <iframe width="100%" height="500"
                            src="https://www.youtube.com/embed/{{ $youtubeLink }}"></iframe>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
