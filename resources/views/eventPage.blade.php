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

<div id=" . $event->id . " class='row justify-content-center event-card'>
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
                    <form method='post' action='/api/going/remove'>
                        @csrf
                        <input type='hidden' name="eventId" value='<?= $id ?>'>
                        <input type='submit' style='background-color: green' value="Going">
                    </form>
                @else
                    <form method='post' action='/api/going/add'>
                        @csrf
                        <input type='hidden' name="eventId" value='<?= $id ?>'>
                        <input type='submit' style='background-color: transparent' value="Going">
                    </form>
                @endif
                
            </div>
            
            
            
            

        </div>
    </div>
</div>
@endsection

<script>
    
</script>