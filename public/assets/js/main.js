document.addEventListener("DOMContentLoaded", function() {
    var niveauSelect = document.querySelector('select[name="niveau"]');
    var filiereSelect = document.querySelector('select[name="filiere"]');
    var classeSelect = document.querySelector('select[name="classe_id"]');
    niveauSelect.addEventListener('change', function() {
        var niveauId = niveauSelect.value;
        if (niveauId) {
            var myObject = new XMLHttpRequest();
            myObject.open("GET", '/get-filieres/' + niveauId);
            myObject.responseType = "json";
            myObject.onload = function()  {
                console.log(myObject.response);
                if (myObject.status === 200) {
                    filiereSelect.innerHTML = '';
                    var data = myObject.response;
                    if (data && Object.keys(data).length > 0) {
                        for (var key in data) {
                            if (data.hasOwnProperty(key)) {
                                var option = document.createElement("option");
                                option.value = key;
                                option.textContent = data[key];
                                filiereSelect.appendChild(option);
                            }
                        }
                    }
                } else {
                    console.error("Failed to load filieres: " + myObject.status);
                }
            };
            myObject.onerror = function() {
                console.error("Network error occurred while trying to make the request.");
            };
            myObject.send();
        } else {
            filiereSelect.innerHTML = ''; 
            if (classeSelect) {
                classeSelect.innerHTML = '';
            }
        }
        
    });

    filiereSelect.addEventListener("change", function() {
        var filiereId = filiereSelect.value;
        if (filiereId) {
            var myObject1 = new XMLHttpRequest();
            myObject1.open("GET", '/get-classes/' + filiereId);
            myObject1.responseType = "json";
            myObject1.onload = function() {
                classeSelect.innerHTML = '';
                var data = myObject1.response;
                if (data) {
                    for (var key in data) {
                        if (data.hasOwnProperty(key)) {
                            var option = document.createElement("option");
                            option.value = key;
                            option.textContent = data[key];
                            classeSelect.appendChild(option);
                        }
                    }
                }
            };
            myObject1.send();
        } else {
            classeSelect.innerHTML = '';
        }
    });
});