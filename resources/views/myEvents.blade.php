@extends('layouts.app')

@section('content')
<?php $id = Auth::user()->id; ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8" style="text-align: center; margin: 1rem 0">
            <h2>My Events</h2>
            <i><p>Currently going to {{ $events->total() }} events</p></i>
        </div>
    </div>
    
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div>
                
                @if (isset($events))
                    @if (count($events) > 0)
                        @if (isset($going))
                            @foreach ($events as $event)
                                @foreach ($going as $g)
                                    @if ($g->userId == $id && $g->eventId == $event->id)
                                        @include('layouts.event', ['event' => $event, 'going' => $going])
                                    @endif
                                @endforeach
                            @endforeach
                        @endif
                    @endif
                @endif

            </div>
            @if (!$events->total() == 0)
                <div class="row justify-content-center" style="margin-top: 2rem">
                    {{ $events->links() }}
                </div>
            @endif
        </div>
    </div>
</div>





@endsection