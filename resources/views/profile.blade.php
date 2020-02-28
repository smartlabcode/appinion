<h2> {{$user->name}} {{$user->last_name}}'s profile</h2>
<img id='profile-image' src="/uploads/avatars/{{ $user->avatar }}" style='width:150px; height:150px; border-radius: 50%'></img>

<form enctype='multipart/form-data' action='/profile' method='POST'>
    <label>Update Profile Image</label>
    <input type='file' name='avatar' onchange="readURL(this)">
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

<div class='form-group'>
    <button type='submit' class='form-control' id='submit' name='submit' onclick="location.href='/profile';" >Poništi izmjene</button>
</div>

<div class='form-group'>
    <button type='submit' class='form-control' id='submit' name='submit' onclick="location.href='/';" >Dashboard</button>
</div>

<script src="https://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
        crossorigin="anonymous"></script>
		
<script>

    function readURL(input){
        var reader = new FileReader();

        reader.onload = function(e){
            $('#profile-image')
                .attr('src', e.target.result);
        };

        reader.readAsDataURL(input.files[0]);
    }

    function stopChanges(){

    }

</script>