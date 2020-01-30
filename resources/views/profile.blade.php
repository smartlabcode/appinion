<h2> {{$user->name}} {{$user->last_name}}'s profile</h2>
<img src="/uploads/avatars/{{ $user->avatar }}" style='width=150, height=150px'></img>

<form enctype='multipart/form-data' action='/profile' method='POST'>
    <label>Update Profile Image</label>
    <input type='file' name='avatar'>
    <input type='hidden' name='_token' value='{{ csrf_token() }}'>
    <input type='submit'>
</form>