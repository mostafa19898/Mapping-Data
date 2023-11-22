<!-- resources/views/partials/sidebar.blade.php -->

<nav id="sidebar" style="float:left;border:0px solid #000; margin-top:90px;margin-left:40px;padding:40px;">
    <div style="padding: 10px;" class="sidebar-header">
        <h6 style="width:150px;">Managemnet Data</h6>
    </div>

    <ul class="list-unstyled components">
        <!-- Add your menu items here -->
        <li class="active" style="padding: 10px;width:200px;">
            <a href="#"><i style="width:150px;" class="btn btn-secondary fas fa-home">Upload Data</i></a>
        </li>
        <li style="padding: 10px;width:200px;">
            <a href="{{ route('all-mapping') }}"><i style="width:150px;" class="btn btn-secondary fas fa-home">Data Matching</i></a>
        </li>
        <li style="padding: 10px;width:200px;">
            <a href="{{ route('upload') }}"><i style="width:150px;" class="btn btn-secondary fas fa-home">Data Linking</i></a>
        </li>
        <li style="padding: 10px;width:200px;">
            <a href="{{ route('show.assign.roles.permissions') }}"><i style="width:150px;" class="btn btn-secondary fas fa-home">Permission</i></a>
        </li>
        <li style="padding: 10px; width:200px;">
            <a style="width:200px" href="{{ route('logout') }}"><i style="width:150px;" class="btn btn-warning fas fa-home">Sign out</i></a>
        </li>
        <!-- Add more menu items as needed -->
    </ul>
</nav>
