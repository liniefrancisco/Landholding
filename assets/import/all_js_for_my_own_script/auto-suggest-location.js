// AUTO COMPLETE COUNTRY  ===============================================================================================

function autocomplete_country(inp, arr) {
  /*the autocomplete function takes two arguments,
  the text field element and an array of possible autocompleted values:*/
  var currentFocus;
  /*execute a function when someone writes in the text field:*/
  inp.addEventListener("input", function(e) {
      var a, b, i, val = this.value;
      /*close any already open lists of autocompleted values*/
      closeAllLists();
      if (!val) { return false;}
      currentFocus = -1;
      /*create a DIV element that will contain the items (values):*/
      a = document.createElement("DIV");
      a.setAttribute("id", this.id + "autocomplete-list");
      a.setAttribute("class", "autocomplete-items");
      /*append the DIV element as a child of the autocomplete container:*/
      this.parentNode.appendChild(a);
      /*for each item in the array...*/
      for (i = 0; i < arr.length; i++) {
        /*check if the item starts with the same letters as the text field value:*/
        if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
          /*create a DIV element for each matching element:*/
          b = document.createElement("DIV");
          /*make the matching letters bold:*/
          b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
          b.innerHTML += arr[i].substr(val.length);
          /*insert a input field that will hold the current array item's value:*/
          b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
          /*execute a function when someone clicks on the item value (DIV element):*/
          b.addEventListener("click", function(e) {
              /*insert the value for the autocomplete text field:*/
              inp.value = this.getElementsByTagName("input")[0].value;
              /*close the list of autocompleted values,
              (or any other open lists of autocompleted values:*/
              closeAllLists();
          });
          a.appendChild(b);
        }
      }
  });
  /*execute a function presses a key on the keyboard:*/
  inp.addEventListener("keydown", function(e) {
      var x = document.getElementById(this.id + "autocomplete-list");
      if (x) x = x.getElementsByTagName("div");
      if (e.keyCode == 40) {
        /*If the arrow DOWN key is pressed,
        increase the currentFocus variable:*/
        currentFocus++;
        /*and and make the current item more visible:*/
        addActive(x);
      } else if (e.keyCode == 38) { //up
        /*If the arrow UP key is pressed,
        decrease the currentFocus variable:*/
        currentFocus--;
        /*and and make the current item more visible:*/
        addActive(x);
      } else if (e.keyCode == 13) {
        /*If the ENTER key is pressed, prevent the form from being submitted,*/
        e.preventDefault();
        if (currentFocus > -1) {
          /*and simulate a click on the "active" item:*/
          if (x) x[currentFocus].click();
        }
      }
  });
  function addActive(x) {
    /*a function to classify an item as "active":*/
    if (!x) return false;
    /*start by removing the "active" class on all items:*/
    removeActive(x);
    if (currentFocus >= x.length) currentFocus = 0;
    if (currentFocus < 0) currentFocus = (x.length - 1);
    /*add class "autocomplete-active":*/
    x[currentFocus].classList.add("autocomplete-active");
  }
  function removeActive(x) {
    /*a function to remove the "active" class from all autocomplete items:*/
    for (var i = 0; i < x.length; i++) {
      x[i].classList.remove("autocomplete-active");
    }
  }
  function closeAllLists(elmnt) {
    /*close all autocomplete lists in the document,
    except the one passed as an argument:*/
    var x = document.getElementsByClassName("autocomplete-items");
    for (var i = 0; i < x.length; i++) {
      if (elmnt != x[i] && elmnt != inp) {
        x[i].parentNode.removeChild(x[i]);
      }
    }
  }
  /*execute a function when someone clicks in the document:*/
  document.addEventListener("click", function (e) {
      closeAllLists(e.target);
  });
}

/*An array containing all the country names in the world:*/
var countries = ['Philippines','Canada','U.S.A','Argentina'];

/*initiate the autocomplete function on the "myInput" element, and pass along the countries array as possible autocomplete values:*/
autocomplete_country(document.getElementById("country"), countries);



// END AUTO COMPLETE COUNTRY  ===============================================================================================







// AUTO COMPLETE PROVINCE ===============================================================================================



