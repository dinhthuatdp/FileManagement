@if ($paginator->lastItem() >= 1)
        @if ($paginator->lastItem() >= 2)
                <a href="http://localhost:8080/demo1/public/yolo/files" >
                    <<
                </a>
        @endif
        @if($paginator->currentPage() >= 1 & $paginator->currentPage() < $paginator->lastItem())
            <a href="{{ $paginator->url($paginator->currentPage() - 1) }}" >
                <
            </a>
        @endif
        @for($i = max($paginator->currentPage() - 2, 1); $i <= min(max($paginator->currentPage()-2, 1) + 2,$paginator->lastItem()); $i++)
                    <!--<a href="{{ url()->current().'\\page\\'.($i) }}">{{ $i }}</a>-->
                    @if ($paginator->currentPage() == $i)
                        <a href="{{$paginator->url($paginator->currentPage()) }}">{{ $i }}</a>
                    @else
                        <a href="{{$paginator->url($paginator->currentPage())}}">{{ $i }}</a>
                    @endif
        @endfor
        
        @if ($paginator->currentPage() < $paginator->lastItem())
            
                <a href="{{ $paginator->url($paginator->currentPage() + 1) }}" >
                    >
                </a>
        @endif
        
        @if ($paginator->lastItem() >= 2)
            <a href="http://localhost:8080/demo1/public/yolo/files/page/" >
                >>
            </a>
        @endif
@endif