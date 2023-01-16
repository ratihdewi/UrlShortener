<table class="table" style="table-layout: fixed;">
    <thead>
        <tr>
            <th colspan="2"> </th>
            <th style="background-color:#d9d9d9; font-weight: bold; width:100%; text-align: center;"> No </th>
            <th style="background-color:#d9d9d9; font-weight: bold; width:215%; text-align: center;"> Nama Kategori </th>
        </tr>
    </thead>
    <tbody>
        @foreach($itemCategories as $itemCategory)
            <tr>
                <td colspan="2"> </td>
                <td style="vertical-align: middle; word-wrap: break-word;"> {{ $itemCategory->id }} </td>
                <td style="vertical-align: middle; word-wrap: break-word;"> {{ $itemCategory->name }} </td>
            </tr>
        @endforeach
    </tbody>
</table>