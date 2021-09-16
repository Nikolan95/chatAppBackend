<div class="media-lists">
    @foreach($medias as $line)
        <div class="media-image">
            {{-- <img src="data:image/png;base64,{{ chunk_split(base64_encode($line->image)) }}" alt="" > --}}
            <img src="{{asset('http://127.0.0.1:8000'.$line->file->file_path)}}" alt="">
            {{-- <p>{{$line->file->file_path}}</p> --}}
        </div>
    @endforeach
</div>