@foreach ($mails as $row) <div class="mail px-3 @if ($row->read==0){{'unread'}}@endif"> <div class="row"> <div class=" col-xl-3 col-lg-4 col-md-3"> <div class="checkboxes d-inline-block"> <input form="form-actions" type="checkbox" name="id[]" value="{{$row->id}}" id="{{$row->id}}"> </div><div class="send-by d-inline-block"> <a href="{{adminUrl('mail/read/' . $row->id)}}"> <h6 class="mb-0">{{$row->name}}</h6> </a> </div></div><div class="content col-xl-7 col-lg-8 col-md-7"> <p class="mb-0">{{Str::limit($row->subject, 80, '...')}}</p></div><div class="send-at offset-xl-0 col-xl-2 offset-lg-4 col-lg-4 col-md-2"> <small>{{parseTime($row->created_at)}}</small> </div></div></div>@endforeach