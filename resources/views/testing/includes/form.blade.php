@if($errors)
    @if($errors->count())

        <ul class="server-errors">
            <li>Solve Following Errors!</li>
            <li>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </li>
        </ul>

    @endif
@endif
{{csrf_field()}}
<input type="hidden" name="id" value="{{$user->id}}">
<div class="form-group">
    <label for="pwd">First Name</label>
    <input type="text" id="first_name" name="first_name" class="form-control" value="{{$user->first_name}}">
</div>

<div class="form-group">
    <label for="pwd">Last Name:</label>
    <input type="text" id="last_name" name="last_name"  class="form-control" value="{{$user->last_name}}">
</div>

<div class="form-group">
    <label for="pwd">Name:</label>
    <input type="text" id="last_name" name="name"  class="form-control" value="{{$user->last_name}}">
</div>

<div class="form-group">
    <label for="pwd">Username:</label>
    <input type="text" id="username" name="username"  class="form-control" value="{{$user->last_name}}">
</div>

<div class="form-group">
    <label for="pwd">Email:</label>
    <input type="text" id="email" name="email"  class="form-control" value="{{$user->email}}">
</div>

<div class="form-group">
    <label for="pwd">Password:</label>
    <input type="password" id="password" name="password"  class="form-control" >
</div>

<div class="form-group">
    <input type="submit" id="btnSave" name="btnSave"  value="Save User">
</div>