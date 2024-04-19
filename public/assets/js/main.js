document.addEventListener("DOMContentLoaded", function () {
    //the code Ajax for Implement dynamic population of Filiere inputs based on selected Niveau

    var niveauSelect = document.querySelector('select[name="niveau"]');
    var filiereSelect = document.querySelector('select[name="filiere"]');
    var classeSelect = document.querySelector('select[name="classe_id"]');
    if (niveauSelect) {
        niveauSelect.addEventListener("change", function () {
            var niveauId = niveauSelect.value;
            if (niveauId) {
                var myObject = new XMLHttpRequest();
                myObject.open("GET", "/get-filieres/" + niveauId);
                myObject.responseType = "json";
                myObject.onload = function () {
                    if (myObject.status === 200) {
                        filiereSelect.innerHTML = "";
                        classeSelect.innerHTML = "";
                        var data = myObject.response;
                        if (data && Object.keys(data).length > 0) {
                            for (var key in data) {
                                if (data.hasOwnProperty(key)) {
                                    var option =
                                        document.createElement("option");
                                    option.value = key;
                                    option.textContent = data[key];
                                    filiereSelect.appendChild(option);
                                }
                            }
                        }
                    } else {
                        console.error(
                            "Failed to load filieres: " + myObject.status
                        );
                    }
                };
                myObject.onerror = function () {
                    console.error(
                        "Network error occurred while trying to make the request."
                    );
                };
                myObject.send();
            } else {
                filiereSelect.innerHTML = "";
                if (classeSelect) {
                    classeSelect.innerHTML = "";
                }
            }
        });
    }

    //the code Ajax for Implement dynamic population of class inputs based on selected filiere

    if (filiereSelect) {
        filiereSelect.addEventListener("change", function () {
            var filiereId = filiereSelect.value;
            if (filiereId) {
                var myObject1 = new XMLHttpRequest();
                myObject1.open("GET", "/get-classes/" + filiereId);
                myObject1.responseType = "json";
                myObject1.onload = function () {
                    classeSelect.innerHTML = "";
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
                classeSelect.innerHTML = "";
            }
        });
    }

    //the code Ajax for Implement dynamic search of students

    let studentSearch = document.querySelector(".student-search");
    if (studentSearch) {
        studentSearch.addEventListener("keyup", function () {
            let searchValue = studentSearch.value;
            let xhr = new XMLHttpRequest();
            xhr.open("Get", "/search-student?studentSearch=" + searchValue);
            xhr.responseType = "json";
            xhr.onload = function () {
                let data = xhr.response;
                // let studentCard = document.querySelector(".student-card");
                let studentCardCantainer = document.querySelector(".student-card-container");
                if (data) {
                    studentCardCantainer.innerHTML = "";
                    data.forEach(function (student) {
                        studentCardCantainer.innerHTML += `
                        <div class="card student-card" style="width: 18rem;">
                            <div class="card-body text-center" bis_skin_checked="1">
                                <img src="/storage/${student.photo}" alt="" width="100" height="100" style="object-fit: cover;" class="position-relative overflow-hidden rounded-circle mb-3 shadow-sm">
                                <h5 class="my-3">${student.nom} ${student.prenom}</h5>
                                <p class="text-muted mb-1">${student.classe.filiere.niveau.nom}</p>
                                <p class="text-muted mb-4">${student.classe.nom}</p>
                                <div class="d-flex justify-content-center mb-2" bis_skin_checked="1">
                                <a href="/etudints/${student.id}"><button type="button" data-mdb-button-init="" data-mdb-ripple-init="" class="btn btn-outline-primary ms-1" data-mdb-button-initialized="true">Profile</button></a>
                                </div>
                            </div>
                        </div>
                        `;
                    });
                } 
            };
            xhr.send();
        });
    }

    //the code Ajax for Implement dynamic search of classes

    let classSearch = document.querySelector(".classSearch");
    let classCards = document.querySelector(".classCards");
    let csrf = document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute("content");
    if (classSearch) {
        classSearch.addEventListener("keyup", function () {
            let searchValue = classSearch.value;
            let xhr = new XMLHttpRequest();
            xhr.open("GET", "/search-class?classSearch=" + searchValue);
            xhr.responseType = "json";
            xhr.onload = function () {
                let data = xhr.response;
                console.log(data);
                classCards.innerHTML = "";
                data.forEach(function (classe) {
                    classCards.innerHTML += `
                            <div class="col-md-4 col-lg-3 mb-4">
                                <div class="card-header bg-info text-white fw-bold text-center">
                                    <i class="fas fa-chalkboard-teacher"></i>${classe.nom}
                                </div>
                                <div class="card-body">
                                    <p class="card-title"><i class="fas fa-sitemap"></i> Level: ${classe.filiere.niveau.nom}</p>
                                    <p class="card-text"><i class="fas fa-graduation-cap"></i> Option: ${classe.filiere.nom}</p>
                                    <p class="card-text"><i class="fas fa-calendar-alt"></i> Promotion: ${classe.annee_scolaire.annee_scolaire_start}---${classe.annee_scolaire.annee_scolaire_end}</p>
                                </div>
                                <div class="card-footer text-muted">
                                <i class="fas fa-users"></i> Total Learners: ${classe.etudiants_count}
                                </div>
                                <div class="card-footer">
                                    <div class="btn-group" role="group" aria-label="Options">
                                        <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#editClassModal${classe.id}"><i class="fas fa-edit"></i> Edit</button>
                                        
                                        <form method="POST" action="classe/${classe.id}">
                                            <input type="hidden" name="_token" value="${csrf}">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <button type="submit" class="btn btn-sm btn-outline-danger"><i class="fas fa-trash-alt"></i> Delete</button>
                                        </form>
                                        <button type="button" class="btn btn-sm btn-outline-secondary"><a href="classe/${classe.id}"><i class="fas fa-info-circle"></i> Details</a></button>
                                    </div>
                                </div>
                            </div>`;
                });
            };
            xhr.send();
        });
    }
    //validation for the form of create or edit student

    let studentForm = document.querySelector("#studentForm");
    let nom = document.querySelector('input[name="nom"]');
    let prenom = document.querySelector('input[name="prenom"]');
    let dateNaissance = document.querySelector('input[name="date_naissance"]');
    let lieuNaissance = document.querySelector('input[name="lieu_naissance"]');
    let sexe = document.querySelector('select[name="sexe"]');
    let emailStudent = document.querySelector('input[name="email_student"]');
    let email = document.querySelector('input[name="email"]');
    let telephone = document.querySelector('input[name="telephone"]');
    let adresse = document.querySelector('input[name="adresse"]');
    let photo = document.querySelector('input[name="photo"]');
    let niveau = document.querySelector('select[name="niveau"]');
    let filiere = document.querySelector('select[name="filiere"]');
    let classe = document.querySelector('select[name="classe_id"]');
    let nomResponsable = document.querySelector(
        'input[name="nom_responsable"]'
    );
    let prenomResponsable = document.querySelector(
        'input[name="prenom_responsable"]'
    );
    let sexeResponsable = document.querySelector(
        'select[name="sexe_responsable"]'
    );
    let cin = document.querySelector('input[name="cin"]');
    let telephoneResponsable = document.querySelector(
        'input[name="telephone_responsable"]'
    );
    let adresseResponsable = document.querySelector(
        'input[name="adresse_responsable"]'
    );
    let allInputs = document.querySelectorAll(".form-control");

    if (studentForm) {
        studentForm.addEventListener("submit", function (e) {
            if (
                nom.value === "" ||
                prenom.value === "" ||
                dateNaissance.value === "" ||
                lieuNaissance.value === "" ||
                sexe.value === "" ||
                emailStudent.value === "" ||
                email.value === "" ||
                telephone.value === "" ||
                adresse.value === "" ||
                photo.value === "" ||
                niveau.value === "" ||
                filiere.value === "" ||
                classe.value === "" ||
                nomResponsable.value === "" ||
                prenomResponsable.value === "" ||
                sexeResponsable.value === "" ||
                cin.value === "" ||
                telephoneResponsable.value === "" ||
                adresseResponsable.value === ""
            ) {
                e.preventDefault();
                allInputs.forEach(function (input) {
                    if (input.value === "") {
                        input.classList.add("is-invalid");
                    }
                });
            }

            const phoneRegex = /^(\+212|0)([5-7]\d{8})$/;

            if (!phoneRegex.test(telephone.value)) {
                e.preventDefault();
                telephone.classList.add("is-invalid");
                let feedback = document.createElement("span");
                feedback.classList.add("invalid-feedback");
                feedback.textContent = "Invalid phone number";
                feedback.role = "alert";
                telephone.parentElement.appendChild(feedback);
            }

            if (!phoneRegex.test(telephoneResponsable.value)) {
                e.preventDefault();
                telephoneResponsable.classList.add("is-invalid");
                let feedback = document.createElement("span");
                feedback.classList.add("invalid-feedback");
                feedback.textContent = "Invalid phone number";
                feedback.role = "alert";
                telephoneResponsable.parentElement.appendChild(feedback);
            }

            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

            if (!emailRegex.test(email.value)) {
                e.preventDefault();
                email.classList.add("is-invalid");
                let feedback = document.createElement("span");
                feedback.classList.add("invalid-feedback");
                feedback.textContent = "Invalid email";
                feedback.role = "alert";
                email.parentElement.appendChild(feedback);
            }

            if (!emailRegex.test(emailStudent.value)) {
                e.preventDefault();
                emailStudent.classList.add("is-invalid");
                let feedback = document.createElement("span");
                feedback.classList.add("invalid-feedback");
                feedback.textContent = "Invalid email";
                feedback.role = "alert";
                emailStudent.parentElement.appendChild(feedback);
            }

            let date = new Date();
            const dateNaissanceValue = dateNaissance.value;
            const [day, month, year] = dateNaissanceValue.split("-");
            const formattedDate = `${year}-${month}-${day}`;

            if (formattedDate >= new Date().toISOString().split("T")[0]) {
                e.preventDefault();
                dateNaissance.classList.add("is-invalid");
                let feedback = document.createElement("span");
                feedback.classList.add("invalid-feedback");
                feedback.textContent = "Invalid date";
                feedback.role = "alert";
                dateNaissance.parentElement.appendChild(feedback);
            }

            const cinRegex = /^[A-Z]{1,2}(\d{3}|\d{4,})$/;

            if (!cinRegex.test(cin.value)) {
                e.preventDefault();
                cin.classList.add("is-invalid");
                let feedback = document.createElement("span");
                feedback.classList.add("invalid-feedback");
                feedback.textContent = "Invalid CIN";
                feedback.setAttribute("role", "alert");
                cin.parentElement.appendChild(feedback);
            }
        });
    }

    //hide the input of matiere_id if the type of activity is note controle
    let activityType = document.querySelector('select[name="type"]');
    let matiereId = document.querySelector('select[name="matiere_id"]');
    let labelMatiere = document.querySelector('#labelMatiere');
    if(matiereId &&labelMatiere) {
        matiereId.style.display = "none";
        labelMatiere.style.display = "none";
    }
    if (activityType) {
        activityType.addEventListener("change", function () {
            if (activityType.value === "exam") {
                matiereId.style.display = "block";
                labelMatiere.style.display = "block";
            }
        });
    }
});
