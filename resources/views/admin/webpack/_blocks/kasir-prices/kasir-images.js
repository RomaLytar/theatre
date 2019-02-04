import Seat from "./class/seatClass"
import ImagesControllerClass from "./class/ImagesControllerClass"
// import {ServerDataSendZone} from "./class/serverDataSendClass"
import {pullImageSeatsFromServer, pushRecommendateSeatsToServer} from "./getDataFromServer"
import schemeDraw from "./schemeDraw"
import {alertSuccess, alertError} from "../../global/alert"

export default function kasirImages() {
  const kasir = document.querySelector(`#kasir-images`);

  if (!kasir) return false;

  window.addEventListener(`load`, (e) => {

    class KasirImages {
      constructor(item) {
        this.item = item;
        this.recommendateController = new ImagesControllerClass(document.querySelector(`.kasir__prices`));
        this.seats = null;
        this.saveBtn = this.item.querySelector(`#saveSeats`);
        this.btnDisabled = false;
        this.scheme = schemeDraw();
        this.massActive = false;
        this.alertBlock = this.item.querySelector(`.kasir__alert-wrap`);

        this.getDataFromServer()
          .then(() => this.seats.forEach((seat, i) => seat.poster ? seat.fillElement({color: `#cccccc`}, true) : ``));

        this.saveBtn.addEventListener(`click`, (e) => {
          this.pushSeats().then(() => {
            this.alertBlock.prepend(alertSuccess(`Данные успешно сохранены`));
            this.clearLocalSeats();
          });
        });

        this.scheme.addEventListener(`click`, (e) => {
          if (this.massActive) return false;

          const target = e.target.closest(`[data-seat]`);

          if (target) this.setSeatPrice(target);
        });

        this.massSeatCheck();
      }

      massSeatCheck() {
        let timer = null,
            keyDownFire = false,
            mouseObj = {X: [], Y: []},
            element = null;

        const sortCoordinates = (a, b) => {
                if (a > b) return 1;
                if (a < b) return -1;
              },
              mouseCoordinatesDown = (e) => {
                mouseObj.X = [];
                mouseObj.Y = [];
                mouseObj.X.push(e.x);
                mouseObj.Y.push(e.y);

                element = createBorderElement({X: e.x, Y: e.y});
                this.scheme.addEventListener(`mousemove`, mouseCoordinatesMove);
              },
              mouseCoordinatesMove = (e) => {
                if (!element) return false;
                const left = parseInt(element.style.left) || `auto`,
                      right = parseInt(element.style.right) || `auto`,
                      top = parseInt(element.style.top) || `auto`,
                      bottom = parseInt(element.style.bottom) || `auto`;

                if (left !== `auto`) {
                  if (e.x < mouseObj.X[0]) {
                    element.style.right = `${window.innerWidth - left}px`;
                    element.style.left = `auto`;
                  }
                } else if (right !== `auto`) {
                  if (e.x > mouseObj.X[0]) {
                    element.style.left = `${window.innerWidth - right}px`;
                    element.style.right = `auto`;
                  }
                }

                if (top !== `auto`) {
                  if (e.y < mouseObj.Y[0]) {
                    element.style.bottom = `${window.innerHeight - top}px`;
                    element.style.top = `auto`;
                  }
                } else if (bottom !== `auto`) {
                  if (e.y > mouseObj.Y[0]) {
                    element.style.top = `${window.innerHeight - bottom}px`;
                    element.style.bottom = `auto`;
                  }
                }

                element.style.width = `${Math.abs(mouseObj.X[0] - e.x)}px`;
                element.style.height = `${Math.abs(mouseObj.Y[0] - e.y)}px`;
              },
              mouseCoordinatesUp = (e) => {
                mouseObj.X.push(e.x);
                mouseObj.Y.push(e.y);
                mouseObj.X.sort(sortCoordinates);
                mouseObj.Y.sort(sortCoordinates);

                if (mouseObj.X.length >= 2 && mouseObj.Y.length >= 2) {
                  this.massSetSeatPrice(mouseObj);
                }
                this.scheme.removeEventListener(`mousemove`, mouseCoordinatesMove);
                if (element) {
                  element.remove();
                  element = null;
                }
              },
              createBorderElement = (coordinate) => {
                const el = document.createElement(`div`);

                el.style.cssText = `position:fixed;top:${coordinate.Y}px;left:${coordinate.X}px;border:1px solid #333333;pointer-events:none;background:rgba(0,0,0,0.2);`
                document.body.appendChild(el);
                return el;
              };

        window.addEventListener(`keydown`, (e) => {
          if (e.keyCode === 17) {
            if (!keyDownFire) {
              this.massActive = true;
              mouseObj.X = [];
              mouseObj.Y = [];
              this.scheme.classList.add(`kasir__scheme-massive`);
              this.scheme.addEventListener(`mousedown`, mouseCoordinatesDown);
              this.scheme.addEventListener(`mouseup`, mouseCoordinatesUp);
              keyDownFire = true;
            }
          }
        });

        window.addEventListener(`keyup`, (e) => {
          if (e.keyCode === 17) {
            this.massActive = false;
            this.scheme.classList.remove(`kasir__scheme-massive`);
            this.scheme.removeEventListener(`mousedown`, mouseCoordinatesDown);
            this.scheme.removeEventListener(`mouseup`, mouseCoordinatesUp);
            keyDownFire = false;

            if (element) {
              element.remove();
              element = null;
            }
          }
        })
      }

      async getDataFromServer() {
        await pullImageSeatsFromServer()
          .then(data => {
            let seats = [];
            data.sections.data.forEach(section => {
              const section_number = section.number;

              section.rows.data.forEach(row => {
                const row_number = row.number;

                row.seats.data.forEach(seat => {
                  seats.push({
                    id: seat.id,
                    seat_number: seat.number,
                    row_number: row_number,
                    section_number: section_number,
                    recommended: seat.recommended,
                    poster: seat.poster
                  });
                })
              })
            })
            return seats;
          })
          .then(serverSeats => {
            this.seats = serverSeats.map(item => {
              const seat = new Seat(item);
              seat.setDomLink(document.querySelector(`#scheme [data-section="${item.section_number}"] [data-row="${item.row_number}"] [data-seat="${item.seat_number}"] circle`))
              return seat
            })
          });
      }

      setSeatPrice(seat) {
        const seatIndex = seat.getAttribute(`data-seat`),
              row = seat.closest(`[data-row]`),
              rowIndex = row.getAttribute(`data-row`),
              section = row.closest(`[data-section]`),
              sectionIndex = section.getAttribute(`data-section`);

        const seatObj = this.seats.find(item => item.row == rowIndex && item.section == sectionIndex && item.seat_number == seatIndex);

        if (seatObj) seatObj.chooseSeatForAddImage();

        this.setLocalSeats();
      }

      massSetSeatPrice(coordinate) {
        const filterSeats = this.seats.filter(item => {
          const itemCoord = item.domItem.getBoundingClientRect(),
                itemCenter = {
                  X: itemCoord.left + itemCoord.width / 2,
                  Y: itemCoord.top + itemCoord.height / 2
                }

          if (coordinate.X[0] <= itemCenter.X && coordinate.X[1] >= itemCenter.X && coordinate.Y[0] <= itemCenter.Y && coordinate.Y[1] >= itemCenter.Y) {
            return true;
          } else {
            return false;
          }
        });

        filterSeats.forEach(item => item.chooseSeatForAddImage());

        this.setLocalSeats();
      }

      setLocalSeats() {
        localStorage.setItem(`${location.href}`, JSON.stringify(this.seats))
      }

      clearLocalSeats() {
        localStorage.removeItem(`${location.href}`)
      }

      // btnSaveStatus() {
      //   this.saveBtn.disabled = this.btnDisabled;

      //   if (this.btnDisabled) {
      //     this.saveBtn.classList.add(`disabled`);
      //   } else {
      //     this.saveBtn.classList.remove(`disabled`);
      //   }
      // }

      // createDataForServer() {
      //   return {
      //     seats: this.seats.map(seat => new ServerDataSendZone(seat))
      //   }
      // }

      async pushSeats() {
        this.btnDisabled = true;
        this.btnSaveStatus();
        await pushRecommendateSeatsToServer(this.createDataForServer()).
              then((data) => {
                this.btnDisabled = false;
                this.btnSaveStatus();
              });
      }
    }

    new KasirImages(kasir);
  })
}
