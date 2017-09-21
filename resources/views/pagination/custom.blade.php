@if ($paginator->hasPages())

    <ul class="pager">
        @if ($paginator->currentPage() > 1)
        <ul class="pagination">
            <li>
                <a href="{{ $paginator->url(1) }}"><<</a></li>
            </li>
        </ul>
        @else
        <ul class="pagination">
            <li>
                <span>
                    <<
                </span>
            </li>
        </ul>
        @endif
        
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
        <ul class="pagination"><li>
            <span class="disabled" style="display:none"><span>← Previous</span></span>
            </li>
        </ul>
        @else
        <ul class="pagination">
            <li>
                <a href="{{ $paginator->previousPageUrl() }}" rel="prev">←</a></li>
            </li>
        </ul>
        @endif
        
        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <span class="disabled"><span>{{ $element }}</span></span>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @if ($paginator->lastPage() < 0)
                    <span class="disabled"><span>...</span></span>
                @else

                @if ($paginator->onFirstPage())
                    <?php
                        $start = 1;
                        $end = $paginator->currentPage() + 2;
                    ?>
                @elseif ($paginator->currentPage() == $paginator->lastPage())
                    <?php 
                        $start = $paginator->currentPage() - 2;
                        $end = $paginator->currentPage();
                    ?>
                @else
                    <?php 
                        $start = max(1, $paginator->currentPage() - 1);
                        $end = min($paginator->currentPage() + 1, $paginator->lastPage());
                    ?>
                @endif
                    <!--{{var_dump($start.'-'.$end)}}-->   
                    @for($x = $start; $x <= $end; $x++) 
                        @if ($x == $paginator->currentPage())
                            <ul class="pagination">
                                <li class="active">
                                    <a>{{ $x }}</a>
                                </li>
                            </ul>
                        @else
                            <ul class="pagination">
                                <li>
                                    <a href="{{ $paginator->url($x) }}">{{ $x }}</a>
                                </li>
                            </ul>
                        @endif
                    @endfor
                
<!--                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span class="active my-active" style="background-color: #5cb85c !important;color: white !important;border-color: #5cb85c !important;">
                                <span>
                                    {{ $page }}
                                </span>
                            </span>
                        @else
                            <span>
                                <a href="{{ $paginator->url($page) }}">{{ $page }}</a>
                            </span>
                        @endif
                    @endforeach-->
                @endif
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <ul class="pagination">
                <li>
                    <a href="{{ $paginator->nextPageUrl() }}" rel="next">→</a></li>
                </li>
            </ul>
        @else
            <ul class="pagination">
                <li>
                    <a>→</a></li>
                </li>
            </ul>
            
        @endif
        
        @if ($paginator->currentPage() < $paginator->lastPage())
            <ul class="pagination">
                <li>
                    <a href="{{$paginator->url($paginator->lastPage())}}" >>></a></li>
                </li>
            </ul>
        @else
            <ul class="pagination">
                <li>
                    <a>>></a></li>
                </li>
            </ul>
        @endif
    </ul>
@endif