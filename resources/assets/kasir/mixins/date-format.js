export default {
  computed: {
    getYear() {
      return new Date(this.eventDate).getFullYear();
    },
    getDate() {
      const formatter = new Intl.DateTimeFormat(`uk`, {
        month: `long`,
        day: `numeric`
      });

      return formatter.format(new Date(this.eventDate));
    },
    getHours() {
      const formatter = new Intl.DateTimeFormat(`uk`, {
        hour: `numeric`,
        hour12: false
      });

      return formatter.format(new Date(this.eventDate));
    },
    getMinutes() {
      const formatter = new Intl.DateTimeFormat(`uk`, {
        minute: `numeric`
      });

      return formatter.format(new Date(this.eventDate));
    }
  }
}
