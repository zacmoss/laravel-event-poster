<div class='row justify-content-center event-card'>
    <div class='col-md-8'>
        <div class='card'>
            <a href='/event/<?= $event->id ?>' style='text-decoration: none; color: black;'>
                <div class='card-header'>
                    <?= $event->title ?>
                </div>
                <?php $boo = false; ?>
                @foreach ($going as $g)
                    @if ($g->userId === Auth::user()->id && $g->eventId === $event->id)
                        <?php $boo = true; ?>
                    @endif
                @endforeach
                <div class='card-body'>
                    <p class='card-text'><?= $event->location ?></p>
                    <p class='card-text'><?= $event->description ?></p>
                    <p class='card-text'><?= $event->date ?></p>
                    <p class='card-text'><?= $event->time ?></p>
                    @if ($boo)
                        <p style='color: green'><i>Currently going to this event</i></p>
                    @endif
                </div>
            </a>

        </div>
    </div>
</div>
