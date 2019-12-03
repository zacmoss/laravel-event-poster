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
    <div class="col-md-8" style="margin: 1rem 0">
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
                @if (Auth::check())
                    @if ($g->userId == Auth::user()->id && $g->eventId == $id)
                        <?php $boo = true; ?>
                    @endif
                @endif
            @endforeach
            
            <div class='card-body'>
                @if (isset($goingCount))
                    @if ($goingCount == 1)
                        <p><?= $goingCount ?> person going</p>
                    @else
                        <p><?= $goingCount ?> people going</p>
                    @endif
                @endif
                <p class='card-text'>Location: <?= $location ?></p>
                <p class='card-text'>Description <?= $description ?></p>
                <p class='card-text'>When: <?= $date ?> | <?= $time ?></p>

                @if (Auth::check())
                    @if (Auth::user()->role == 'client')
                        
                        <form method='post' action='/api/going/toggle'>
                            @csrf
                            <div class="form-group row">
                            <input type="hidden" name="eventId" value="<?= $id ?>">
                            <div class="col-md-4">
                                @if ($boo)
                                    <select name="goingBoo" class="form-control">
                                        <option value="true">Going</option>
                                        <option value="false">Not Going</option>
                                    </select>
                                @else
                                    <select name="goingBoo" class="form-control">
                                        <option value="false">Not Going</option>
                                        <option value="true">Going</option>
                                    </select>
                                @endif
                                </div>
                                <div class="col-md-6">
                                    <input type='submit' class='btn btn-primary' value="RSVP">
                                </div>
                            </div>
                        </form>
                    @endif
                @endif
                
            </div>
            
            
            
            

        </div>
    </div>
</div>
@endsection

<script>
    
</script>