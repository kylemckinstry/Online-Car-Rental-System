var ajax;
if (window.XMLHttpRequest) {
  ajax = new XMLHttpRequest();
} else {
  ajax = null;
}

var carData = [];

function getCars() {
  var ajax = new XMLHttpRequest();
  ajax.open("GET", "cars.json");
  ajax.onreadystatechange = function () {
    if (ajax.readyState === XMLHttpRequest.DONE && ajax.status === 200) {
      handleCars(ajax);
    }
  };
  ajax.send();
}

function handleCars(xml) {
  var carList = JSON.parse(xml.responseText);
  // console.log(carList);
  // console.log(carList[0]);

  for (var i = 0; i < carList.length; i++) {
    var carItem = {};
    carItem["Category"] = carList[i].category;
    for (var key in carList[i]) {
      if (carList[i].hasOwnProperty(key)) {
        carItem[key] = carList[i][key];
      }
    }
    carData.push(carItem);
  }
}

const cars = new Vue({
  el: "#infoArea",
  data() {
    return {
      cars: carData,
    };
  },
  updated() {
    setTimeout(() => {
      const frame = window.parent.document.getElementById("contentFrame");
      const frameBody = frame.contentWindow.document.body;
      const frameHeight = `${frameBody.scrollHeight}px`;
      frame.style.height = frameHeight;
    }, 100);
  },
  methods: {
    addToCart(id, event) {
      event.preventDefault();
      checkAvailability(id, event.target);
    },
  },
});

function checkAvailability(id) {
  var ajax = new XMLHttpRequest();
  ajax.open("GET", "checkAvailability.php?id=" + id);
  ajax.onreadystatechange = function () {
    if (ajax.readyState === XMLHttpRequest.DONE && ajax.status === 200) {
      handleCheck(ajax);
    }
  };
  ajax.send();
}

function handleCheck(xml) {
  if (xml.responseText == 1) {
    const parentWindow = window.parent;
    parentWindow.Swal.fire({
      allowOutsideClick: true,
      position: "center",
      padding: "3em",
      icon: "success",
      iconColor: "#ffc107",
      title: "Vehicle added to reservation cart.",
      showConfirmButton: false,
      timer: 2000,
    });
  } else {
    alert(
      "This vehicle is unavailable. Please select a different vehicle." +
        xml.responseText
    );
  }
}
