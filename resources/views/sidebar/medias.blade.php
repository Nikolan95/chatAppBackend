<div class="media-lists">
    @foreach($conversation[0]['messages'] as $line)
        <div class="media-image">
            <img src="data:image/png;base64,{{ chunk_split(base64_encode($line->image)) }}" alt="">
            {{-- <img src="data:image/png;base64,{{ chunk_split(base64_encode($line->image)) }}" alt="" > --}}
        </div>
    @endforeach
</div>