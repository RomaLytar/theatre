;(() => {
  window.customAjax = ({url = "/echo", method = "POST", type = "json", timeout = 1000, data, json = false}) => {
    const STATUS_CODE = {
      OK: 200,
      WRONG_REQUEST: 400,
      USER_NO_AUTHORIZATION: 401,
      NOT_FOUND: 404,
      OTHER: `Unknown status`,
    };

    if (json) {
      return fetch(url, {
        method: method,
        body: data
      }).then((response) => {
        // console.log(response);
        if (response.status == STATUS_CODE.OK) {
          return response.json();
        } else {
          let error = new Error(response.statusText);
          error.response = response;

          throw error;
        }
      })
    }

    return fetch(url, {
      method: method,
      body: data
    }).then((response) => {
      try {
        JSON.parse(response.text());

        if (response.status == STATUS_CODE.OK) {
          return response.json();
        } else {
          let error = new Error(response.statusText);
          error.response = response;

          throw error;
        }
      } catch (err) {}
    })
  }
})();
