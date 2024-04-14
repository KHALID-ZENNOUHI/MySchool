document.addEventListener("DOMContentLoaded", function() {

    //the code Ajax for Implement dynamic population of Filiere inputs based on selected Niveau

    var niveauSelect = document.querySelector('select[name="niveau"]');
    var filiereSelect = document.querySelector('select[name="filiere"]');
    var classeSelect = document.querySelector('select[name="classe_id"]');
    if(niveauSelect) {
        niveauSelect.addEventListener('change', function() {
            var niveauId = niveauSelect.value;
            if (niveauId) {
                var myObject = new XMLHttpRequest();
                myObject.open("GET", '/get-filieres/' + niveauId);
                myObject.responseType = "json";
                myObject.onload = function()  {
                    if (myObject.status === 200) {
                        filiereSelect.innerHTML = '';
                        classeSelect.innerHTML = '';
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
    }

    //the code Ajax for Implement dynamic population of class inputs based on selected filiere

    if (filiereSelect) {
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
    }

    let studentSearch = document.querySelector('.student-search');
    studentSearch.addEventListener('keyup', function() {
        let searchValue = studentSearch.value;
        let xhr = new XMLHttpRequest();
        xhr.open('Get', '/search-student/' + searchValue);
        xhr.responseType = "json";
        xhr.onload = function() {
            let data = xhr.response;
            console.log(data);
            let studentList = document.querySelector('.student-table-body');
            studentList.innerHTML = '';
            if (data && data.length > 0) {
                console.log(data);
                data.forEach(function(student) {
                    let studentItem = document.createElement('tr');
                    studentItem.innerHTML = `
                        <td>
                            <div class="form-check check-tables">
                                <input class="form-check-input" type="checkbox" value="something">
                            </div> 
                        </td>
                        <td>
                            <h2 class="table-avatar">
                                <a href=""class="avatar avatar-sm me-2">
                                    <img class="avatar-img rounded-circle" src="/storage/${student.photo}" alt="User Image">
                                </a>
                                <a href="">${student.nom} ${student.prenom}</a>
                            </h2>
                        </td>
                        <td>${student.email}</td>
                        <td>${student.classe_id}</td>
                        <td>${student.classe_id}</td>
                        <td>${student.classe_id}</td>
                        <td>${student.telephone}</td>
                        <td>${student.adresse}</td>
                        <td class="text-end">
                            <div class="actions">
                                <a href="/etudiants/${student.id}/edit" class="btn btn-sm bg-danger-light">
                                    <i class="far fa-edit me-2"></i>
                                </a>
                                <a class="btn btn-sm bg-danger-light student_delete" data-bs-toggle="modal" data-bs-target="#studentUser${student.id}">
                                    <i class="far fa-trash-alt me-2"></i>
                                </a>
                                <a href="/etudiants/${student.id}" class="btn btn-sm bg-danger-light">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </div>
                        </td>
                    `;
                    studentList.appendChild(studentItem);
                });
            } else {
                let studentItem = document.createElement('p');
                studentItem.classList.add('text-center');
                studentItem.textContent = 'No student found';
                studentList.appendChild(studentItem);
            }
        };
        xhr.send();
        });
});