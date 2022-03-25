@if ($errors->any())
<div class="alert alert-danger" style="margin-right:20px;margin-left:20px;">
    <b>{{ \App\Utilities\FlashMessage::MESSAGE_ADDON[\App\Utilities\FlashMessage::DANGER] }}</b> 
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
@if (session('message'))
<div class="alert alert-{{ session('message')->level }} alert-dismissable">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <b>{{ session('message')->addon }}</b> {{ session('message')->message }}
</div>
@endif