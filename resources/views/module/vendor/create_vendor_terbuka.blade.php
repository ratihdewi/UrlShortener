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
                                    <b>SANDRA</b>
                                    <font style="font-size:8pt;">E-procurement Universitas Pertamina</font>
                                </div>
                            </div>
                        </div>
                    </div>
                </header>
		<!-- Main page content-->
 <h1 style="font-family:verdana; text-align: center;">Form Pendaftaran Vendor<h1>
                <div class="container mt-4">
                @include('partial.alert')
		    <div class="row">
                        <div class="col-xl-12">
                            <!-- Account details card-->
			    <div class="card mb-4">
                                <div class="card-body">
                                    <form action="{{route('vendor.tenderterbuka.store')}}" method="POST">
                                        @csrf
                                        <div class="row">
                                            <div class="col-xl-6">
                                                <div class="form-group">
                                                    <label class="small mb-1">Nama Vendor </label>
                                                    <input name="name" required="true" value="{{ old('name') }}" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" type="text"/>
                                                    @if ($errors->has('name'))
                                                        <span class="small" style="color:red" role="alert">
                                                            <strong>{{ $errors->first('name') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                                <div class="form-group">
                                                    <label class="small mb-1">Alamat Vendor </label>
                                                    <textarea name="address" rows="4" class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}">{{ old('address') }}</textarea>
                                                    @if ($errors->has('address'))
                                                        <span class="small" style="color:red" role="alert">
                                                            <strong>{{ $errors->first('address') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                                <div class="form-group">
                                                    <label class="small mb-1">No. Telepon </label>
                                                    <input name="no_telp" required="true" value="{{ old('no_telp') }}" class="form-control{{ $errors->has('no_telp') ? ' is-invalid' : '' }}" type="number"/>
                                                    @if ($errors->has('no_telp'))
                                                        <span class="small" style="color:red" role="alert">
                                                            <strong>{{ $errors->first('no_telp') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                                <div class="form-group">
                                                    <label class="small mb-1">Alamat Email </label>
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
                                                    <label class="small mb-1">Nama PIC </label>
                                                    <input name="pic_name" required="true" value="{{ old('pic_name') }}" class="form-control{{ $errors->has('pic_name') ? ' is-invalid' : '' }}" type="text"/>
                                                    @if ($errors->has('pic_name'))
                                                        <span class="small" style="color:red" role="alert">
                                                            <strong>{{ $errors->first('pic_name') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                                <div class="form-group">
                                                    <label class="small mb-1">Bidang Usaha</label>
                                                    <select class="form-control select2" name="category_id[]" multiple="" style="width:100%">
                                                        @foreach($categories as $category)
                                                            <option value="{{$category->id}}">{{$category->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label class="small mb-1">Nomor Rekening </label>
                                                    <input name="no_rek" required="true" value="{{ old('no_rek') }}" class="form-control{{ $errors->has('no_rek') ? ' is-invalid' : '' }}" type="number"/>
                                                    @if ($errors->has('no_rek'))
                                                        <span class="small" style="color:red" role="alert">
                                                            <strong>{{ $errors->first('no_rek') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                                <div class="form-group">
                                                    <label class="small mb-1">Nama Bank </label>
                                                    <input name="bank_name" required="true" value="{{ old('bank_name') }}" class="form-control{{ $errors->has('bank_name') ? ' is-invalid' : '' }}" type="text"/>
                                                    @if ($errors->has('bank_name'))
                                                        <span class="small" style="color:red" role="alert">
                                                            <strong>{{ $errors->first('bank_name') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                                <div class="form-group">
                                                    <label class="small mb-1"> NPWP / TIN (Tax Identification Number) </label>
                                                    <input name="no_tax" required="true" value="{{ old('no_tax') }}" class="form-control{{ $errors->has('no_tax') ? ' is-invalid' : '' }}" type="text"/>
                                                    @if ($errors->has('no_tax'))
                                                        <span class="small" style="color:red" role="alert">
                                                            <strong>{{ $errors->first('no_tax') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                            <h4>*Pilih bidang usaha yang sesuai, Bisa memilih lebih dari 1 bidang usaha</h4>
                                        </div>
                                        <button class="btn btn-primary float-right" type="submit">Simpan</button>
                                        <a href="{{ url()->previous() }}" class="btn btn-light float-right" style="margin-right:10px">Kembali</a>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
            <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
            @include('partial.jsfooter')
        </div>
    </body>
</html>

