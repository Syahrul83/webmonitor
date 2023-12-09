<div>
    <div wire:poll>
<table class="table table-dark table-hover">
  <thead>
    <tr  class="text-center">
      <th scope="col">#</th>
      <th scope="col">Name</th>
      <th scope="col">Date Start</th>
     <th scope="col">Date Count</th>
      <th scope="col">Date End</th>
    </tr>
  </thead>
  <tbody>
    @php
        function stage($date){
        if($date < 7){
            return $color ="text-danger";
        }
        elseif($date < 14){
            return $color ="text-warning";
        }else{
            return $color ="text-success";
        }
    }
    @endphp
    @foreach($posts as $post)
    @php
       $awal = Carbon\Carbon::parse($post->tanggal);
       $akhir = $awal->copy()->addYear();
       $differenceInDays =    $akhir->diffInDays( now() ); // Calculate the difference in days between now and $awal
   @endphp
      <tr  class="text-center">
        <th wire:key='{{$post->id}}'>{{  $loop->iteration  }}</th>
        <td class="text-info-emphasis"><a target="_blank" href="{{ $post->name }}">{{ $post->name }} </a> </td>
        <td class="text-primary">{{ $awal->translatedFormat('d F Y') }}</td>
        <td class="text-center {{stage( $differenceInDays)}}"><h5>{{ $differenceInDays }}</h5></td>
        <td  class="text-danger">{{ $akhir->translatedFormat('d F Y') }}</td>
      </tr>
  @endforeach

  </tbody>
</table>
</div>
</div>
