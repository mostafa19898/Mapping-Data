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


    <nav id="sidebar" style="float:left;border:0px solid #000; margin-top:-50px;margin-left:40px;padding:40px;">
        
        <div style="padding: 10px;"  class="sidebar-header">
            <h6 style="width:150px;">Managemnet Data</h6>
        </div>

        <ul class="list-unstyled components">
            <li class="active" style="padding: 10px;width:200px;" >
                <a href="{{ route('upload-form') }}"><i style="width:150px;" class="btn btn-secondary fas fa-home">Upload Data</i></a>
            </li>
            <li style="padding: 10px;width:200px;">
                <a href="#"><i style="width:150px;" class="btn btn-secondary fas fa-home">Data Matching</i></a>
            </li>

            <li style="padding: 10px;width:200px;">
                <a href="{{ route('upload') }}"><i style="width:150px;" class="btn btn-secondary fas fa-home">Data Linking</i></a>
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

        
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Upload Excel Sheet</div>

                    <div class="card-body">
                        <form action="{{ route('upload') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="excel_file">Choose Excel File:</label>
                                <input type="file" class="form-control-file" name="excel_file" accept=".xlsx, .xls">
                            </div>
                            <button type="submit" class="btn btn-primary">Upload</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
