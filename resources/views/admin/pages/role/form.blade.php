<input type="hidden" id="role_id" name="role_id" value="{{ $bol }}">
<table class="table">
    <thead>
        <tr>
            <th>Module name</th>
            <th>View</th>
            <th>Add</th>
            <th>Edit</th>
            <th>Delete</th>
            <th>Show</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            @foreach($permission as $key=>$permissions)
            <tr>
                <td>{{$key}}</td>
                @foreach($permissions as $perm)
                <td>@if(in_array($perm->name,array_column($user_permission,'name')))
                    <label class="i-checks">
                        <input type="checkbox" class="iCheck-helper" checked name="permission[]" value="{{ $perm->id }}"/>
                    </label>
                    @else
                    <label class="i-checks">
                        <input type="checkbox" class="iCheck-helper" value="{{ $perm->id }}" name="permission[]"/>
                    </label>
                    @endif
                </td>
                @endforeach
            </tr>
        @endforeach
        </tr>
    </tbody>
</table>