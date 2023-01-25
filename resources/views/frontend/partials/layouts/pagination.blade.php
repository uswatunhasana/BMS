@if ($paginator->hasPages())
<ul class="justify-content-center">
  @if ($paginator->onFirstPage())
  <li class="disabled"><a><i class="bi bi-arrow-left"></i></a></li>
  @else
  <li class=""><a class="" href="{{ $paginator->previousPageUrl() }}" rel="prev"><i class="bi bi-arrow-left"></i></a></li>
  @endif

  @foreach ($elements as $element)
  @if (is_string($element))
  <li class="disabled"><a>{{ $element }}</a></li>
  @endif

  @if (is_array($element))
  @foreach ($element as $page => $url)
  @if ($page == $paginator->currentPage())
  <li class="active"><a class="" href="">{{ $page }}</a></li>
  @else
  <li class=""><a class="" href="{{ $url }}">{{ $page }}</a></li>
  @endif
  @endforeach
  @endif
  @endforeach

  @if ($paginator->hasMorePages())
  <li class=""><a class="" href="{{ $paginator->nextPageUrl() }}" rel="next"><i class="bi bi-arrow-right"></i></a></li>
  @else
  <li class="disabled"><a><i class="bi bi-arrow-right"></i></a></li>
  @endif
</ul>
@endif