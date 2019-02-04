import getPageId from "../../global/getPageId"
import getDistributorPageId from "../../global/getDistributorPageId"
import getImageHallId from "../../global/getImageHallId"

export function pullPriceZonesFromServer(patternId) {
  try {
    return fetch(`/admin/pricePatterns/${patternId}`, {
      method: `GET`
    })
    .then(response => response.json())
    .then(data => data.data)
    .catch(error => console.log(error))
  } catch(err) {
    throw err
  }
};

export function pullPriceSeatsFromServer() {
  try {
    return fetch(`/admin/hallWithSeats/${getPageId()}`, {
      method: `GET`
    })
    .then(response => response.json())
    .then(data => data.data)
    .catch(error => console.log(error))
  } catch(err) {
    throw err
  }
};

export function pushPriceSeatsToServer(payload) {
  try {
    return fetch(`/admin/hall-price-patterns/${getPageId()}/seat-prices`, {
      method: `PUT`,
      headers: {
        "Content-Type": `application/json`,
        "Accept": `application/json`,
        'X-CSRF-TOKEN': window.csrf_token
      },
      body: JSON.stringify(payload)
    })
    .then(response => response.json())
    .catch(error => console.log(error))
  } catch(err) {
    throw err
  }
};

export function pullRecommendateSeatsFromServer() {
  try {
    return fetch(`/admin/hallSeats/${getPageId()}`, {
      method: `GET`
    })
    .then(response => response.json())
    .then(data => data.data)
    .catch(error => console.log(error))
  } catch(err) {
    throw err
  }
};

export function pushRecommendateSeatsToServer(payload) {
  try {
    return fetch(`/admin/halls/${getPageId()}/updateSeats`, {
      method: `PUT`,
      headers: {
        "Content-Type": `application/json`,
        "Accept": `application/json`,
        'X-CSRF-TOKEN': window.csrf_token
      },
      body: JSON.stringify(payload)
    })
    .then(response => response.json())
    .catch(error => console.log(error))
  } catch(err) {
    throw err
  }
};

export function pullImageSeatsFromServer() {
  try {
    return fetch(`/admin/hallSeats/${getImageHallId()}`, {
      method: `GET`
    })
    .then(response => response.json())
    .then(data => data.data)
    .catch(error => console.log(error))
  } catch(err) {
    throw err
  }
};

export function pullDistributorsFromServer() {
  try {
    return fetch(`/admin/distributors-list`, {
      method: `GET`
    })
    .then(response => response.json())
    .then(data => data.data)
    .catch(error => console.log(error))
  } catch(err) {
    throw err
  }
};

export function pullDistributorsSeatsFromServer() {
  try {
    return fetch(`/admin/performanceCalendars/${getDistributorPageId()}/getDateWithTickets`, {
      method: `GET`
    })
    .then(response => response.json())
    .then(data => data.data)
    .catch(error => console.log(error))
  } catch(err) {
    throw err
  }
};

export function pushDistributorsSeatsToServer(payload) {
  try {
    return fetch(`/admin/performanceCalendars/${getDistributorPageId()}/updateDateTickets`, {
      method: `PUT`,
      headers: {
        "Content-Type": `application/json`,
        "Accept": `application/json`,
        'X-CSRF-TOKEN': window.csrf_token
      },
      body: JSON.stringify(payload)
    })
    .then(response => {
      if (response.ok) {
        return response.json()
      } else {
        throw new Error();
      }
    })
    .then(data => {
      if (data.status) {
        return data
      } else {
        throw data
      }
    })
  } catch(err) {
    throw err
  }
};

export function sellDistributorsTickets(payload) {
  try {
    return fetch(`/admin/cash-box/orders/create-for-distributor`, {
      method: `POST`,
      headers: {
        "Content-Type": `application/json`,
        "Accept": `application/json`,
        'X-CSRF-TOKEN': window.csrf_token
      },
      body: JSON.stringify(payload)
    })
    .then(response => {
      if (response.ok) {
        return response.json()
      } else {
        throw new Error();
      }
    })
  } catch(err) {
    throw err
  }
};
