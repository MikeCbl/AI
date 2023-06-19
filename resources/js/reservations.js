import { Calendar } from "@fullcalendar/core";
import dayGridPlugin from "@fullcalendar/daygrid";
import timeGridPlugin from "@fullcalendar/timegrid";
import listPlugin from "@fullcalendar/list";
import interactionPlugin, { Draggable } from "@fullcalendar/interaction";
import axios from "axios";

const url = `http://localhost:8000/api/reservations`;

// Get local language
const userLanguage = navigator.language || navigator.userLanguage;

// Define track colors manually
const trackColors = {
  track1: "text-white bg-red-500 hover:bg-red-600",
  track2: "text-white bg-green-500 hover:bg-green-600",
  track3: "text-white bg-blue-500 hover:bg-blue-600",
  track4: "text-white bg-yellow-500 hover:bg-yellow-600",
  // Add more tracks and their colors as needed
};

document.addEventListener("DOMContentLoaded", function () {
  const calendarEl = document.getElementById("calendar");
  const legendEl = document.getElementById("legend");

  const calendar = new Calendar(calendarEl, {
    plugins: [dayGridPlugin, timeGridPlugin, listPlugin, interactionPlugin],
    fontFamily: "custom-font",
    headerToolbar: {
      left: "prev,next today",
      center: "title",
      right: "dayGridMonth,timeGridWeek,timeGridDay,listMonth",
    },
    nowIndicator: true,
    now: new Date().toISOString(),
    navLinks: true,
    editable: true,
    dayMaxEvents: true,
    locale: "en",
    contentHeight: "auto",
    slotMinTime: "8:00:00",
    slotMaxTime: "19:00:00",
    views: {
      dayGridMonth: {
        titleFormat: { year: "numeric", month: "short" },
      },
    },
    events: function (fetchInfo, successCallback, failureCallback) {
      axios
        .get(url)
        .then((response) => {
          const data = response.data;
          const events = data.map((reservation) => ({
            id: reservation.id,
            title: "Reservation",
            className: trackColors[`track${reservation.track_id}`],
            start: reservation.reservation_date + "T" + reservation.start_time,
            end: reservation.reservation_date + "T" + reservation.end_time,
            description: `Track: ${reservation.track_name} <br> Reserver: ${reservation.name} ${reservation.last_name}`,
          }));

          const groupedEvents = groupEventsByDay(events);
          const flattenedEvents = flattenGroupedEvents(groupedEvents);

          successCallback(flattenedEvents);
        })
        .catch((error) => {
          console.error("An error occurred while retrieving reservations:", error);
          failureCallback(error);
        });
    },
    eventContent: (arg) => {
      const { event } = arg;
      const html = `<div class="fc-event-title-container">
                <div class="fc-event-title fc-sticky">${event.id}: ${event.title}</div>
                <div class="fc-event-description">${event.extendedProps.description}</div>
              </div>`;

      return { html };
    },

    droppable: true,
    drop: function (info) {
      const event = info.draggedEl;
      event.parentNode.removeChild(event);
    },
    eventLimit: true, // Allow "more" link when too many events
    eventLimitText: "More", // Sets the text for more events
  });

  calendar.render();

  new Draggable(calendarEl, {
    itemSelector: ".fc-event",
    eventData: function (eventEl) {
      const title = eventEl.querySelector(".fc-event-title").innerText;
      const description = eventEl.querySelector(".fc-event-description").innerText;

      return {
        id: id,
        title: title.trim(),
        description: description.trim(),
      };
    },
  });
});

// Function to group events by day
function groupEventsByDay(events) {
  const groupedEvents = {};

  events.forEach((event) => {
    const date = event.start.substr(0, 10); // Extract the date part of the start time
    if (!groupedEvents[date]) {
      groupedEvents[date] = [event];
    } else {
      groupedEvents[date].push(event);
    }
  });

  return groupedEvents;
}

// Function to flatten the grouped events
function flattenGroupedEvents(groupedEvents) {
  const flattenedEvents = [];

  Object.values(groupedEvents).forEach((events) => {
    if (events.length > 2) {
      const groupEvent = {
        id: "group",
        title: `Group (${events.length})`,
        className: "group-event",
        start: events[0].start,
        end: events[0].end,
        description: events.map((event) => event.description).join("<br>"),
      };

      flattenedEvents.push(groupEvent);
    } else {
      flattenedEvents.push(...events);
    }
  });

  return flattenedEvents;
}
