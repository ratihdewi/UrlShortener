<!DOCTYPE html>
<html>
    <head>
      @include('partial.head')  
      <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="nav-fixed">
        
            
        <div id="layoutSidenav_content">
            <main>
                
                <header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
                    <div class="container-fluid">
                        <div class="page-header-content">
                            <div class="row align-items-center justify-content-between pt-3">
                                <div class="col-auto mb-3">
                                </div>
                            </div>
                        </div>
                    </div>
                </header>
                <!-- Main page content-->
                <div class="container mt-4">
                @php $date = \Carbon\Carbon::now()->format('Y-m-d') @endphp
                @if($procurement->tanggal_batas_tender_terbuka < $date)
                    <b>Link expired</b>
                @else
                @include('partial.alert')
                    <div class="row">
                        <div class="col-xl-12">
                            <!-- Account details card-->
                            <div class="card mb-4">
                                <div class="card-body">
                                    Perihal: {{$procurement->name}}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-12">
                            <!-- Account details card-->
                            <div class="card mb-4">
                                <div class="card-body">
                                    <form action="{{route('procurement.tenderterbuka.store')}}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <div class="col-xl-6">
                                                <!-- Form Group (username)-->
                                                <div class="form-group">
                                                    <label class="small mb-1">No Penawaran</label>
                                                    <input name="no_penawaran" required="true" value="{{ old('no_penawaran') }}" class="form-control{{ $errors->has('no_penawaran') ? ' is-invalid' : '' }}" type="text"/>
                                                    @if ($errors->has('no_penawaran'))
                                                        <span class="small" style="color:red" role="alert">
                                                            <strong>{{ $errors->first('no_penawaran') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                                <div class="form-group">
                                                    <label class="small mb-1">Nama Vendor </label><label class="small mb-1" style="color:red">*</label>
                                                    <input name="name" required="true" value="{{ old('name') }}" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" type="text"/>
                                                    @if ($errors->has('name'))
                                                        <span class="small" style="color:red" role="alert">
                                                            <strong>{{ $errors->first('name') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                                <div class="form-group">
                                                    <label class="small mb-1">Alamat Vendor </label><label class="small mb-1" style="color:red">*</label>
                                                    <textarea name="address" rows="4" class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}">{{ old('address') }}</textarea>
                                                    @if ($errors->has('address'))
                                                        <span class="small" style="color:red" role="alert">
                                                            <strong>{{ $errors->first('address') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                                <div class="form-group">
                                                    <label class="small mb-1">No. Telepon </label><label class="small mb-1" style="color:red">*</label>
                                                    <input name="no_telp" required="true" value="{{ old('no_telp') }}" class="form-control{{ $errors->has('no_telp') ? ' is-invalid' : '' }}" type="number"/>
                                                    @if ($errors->has('no_telp'))
                                                        <span class="small" style="color:red" role="alert">
                                                            <strong>{{ $errors->first('no_telp') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                                <div class="form-group">
                                                    <label class="small mb-1">Alamat Email </label><label class="small mb-1" style="color:red">*</label>
                                                    <input name="email" required="true" value="{{ old('email') }}" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" type="email"/>
                                                    @if ($errors->has('email'))
                                                        <span class="small" style="color:red" role="alert">
                                                            <strong>{{ $errors->first('email') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-xl-6">
                                                <div class="form-group">
                                                    <label class="small mb-1">Nomor Rekening </label><label class="small mb-1" style="color:red">*</label>
                                                    <input name="no_rek" required="true" value="{{ old('no_rek') }}" class="form-control{{ $errors->has('no_rek') ? ' is-invalid' : '' }}" type="number"/>
                                                    @if ($errors->has('no_rek'))
                                                        <span class="small" style="color:red" role="alert">
                                                            <strong>{{ $errors->first('no_rek') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                                <div class="form-group">
                                                    <label class="small mb-1">Nama Bank </label><label class="small mb-1" style="color:red">*</label>
                                                    <input name="bank_name" required="true" value="{{ old('bank_name') }}" class="form-control{{ $errors->has('bank_name') ? ' is-invalid' : '' }}" type="text"/>
                                                    @if ($errors->has('bank_name'))
                                                        <span class="small" style="color:red" role="alert">
                                                            <strong>{{ $errors->first('bank_name') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                                <div class="form-group">
                                                    <label class="small mb-1"> NPWP / TIN (Tax Identification Number) </label><label class="small mb-1" style="color:red">*</label>
                                                    <input name="no_tax" required="true" value="{{ old('no_tax') }}" class="form-control{{ $errors->has('no_tax') ? ' is-invalid' : '' }}" type="text"/>
                                                    @if ($errors->has('no_tax'))
                                                        <span class="small" style="color:red" role="alert">
                                                            <strong>{{ $errors->first('no_tax') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                                <div class="form-group">
                                                    <input name="procurement_id" value="{{$procurement->id}}" type="hidden"/>
                                                    <label class="small mb-1">Unggah File Penawaran Harga (.pdf) </label>
                                                    <input name="file_penawaran" required="true" value="{{ old('file_penawaran') }}" class="form-control{{ $errors->has('file_penawaran') ? ' is-invalid' : '' }}" type="file"/>
                                                    @if ($errors->has('file_penawaran'))
                                                        <span class="small" style="color:red" role="alert">
                                                            <strong>{{ $errors->first('file_penawaran') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                                <div class="form-group">
                                                    <label class="small mb-1">Unggah Data Penawaran Barang (.xlxs) </label>
                                                    <input name="data_penawaran" required="true" value="{{ old('data_penawaran') }}" class="form-control{{ $errors->has('data_penawaran') ? ' is-invalid' : '' }}" type="file"/>
                                                    @if ($errors->has('data_penawaran'))
                                                        <span class="small" style="color:red" role="alert">
                                                            <strong>{{ $errors->first('data_penawaran') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                                
                                            </div>
                                        </div>
                                        <button class="btn btn-primary float-right" type="submit">Simpan</button>
                                        <a href="{{ url()->previous() }}" class="btn btn-light float-right" style="margin-right:10px">Kembali</a>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                </div>
            </main>
            <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
            @include('partial.jsfooter')
        </div>
    </body>
</html>

