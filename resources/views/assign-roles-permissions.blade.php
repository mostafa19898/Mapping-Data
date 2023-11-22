<!-- resources/views/upload-form.blade.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Excel Sheet</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>

<body class="bg-light">
    
    <nav id="sidebar" style="float:left;border:0px solid #000; margin-top:-50px;margin-left:20px;padding:40px;">
        
        <div style="padding: 10px;"  class="sidebar-header">
            <h6 style="width:150px;">Managemnet Data</h6>
        </div>

        <ul class="list-unstyled components">
            <li class="active" style="padding: 10px;width:200px;" >
                <a href="#"><i style="width:150px;" class="btn btn-secondary fas fa-home">Upload Data</i></a>
            </li>
            <li style="padding: 10px;width:200px;">
                <a href="#"><i style="width:150px;" class="btn btn-secondary fas fa-home">Data Matching</i></a>
            </li>

            <li style="padding: 10px;width:200px;">
                <a href="{{ route('upload') }}"><i style="width:150px;" class="btn btn-secondary fas fa-home">Data Linking</i></a>
            </li>


            <li style="padding: 10px;width:200px;">
                <a href="#"><i style="width:150px;" class="btn btn-secondary fas fa-home">Reasons</i></a>
            </li>


            <li style="padding: 10px;width:200px;">
                <a  href="{{ route('show.assign.roles.permissions') }}"><i style="width:150px;" class="btn btn-secondary fas fa-home">Permission</i></a>
            </li>
 
 
          
            <li style="padding: 10px; width:200px;">
                <a style="width:200px" href="{{ route('logout') }}"><i style="width:150px;" class="btn btn-warning fas fa-home">Sign out</i></a>
            </li>
            <!-- Add more menu items as needed -->
        </ul>
    </nav>
<div class="container mt-4">

    <h5>Assign Roles and Permissions</h5>

    @if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

    <form method="POST" action="{{ route('assign.roles.permissions') }}">
        @csrf

        <div class="form-group">
            <label for="user_id">Select User:</label>
            <select name="user_id" id="user_id" class="form-control">
                @foreach ($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="roles">Assign Roles:</label>
            <select name="roles[]" id="roles" class="form-control" multiple>
                @foreach ($roles as $role)
                    <option value="{{ $role->name }}">{{ $role->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="permissions">Assign Permissions:</label>
            <select name="permissions[]" id="permissions" class="form-control" multiple>
                @foreach ($permissions as $permission)
                    <option value="{{ $permission->name }}">{{ $permission->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Assign Roles and Permissions</button>
    </form>

    @if(session('success'))
    <div class="alert alert-success mt-4">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
<div class="alert alert-success mt-4">
    {{ session('error') }}
</div>
@endif
    
</div>
</body>
</html>
