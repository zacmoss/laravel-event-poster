<div class='row justify-content-center event-card'>
    <div class='col-md-8'>
        <div class='card'>
            <a href='/event/<?= $event->id ?>' style='text-decoration: none; color: black;'>
                <div class='card-header'>
                    <?= $event->title ?>
                </div>
                
                <div class='card-body'>
                    <p class='card-text'>Location: <?= $event->location ?></p>
                    <p class='card-text'>Description: <?= $event->description ?></p>
                    <p class='card-text'>Date: <?= $event->date ?></p>
                    <p class='card-text'>Time: <?= $event->time ?></p>

                    @if (Auth::user()->role == 'client')
                        @if (isset($going) && Auth::check())
                            <?php $boo = false; ?>
                            @foreach ($going as $g)
                                @if ($g->userId === Auth::user()->id && $g->eventId === $event->id)
                                    <?php $boo = true; ?>
                                @endif
                            @endforeach
                            @if ($boo)
                                <p style='color: green'><i>Currently going to this event</i></p>
                            @endif
                        @endif
                    @elseif (Auth::user()->role == 'administrator')
                        <p><a href='/api/events/deleteEvent/".$event->id."'><button>Delete</button></a></p>
                    @endif
                </div>
            </a>
        </div>
    </div>
</div>