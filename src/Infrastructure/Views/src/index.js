fetch("http://localhost:9200/articles")
  .then(function (response) {
    return response.json();
  })
  .then(function (data) {
    // Global
    const RESULTSDIV = document.getElementById("resultsDiv");
    const ACTIVEBIDS = document.getElementsByClassName("card-enabled");
    const DIRECTBIDBTN1 = document.getElementById("fbtn1");
    const DIRECTBIDBTN2 = document.getElementById("fbtn2");
    const DIRECTBIDBTN3 = document.getElementById("fbtn3");
    const MANUALBIDFORM = document.getElementById("directBidForm");
    const TBODY = document.getElementsByTagName("tbody")[0];

    for (let i in data) {
      let cardStatus;
      let modalToggler;
      let paragraphStatus;
      if (data[i].isActive == true) {
        cardStatus = "card-enabled";
        paragraphStatus = `<p class="card-text text-success">Subasta abierta</p>`;
        modalToggler = `data-bs-toggle="modal" data-bs-target="#itemModal"`;
      } else {
        cardStatus = "card-disabled";
        paragraphStatus = `<p class="card-text text-danger">Subasta cerrada</p>`;
      }
      const ITEM = `
        <div class="col" index="${i}">
        <div class="card ${cardStatus}" ${modalToggler}>
          <div class="card-body text-center">
            <img src="${data[i].image}" class="card-img-top mb-3" alt="..." />
            <h5 class="card-title">${data[i].name}</h5>
            ${paragraphStatus}
          </div>
        </div>
        </div>`;
      RESULTSDIV.innerHTML += ITEM;
    }

    for (let i = 0; i < ACTIVEBIDS.length; i++) {
      ACTIVEBIDS[i].addEventListener("click", function () {
        const INDEX = ACTIVEBIDS[i].parentElement.getAttribute("index");
        document.getElementById("itemModal").setAttribute("index", INDEX);
        getBidData(INDEX);
      });
    }

    // Time counter
    const ENDDATE = new Date("May 31, 2022 23:59:59").getTime();
    const X = setInterval(function () {
      const NOW = new Date().getTime();
      const DISTANCE = ENDDATE - NOW;
      const DAYS = Math.floor(DISTANCE / (1000 * 60 * 60 * 24));
      const HOURS = Math.floor(
        (DISTANCE % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60)
      );
      const MINUTES = Math.floor((DISTANCE % (1000 * 60 * 60)) / (1000 * 60));
      const SECONDS = Math.floor((DISTANCE % (1000 * 60)) / 1000);

      document.getElementById("counter").innerHTML =
        "Cierra en " +
        DAYS +
        "d " +
        HOURS +
        "h " +
        MINUTES +
        "m " +
        SECONDS +
        "s ";

      if (DISTANCE < 0) {
        clearInterval(X);
        DIRECTBIDBTN1.disabled = true;
        DIRECTBIDBTN2.disabled = true;
        DIRECTBIDBTN3.disabled = true;
        MANUALBIDFORM.getElementsByTagName("button")[0].disabled = true;
        document.getElementById("counter").innerHTML = "Subasta terminada";
      }
    }, 1000);

    // Events
    DIRECTBIDBTN1.addEventListener("click", function () {
      const INDEX = document.getElementById("itemModal").getAttribute("index");
      prepareBidData(INDEX, parseInt(this.textContent, 10));
    });

    DIRECTBIDBTN2.addEventListener("click", function () {
      const INDEX = document.getElementById("itemModal").getAttribute("index");
      prepareBidData(INDEX, parseInt(this.textContent, 10));
    });

    DIRECTBIDBTN3.addEventListener("click", function () {
      const INDEX = document.getElementById("itemModal").getAttribute("index");
      prepareBidData(INDEX, parseInt(this.textContent, 10));
    });

    MANUALBIDFORM.addEventListener("submit", function (e) {
      e.preventDefault();
      let inputValue = this.getElementsByTagName("input")[0].value;
      const INDEX = document.getElementById("itemModal").getAttribute("index");
      const MINBIDVALUE = parseInt(data[INDEX].directBidPrice1, 10);
      if (inputValue >= MINBIDVALUE) {
        prepareBidData(INDEX, inputValue);
      } else {
        errorAlert(MINBIDVALUE);
      }
      this.reset();
    });

    // Methods
    function getBidData(index) {
      let currentPrice = parseInt(data[index].currentPrice, 10);
      let directBid1 = parseInt(data[index].directBidPrice1, 10);
      let directBid2 = parseInt(data[index].directBidPrice2, 10);
      let directBid3 = parseInt(data[index].directBidPrice3, 10);
      let bids = getBidHistoryByArticleId(parseInt(index)+1); //revisar esto

      printBidData(index, currentPrice, directBid1,
        directBid2, directBid3);
    }

    function getBidHistoryByArticleId(index) {
      fetch(`http://localhost:9200/articles/${index}/bids`)
          .then(function (response) {
            return response.json();
          })
          .then(function (data) {
            printBidHistory(data);
          });
    }

    function printBidHistory(bids) {
      TBODY.innerHTML = "";
      for (let i in bids) {
        const ROW = document.createElement("tr");
        const DATE = new Date(bids[i].createdAtDateTime);
        ROW.innerHTML = `
                <tr>
                <td>${DATE.getDate()}/${DATE.getMonth() + 1}/${DATE.getFullYear()}</td>
                <td>${DATE.getHours()}:${DATE.getMinutes()}:${DATE.getSeconds()}</td>
                <td>${bids[i].price}€</td>
                </tr>`;
        TBODY.insertBefore(ROW, TBODY.firstChild);
      }
    }

    function printBidData(index, currentPrice, directBid1,
                          directBid2, directBid3) {
      document.getElementById('modalTitle').textContent = data[index].name;
      document.getElementById('modalImg').src = data[index].image;
      document.getElementById("currentPrice").innerHTML = currentPrice;
      document.getElementById("nextBidPrice").innerHTML = directBid1;
      DIRECTBIDBTN1.innerHTML = directBid1 + "€";
      DIRECTBIDBTN2.innerHTML = directBid2 + "€";
      DIRECTBIDBTN3.innerHTML = directBid3 + "€";
    }

    function prepareBidData(index, price) {
      const INDEX = index;
      const NOW = new Date();
      let currentPrice = parseInt(price, 10);

      writeBidApi(INDEX, NOW, currentPrice);
    }

    function writeBidApi(index, now, price) {
      let url = `http://localhost:9200/articles/${index}/bids/create`;
      let data = {
        date: now,
        precio: price
      };

      fetch(url, {
        method: "POST",
        body: JSON.stringify(data),
        headers: {
          "Content-Type": "application/json"
        }
      })
        .then((res) => res.json())
        .catch((error) => console.error("Error:", error))
        .then(function(response) {
          console.log("Success:", response);
          successAlert();
          editArticleApi(index, price);
        });
    }

    function editArticleApi(index, currentPrice) {
      let directBid1 = Math.ceil(currentPrice + currentPrice * 0.1);
      let directBid2 = directBid1 + 5;
      let directBid3 = directBid2 + 5;

      let url = `http://localhost:9200/articles/${index}/edit`;
      let data =  {
        currentPrice: currentPrice,
        directBidPrice1: directBid1,
        directBidPrice2: directBid2,
        directBidPrice3: directBid3
      };

      fetch(url, {
        method: "PATCH",
        body: JSON.stringify(data),
        headers: {
          "Content-Type": "application/json"
        }
      })
        .then((res) => res.json())
        .catch((error) => console.error("Error:", error))
        .then(function(response) {
          console.log("Success:", response)
          getBidData(index);
        });
    }

    function successAlert() {
      Swal.fire({
        icon: "success",
        title: "Puja realizada",
        showConfirmButton: false,
        timer: 2000
      });
    }

    function errorAlert(minValue) {
      Swal.fire({
        icon: "error",
        title: "Oops...",
        text: `El valor debe ser mayor o igual a ${minValue}€`
      });
    }
  });
