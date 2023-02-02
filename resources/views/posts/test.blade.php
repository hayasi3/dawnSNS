@foreach($posts as $post)
<div class="user-status">
  <span>{{ $post->created_at }}</span>
</div>
<div class="text">
  <p>{{ $post->posts }}</p>
</div>
@endforeach