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
                        <input type="checkbox" disabled class="iCheck-helper" checked name="permission[]" value="{{ $perm->id }}"/>
                    </label>
                    @else
                    <label class="i-checks">
                        <input type="checkbox" disabled class="iCheck-helper" value="{{ $perm->id }}" name="permission[]"/>
                    </label>
                    @endif
                </td>
                @endforeach
            </tr>
            @endforeach
        </tr>
    </tbody>
</table>
<style>
.icheckbox_square-green.checked.disabled{background-color: #2C8F7B}
</style>
<link href="{{ asset('assets/admin/css/plugins/iCheck/custom.css')}}" rel="stylesheet">
<script src="{{ asset('assets/admin/js/plugins/iCheck/icheck.min.js')}}"></script>
<script>
$(document).ready(function () {
    $('.i-checks').iCheck({
        checkboxClass: 'icheckbox_square-green',
        radioClass: 'iradio_square-green',
    });
});
</script>