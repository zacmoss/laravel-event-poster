@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8" style="text-align: center; margin: 1rem 0">
            <h2>What's Poppin</h2>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-lg-12">
            
                @foreach ($events as $event)
                <div class="row justify-content-center event-card">
                    <div class="col-md-8">
                        <div class='card'>
                            <a href='/event/<?= $event->id ?>' style='text-decoration: none; color: black;'>
                                <div class='row justify-content-between' style="padding: 1rem">
                                    <div class="col-md-4">
                                        <div class="row justify-content-left" style="padding-left: 1rem">
                                            <h4 style="padding: 0; margin: 0"><?= $event->title ?></h4>
                                        </div>
                                    </div>
                                    <?php
                                        $goingCount = 0;
                                        foreach ($going as $g) {
                                            if ($g->eventId == $event->id) {
                                                $goingCount = $goingCount + 1;
                                            }
                                        }
                                    ?>
                                    <div class="col-md-4">
                                        <div class="row justify-content-center">
                                            <p><?= $goingCount ?></p>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="row justify-content-end" style="padding-right: 1rem">
                                            @if ($goingCount > 4)
                                                <img src="bar80.png" width="80px" height="30px">
                                            @elseif ($goingCount > 2)
                                                <img src="bar50.png" width="80px" height="30px">
                                            @elseif ($goingCount > 1)
                                                <img src="bar30.png" width="80px" height="30px">
                                            @else
                                                <img src="bar10.png" width="80px" height="30px">
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            
        </div>
    </div>
</div>


@endsection