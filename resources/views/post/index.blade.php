@extends('layouts.master')
@section('content')

    {{-- {{ dd($data) }} --}}

    @foreach ($data as $post)
        {{-- {{dd($post->likes)}} --}}
        <div class="container">
            {{-- <h2>Card Header and Footer</h2> --}}
            <div class="card">
                <div class="card-header" style="background-color: darkgrey">Posted By {{ $post->user->name }}</div>
                <div class="card-body">{{ $post->description }}</div>
                <div class="card-footer">
                    <div class="btn-group">
                        <a class="btn btn-primary" data-id="{{ $post->id }}" id="like_btn">
                            <span class="fa fa-thumbs-up like_count">({{ $post->likes->count() }})</span> Like
                        </a>
                        <a class="btn btn-warning" data-id="{{ $post->id }}" id="comment_btn"><span
                                class='fa fa-comment'>({{ $post->comments->count() }})</span>Comment</a>
                        <a class="btn btn-secondary"><span class='fa fa-share'></span>Share</a>
                    </div>

                </div>
                <div style="display: none" class="comment_div" id="comment">
                    <div id="postComment">
                    </div>


                    <p>Comments <br><textarea name="comment_text" id="comment_text" rows="2" cols="40"></textarea><br><br>
                        <a data-id="{{ $post->id }}" id="commentPost" class="btn btn-primary btn-sm">Post</a>
                    </p>
                </div>



            </div>
        </div>


    @endforeach
    <script type="text/javascript">
        function commentAppend(data) {
            $('#postComment').append(
                '<h6>' + data + '</h6>'
            );

        }

        function renderComment(data) {
            $("#postComment").empty();
            $(data).each(function(index, data) {
                $('#postComment').append(
                    '<h6>' + data.text + '</h6>'
                );
            });

        }
        $(document).on('click', '#comment_btn', function(event) {


            var postId = $(this).data("id");

            $.ajax({
                type: 'GET',
                url: 'post_commnet/' + postId,

                success: function(data) {
                    renderComment(data);
                    $("#comment").toggle();

                }
            });



        });

        $(document).on('click', '#like_btn', function(event) {

            var postId = $(this).data("id");
            var _token = $('meta[name="csrf-token"]').attr('content');
            var _prevCount=$(this).find(".like_count").text();
            _prevCount=_prevCount.replace(/\(|\)/g, '');
            console.log(_prevCount);

            // $.ajax({
            //     type: 'POST',
            //     url: 'like/' + postId,
            //     // dataType: 'json',
            //     data: {
            //         _token: _token,
            //         'post_id': postId,
            //         // 'text': comment,

            //     },
            //     success: function(data) {
            //         // $(this).removeClass('disabled').addClass('active');
            //         // $(this).removeAttr('id');


            //     }
            // });



        });


        $(document).on('click', '#commentPost', function(event) {
            event.preventDefault();
            var postId = $(this).data("id");
            var comment = $('#comment_text').val();
            console.log(comment);
            if (comment && comment != null && comment != " ") {
                var _token = $('meta[name="csrf-token"]').attr('content');

                $.ajax({
                    type: 'POST',
                    url: 'commnet/' + postId,
                    // dataType: 'json',
                    data: {
                        _token: _token,
                        'post_id': postId,
                        'text': comment,

                    },
                    success: function(data) {
                        commentAppend(comment);
                        $('#comment_text').val(null);

                    }
                });
            } else {
                alert('comment not posted!');
            }


        });
    </script>

@endsection