function autocomplete_province(inp, arr) {
  /*the autocomplete function takes two arguments,
  the text field element and an array of possible autocompleted values:*/
  var currentFocus;
  /*execute a function when someone writes in the text field:*/
  inp.addEventListener("input", function(e) {
      var a, b, i, val = this.value;
      /*close any already open lists of autocompleted values*/
      closeAllLists();
      if (!val) { return false;}
      currentFocus = -1;
      /*create a DIV element that will contain the items (values):*/
      a = document.createElement("DIV");
      a.setAttribute("id", this.id + "autocomplete-list");
      a.setAttribute("class", "autocomplete-items");
      /*append the DIV element as a child of the autocomplete container:*/
      this.parentNode.appendChild(a);
      /*for each item in the array...*/
      for (i = 0; i < arr.length; i++) {
        /*check if the item starts with the same letters as the text field value:*/
        if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
          /*create a DIV element for each matching element:*/
          b = document.createElement("DIV");
          /*make the matching letters bold:*/
          b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
          b.innerHTML += arr[i].substr(val.length);
          /*insert a input field that will hold the current array item's value:*/
          b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
          /*execute a function when someone clicks on the item value (DIV element):*/
          b.addEventListener("click", function(e) {
              /*insert the value for the autocomplete text field:*/
              inp.value = this.getElementsByTagName("input")[0].value;
              /*close the list of autocompleted values,
              (or any other open lists of autocompleted values:*/
              closeAllLists();
          });
          a.appendChild(b);
        }
      }
  });
  /*execute a function presses a key on the keyboard:*/
  inp.addEventListener("keydown", function(e) {
      var x = document.getElementById(this.id + "autocomplete-list");
      if (x) x = x.getElementsByTagName("div");
      if (e.keyCode == 40) {
        /*If the arrow DOWN key is pressed,
        increase the currentFocus variable:*/
        currentFocus++;
        /*and and make the current item more visible:*/
        addActive(x);
      } else if (e.keyCode == 38) { //up
        /*If the arrow UP key is pressed,
        decrease the currentFocus variable:*/
        currentFocus--;
        /*and and make the current item more visible:*/
        addActive(x);
      } else if (e.keyCode == 13) {
        /*If the ENTER key is pressed, prevent the form from being submitted,*/
        e.preventDefault();
        if (currentFocus > -1) {
          /*and simulate a click on the "active" item:*/
          if (x) x[currentFocus].click();
        }
      }
  });
  function addActive(x) {
    /*a function to classify an item as "active":*/
    if (!x) return false;
    /*start by removing the "active" class on all items:*/
    removeActive(x);
    if (currentFocus >= x.length) currentFocus = 0;
    if (currentFocus < 0) currentFocus = (x.length - 1);
    /*add class "autocomplete-active":*/
    x[currentFocus].classList.add("autocomplete-active");
  }
  function removeActive(x) {
    /*a function to remove the "active" class from all autocomplete items:*/
    for (var i = 0; i < x.length; i++) {
      x[i].classList.remove("autocomplete-active");
    }
  }
  function closeAllLists(elmnt) {
    /*close all autocomplete lists in the document,
    except the one passed as an argument:*/
    var x = document.getElementsByClassName("autocomplete-items");
    for (var i = 0; i < x.length; i++) {
      if (elmnt != x[i] && elmnt != inp) {
        x[i].parentNode.removeChild(x[i]);
      }
    }
  }
  /*execute a function when someone clicks in the document:*/
  document.addEventListener("click", function (e) {
      closeAllLists(e.target);
  });
}

/*An array containing all the country names in the world:*/
var province = ["Bohol","Cebu","Davao","Manila"];

/*initiate the autocomplete function on the "myInput" element, and pass along the countries array as possible autocomplete values:*/
autocomplete_province(document.getElementById("province"), province);



// END AUTO COMPLETE PROVINCES ================================================================================================









// AUTO COMPLETE ZIPCODE ============================================================================================



