
<table>
    <thead>
        <tr>
            <th style="background-color:#d9d9d9; font-weight: bold; width:20px; text-align: center;">Tanggal</th>
            <th style="background-color:#d9d9d9; font-weight: bold; width:20px; text-align: center;">Nomor Memo</th>
            <th style="background-color:#d9d9d9; font-weight: bold; width:20px; text-align: center;">Perihal</th>
            @foreach($master_sla as $sla)
                <th style="background-color:#d9d9d9; font-weight: bold; width:20px; text-align: center;">{{$sla->process}}</th>
            @endforeach
        </tr>
    </thead>
    <tbody>
    @foreach($procs as $proc)
        <tr>
            <td>{{$proc->tanggal_caption}}</td>
            <td>{{$proc->no_memo}}</td>
            <td>{{$proc->name}}</td>
            @foreach($master_sla as $sla)
                <td>{{$sla->realisasi($proc->id, 0)}}</td>
            @endforeach
        </tr>
    @endforeach
    </tbody>
</table>