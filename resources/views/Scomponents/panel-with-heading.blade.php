<div class="panel-with-heading box px-0 mb-4 {{ $class }}">
    <h5 class="box-title">{{ $title }}</h5><!-- Panel Title -->
    <hr><!-- hr -->
    <!-- Start Data --->
    <div class="box-body {{ $body }}">

        {{ $slot }}

    </div>
    <!-- End Data --->
</div>