function autocomplete_zipcode(inp, arr) {
  /*the autocomplete function takes two arguments,
  the text field element and an array of possible autocompleted values:*/
  var currentFocus;
  /*execute a function when someone writes in the text field:*/
  inp.addEventListener("input", function(e) {
      var a, b, i, val = this.value;
      /*close any already open lists of autocompleted values*/
      closeAllLists();
      if (!val) { return false;}
      currentFocus = -1;
      /*create a DIV element that will contain the items (values):*/
      a = document.createElement("DIV");
      a.setAttribute("id", this.id + "autocomplete-list");
      a.setAttribute("class", "autocomplete-items");
      /*append the DIV element as a child of the autocomplete container:*/
      this.parentNode.appendChild(a);
      /*for each item in the array...*/
      for (i = 0; i < arr.length; i++) {
        /*check if the item starts with the same letters as the text field value:*/
        if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
          /*create a DIV element for each matching element:*/
          b = document.createElement("DIV");
          /*make the matching letters bold:*/
          b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
          b.innerHTML += arr[i].substr(val.length);
          /*insert a input field that will hold the current array item's value:*/
          b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
          /*execute a function when someone clicks on the item value (DIV element):*/
          b.addEventListener("click", function(e) {
              /*insert the value for the autocomplete text field:*/
              inp.value = this.getElementsByTagName("input")[0].value;
              /*close the list of autocompleted values,
              (or any other open lists of autocompleted values:*/
              closeAllLists();
          });
          a.appendChild(b);
        }
      }
  });
  /*execute a function presses a key on the keyboard:*/
  inp.addEventListener("keydown", function(e) {
      var x = document.getElementById(this.id + "autocomplete-list");
      if (x) x = x.getElementsByTagName("div");
      if (e.keyCode == 40) {
        /*If the arrow DOWN key is pressed,
        increase the currentFocus variable:*/
        currentFocus++;
        /*and and make the current item more visible:*/
        addActive(x);
      } else if (e.keyCode == 38) { //up
        /*If the arrow UP key is pressed,
        decrease the currentFocus variable:*/
        currentFocus--;
        /*and and make the current item more visible:*/
        addActive(x);
      } else if (e.keyCode == 13) {
        /*If the ENTER key is pressed, prevent the form from being submitted,*/
        e.preventDefault();
        if (currentFocus > -1) {
          /*and simulate a click on the "active" item:*/
          if (x) x[currentFocus].click();
        }
      }
  });
  function addActive(x) {
    /*a function to classify an item as "active":*/
    if (!x) return false;
    /*start by removing the "active" class on all items:*/
    removeActive(x);
    if (currentFocus >= x.length) currentFocus = 0;
    if (currentFocus < 0) currentFocus = (x.length - 1);
    /*add class "autocomplete-active":*/
    x[currentFocus].classList.add("autocomplete-active");
  }
  function removeActive(x) {
    /*a function to remove the "active" class from all autocomplete items:*/
    for (var i = 0; i < x.length; i++) {
      x[i].classList.remove("autocomplete-active");
    }
  }
  function closeAllLists(elmnt) {
    /*close all autocomplete lists in the document,
    except the one passed as an argument:*/
    var x = document.getElementsByClassName("autocomplete-items");
    for (var i = 0; i < x.length; i++) {
      if (elmnt != x[i] && elmnt != inp) {
        x[i].parentNode.removeChild(x[i]);
      }
    }
  }
  /*execute a function when someone clicks in the document:*/
  document.addEventListener("click", function (e) {
      closeAllLists(e.target);
  });
}

/*An array containing all the country names in the world:*/
var zcode = ["6302",
             "6314",
             "6311",
             "6335",
             "6301",
             "6342",
             "6318",
             "6326",
             "6317",
             "6333",
             "6328",
             "6312",
             "6346",
             "6319",
             "6343",
             "6330",
             "6337",
             "6341",
             "6322",
             "6344",
             "6339",
             "6305",
             "6309",
             "6307",
             "6310",
             "6332",
             "6308",
             "6334",
             "6304",
             "6303",
             "6316",
             "6327",
             "6313",
             "6336",
             "6340",
             "6321",
             "6331",
             "6345",
             "6323",
             "6347",
             "6320",
             "6338",
             "6300",
             "6325",
             "6324",
             "6329",
             "6315",
             "6306"];

/*initiate the autocomplete function on the "myInput" element, and pass along the countries array as possible autocomplete values:*/
autocomplete_zipcode(document.getElementById("zipcode"), zcode);



// END AUTO COMPLETE ZIPCODE  ===============================================================================






// start auto complete town ===================================================================================





function autocomplete_town(inp, arr) {
  /*the autocomplete function takes two arguments,
  the text field element and an array of possible autocompleted values:*/
  var currentFocus;
  /*execute a function when someone writes in the text field:*/
  inp.addEventListener("input", function(e) {
      var a, b, i, val = this.value;
      /*close any already open lists of autocompleted values*/
      closeAllLists();
      if (!val) { return false;}
      currentFocus = -1;
      /*create a DIV element that will contain the items (values):*/
      a = document.createElement("DIV");
      a.setAttribute("id", this.id + "autocomplete-list");
      a.setAttribute("class", "autocomplete-items");
      /*append the DIV element as a child of the autocomplete container:*/
      this.parentNode.appendChild(a);
      /*for each item in the array...*/
      for (i = 0; i < arr.length; i++) {
        /*check if the item starts with the same letters as the text field value:*/
        if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
          /*create a DIV element for each matching element:*/
          b = document.createElement("DIV");
          /*make the matching letters bold:*/
          b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
          b.innerHTML += arr[i].substr(val.length);
          /*insert a input field that will hold the current array item's value:*/
          b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
          /*execute a function when someone clicks on the item value (DIV element):*/
          b.addEventListener("click", function(e) {
              /*insert the value for the autocomplete text field:*/
              inp.value = this.getElementsByTagName("input")[0].value;
              /*close the list of autocompleted values,
              (or any other open lists of autocompleted values:*/
              closeAllLists();
          });
          a.appendChild(b);
        }
      }
  });
  /*execute a function presses a key on the keyboard:*/
  inp.addEventListener("keydown", function(e) {
      var x = document.getElementById(this.id + "autocomplete-list");
      if (x) x = x.getElementsByTagName("div");
      if (e.keyCode == 40) {
        /*If the arrow DOWN key is pressed,
        increase the currentFocus variable:*/
        currentFocus++;
        /*and and make the current item more visible:*/
        addActive(x);
      } else if (e.keyCode == 38) { //up
        /*If the arrow UP key is pressed,
        decrease the currentFocus variable:*/
        currentFocus--;
        /*and and make the current item more visible:*/
        addActive(x);
      } else if (e.keyCode == 13) {
        /*If the ENTER key is pressed, prevent the form from being submitted,*/
        e.preventDefault();
        if (currentFocus > -1) {
          /*and simulate a click on the "active" item:*/
          if (x) x[currentFocus].click();
        }
      }
  });
  function addActive(x) {
    /*a function to classify an item as "active":*/
    if (!x) return false;
    /*start by removing the "active" class on all items:*/
    removeActive(x);
    if (currentFocus >= x.length) currentFocus = 0;
    if (currentFocus < 0) currentFocus = (x.length - 1);
    /*add class "autocomplete-active":*/
    x[currentFocus].classList.add("autocomplete-active");
  }
  function removeActive(x) {
    /*a function to remove the "active" class from all autocomplete items:*/
    for (var i = 0; i < x.length; i++) {
      x[i].classList.remove("autocomplete-active");
    }
  }
  function closeAllLists(elmnt) {
    /*close all autocomplete lists in the document,
    except the one passed as an argument:*/
    var x = document.getElementsByClassName("autocomplete-items");
    for (var i = 0; i < x.length; i++) {
      if (elmnt != x[i] && elmnt != inp) {
        x[i].parentNode.removeChild(x[i]);
      }
    }
  }
  /*execute a function when someone clicks in the document:*/
  document.addEventListener("click", function (e) {
      closeAllLists(e.target);
  });
}

