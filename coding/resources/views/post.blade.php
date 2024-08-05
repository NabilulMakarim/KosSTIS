@extends('layout.main')

@section('container')

    <div class="container">
        <div class="row justify-content-center mb-5">
            <div class="col-lg-9">
                <h2>{{ $post->title }}</h2>

                <h5>By: <a href="/blog?author={{ $post->author->username }}">{{ $post->author->name }}</a> in <a href="/blog?category={{ $post->category->slug }}">{{ $post->category->name }}</a></h5>
                
                @if ($post->image)
                    <div style="max-height: 350px; overflow:hidden">
                        <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->category->name }}" class="img-fluid"> 
                    </div>
                @else   
                    <img src="https://source.unsplash.com/1200x400?{{ $post->category->name }}" alt="{{ $post->category->name }}" class="img-fluid"> 
                @endif
                
                <article class="my-3 fs-5">
                    <p>tag html main</p>
                    {!! $post->body !!} {{--tag html di sini main --}}
                </article>
                

                
                <p>tag html ga main</p>
                {{  $post->body }} {{--tag html di sini ga main --}}
    </article>

    <a href="/blog" class="d-block mt-3">Back to Posts</a>
            </div>
        </div>
    </div>

    <article>
        

@endsection