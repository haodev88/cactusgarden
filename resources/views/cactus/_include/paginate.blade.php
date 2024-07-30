<?php $link_limit = 7; ?>
@if($paginator->lastPage() > 1)
    <div class="product-pagination">
        <ul class="">
            @if($paginator->currentPage() > 1)
                <li><a href="{{ $paginator->url($paginator->currentPage()-1) }}">&laquo;</a></li>
            @endif

            @for ($i = 1; $i <= $paginator->lastPage(); $i++)
                <?php
                    $half_total_links = floor($link_limit / 2);
                    $from = $paginator->currentPage() - $half_total_links;
                    $to = $paginator->currentPage() + $half_total_links;
                    if ($paginator->currentPage() < $half_total_links) {
                        $to += $half_total_links - $paginator->currentPage();
                    }
                    if ($paginator->lastPage() - $paginator->currentPage() < $half_total_links) {
                        $from -= $half_total_links - ($paginator->lastPage() - $paginator->currentPage()) - 1;
                    }
                ?>
                @if ($from < $i && $i < $to)
                    @if ($paginator->currentPage() == $i)
                        <li class="active"><a href="javascript:void(0);">{{ $i }}</a></li>
                    @else
                        <li><a href="{{ $paginator->url($i) }}">{{ $i }}</a></li>
                    @endif
                @endif
            @endfor

            @if($paginator->currentPage() < $paginator->lastPage())
                <li><a href="{{ $paginator->url($paginator->currentPage()+1) }}">&raquo;</a></li>
            @endif
        </ul>
    </div>
@endif
