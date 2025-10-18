<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Activity Create</title>
</head>
<body>
  <h1>Activity Create</h1>
  <form action="{{ route('activities.store') }}" method="post">
    @csrf

    <input type="text" name="title" id="" placeholder="title", value="{{ old('title') }}"><br>
    @error('title')
        <p style="color: red;">{{ $message }}</p>
    @enderror

    <textarea name="content" id="" cols="30" rows="10" placeholder="content">{{ old('content') }}</textarea><br>
    @error('content')
        <p style="color: red;">{{ $message }}</p>
    @enderror

    <input type="url" name="link" id="" placeholder="link" value="{{ old('link') }}"><br>
    @error('link')
        <p style="color: red;">{{ $message }}</p>
    @enderror


    <input type="number" name="points" id="" placeholder="points" value="{{ old('points') }}"><br>
    @error('points')
        <p style="color: red;">{{ $message }}</p>
    @enderror

    <label for="type">type</label>
    <select name="type" id="type">
      <option value="1">1</option>
      <option value="2">2</option>
      <option value="3">3</option>
    </select><br>

    <label for="category">category</label>
    <select name="category" id="category">
      <option value="academic">Học thuật</option>
      <option value="sport">Thể thao</option>
      <option value="volunteer">Tình nguyện</option>
    </select><br>

    <label for="start_at">start at</label>
    <input type="datetime-local" name="start_at" id="start_at" placeholder="start_at" value="{{ old('start_at') }}"><br>
    @error('start_at')
        <p style="color: red;">{{ $message }}</p>
    @enderror

    <label for="end_at">end at</label>
    <input type="datetime-local" name="end_at" id="end_at" placeholder="end_at" value="{{ old('end_at') }}"><br>
    @error('end_at')
        <p style="color: red;">{{ $message }}</p>
    @enderror

    <button type="submit">Create</button>

  </form>
</body>
</html>