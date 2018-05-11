@extends('layouts.index')

@section('content')
    <style>
        img {
            max-width: 100%;
        }

        .starrr {
            font-size: 2em;
        }

        /*.preview {*/
        /*display: -webkit-box;*/
        /*display: -webkit-flex;*/
        /*display: -ms-flexbox;*/
        /*display: flex;*/
        /*-webkit-box-orient: vertical;*/
        /*-webkit-box-direction: normal;*/
        /*-webkit-flex-direction: column;*/
        /*-ms-flex-direction: column;*/
        /*flex-direction: column; }*/
        @media screen and (max-width: 996px) {
            .preview {
                padding: 0;
                margin-bottom: 20px;
            }
        }

        .preview-pic {
            -webkit-box-flex: 1;
            -webkit-flex-grow: 1;
            -ms-flex-positive: 1;
            flex-grow: 1;
        }

        .preview-thumbnail.nav-tabs {
            border: none;
            margin-top: 15px;
        }

        .preview-thumbnail.nav-tabs li {
            width: 18%;
            margin-right: 2%;
            margin-bottom: 2%;
        }

        .preview-thumbnail.nav-tabs li img {
            max-width: 100%;
            display: block;
        }

        .preview-thumbnail.nav-tabs li a {
            padding: 0;
        / / margin: 0;
        }

        .preview-thumbnail.nav-tabs li:last-of-type {
        / / margin-right: 0;
        }

        .tab-content {
            overflow: hidden;
        }

        .tab-content img {
            width: 100%;
            -webkit-animation-name: opacity;
            animation-name: opacity;
            -webkit-animation-duration: .3s;
            animation-duration: .3s;
        }

        .card {
            background: #fff;
            padding: 3em;
            line-height: 1.5em;
            box-shadow: 1px 1px 3px rgba(0, 0, 0, 0.1);
        }

        @media screen and (min-width: 997px) {
            .wrapper {
                display: -webkit-box;
                display: -webkit-flex;
                display: -ms-flexbox;
                display: flex;
            }
        }

        .details {
            display: -webkit-box;
            display: -webkit-flex;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-orient: vertical;
            -webkit-box-direction: normal;
            -webkit-flex-direction: column;
            -ms-flex-direction: column;
            flex-direction: column;
        }

        .colors {
            -webkit-box-flex: 1;
            -webkit-flex-grow: 1;
            -ms-flex-positive: 1;
            flex-grow: 1;
        }

        .product-title, .price, .sizes, .colors {
            text-transform: UPPERCASE;
            font-weight: bold;
        }

        .checked, .price span {
            color: #ff9f1a;
        }

        .product-title, .rating, .product-description, .price, .vote, .sizes {
            margin-bottom: 15px;
        }

        .product-title {
            margin-top: 0;
        }

        .size {
            margin-right: 10px;
        }

        .size:first-of-type {
            margin-left: 40px;
        }

        .color {
            display: inline-block;
            vertical-align: middle;
            margin-right: 10px;
            height: 2em;
            width: 2em;
            border-radius: 2px;
        }

        .color:first-of-type {
            margin-left: 20px;
        }

        .add-to-cart, .like {
            background: #ff9f1a;
            margin-bottom: 2%;
            padding: 1.2em 1.5em;
            border: none;
            text-transform: UPPERCASE;
            font-weight: bold;
            color: #fff;
            -webkit-transition: background .3s ease;
            transition: background .3s ease;
        }

        .add-to-cart:hover, .like:hover {
            background: #b36800;
            color: #fff;
        }

        .not-available {
            text-align: center;
            line-height: 2em;
        }

        .not-available:before {
            font-family: fontawesome;
            content: "\f00d";
            color: #fff;
        }

        .orange {
            background: #ff9f1a;
        }

        .green {
            background: #85ad00;
        }

        .blue {
            background: #0076ad;
        }

        .tooltip-inner {
            padding: 1.3em;
        }

        @-webkit-keyframes opacity {
            0% {
                opacity: 0;
                -webkit-transform: scale(3);
                transform: scale(3);
            }
            100% {
                opacity: 1;
                -webkit-transform: scale(1);
                transform: scale(1);
            }
        }

        @keyframes opacity {
            0% {
                opacity: 0;
                -webkit-transform: scale(3);
                transform: scale(3);
            }
            100% {
                opacity: 1;
                -webkit-transform: scale(1);
                transform: scale(1);
            }
        }

        /*# sourceMappingURL=style.css.map */
        .modal-backdrop.in {
            display: none;
        }
    </style>

    <button id="showmodal" hidden type="button" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">
        Open
    </button>

    <div class="card">
        <div class="container-fliud">
            <div class="wrapper row">
                <div class="preview col-md-6">

                    <div class="preview-pic tab-content">
                        <div class="active tab-pane" id="pic-2"><img
                                    src="{{asset('images/apps/' . $app->id . '/'. $images[2])}}"/></div>
                        @for($i = 3; $i < count($images)+2; $i++)
                            <div class="tab-pane" id="pic-{{ $i }}"><img
                                        src="{{asset('images/apps/' . $app->id . '/'. $images[$i])}}"/></div>
                        @endfor
                    </div>
                    <ul class="preview-thumbnail nav nav-tabs">
                        <li class="active"><a data-target="#pic-2" data-toggle="tab"><img
                                        src="{{asset('images/apps/' . $app->id . '/'. $images[2])}}"/></a></li>
                        @for($i = 3; $i < count($images)+2; $i++)
                            <li><a data-target="#pic-{{ $i }}" data-toggle="tab"><img
                                            src="{{asset('images/apps/' . $app->id . '/'. $images[$i])}}"/></a></li>
                        @endfor
                    </ul>

                </div>
                <div class="details col-md-6">
                    <h3 class="product-title">{{$app->title}}</h3>
                    <div class="rating">
                        <div class='starrr star2' id='rate'>
                            <input type='text' hidden name='rating' value='{{round($app->rate/$app->ratecount)}}'
                                   class='star2_input'/>
                        </div>
                    </div>
                    <div class="action">
                        <button class="add-to-cart btn btn-default" type="button">Download</button>
                        <button class="like btn btn-default" type="button"><span class="fa fa-heart"></span></button>
                    </div>
                    <h4 class="price">Category: <span>{{$app->category}}</span></h4>
                    <h5 class="sizes">Version:
                        <span class="size" data-toggle="tooltip" title="small">{{$app->version}}</span>
                    </h5>
                    <h5 class="sizes">Android:
                        <span class="size" data-toggle="tooltip" title="small">{{$app->android}}</span>
                    </h5>
                    <p class="product-description">
                        {{$app->description}}
                    </p>
                    <h5 class="sizes">Size:
                        <span class="size" data-toggle="tooltip" title="small">{{$app->size}} Mb</span>
                    </h5>
                    <h5 class="sizes">Company:
                        <span class="size" data-toggle="tooltip" title="small">{{$app->company}}</span>
                    </h5>
                    <h5 class="sizes">Contact:
                        <span class="size" data-toggle="tooltip" title="small">{{$app->user_email}}</span>
                    </h5>
                    <h6 class="sizes">Uploaded:
                        <span class="size" data-toggle="tooltip" title="small">{{$app->created_at}}</span>
                    </h6>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="{{route('rating.send')}}" method="POST">
                <div class="modal-content">
                    <div class="modal-header">

                        <h5 class="modal-title" id="exampleModalLabel">New rate</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @csrf
                        <input type='text' hidden name='app_id' value='{{$app->id}}'/>

                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Rate:</label>
                            <div class='starrr star2' id=''>
                                <input type='text' hidden name='rate' value='0' class='star2_input'/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Comment:</label>
                            <textarea name="comment" class="form-control" maxlength="300" id="message-text"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Send</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function (event) {

            $('.like').on('click', function () {
                alert('Liked');

            });
            $('#rate').on('click', function (e) {
                e.preventDefault();
                if ({!! Auth::check()?"1":"0" !!}) {
                    $('#showmodal').click();
                }else{
                    window.location.href = "{!! route('login') !!}";
                }

            });
            $('.add-to-cart').on('click', function (e) {
                window.location.href = '{{ asset('apps/' . $app->id .'/'. HomeController::getFile($app->id)) }}';
            });
        });
    </script>
@endsection