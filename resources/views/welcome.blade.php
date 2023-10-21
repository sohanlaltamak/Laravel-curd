<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
  @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
  <h2>Users</h2>
  <table class="table">
    <thead>
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Gender</th>
        <th>Status</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
        @foreach($userData['data'] as $user)
        
      <tr>
        <td>{{ $user['id'] }}</td>
        <td>{{ $user['name'] }}</td>
        <td>{{ $user['email'] }}</td>
        <td>{{ $user['gender'] }}</td>
        <td>{{ $user['status'] }}</td>
        <td><a href="{{ route('getUser', ['id' => $user['id']]) }}" class="btn btn-info">Copy To Database</a></td>
        <td><a href="{{ route('chat', ['id' => $user['id']]) }}" class="btn btn-info">Chat</a></td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>

</body>
</html>
