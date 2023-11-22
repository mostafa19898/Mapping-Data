<!-- resources/views/display-columns.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        /* Add your custom styles here */
        body {
            font-family: 'Arial', sans-serif;
        }

        #content {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        #sidebar {
            height: 100%;
            width: 250px;
            padding-top: 20px;
            background-color: #f8f9fa;
            position: fixed;
        }

        #sidebar .nav-link {
            color: #000;
        }

        #main-content {
            padding: 15px;
            margin-left: 250px;
            transition: margin-left 0.3s;
        }

        #sidebarCollapse {
            cursor: pointer;
        }
    </style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Companies  Data  Uploaded</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <!-- Include Bootstrap Select CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.min.css">
</head>
<body>
    @include('partials.sidebar')
    <div class="container mt-5">
        <br/>
        <div id="result-container">
            <!-- هنا سيتم عرض النتائج -->
        </div>
        <form style="width: 100%">
            @csrf
            <button style="margin-bottom: 5px;" type="button" class="btn btn-primary" id="saveButton">Linking Data</button>
            <table class="center mx-auto table table-bordered" style="width:100%;">
                @include('partials.table-headers', ['headers' => $headers, 'mainData' => $mainData, 'reasons' => $reasons])
            </table>
        </form>
    </div>

 <!-- Include jQuery -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<!-- Include Popper.js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<!-- Include Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<!-- Include Bootstrap Select JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    @include('partials.javascript')
</body>
</html>
