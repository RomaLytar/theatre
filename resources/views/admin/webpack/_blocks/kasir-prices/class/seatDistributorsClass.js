export default class SeatDistributors {
    constructor(item) {
      this.domItem = null;
      this.id = item.id;
      this.seat_number = item.seatPrice.data.seat_number;
      this.row = item.seatPrice.data.row_number;
      this.section = item.seatPrice.data.section_number;
      this.distributor_id = item.distributor_id;
      this.isAvailable = item.isAvailable;
    }

    setDomLink(link) {
      this.domItem = link;
    }

    fillElement({id, color}, flag) {
      if (flag) {
        this.distributor_id = id;
        this.domItem.style.fill = color;
        this.domItem.style.stroke = color;
        this.isAvailable = 0;
      } else {
        this.domItem.style.fill = ``;
        this.domItem.style.stroke = ``;
        this.distributor_id = null;
        this.isAvailable = 1;
      }
    }
};
