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



To be added : Styling / Input length verification / map api integration / add capitalization check for 
cities (lowercase all cities in db and checking db) / Need to be able to apply multiple filters 
like filter by city AND date / Need to restart pagination count when clicking show all / should
be different filters for event feed (all) and myEvents (going set) / Show most rsvp'd to events first / 
Show number of people currently rsvp'd for an event / Add find a friend and add friend functionality /
Find friend for the time being would just match first name and last name or username? email? / Add
'quick adds' functionality for admins and partners. Could hard set a city / address / date for
adding multiple events more quickly. / What's Poppin - Pick a day and show an ordered list of 
events by how many people are rsvp'd



Issues:

Redundant event render for regular event feed and search feed...

Should make search with functionality which takes an array of events to search through so we can
add this feature to myEvents

When adding the date filter, had to change styling of events iteration for myEvents page by adding if statement

Filters need to be re-factored and made in a way that pagination can be passed to them

If we're going to have toggle-able going or interested buttons on eventFeed / results page / or eventPage
we're gonna need to have local state initialized with the status of that button on page load, then 
change the state on toggle and then when they leave the page we would then need to send that
status update to db...




Discussion

Events are rendered two ways in this system. One using the Controllers to pass data to view, the
other using Ajax to grab events from controllers, then add to html of searchFeed div to 'load'
the view without a page refresh...

To me, it's much cleaner to pass events to view using the controllers. We demonstrate this
with the render of Event Feed and the render of the My Events page. With the Ajax strategy, 
we don't have access to Laravel's paginator which is an issue. Is there a strategy which
let's us use the first strategy without having to refresh the page when events are filtered???

More of the filter logic can be moved to the controllers. I think we can do all the auth / 
logged in checks in the controller and pass the html render string in a variable to the view,
which then just adds the html render string to the div and shows the div.

Down the line: Could add gearman job which goes through and removes past date events every night. 
(Delete their corresponding going data items as well). Could also add a gearman job which removes
 going data items with eventIds for events which no longer exist / were deleted, b/c I'm having
 issues with the delete on cascade option in the model...Could add auto filter on event feed load
 which uses the geo location var to only load events at that location or default to lafayette or
 if they don't 'allow' geo locator show an error, must allow geo locator or redirect to a page
 which asks them to choose a city to view events for. All that would be is the city filter. Could
 also add a table for available cities and their coords. So we can just grab all currently
 available cities from that table and include in options of city filter and we would then have
 those coords to be able to do that - 1 + 1 trick for anyone within a few miles of city to get
 pegged at that city.