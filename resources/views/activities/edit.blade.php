<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Edit Activity</title>
</head>
<body>
  <h1>Edit Activity</h1>

  <form action="{{ route('activities.update', $activity->id) }}" method="post">

    @csrf
    @method('PUT')

    <input type="text" name="title" id="" placeholder="title" value="{{ old('title', $activity->title) }}"><br>
    @error('title')
        <p style="color: red;">{{ $message }}</p>
    @enderror

    <textarea name="content" id="" cols="30" rows="10" placeholder="content">{{ old('content', $activity->content) }}</textarea><br>
    @error('content')
        <p style="color: red;">{{ $message }}</p>
    @enderror
    <input type="url" name="link" id="" placeholder="link" value="{{ old('link', $activity->link) }}"><br>
    @error('link')
        <p style="color: red;">{{ $message }}</p>
    @enderror

    <input type="number" name="points" id="" placeholder="points" value="{{ old('points', $activity->points) }}"><br>
    @error('points')
        <p style="color: red;">{{ $message }}</p>
    @enderror

    <label for="type">type</label>
    <select name="type" id="type">
      <option value="1" {{ $activity->type == 1 ? 'selected' : '' }}>1</option>
      <option value="2" {{ $activity->type == 2 ? 'selected' : '' }}>2</option>
      <option value="3" {{ $activity->type == 3 ? 'selected' : '' }}>3</option>
    </select><br>

    <label for="category">category</label>
    <select name="category" id="category">
      <option value="academic" {{ $activity->category == 'academic' ? 'selected' : '' }}>Học thuật</option>
      <option value="sport" {{ $activity->category == 'academic' ? 'selected' : '' }}>Thể thao</option>
      <option value="volunteer" {{ $activity->category == 'academic' ? 'selected' : '' }}>Tình nguyện</option>
    </select><br>

    <label for="start_at">start at</label>
    <input type="datetime-local" name="start_at" id="start_at" placeholder="start_at" value="{{ old('start_at', $activity->start_at) }}"><br>
    @error('start_at')
        <p style="color: red;">{{ $message }}</p>
    @enderror

    <label for="end_at">end at</label>
    <input type="datetime-local" name="end_at" id="end_at" placeholder="end_at" value="{{ old('end_at', $activity->end_at) }}"><br>
    @error('end_at')
        <p style="color: red;">{{ $message }}</p>
    @enderror

    <button type="submit">Save</button>
  </form>
</body>
</html>