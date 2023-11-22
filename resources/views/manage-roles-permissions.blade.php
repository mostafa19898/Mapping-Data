
namespace App\Http\Controllers;
    <div class="container">
        <h2>Assign Roles and Permissions</h2>

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
    </div>

