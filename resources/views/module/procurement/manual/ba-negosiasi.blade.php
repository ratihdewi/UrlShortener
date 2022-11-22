<div class="accordion" id="accordionExample">
	<div class="card" style="margin: 1.5%">
		<div class="card-header" id="headingOne">
			<h2 class="mb-0">
				<button class="btn text-left" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
					Collapsible Group Item #1
				</button>
			</h2>
		</div>
		<div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
			<div class="card-body" style="border: none !important">
				<span class="form-row mb-2">
					<div class="col">
						<label class="small">Hari/Tanggal </label>
						<input name="date" class="form-control" required="true" type="date"/>
					</div>
					<div class="col">
						<label class="small">Waktu </label>
						<input name="time" class="form-control" required="true" type="time"/>
					</div>
				</span>

				<span class="form-row mb-2 mt-3">
					<div class="col">
						<label class="small"> Tempat </label>
						<input name="location" class="form-control" required="true" type="ztext"/>
					</div>
					<div class="col">
						<label class="small">Peserta Rapat Vendor/Eksternal</label> <label style="font-size:8pt" class="small mb-1">Pisahkan nama dengan tanda koma ","</label>
						<input name="peserta_eksternal" class="form-control" required="true" type="text"/>
					</div>
				</span>

				<div class="form-row mb-2 mt-3">
					<div class="col-xl-12">
						<div class="form-group">
							<label class="small">Peserta Rapat Internal</label>
							<select class="form-control select2" name="peserta_id[]" multiple="" style="width:100%">
								@foreach($pesertas as $peserta)
								<option value="{{$peserta->id}}">{{$peserta->name}}</option>
								@endforeach
							</select>
						</div>
					</div>
				</div>

				<div class="form-row mb-2 mt-3">
					<div class="col-xl-12">
						<div class="form-group">
							<label class="small mb-1">Hasil Rapat </label>
							<textarea name="meeting_result" rows="4" class="form-control{{ $errors->has('meeting_result') ? ' is-invalid' : '' }}">{{ old('meeting_result') }}</textarea>
						</div>
					</div>
				</div>

				<div class="form-row mb-2 mt-3">
					<div class="col">
						<div class="form-group">
							<label class="small mb-1">Upload Dokumentasi Meeting (.jpg | .png) </label>
							<input name="photo_doc" required="true" class="form-control" type="file"/>
						</div>
					</div>
					<div class="col">
						<div class="form-group">
							<label class="small mb-1">Negosiasi </label>(Rp)
							<input name="negosiasi" required="true" class="form-control" type="text"/>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