/*An array containing all the country names in the world:*/
var municip = ["Albuquerque",
            "Alicia",
            "Anda",
            "Antiquera",
            "Baclayon",
            "Balilihan",
            "Batuan",
            "Bien Unido",
            "Bilar",
            "Buenavista",
            "Calape",
            "Candijay",
            "Carlos P. Garcia (Dao)",
            "Carmen",
            "Catigbi-an",
            "Clarin",
            "Corella",
            "Cortez",
            "Daguhoy",
            "Danao",
            "Dauis",
            "Dimiao",
            "Duero",
            "Garcia Hernandez",
            "Guindulman",
            "Inabanga",
            "Jagna",
            "Jetafe",
            "Lila",
            "Loay",
            "Loboc",
            "Loon",
            "Mabini",
            "Maribojoc",
            "Panglao",
            "Pilar",
            "Sagbayan",
            "San Isidro",
            "San Miguel",
            "Sevilla",
            "Sierra Bullones",
            "Sikatuna",
            "Tagbilaran City",
            "Talibon",
            "Trinidad",
            "Tubigon",
            "Ubay",
            "Valencia"];

/*initiate the autocomplete function on the "myInput" element, and pass along the countries array as possible autocomplete values:*/
autocomplete_town(document.getElementById("town"), municip);



// end auto complete town ==================================================================================



function autocomplete_barangay(inp, arr) {
  /*the autocomplete function takes two arguments,
  the text field element and an array of possible autocompleted values:*/
  var currentFocus;
  /*execute a function when someone writes in the text field:*/
  inp.addEventListener("input", function(e) {
      var a, b, i, val = this.value;
      /*close any already open lists of autocompleted values*/
      closeAllLists();
      if (!val) { return false;}
      currentFocus = -1;
      /*create a DIV element that will contain the items (values):*/
      a = document.createElement("DIV");
      a.setAttribute("id", this.id + "autocomplete-list");
      a.setAttribute("class", "autocomplete-items");
      /*append the DIV element as a child of the autocomplete container:*/
      this.parentNode.appendChild(a);
      /*for each item in the array...*/
      for (i = 0; i < arr.length; i++) {
        /*check if the item starts with the same letters as the text field value:*/
        if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
          /*create a DIV element for each matching element:*/
          b = document.createElement("DIV");
          /*make the matching letters bold:*/
          b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
          b.innerHTML += arr[i].substr(val.length);
          /*insert a input field that will hold the current array item's value:*/
          b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
          /*execute a function when someone clicks on the item value (DIV element):*/
          b.addEventListener("click", function(e) {
              /*insert the value for the autocomplete text field:*/
              inp.value = this.getElementsByTagName("input")[0].value;
              /*close the list of autocompleted values,
              (or any other open lists of autocompleted values:*/
              closeAllLists();
          });
          a.appendChild(b);
        }
      }
  });
  /*execute a function presses a key on the keyboard:*/
  inp.addEventListener("keydown", function(e) {
      var x = document.getElementById(this.id + "autocomplete-list");
      if (x) x = x.getElementsByTagName("div");
      if (e.keyCode == 40) {
        /*If the arrow DOWN key is pressed,
        increase the currentFocus variable:*/
        currentFocus++;
        /*and and make the current item more visible:*/
        addActive(x);
      } else if (e.keyCode == 38) { //up
        /*If the arrow UP key is pressed,
        decrease the currentFocus variable:*/
        currentFocus--;
        /*and and make the current item more visible:*/
        addActive(x);
      } else if (e.keyCode == 13) {
        /*If the ENTER key is pressed, prevent the form from being submitted,*/
        e.preventDefault();
        if (currentFocus > -1) {
          /*and simulate a click on the "active" item:*/
          if (x) x[currentFocus].click();
        }
      }
  });
  function addActive(x) {
    /*a function to classify an item as "active":*/
    if (!x) return false;
    /*start by removing the "active" class on all items:*/
    removeActive(x);
    if (currentFocus >= x.length) currentFocus = 0;
    if (currentFocus < 0) currentFocus = (x.length - 1);
    /*add class "autocomplete-active":*/
    x[currentFocus].classList.add("autocomplete-active");
  }
  function removeActive(x) {
    /*a function to remove the "active" class from all autocomplete items:*/
    for (var i = 0; i < x.length; i++) {
      x[i].classList.remove("autocomplete-active");
    }
  }
  function closeAllLists(elmnt) {
    /*close all autocomplete lists in the document,
    except the one passed as an argument:*/
    var x = document.getElementsByClassName("autocomplete-items");
    for (var i = 0; i < x.length; i++) {
      if (elmnt != x[i] && elmnt != inp) {
        x[i].parentNode.removeChild(x[i]);
      }
    }
  }
  /*execute a function when someone clicks in the document:*/
  document.addEventListener("click", function (e) {
      closeAllLists(e.target);
  });
}

