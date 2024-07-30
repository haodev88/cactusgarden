<?php   
    $link_limit = 7; // maximum number of links (a little bit inaccurate, but will be ok for now)
?>

@if ($paginator->lastPage() > 1)
    <div class="btn-group">
        <a href="{{ $paginator->url($paginator->currentPage()-1) }}" class="btn btn-success" type="button">Lùi</a>
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
                <a href="{{ $paginator->url($i) }}" type="button" class="btn btn-success{{ ($paginator->currentPage() == $i) ? ' active' : '' }}">{{ $i }}</a>
            @endif
        @endfor
        <a href="{{ $paginator->url($paginator->currentPage()+1) }}" class="btn btn-success" type="button">Tiếp theo</a>
    </div>
@endif