<?php
    //$title = 'yo';
    
    foreach ($events as $event) {
        if ($event->id == $id) {
            $id = $event->id;
            $title = $event->title;
            $location = $event->location;
            $description = $event->description;
            $date = $event->date;
            $time = $event->time;
        }
    }
    
?>

@extends('layouts.app')

@section('content')
<div class='row justify-content-center'>
    <div class="col-md-8" style="margin-top: 1rem">
        <a href="javascript:history.go(-1)"><button class="btn btn-primary" style="width: 100px">&#x27F5;<span style='margin-right: 5px'></span> Back</button></a>
    </div>
</div>
<div class='row justify-content-center event-card'>
    <div class='col-md-8'>
        <div class='card'>
            <div class='card-header'>
                <?= $title ?>
            </div>

            <?php $boo = false; ?>
            @foreach ($going as $g)
                @if ($g->userId == Auth::user()->id && $g->eventId == $id)
                    <?php $boo = true; ?>
                @endif
            @endforeach
            
            <div class='card-body'>
                <p class='card-text'><?= $location ?></p>
                <p class='card-text'><?= $description ?></p>
                <p class='card-text'><?= $date ?></p>
                <p class='card-text'><?= $time ?></p>

                @if ($boo)
                    <p><i>Currently going to this event</i></p>
                    <form method='post' action='/api/going/remove'>
                        @csrf
                        <input type='hidden' name="eventId" value='<?= $id ?>'>
                        <input type='submit' class='btn-red' value="Don't Go">
                        
                    </form>
                @else
                    <form method='post' action='/api/going/add'>
                        @csrf
                        <input type='hidden' name="eventId" value='<?= $id ?>'>
                        <input type='submit' class='btn-green' value="RSVP">
                    </form>
                @endif
                
            </div>
            
            
            
            

        </div>
    </div>
</div>
@endsection

<script>
    
</script>