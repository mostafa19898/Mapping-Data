<thead>
    <tr style="text-align:center">
        <th>Code</th>
        <th></th>
        <th>list 1</th>
        <th></th>
        <th>list 2</th>
        <th></th>
        <th>list 3</th>
        <th></th>
        <th>Main Data</th>
        <th>Reasons</th>
    </tr>
</thead>

<tbody>
    @foreach ($headers as $row)
        <tr>
            @foreach ($row as $columnValue)
                @if ($columnValue !== null)
                    <td>{{ $columnValue }}</td>
                    <td>
                        <input style="width: 20px; height: 20px; background-color: blue;" type="checkbox" name="selected_columns[]" value="{{ $columnValue }}">
                    </td>
                @endif
            @endforeach
            <td>
                <select style="" class="selectpicker" data-live-search="true" name="main_data_options[]" title="Choose an option">
                    @foreach ($mainData as $id => $description)
                        <option value="{{ $description->id }}">{{ $description->description }}</option>
                    @endforeach
                </select>
            </td>
            <td>
                <select style="" class="selectpicker" data-live-search="true" name="reasons_options[]" title="Choose an option">
                   
                    @foreach ($reasons as $id => $reason)
                        <option value="{{ $reason->id }}">{{ $reason->name }}</option>
                    @endforeach
                </select>
            </td>
        </tr>
    @endforeach
</tbody>