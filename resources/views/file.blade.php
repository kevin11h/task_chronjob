<form  action="{{route('/directory')}}" method="get">
    <td ><input type="text" placeholder="Name" name="name" class="form-control"></td>
    <td>
        <input type="submit" class="form-control col-md-4" value="Add Fruit">
    </td>
    {{csrf_field()}}
</form>
