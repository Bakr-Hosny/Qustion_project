@extends('dashboard.layouts.master')
@section('title', dbTrans('mailbox.Read page title'))

<x-dashboard.css :links="[
    [
        'link' => 'mail/mailbox.css',
    ],
    [
        'external' => asset('dashboard/plugins/summernote/summernote-bs4.min.css'),
    ],
]" />


@section('content')

    <x-dashboard.links-bar :links="[
        [
            'name' => 'البريد الوارد',
            'link' => adminUrl('mail'),
        ],

        [
            'name' => $row->name,
        ],
    ]" />

    <section id="read-mail">
        <div class="row">

            <div class="col-xl-3">

                <a href="{{ adminUrl('mail') }}" class="btn btn-soft-main btn-block mb-3">العودة إلى البريد الوارد
                </a>

                <div class="box p-0">
                    <h6 class="p-3 mb-0">الرسائل المستلمة</h6>
                    @foreach ($listOfMessages->mails as $list)
                        <div class="px-3 list mail @if ($list->read == 0) {{ 'unread' }} @endif">
                            <a href="{{ adminUrl('mail/read/' . $list->id) }}">
                                <div class="send-by">
                                    <h6 class="mb-0 ">{{ $list->name }}</h6>
                                </div>
                                <small class="">{{ Str::limit($list->subject, 50) }}</small>
                            </a>
                        </div>
                    @endforeach
                </div><!-- Messages List -->

                @if (count($replies) > 0)
                    <div class="box p-0">
                        <h6 class="p-3 mb-0">آخر الردود</h6>
                        @foreach ($replies as $reply)
                            <div class="px-3 list mail ">

                                <a target="__blank" href="{{ adminUrl('mail/show/reply/' . $reply->id) }}">
                                    <div class="send-by">
                                        <h6 class="mb-1">{{ Str::limit($reply->subject, 40) }}</h6>
                                    </div>
                                </a><!-- reply subject -->


                                <small
                                    class=" d-block">{{ dbTrans('mailbox.By') . ' : ' . $reply->admin->full_name }}</small>


                            </div>
                        @endforeach
                    </div>
                @endif
                <!-- All Replays -->

            </div><!-- grid 1 -->

            <div class="col-xl-9">

                <div class="box px-0">

                    <div class="px-3 box-head">
                        <h6 class="name mb-0  mt-1">{{ $row->name }}
                            @if ($row->ip != null)
                                @if ($row->ip->status == '0')
                                    <small class=" badge badge-danger">تم الحظر</small>
                                @endif
                            @endif
                        </h6><!-- name -->

                        <div class="actions">
                            <a href="#reply" id="btn-reply" class="btn btn-sm btn-light bg-transparent border tip"
                                title="{{ dbTrans('mailbox.Reply') }}"><i class="fa-solid fa-reply"></i></a>
                            <!-- Reply -->

                            @if ($row->ip != null)
                                <form class="delete d-inline-block" action="{{ route('mail-multi-actions') }}"
                                    method="post">
                                    @csrf
                                    <input type="hidden" name="action" value="block">
                                    <input type="hidden" name="id[]" value="{{ $row->id }}">
                                    <button type="submit" class="tip btn btn-sm btn-light bg-transparent border"
                                        title="@if ($row->ip->status == '0') {{ 'إلغاء الحظر' }} @else {{ 'حظر IP' }} @endif "><i
                                            class="fa-solid fa-ban"></i></button>
                                </form><!-- Ban ip -->
                            @endif
                            <form class="delete d-inline-block" action="{{ route('mail-multi-actions') }}" method="post">
                                @csrf
                                <input type="hidden" name="action" value="trash">
                                <input type="hidden" name="id[]" value="{{ $row->id }}">
                                <button type="submit" data-delete="Are You Need Delete "
                                    class="tip btn btn-sm btn-light bg-transparent border" title="{{ __('delete') }}"><i
                                        class="fa-regular fa-trash-can"></i></button>
                            </form><!-- delete -->
                        </div><!-- action -->

                        <div class="clearfix"></div>
                    </div><!-- name & actions -->

                    <hr>

                    <div class="px-3">

                        <div>
                            <small class=" d-block text-secondary">البريد الإلكتروني</small>
                            {{ $row->get->email }}
                        </div>

                        <div class="my-3">
                            <small class=" d-block text-secondary">الموضوع<span class="mx-1">:</span></small>
                            {{ $row->subject }}
                        </div>

                        <small class=" d-block text-secondary">الرسالة<span class="mx-1">:</span></small>
                        <p class="mb-0">{{ $row->message }}</p>

                        <!-- end of body -->
                    </div><!-- mail body -->

                </div>

                <div id="reply">
                    <x-panel-with-heading title="Reply">

                        <form action="{{ route('reply-mail') }}" method="POST">


                            <x-form-group :properties="[
                                'input' => [
                                    'name' => '',
                                    'type' => 'text',
                                    'value' => dbTrans('mailbox.To :') . ' ' . $row->get->email,
                                    'options' => ['readonly'],
                                ],
                            ]" /><!-- subject -->


                            <x-form-group :properties="[
                                'input' => [
                                    'name' => 'subject',
                                    'type' => 'text',
                                    'value' => $row->subject,
                                    'options' => [
                                        'placeholder' => dbTrans('mailbox.Subject'),
                                        'required',
                                    ],
                                ],
                                'label' => [
                                    'text' => dbTrans('mailbox.Subject'),
                                    'options' => [
                                        'class' => 'required',
                                    ],
                                ],
                            ]" /><!-- subject -->

                            <!-- Start tokens -->
                            <div class="">
                                <div class="">
                                    <div class="">
                                        <div class="">
                                            <div class="">
                                                <div class="">
                                                    <div class="">
                                                        <input type="hidden" name="token_1"
                                                            value="{{ Crypt::encryptString($row->get->email) }}">
                                                        @csrf
                                                        <input type="hidden" name="token_2"
                                                            value="{{ Crypt::encryptString($row->get->id) }}">
                                                        <input type="hidden" name="token_3"
                                                            value="{{ Crypt::encryptString($row->id) }}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End tokens -->

                            <x-form-group :properties="[
                                'textarea' => [
                                    'name' => 'message',
                                    'type' => 'email',
                                    'options' => [
                                        'rows' => 10,
                                        'placeholder' => dbTrans('mailbox.Message'),
                                        'class' => 'editor remove-upload-image',
                                    ],
                                ],
                                'label' => [
                                    'text' => dbTrans('mailbox.Message'),
                                    'options' => [
                                        'class' => 'required',
                                    ],
                                ],
                            ]" /><!-- message -->

                            <button class="btn btn-main">{{ dbTrans('mailbox.Send Reply') }}</button>
                        </form><!-- form -->
                    </x-panel-with-heading>
                </div><!-- reply -->

            </div><!-- grid 2 -->

        </div><!-- end row -->
    </section><!-- end section -->

@endsection

<x-dashboard.js :links="[
    [
        'link' => 'mail/mailbox.js',
        'type' => 'module',
    ],
    [
        'external' => asset('dashboard/plugins/summernote/summernote-bs4.min.js'),
    ],
]" />
