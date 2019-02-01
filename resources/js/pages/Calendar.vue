<template>
  <div class="container">
    <full-calendar
      class="calendar-custom"
      :events="events"
      :config="config"
      @day-click="click"
      @event-created="select"
    ></full-calendar>
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
      footer: {
        left: "",
        center: "prev,next",
        right: ""
      },
      events: [
        {
          title: "event1",
          start: "2019-01-01",
          durationEditable: true
        },
        {
          title: "event2",
          start: "2019-01-05",
          end: "2019-01-07"
        },
        {
          title: "event3",
          start: "2019-01-09T12:30:00",
          allDay: false
        }
      ],
      config: {
        firstDay: 1,
        defaultView: "month",
        weekends: true,
        drop(...args) {
          //handle drop logic in parent
        }
      }
    };
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
    select: (start, end, jsEvent, view) => {
      console.log("start:");

      console.log(start);

    }
  }
};
</script>

<style scoped>
.calendar-custom {
  margin: 25px 0;
}
</style>
