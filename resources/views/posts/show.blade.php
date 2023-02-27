@extends('layouts.app')

 @section('title', '投稿詳細')

 @section('content')
     @if (session('flash_message'))
         <p class="text-success">{{ session('flash_message') }}</p>
     @endif

     <div class="mb-2">
         <a href="{{ route('posts.index') }}" class="text-decoration-none">&lt; 戻る</a>
     </div>

     <div class="card mb-3">
         <div class="card-body">
             <h2 class="card-title fs-5">{{ $post->title }}</h2>
             <p class="card-text">{{ $post->content }}</p>
             <p>投稿'{{ $post->user->name }}'さん</p>

             <div class="d-flex">
                @if(Auth::id() === $post->user_id)
                 <a href="{{ route('posts.edit', $post) }}" class="btn btn-outline-primary d-block me-1">編集</a>

                 <form action="{{ route('posts.destroy', $post) }}" method="post" id="delete_post">
                     @csrf
                     @method('delete')
                     <button type="submit" class="btn btn-outline-danger">削除</button>
                 </form>
                @endif
             </div>
         </div>
         <h3>Comments</h3>
         <ul>
            <li>
                <form method="post" action="{{ route('comments.store', $post) }}" class="comment-form">
                    @csrf

                    <input type="text" name="body">
                    <button>投稿</button>
                </form>
            </li>
            @foreach ($post->comments()->latest()->get() as $comment)
                 <li>
                     {{ $comment->body }}
                     <form method="post" action="{{ route('comments.destroy', $comment) }}" class="delete-comment">
                        @method('DELETE')
                        @csrf

                        <button class="btn">[x]</button>
                    </form>
                 </li>
             @endforeach
         </ul>

         <script>
            'use strict';

            {
                document.getElementById('delete_post').addEventListener('submit', e => {
                    e.preventDefault();

                    if (!confirm('Sure to delete?')) {
                        return;
                    }

                    e.target.submit();
                });

                document.querySelectorAll('.delete-comment').forEach(form => {
                    form.addEventListener('submit', e => {
                        e.preventDefault();

                        if (!confirm('Sure to delete?')) {
                            return;
                        }

                        form.submit();
                    });
                });
            }
        </script>
     </div>
 @endsection
