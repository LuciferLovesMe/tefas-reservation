@props(['earlyPages', 'currentPage'])

<ol class="flex flex-wrap pt-1 mr-12 bg-transparent rounded-lg sm:mr-16">
    <li class="text-sm leading-normal">
        @foreach ($earlyPages as $item)
            <a class="text-white opacity-50" href="{{ $item['link'] }}">{{ $item['title'] }}</a>
        @endforeach
    </li>
    <li class="text-sm pl-2 capitalize leading-normal text-white before:float-left before:pr-2 before:text-white before:content-['/']" aria-current="page">{{ $currentPage }}</li>
</ol>
<h6 class="mb-0 font-bold text-white capitalize">{{ $currentPage }}</h6>