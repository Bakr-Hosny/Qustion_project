@if (isset($details['sub_menu']))
    <li class="side-item">
        <a>
            <span class="side-icon">{!! $details['icon'] !!}</span>
            <span class="side-name-lable">{{ $details['name'] }}</span>
            <span
                class="arrow-icon @foreach ($details['sub_menu'] as $item) {{ adminActiveLink($item['link'], 'rotate-icon') }} @endforeach"><i
                    class="fas fa-angle-down"></i></span>
        </a>
        <ul
            class="sub-menu @foreach ($details['sub_menu'] as $item) {{ adminActiveLink($item['link'], 'show') }} @endforeach">
            @foreach ($details['sub_menu'] as $item)
                @if (isset($item['can']) && $item['can'] != null)
                    @can($item['can'])
                        <li class="sub-item">
                            <a class="{{ adminActiveLink($item['link']) }}" href="{{ $item['link'] }}">
                                <span class="side-icon"></span>
                                <span class="side-name-lable">{{ $item['name'] }}</span>
                            </a>
                        </li>
                    @endcan
                @else
                    <li class="sub-item">
                        <a class="{{ adminActiveLink($item['link']) }}" href="{{ $item['link'] }}">
                            <span class="side-icon"></span>
                            <span class="side-name-lable">{{ $item['name'] }}</span>
                        </a>
                    </li>
                @endif
            @endforeach
        </ul>
    </li>
@else
    <li class="side-item">
        <a class="{{ adminActiveLink($details['link']) }}" href="{{ $details['link'] }}">
            <span class="side-icon">{!! $details['icon'] !!}</span>
            <span class="side-name-lable">{{ $details['name'] }}</span>
        </a>
    </li>
@endif
