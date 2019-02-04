export class ServerDataSendZone {
  constructor(item) {
    this.id = item.id;

    if (`price_zone_id` in item) {
      this.price_zone_id = item.price_zone_id;
    }

    if (`recommended` in item) {
      this.recommended = item.recommended;
    }
  }
}

export class ServerDataSendDistributors {
  constructor(item) {
    this.id = item.id;
    this.distributor_id = item.distributor_id;
    this.isAvailable = item.isAvailable;
  }
}
