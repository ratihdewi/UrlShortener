
<table>
    <thead>
        <tr>
            <th style="background-color:#d9d9d9; font-weight: bold; width:215%; vertical-align: middle; text-align: center; word-wrap: break-word;">Tanggal</th>
            <th style="background-color:#d9d9d9; font-weight: bold; width:275%; vertical-align: middle; text-align: center; word-wrap: break-word;">Nomor Memo</th>
            <th style="background-color:#d9d9d9; font-weight: bold; width:215%; vertical-align: middle; text-align: center; word-wrap: break-word;">Perihal</th>
            @foreach($master_sla as $sla)
                <th style="background-color:#d9d9d9; font-weight: bold; width:150%; vertical-align: middle; text-align: center; word-wrap: break-word;">{{$sla->process}}</th>
            @endforeach
        </tr>
    </thead>
    <tbody>
    @foreach($procs as $proc)
        <tr>
            <td style="vertical-align: middle; text-align: center; word-wrap: break-word;">{{$proc->tanggal_caption}}</td>
            <td style="vertical-align: middle; text-align: center; word-wrap: break-word;">{{$proc->no_memo}}</td>
            <td style="vertical-align: middle; text-align: center; word-wrap: break-word;">{{$proc->name}}</td>
            @foreach($master_sla as $sla)
                <td style="vertical-align: middle; text-align: center; word-wrap: break-word;">{{$sla->realisasi($proc->id, 0)}}</td>
            @endforeach
        </tr>
    @endforeach
    </tbody>
</table>