# Yo The ReadMe

This is a new version of The Famous Event Poster built using the Laravel framework



It utilizes the build-in laravel auth system which is generated when running php artisan make:auth

Also utilizes laravel's paginator on the event feed



If user is logged in, they are able to create events

If user is 'administrator' they are able to delete events

If user is logged in, they can see a going button on each event in event feed

User can search events for matching text to title, location, and description

User can see if they've rsvp'd to an event from feed, search, and individual event page

User can click to rsvp to an event on individual event page

User can see all events they are rsvp'd to on their myEvents page

User can filter events by date

User can filter events by city



To be added : No event input before current date / Styling / Input length verification / map api integration / add capitalization check for cities (lowercase all cities in db and checking db) / Need
to be able to apply multiple filters like filter by city AND date



Issues:

Redundant event render for regular event feed and search feed...

Should make search with functionality which takes an array of events to search through so we can
add this feature to myEvents

When adding the date filter, had to change styling of events iteration for myEvents page by adding if statement

Filters need to be re-factored and made in a way that pagination can be passed to them