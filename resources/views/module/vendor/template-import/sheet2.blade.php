<table class="table" style="table-layout: fixed;">
    <thead>
        <tr>
            <td colspan="2"> </td>
            <td colspan="2" style="background-color:#d9d9d9; font-weight: bold; width:100%; text-align: center;"> Daftar kategori </td>
        </tr>
        <tr>
            <th colspan="2"> </th>
            <th style="background-color:#d9d9d9; font-weight: bold; width:125%; text-align: center;"> No </th>
            <th style="background-color:#d9d9d9; font-weight: bold; width:350%; text-align: center;"> Nama Kategori </th>
        </tr>
    </thead>
    <tbody>
        @foreach($itemCategories as $itemCategory)
            <tr>
                <td colspan="2"> </td>
                <td style="vertical-align: middle; word-wrap: break-word; text-align: center;"> {{ $itemCategory->id }} </td>
                <td style="vertical-align: middle; word-wrap: break-word; text-align: center;"> {{ $itemCategory->name }} </td>
            </tr>
        @endforeach
        <tr>
            <td colspan="2"> </td>
            <td colspan="2" style="width:100%; text-align: center;"> *)  Masukkan dengan format nomor, EX : 1,4,5 </td>
        </tr>
    </tbody>
</table>