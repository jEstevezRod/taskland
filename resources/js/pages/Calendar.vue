<template>
  <div class="columns">
    <div class="column is-10 is-offset-1 is-10-mobile is-offset-1-mobile">
      <full-calendar
        class="calendar-custom"
        :events="events"
        :config="config"
        @day-click="click"
        @event-created="created"
        @event-resize="resize"
        @event-drop="drop"
      ></full-calendar>
    </div>
  </div>
</template>

<script>
import { FullCalendar } from "vue-full-calendar";

export default {
  components: {
    FullCalendar
  },
  data() {
    return {
      self: this,
      footer: {
        left: "",
        center: "prev,next",
        right: ""
      },
      events: [
        {
          title: "event1",
          start: "2019-02-01",
          id: 11
        },
        {
          title: "event2",
          id: 10,
          start: "2019-02-05",
          end: "2019-02-09"
        },
        {
          title: "event3",
          start: "2019-02-09",
          end: "2019-02-10",
          id: 12
        }
      ],
      config: {
        firstDay: 1,
        defaultView: "month",
        weekends: false,
        drop(...args) {
          today: new Date();
        },
        eventClick: event => {
          this.selected = event;
          alert(event.title);
          console.log(event);
        },
        eventMouseover: (calEvent, jsEvent) => {
          console.log(calEvent);
          console.log(jsEvent.currentTarget);
        },
        eventMouseout: function(calEvent, jsEvent) {
          console.log(calEvent);
          console.log(jsEvent);
        }
      }
    };
  },
  mounted() {
    this.$store.dispatch('loadTasksCalendar');
    $(document).ready(
      $("#calendar").fullCalendar({
        viewRender: function(view, element) {
          if (view.name != "month") {
            $(element)
              .find(".fc-scroller")
              .perfectScrollbar();
          }
        },
        defaultView: "agendaWeek",
        defaultDate: this.today,
        dayRender: function(date, cell) {
          if (date > this.today) {
            $(cell).addClass("disabled");
          }
        }
      })
    );
  },
  methods: {
    click: (date, jsEvent, view) => {
      console.log("date:");
      console.log(date);
      console.log("jsEvent :");
      console.log(jsEvent);
      console.log("view :");
      console.log(view);
    },
    created: event => {
      console.log("created:");
      console.log(event);
    },
    resize: event => {
      console.log("resize");
      console.log(event);
    },
    drop: event => {
      console.log("drop");
      console.log(event);
    }
  }
};
</script>

<style scoped>
.calendar-custom {
  margin: 25px 0;
}

.fc-scroller.fc-day-grid-container {
  overflow: hidden !important;
  height: 700px !important;
}
</style>
