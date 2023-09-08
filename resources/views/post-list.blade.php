<div class="row" id="ajax_data">
    @foreach ($post as $post)
        <div class="col-lg-3 col-md-6 col-sm-6 d-flex">
            <div class="card w-100 my-2 shadow-2-strong">
                <img src="https://cdn.pixabay.com/photo/2019/03/01/18/32/night-4028339_640.jpg"
                    class="card-img-top" style="aspect-ratio: 1 / 1" />
                <div class="card-body d-flex flex-column" id="postlist">
                    <h1 class="card-title">{{ $post->title }}</h1>
                    <p class="card-text">{!! $post->description !!}</p>
                    <p>Writer: {{ optional($post->writer)->write }}</p>
                    <div class="card-footer d-flex align-items-end pt-3 px-0 pb-0 mt-auto">
                        <a href="#!" class="btn btn-primary shadow-0 me-1">View Post</a>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>
