<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Activity Show</title>
</head>
<body>
    <h1>{{ $activity->title }}</h1> 
    <h3> {{ $activity->content }}</h3>
    <a href="{{ $activity->link }}">Link</a><br>
    <p>{{ $activity->points }}</p>
    <p>{{ $activity->start_at }}</p>
    <p>{{ $activity->end_at }}</p>
  <a href="{{ route('activities.index') }}">Back</a><br>
  <a href="{{ route('activities.edit', $activity->id) }}">Edit</a>

  <form action="{{ route('activities.destroy', $activity) }}" method="post">
    @csrf
    @method('DELETE')
    <button type="submit">Delete</button>
  </form>
</body>
</html>