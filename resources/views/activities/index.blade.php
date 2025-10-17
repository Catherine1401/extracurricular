<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Activity Management</title>
</head>
<body>
  <h1>Activity Management Index</h1>
  <a href="{{ route('activities.create') }}">Create Activity</a><br>

  @foreach ($activities as $activity)
      <a href="{{ route('activities.show', $activity->id) }}">{{ $activity->title }}</a><br>
  @endforeach
</body>
</html>