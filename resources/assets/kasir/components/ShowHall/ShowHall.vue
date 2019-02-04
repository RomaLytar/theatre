<template>
  <div class="show-hall">
    <embed
      type="image/svg+xml"
      :src="hallSrc"
      ref="embed"
    >
    <HallSchemeHint
      :config="seatConfig"
      :scheme="$refs.embed"
      v-if="seatHover"
    ></HallSchemeHint>
  </div>
</template>

<script>
  import SvgPanZoom from "../../../../../public/js/plugins/svg-pan-zoom.js"
  import HallSchemeHint from "../Hall/HallScheme/HallSchemeHint"

  let svgScheme = null;

  export default {
    props: {
      order: {
        type: Object,
        required: true
      }
    },
    components: {
      HallSchemeHint
    },
    data() {
      return {
        seatHover: false,
        seatConfig: {}
      }
    },
    mounted() {
      this.$refs.embed.addEventListener(`load`, () => {
        this.$emit(`schemeLoad`);
        this.markSeats();

        svgScheme = SvgPanZoom(this.$refs.embed, {
          viewportSelector: ".svg-pan-zoom_viewport",
          panEnabled: true,
          controlIconsEnabled: false,
          zoomEnabled: true,
          dblClickZoomEnabled: false,
          mouseWheelZoomEnabled: true,
          preventMouseEventsDefault: true,
          zoomScaleSensitivity: 0.2,
          minZoom: 1,
          maxZoom: 10,
          fit: true,
          contain: false,
          center: true,
          refreshRate: "auto",
          eventsListenerElement: null
        });

        let rightMouseTimer = null;

        this.$refs.embed.getSVGDocument().addEventListener(`contextmenu`, (e) => {
          e.preventDefault();

          if (rightMouseTimer) {
            this.svgSchemeZoomOut();
            clearTimeout(rightMouseTimer);
            rightMouseTimer = null;
          }

          rightMouseTimer = setTimeout(() => {
            clearTimeout(rightMouseTimer);
            rightMouseTimer = null;
          }, 300);
        });

        this.$refs.embed.getSVGDocument().addEventListener(`dblclick`, (e) => {
          e.preventDefault();

          this.svgSchemeZoomIn();
        });

        let seat = null,
            timer = null;

        const getSeat = (e) => {
          clearTimeout(timer);

          const target = e.target.closest(`[data-seat]`);

          if (target) {
            if (target !== seat && !target.hasAttribute(`data-not-available`)) {
              timer = setTimeout(() => {
                seat = target;

                this.seatConfig = {
                  sectionName: target.closest(`[data-section]`).getAttribute(`data-name-ua`),
                  row: target.closest(`[data-row]`).getAttribute(`data-row`),
                  seat: target.querySelector(`text`).textContent,
                  price: target.getAttribute(`data-price`),
                  ticketId: target.getAttribute(`data-id`),
                  coordinates: target.getBoundingClientRect()
                };
                this.seatHover = true;
              }, 200);
            }
          } else {
            if (seat != null) {
              seat = null;
              this.seatHover = false;
              this.seatConfig = {};
            }
          }
        };

        this.$refs.embed.addEventListener(`mouseover`, (e) => {
          this.$refs.embed.getSVGDocument().addEventListener(`mousemove`, getSeat);
        });

        this.$refs.embed.addEventListener(`mouseout`, (e) => {
          this.$refs.embed.getSVGDocument().removeEventListener(`mousemove`, getSeat);
        });
      });
    },
    computed: {
      hallName() {
        return this.order.tickets.data[0].performanceCalendar.data.hall.data.name
      },
      hallSrc() {
        return `/design/img/scheme/${this.hallName}-admin.svg`
      },
      hallTickets() {
        return this.order.tickets.data
      }
    },
    methods: {
      svgSchemeZoomIn() {
        if (Math.round(svgScheme.getZoom()) >= 10) {
          svgScheme.resetZoom();
          svgScheme.resetPan();
        } else {
          svgScheme.zoomIn();
        }
      },
      svgSchemeZoomOut() {
        if (Math.round(svgScheme.getZoom()) <= 1) {
          svgScheme.resetZoom();
          svgScheme.resetPan();
        } else {
          svgScheme.zoomOut();
        }
      },
      markSeats() {
        const svgObj = this.$refs.embed.getSVGDocument().documentElement;

        this.hallTickets.forEach(ticket => {
          const id = ticket.id,
                infoPrice = ticket.seatPrice.data,
                price = infoPrice.price,
                section_number = infoPrice.section_number,
                row_number = infoPrice.row_number,
                seat_number = infoPrice.seat_number;

          const el = svgObj.querySelector(`[data-section="${section_number}"] [data-row="${row_number}"] [data-seat="${seat_number}"]`);

          if (!el) return false;

          const circle = el.querySelector(`circle`),
                color = `#ff0000`;

          circle.style.fill = color;
          circle.style.stroke = color;
        })
      }
    }
  }
</script>
