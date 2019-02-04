export default class Seat {
  constructor(item) {
    this.domItem = null;
    this.id = item.id;
    this.seat_number = item.seat_number;
    this.row = item.row_number;
    this.section = item.section_number;

    if (`price_zone_id` in item) {
      this.price_zone_id = item.price_zone_id;
    }

    if (`recommended` in item) {
      this.recommended = item.recommended;
    }
  }

  setDomLink(link) {
    this.domItem = link;
  }

  fillElement({id, color}, flag) {
    if (`price_zone_id` in this) {
      this.price_zone_id = id;
      this.domItem.style.fill = color;
      this.domItem.style.stroke = color;
    }

    if (`recommended` in this) {
      this.recommended = flag;
      if (flag == `1`) {
        this.domItem.style.fill = color;
        this.domItem.style.stroke = color;
      } else {
        this.domItem.style.fill = `#ffffff`;
        this.domItem.style.stroke = `#999999`;
      }
    }
  }

  chooseSeatForAddImage() {
    const color = `#cccccc`;

    this.domItem.style.fill = color;
    this.domItem.style.stroke = color;
  }
};
