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

    //the code Ajax for Implement dynamic search of students

    let studentSearch = document.querySelector('.student-search');
    if (studentSearch) {
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
    }

        //validation for the form of create or edit student

        let studentForm = document.querySelector('#studentForm');
        let nom = document.querySelector('input[name="nom"]');
        let prenom = document.querySelector('input[name="prenom"]');
        let dateNaissance = document.querySelector('input[name="date_naissance"]');
        let lieuNaissance  = document.querySelector('input[name="lieu_naissance"]');
        let sexe = document.querySelector('select[name="sexe"]');
        let emailStudent = document.querySelector('input[name="email_student"]');
        let email = document.querySelector('input[name="email"]');
        let telephone = document.querySelector('input[name="telephone"]');
        let adresse = document.querySelector('input[name="adresse"]');
        let photo = document.querySelector('input[name="photo"]');
        let niveau = document.querySelector('select[name="niveau"]');
        let filiere = document.querySelector('select[name="filiere"]');
        let classe = document.querySelector('select[name="classe_id"]');
        let nomResponsable = document.querySelector('input[name="nom_responsable"]');
        let prenomResponsable = document.querySelector('input[name="prenom_responsable"]');
        let sexeResponsable = document.querySelector('select[name="sexe_responsable"]');
        let cin = document.querySelector('input[name="cin"]');
        let telephoneResponsable = document.querySelector('input[name="telephone_responsable"]');
        let adresseResponsable = document.querySelector('input[name="adresse_responsable"]');
        let allInputs = document.querySelectorAll('.form-control');

        studentForm.addEventListener('submit', function(e) {

            if (nom.value === '' || prenom.value === '' || dateNaissance.value === '' || lieuNaissance.value === '' || sexe.value === '' || emailStudent.value === '' || email.value === '' || telephone.value === '' || adresse.value === '' || photo.value === '' || niveau.value === '' || filiere.value === '' || classe.value === '' || nomResponsable.value === '' || prenomResponsable.value === '' || sexeResponsable.value === '' || cin.value === '' || telephoneResponsable.value === '' || adresseResponsable.value === '') {
                e.preventDefault();
                allInputs.forEach(function(input) {
                    if (input.value === '') {
                        input.classList.add('is-invalid');
                    }
                });
            }

            const phoneRegex = /^(\+212|0)([5-7]\d{8})$/;

            if (!phoneRegex.test(telephone.value)) {
                e.preventDefault();
                telephone.classList.add('is-invalid');
                let feedback = document.createElement('span');
                feedback.classList.add('invalid-feedback');
                feedback.textContent = 'Invalid phone number';
                feedback.role = 'alert';
                telephone.parentElement.appendChild(feedback);
            }

            if (!phoneRegex.test(telephoneResponsable.value)) {
                e.preventDefault();
                telephoneResponsable.classList.add('is-invalid');
                let feedback = document.createElement('span');
                feedback.classList.add('invalid-feedback');
                feedback.textContent = 'Invalid phone number';
                feedback.role = 'alert';
                telephoneResponsable.parentElement.appendChild(feedback);
            }

            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

            if (!emailRegex.test(email.value)) {
                e.preventDefault();
                email.classList.add('is-invalid');
                let feedback = document.createElement('span');
                feedback.classList.add('invalid-feedback');
                feedback.textContent = 'Invalid email';
                feedback.role = 'alert';
                email.parentElement.appendChild(feedback);
            }

            if (!emailRegex.test(emailStudent.value)) {
                e.preventDefault();
                emailStudent.classList.add('is-invalid');
                let feedback = document.createElement('span');
                feedback.classList.add('invalid-feedback');
                feedback.textContent = 'Invalid email';
                feedback.role = 'alert';
                emailStudent.parentElement.appendChild(feedback);
            }


            let date = new Date();
            const dateNaissanceValue = dateNaissance.value;
            const [day, month, year] = dateNaissanceValue.split('-');
            const formattedDate = `${year}-${month}-${day}`;
            
            if (formattedDate >= new Date().toISOString().split('T')[0]) {
                e.preventDefault();
                dateNaissance.classList.add('is-invalid');
                let feedback = document.createElement('span');
                feedback.classList.add('invalid-feedback');
                feedback.textContent = 'Invalid date';
                feedback.role = 'alert';
                dateNaissance.parentElement.appendChild(feedback);                
            }

            const cinRegex = /^[A-Z]{1,2}(\d{3}|\d{4,})$/;

            if (!cinRegex.test(cin.value)) {
                e.preventDefault();
                cin.classList.add('is-invalid');
                let feedback = document.createElement('span');
                feedback.classList.add('invalid-feedback');
                feedback.textContent = 'Invalid CIN';
                feedback.setAttribute('role', 'alert');
                cin.parentElement.appendChild(feedback);
            }

        });

});