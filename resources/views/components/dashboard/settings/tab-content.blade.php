<div class="tab-pane {{ $class }}" id="v-pills-{{ $tab }}" role="tabpanel"
    aria-labelledby="{{ $tab }}-tab">
    <form class="form" action="{{ route('store-settings') }}" method="POST" enctype="multipart/form-data">

        <x-panel-with-heading title="{{ $name }}">
            @csrf
            {{ $slot }}
            <input type="hidden" value="{{ $tab }}" name="action">

        </x-panel-with-heading>
        <button class="btn-main btn px-4" type="submit">حفظ</button>

    </form>

</div><!-- End Tab Box -->