/*An array containing all the country names in the world:*/
var brgy = [
                //Alburquerque
                "Bahi","Basacdacu","Cantiguib","Dangay","East Poblacion","Ponong","San Agustin","Santa Filomena","Tagbuane","Toril","West Poblacion",
                //Antequera
                "Angilan","Bantolinao","Bicahan","Bitaugan","Bungahan","Canlaas","Can-omay","Cansibuan","Ceiling","Danao","Danicop","Mag-aso","Poblacion","Quinapon-an","Santo Rosario","Tabuan","Tagubaas","Tupas","Ubojan","Viga","Villa Aurora (Canoc-oc)",
                //Baclayon
                "Buenaventura","Cambanac","Dasitam","Landican","Laya","Libertad","Montana","Pamilacan","Payahan","San Isidro","San Roque","Taguihon","Tanday",
                //Balilihan
                "Baucan Norte","Baucan Sur","Boctol","Boyog Norte","Boyog Proper","Boyog Sur","Cabad","Candasig","Cantalid","Cantomimbo","Cogon","Datag Norte","Datag Sur","Del Carmen Este","Del Carmen Norte","Del Carmen Sur","Del Carmen Weste","Del Rosario","Dorol","Haguilanan Grande","Hanopol Este","Hanopol Norte","Hanopol Weste","Magsija","Maslog","Sagasa","Sal-ing","Santo Niño","Tagustusan",
                //Calape
                "Abucayan Norte","Abucayan Sur","Banlasan","Bentig","Binogawan","Bonbon","Cabayugan","Cabudburan","Calunasan","Camias","Canguha","Catmonan","Desamparados","Kahayag","Kinabag-an","Labuon","Lawis","Liboron","Lomboy","Lo-oc","Lucob","Madangog","Magtongtong","Mandaug","Mantatao","Sampoangon","Santa Cruz","Sojoton","Talisay","Tinibgan","Tultugan","Ulbujan",
                //Catigbian
                "Alegria","Ambuan","Baang","Bagtic","Bongbong","Cambailan","Candumayao","Causwagan Norte","Hagbuaya","Haguilanan","Kang-iras","Libertad Sur","Liboron","Mahayag Norte","Mahayag Sur","Maitum","Mantasida","Poblacion Weste","Rizal","Sinakayanan","Triple Union",
                //Corella
                "Anislag","Canangca-an","Canapnapan","Cancatac","Pandol","Sambog","Tanday",
                //Cortes
                "De La Paz","Fatima","Loreto","Lourdes","Malayo Norte","Malayo Sur","Monserrat","New Lourdes","Patrocinio","Rosario","Salvador","Upper De La Paz",
                //Dauis
                "Biking","Bingag","Catarman","Mariveles","Mayacabac","San Isidro (Canlongon)","Songculan","Tabalong","Tinago","Totolan",
                //Loon
                "Badbad Occidental","Badbad Oriental","Basac","Basdacu","Basdio","Biasong","Bongco","Bugho","Cabacongan","Cabadug","Cabug","Calayugan Norte","Calayugan Sur","Cambaquiz","Campatud","Candaigan","Canhangdon Occidental","Canhangdon Oriental","Canigaan","Canmaag","Canmanoc","Cansuagwit","Cansubayon","Cantam-is Bago","Cantam-is Baslay","Cantaongon","Cantumocad","Catagbacan Handig","Catagbacan Norte","Catagbacan Sur","Cogon Norte","Cogon Sur","Cuasi","Genomoan","Lintuan","Mocpoc Norte","Mocpoc Sur","Moto Norte","Moto Sur","Nagtuang","Napo","Nueva Vida","Panangquilon","Pantudlan","Pig-ot","Pondol","Quinobcoban","Sondol","Song-on","Talisay","Tan-awan","Tangnan","Taytay","Ticugan","Tiwi","Tontonan","Tubodacu","Tubodio","Tubuan","Ubayon",
                //Maribojoc
                "Agahay","Aliguay","Anislag","Bayacabac","Bood","Busao","Cabawan","Candavid","Dipatlong","Jandig","Lagtangon","Lincod","Pagnitoan","Punsod","Punta Cruz","San Roque (Aghao)","San Vicente",
                //Panglao
                "Bil-isan","Bolod","Danao","Doljo","Libaong","Looc","Lourdes","Tangnan","Tawala",
                //Sikatuna
                "Abucay Norte","Abucay Sur","Badiang","Bahaybahay","Cambuac Norte","Cambuac Sur","Canagong","Libjo",
                //Tagbilaran
                "Bool","Booy","Cabawan","Cogon","Dampas","Dao","Manga","Mansasa","Poblacion I","Poblacion II","Poblacion III","Taloto","Tiptip","Ubujan",
                //Tubigon
                "Bagongbanwa","Banlasan","Batasan Island","Bilangbilangan Island","Bosongon","Buenos Aires","Bunacan","Cabulihan","Cahayag","Cawayanan","Centro","Genonocan","Guiwanon","Ilijan Norte","Ilijan Sur","Libertad","Macaas","Matabao","Mocaboc Island","Panadtaran","Panaytayon","Pandan","Pangapasan Island","Pinayagan Norte","Pinayagan Sur","Pooc Occidental","Pooc Oriental","Potohan","Talenceras","Tan-awan","Tinangnan","Ubay Island","Villanueva",
                //Bien Unido
                "Bilangbilangan Dako","Bilangbilangan Diot","Hingotanan East","Hingotanan West","Liberty","Malingin","Mandawa","Maomawan","Nueva Esperanza","Nueva Estrella","Pinamgo","Puerto San Pedro","Sagasa","Tuboran",
                //Buenavista
                "Anonang","Asinan","Bago","Baluarte","Bantuan","Bato","Bonotbonot","Bugaong","Cambuhat","Cambus-oc","Cangawa","Cantomugcad","Cantores","Cantuba","Catigbian","Cawag","Cruz","Dait","Eastern Cabul-an","Hunan","Lapacan Norte","Lapacan Sur","Lubang","Lusong (Plateau)","Magkaya","Merryland","Nueva Granada","Nueva Montana","Overland","Panghabgan","Putting Bato","Rufo Hill","Sweetland","Western Cabul-an",
                //Clarin
                "Bacani","Bogtongbod","Bontud","Buacao","Buangan","Cabog","Caboy","Caluwasan","Candajec","Cantoyoc","Comaang","Danahao","Katipunan","Lajog","Mataub","Nahawan","Poblacion Centro","Tangaran","Tontunan","Tubod","Villaflor",
                //Dagohoy
                "Babag","Cagawasan","Cagawitan","Caluasan","Candelaria","Can-oling","Estaca","La Esperanza","Mahayag","Malitbog","San Miguel","Villa Aurora",
                //Danao
                "Cabatuan","Cantubod","Carbon","Concepcion","Dagohoy","Hibale","Magtangtang","Nahud","Remedios","San Carlos","Santa Fe","Tabok","Taming","Villa Anunciado",
                //Getafe
                "Alumar","Banacon","Buyog","Cabasakan","Campao Occidental","Campao Oriental","Cangmundo","Carlos P. Garcia","Corte Baud","Handumon","Jagoliao","Jandayan Norte","Jandayan Sur","Mahanay Island","Nasingin","Pandanon","Saguise","Salog","San Jose","Taytay","Tugas","Tulang",
                //Inabanga
                "Anonang","Badiang","Baguhan","Bahan","Banahao","Baogo","Bugang","Cagawasan","Cagayan","Cambitoon","Canlinte","Cawayan","Cogon","Cuaming","Dagnawan","Dagohoy","Dait Sur","Datag","Hambongan","Ilaud","Ilaya","Ilihan","Lapacan Norte","Lapacan Sur","Lawis","Liloan Norte","Liloan Sur","Lomboy","Lonoy Cainisican","Lonoy Roma","Lutao","Luyo","Mabuhay","Maria Rosario","Nabuad","Napo","Ondol","Riverside","Saa","Sua","Tambook","Tungod","U-og",
                //Pres. Carlos P. Garcia
                "Aguining","Baud","Bayog","Bogo","Bonbonon","Butan","Campamanog","Canmangao","Gaus","Kabangkalan","Lapinig","Lipata","Popoo","Saguise","San Jose (Tawid)","Tilmobo","Tugas","Tugnao","Villa Milagrosa",
                //Sagbayan
                "Calangahan","Canmao","Canmaya Centro","Canmaya Diot","Dagnawan","Kabasacan","Kagawasan","Katipunan","Langtad","Libertad Norte","Libertad Sur","Mantalongon","Sagbayan Sur","San Antonio","San Ramon","San Vicente Norte","San Vicente Sur","Santa Catalina",
                //San Isidro
                "Abehilan","Baryong Daan","Baunos","Cabanugan","Caimbang","Cambansag","Candungao","Cansague Norte","Cansague Sur","Causwagan Sur","Masonoy",
                //San Miguel
                "Bayongan","Bugang","Cabangahan","Caluasan","Camanaga","Cambangay Norte","Capayas","Corazon","Garcia","Hagbuyo","Kagawasan","Mahayag","Tomoc",
                //Talibon
                "Bagacay","Balintawak","Burgos","Busalian","Calituban","Cataban","Guindacpan","Magsaysay","Mahanay","Nocnocan","Rizal","Sag","San Francisco","Sikatuna","Suba","Tanghaligue","Zamora",
                //Trinidad
                "Banlasan","Bongbong","Catoogan","Guinobatan","Hinlayagan Ilaud","Hinlayagan Ilaya","Kauswagan","Kinan-oan","La Union","La Victoria","Mabuhay Cabigoha","Mahabgu","Manuel M. Roxas","Santo Tomas","Soom","Tagum Norte","Tagum Sur",
                //Ubay
                "Achila","Bay-ang","Benliw","Biabas","Bongbong","Bood","Buenavista","Bulilis","Cagting","Calanggaman","California","Camali-an","Camambugan","Casate","Cuya","Gabi","Governor Boyles","Guintabo-an","Hambabauran","Humayhumay","Ilihan","Imelda","Juagdan","Katarungan","Lomangog","Los Angeles","Pag-asa","Pangpang","San Pascual","Sentinila","Sinandigan","Tapal","Tapon","Tintinan","Tipolo","Tubog","Tuboran","Union","Villa Teresita",
                //Alicia
                "Cabatang","Cagongcagong","Cambaol","Cayacay","Del Monte","Katipunan","La Hacienda","Mahayag","Napo","Pagahat","Poblacion (Calingganay)","Progreso","Putlongcam","Sudlon (Omhor)","Untaga",
                //Anda
                "Almaria","Bacong","Badiang","Buenasuerte","Candabong","Casica","Katipunan","Linawan","Lundag","Suba","Talisay","Tanod","Tawid","Virgen",
                //Batuan
                "Aloja","Behind The Clouds (San Jose)","Cabacnitan","Cambacay","Cantigdas","Garcia","Janlud","Poblacion Norte","Poblacion Sur","Poblacion Vieja","Quezon","Quirino","Rizal","Rosariohan",
                //Bilar
                "Bonifacio","Bugang Norte","Bugang Sur","Cabacnitan (Magsaysay)","Cambigsi","Campagao","Cansumbol","Dagohoy","Owac","Quezon","Riverside","Rizal","Roxas","Subayon","Villa Aurora","Villa Suerte","Yanaya",
                //Candijay
                "Abihilan","Anoling","Boyo-an","Cadapdapan","Cambane","Canawa","Can-olin","Cogtong","La Union","Luan","Lungsoda-an","Mahangin","Pagahat","Panadtaran","Panas","Tambongan","Tawid","Tubod (Tres Rosas)",
                //Carmen
                "Alegria","Bicao","Buenavista","Buenos Aires","Calatrava","El Progreso","El Salvador","Guadalupe","Katipunan","La Libertad","La Paz","La Salvacion","La Victoria","Matin-ao","Montehermoso","Montesuerte","Montesunting","Montevideo","Nueva Fuerza","Nueva Vida Este","Nueva Vida Norte","Nueva Vida Sur","Tambo-an","Vallehermoso","Villaflor","Villafuerte","Villarcayo",
                //Dimiao
                "Abihid","Alemania","Baguhan","Bakilid","Balbalan","Banban","Bauhugan","Bilisan","Cabagakian","Cabanbanan","Cadap-agan","Cambacol","Cambayaon","Canhayupon","Canlambong","Casingan","Catugasan","Datag","Guindaguitan","Guingoyuran","Ile","Lapsaon","Limokon Ilaod","Limokon Ilaya","Luyo","Malijao","Oac","Pagsa","Pangihawan","Puangyuta","Sawang","Tangohay","Taongon Cabatuan","Taongon Can-andam","Tawid Bitaog",
                //Duero
                "Alejawan","Angilan","Anibongan","Bangwalog","Cansuhay","Danao","Duay","Guinsularan","Imelda","Itum","Langkis","Lobogon","Madua Norte","Madua Sur","Mambool","Mawi","Payao","San Pedro","Taytay",
                //Garcia Hernandez
                "Abijilan","Antipolo","Basiao","Cagwang","Calma","Cambuyo","Canayon East","Canayon West","Candanas","Candulao","Catmon","Cayam","Cupa","Datag","Estaca","Libertad","Lungsodaan East","Lungsodaan West","Malinao","Manaba","Pasong","Poblacion East","Poblacion West","Sacaon","Sampong","Tabuan","Togbongon","Ulbujan East","Ulbujan West","Victoria",
                //Guindulman
                "Basdio","Bato","Bayong","Biabas","Bulawan","Cabantian","Canhaway","Cansiwang","Casbu","Catungawan Norte","Catungawan Sur","Guinacot","Guio-ang","Lombog","Mayuga","Sawang","Tabajan","Tabunok","Trinidad",
                //Jagna
                "Alejawan","Balili","Boctol","Bunga Ilaya","Bunga Mar","Buyog","Cabunga-an","Calabacita","Cambugason","Can-ipol","Canjulao","Cantagay","Cantuyoc","Can-uba","Can-upao","Faraon","Ipil","Kinagbaan","Laca","Larapan","Lonoy","Malbog","Mayana","Naatang","Nausok","Odiong","Pagina","Pangdan","Poblacion (Pondol)","Tejero","Tubod Mar","Tubod Monte",
                //Lila
                "Banban","Bonkokan Ilaya","Bonkokan Ubos","Calvario","Candulang","Catugasan","Cayupo","Cogon","Jambawan","La Fortuna","Lomanoy","Macalingan","Malinao East","Malinao West","Nagsulay","Taug","Tiguis",
                //Loay
                "Agape","Alegria Norte","Alegria Sur","Botoc Occidental","Botoc Oriental","Calvario","Concepcion","Hinawanan","Las Salinas Norte","Las Salinas Sur","Palo","Poblacion Ibabao","Poblacion Ubos","Sagnap","Tambangan","Tangcasan Norte","Tangcasan Sur","Tayong Occidental","Tayong Oriental","Tocdog Dacu","Tocdog Ilaya","Villalimpia","Yanangan",
                //Loboc
                "Alegria","Bagumbayan","Bahian","Bonbon Lower","Bonbon Upper","Buenavista","Bugho","Cabadiangan","Calunasan Norte","Calunasan Sur","Camayaan","Cambance","Candabong","Candasag","Canlasid","Gon-ob","Gotozon","Jimilian","Oy","Poblacion Ondol","Poblacion Sawang","Quinoguitan","Taytay","Tigbao","Ugpong","Valladolid",
                //Mabini
                "Abaca","Abad Santos","Aguipo","Baybayon","Bulawan","Cabidian","Cawayanan","Concepcion (Banlas)","Del Mar","Lungsoda-an","Marcelo","Minol","Paraiso","San Rafael","San Roque (Cabulao)","Tambo","Tangkigan","Valaga",
                //Pilar
                "Aurora","Bagacay","Bagumbayan","Bayong","Buenasuerte","Cagawasan","Cansungay","Catagda-an","Del Pilar","Estaca","Ilaud","Inaghuban","La Suerte","Lumbay","Lundag","Pamacsalan","Rizal",
                //Sevilla
                "Bayawahan","Cabancalan","Calinga-an","Calinginan Norte","Calinginan Sur","Cambagui","Ewon","Guinob-an","Lagtangan","Licolico","Lobgob","Magsaysay",
                //Sierra Bullones
                "Abachanan","Anibongan","Bugsoc","Canlangit","Canta-ub","Casilay","Dusita","La Union","Lataban","Magsaysay","Man-od","Matin-ao","Salvador","San Juan","Villa Garcia",
                //Valencia
                "Adlawan","Anas","Anonang","Anoyon","Balingasao","Banderaahan (Upper Ginopolan)","Botong","Buyog","Canduao Occidental","Canduao Oriental","Canlusong","Canmanico","Cansibao","Catug-a","Cutcutan","Danao","Genoveva","Ginopolan (Ginopolan Proper)","La Victoria","Lantang","Limocon","Loctob","Magsaysay","Marawis","Maubo","Nailo","Omjon","Pangi-an","Poblacion Occidental","Poblacion Oriental","Simang","Taug","Tausion","Taytay","Ticum",
                ];

/*initiate the autocomplete function on the "myInput" element, and pass along the countries array as possible autocomplete values:*/
autocomplete_barangay(document.getElementById("barangay"), brgy);