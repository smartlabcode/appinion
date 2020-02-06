<h2> {{$user->name}} {{$user->last_name}}'s profile</h2>
<img src="/uploads/avatars/{{ $user->avatar }}" style='width:150px; height:150px; border-radius: 50%'></img>

<form enctype='multipart/form-data' action='/profile' method='POST'>
    <label>Update Profile Image</label>
    <input type='file' name='avatar'>
    <input type='hidden' name='_token' value='{{ csrf_token() }}'> <br>
    <label>Edit name: </label>
    <input type='text' name='name' value='{{Auth::User()->name}}'><br>
    <label>Edit last name: </label>
    <input type='text' name='lastname' value='{{Auth::User()->last_name}}'><br>
    <label>Edit email: </label>
    <input type='email' name='email' value='{{Auth::User()->email}}'><br>
    <label>Edit password: </label>
    <input type='password' name='password' value='{{Auth::User()->password}}'><br>
    <input type='submit' value='Potvrdi'>
</form>

<div className='form-group'>
    <button type='submit' className='form-control' id='submit' name='submit' onclick="location.href='/';" >Dashboard</button>
</div>