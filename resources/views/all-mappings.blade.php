<!-- resources/views/all-mappings.blade.php -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Mappings</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>

<body class="bg-light">

    <nav id="sidebar" style="float:left;border:0px solid #000; margin-top:-60px;margin-left:20px;padding:40px;">
        
        <div style="padding: 10px;"  class="sidebar-header">
            <h6 style="width:150px;">Managemnet Data</h6>
        </div>

        <ul class="list-unstyled components">
            <li class="active" style="padding: 10px;width:200px;" >
                <a href="{{ route('upload-form') }}"><i style="width:150px;" class="btn btn-secondary fas fa-home">Upload Data</i></a>
            </li>
            <li style="padding: 10px;width:200px;">
                <a href="{{ route('all-mapping') }}"><i style="width:150px;" class="btn btn-secondary fas fa-home">Data Matching</i></a>
            </li>

            <li style="padding: 10px;width:200px;">
                <a href=""><i style="width:150px;" class="btn btn-secondary fas fa-home">Data Linking</i></a>
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

    <div class="container mt-5">

        <h5>All Mappings</h5>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Main Data</th>
                    <th>Description</th>
                    <th>Reason</th>
                    <!-- Add other columns as needed -->
                </tr>
            </thead>
            <tbody>
                @if(!@empty($mappings))
                     @foreach ($mappings as $mapping)
                     <tr>
                    <td>{{ $mapping->mainData->description }}</td>
                    <td>{{ $mapping->description }}</td>
                    <td>{{ $mapping->reason->name }}</td>
                    </tr>
                     @endforeach
                @else
                  <tr><td>Data are not found !!</td></tr>
                @endif
            </tbody>
        </table>
    </div>

</body>

</html>
