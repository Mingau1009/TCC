var form = document.getElementById("myForm"),
    imgInput = document.querySelector(".img"),
    file = document.getElementById("imgInput"),
    userName = document.getElementById("name"),
    birthDate = document.getElementById("sdate"),
    phone = document.getElementById("telefone"),
    address = document.getElementById("address"),
    frequency = document.getElementById("frequency"),
    objective = document.getElementById("Objective"),
    startDate = document.getElementById("sDate"),
    submitBtn = document.querySelector(".submit"),
    userInfo = document.getElementById("data"),
    modalTitle = document.querySelector("#userForm .modal-title"),
    newUserBtn = document.querySelector(".newUser"),
    searchInput = document.querySelector('.search-input'),
    selectAllCheckbox = document.getElementById("selectAll");

let getData = localStorage.getItem('userProfile') ? JSON.parse(localStorage.getItem('userProfile')) : [];
let isEdit = false, editId;

showInfo();

newUserBtn.addEventListener('click', () => {
    submitBtn.innerText = 'Cadastrar';
    modalTitle.innerText = "Ficha de Matrícula do Aluno";
    isEdit = false; 
    imgInput.src = "./image/Profile Icon.webp"; 
    form.reset(); 
});

file.onchange = function () {
    if (file.files[0].size < 1000000) { 
        var fileReader = new FileReader();
        fileReader.onload = function (e) {
            imgInput.src = e.target.result; 
        }
        fileReader.readAsDataURL(file.files[0]);
    } else {
        alert("Este arquivo é muito grande!");
    }
}

function showInfo(dataToShow = getData) {
    userInfo.innerHTML = '';
    dataToShow.forEach((element, index) => {
        let createElement = `<tr class="employeeDetails">
            <td><input type="checkbox" name="selectStudent" value="${index}" class="student-checkbox"></td>
            <td><img src="${element.picture}" alt="" width="50" height="50"></td>
            <td>${element.employeeName}</td>
            <td>${formatDate(element.birthDate)}</td>
            <td>${element.phone}</td>
            <td>${element.address}</td>
            <td>${element.frequency}</td>
            <td>${element.objective}</td>
            <td>${formatDate(element.startDate)}</td>
            <td>
        
                <button class="btn btn-success" onclick="readInfo(${index})" data-bs-toggle="modal" data-bs-target="#readData"><i class="bi bi-eye"></i></button>
                <button class="btn btn-primary" onclick="editInfo(${index})" data-bs-toggle="modal" data-bs-target="#userForm"><i class="bi bi-pencil-square"></i></button>
                <button class="btn btn-danger" onclick="deleteInfo(${index})"><i class="bi bi-trash text-white"></i></button> 

            </td>
        </tr>`;
        userInfo.innerHTML += createElement; 
    });
}

function readInfo(index) {
    const userData = getData[index];

    document.querySelector('.showImg').src = userData.picture;
    document.querySelector('#showName').value = userData.employeeName;
    document.querySelector("#showAge").value = calculateAge(userData.birthDate);
    document.querySelector("#showCity").value = userData.address;
    document.querySelector("#showPhone").value = userData.phone;
    document.querySelector("#showFrequency").value = userData.frequency; 
    document.querySelector("#showObjective").value = userData.objective; 
    document.querySelector("#showsDate").value = formatDate(userData.startDate);
}

searchInput.addEventListener('input', () => {
    const searchTerm = searchInput.value.toLowerCase();
    userInfo.innerHTML = ''; 
    const filteredData = getData.map((element, index) => ({ ...element, originalIndex: index }))
        .filter(element => element.employeeName.toLowerCase().includes(searchTerm));

    filteredData.forEach((element) => {
        let createElement = `<tr class="employeeDetails">
            <td><input type="checkbox" name="selectStudent" value="${element.originalIndex}" class="student-checkbox"></td>
            <td><img src="${element.picture}" alt="" width="50" height="50"></td>
            <td>${element.employeeName}</td>
            <td>${formatDate(element.birthDate)}</td>
            <td>${element.phone}</td>
            <td>${element.address}</td>
            <td>${element.frequency}</td>
            <td>${element.objective}</td>
            <td>${formatDate(element.startDate)}</td>
            <td>
                <button class="btn btn-success" onclick="readInfo(${element.originalIndex})" data-bs-toggle="modal" data-bs-target="#readData"><i class="bi bi-eye"></i></button>
                <button class="btn btn-primary" onclick="editInfo(${element.originalIndex})" data-bs-toggle="modal" data-bs-target="#userForm"><i class="bi bi-pencil-square"></i></button>
                <button class="btn btn-danger" onclick="deleteInfo(${element.originalIndex})"><i class="bi bi-trash text-white"></i></button> 
            </td>
        </tr>`;
        userInfo.innerHTML += createElement; 
    });
});

function editInfo(index) {
    isEdit = true;
    editId = index;
    const userData = getData[index];

    imgInput.src = userData.picture; 
    userName.value = userData.employeeName; 
    birthDate.value = userData.birthDate; 
    phone.value = userData.phone; 
    address.value = userData.address; 
    frequency.value = userData.frequency; 
    objective.value = userData.objective; 
    startDate.value = userData.startDate; 

    submitBtn.innerText = "Atualizar"; 
    modalTitle.innerText = "Atualizar Matrícula"; 
}

function deleteInfo(index) {
    getData.splice(index, 1);
    localStorage.setItem("userProfile", JSON.stringify(getData));
    showInfo();
}

form.addEventListener('submit', (e) => {
    e.preventDefault(); 

    const information = {
        picture: imgInput.src === undefined ? "./image/Profile Icon.webp" : imgInput.src,
        employeeName: userName.value,
        birthDate: birthDate.value,
        phone: phone.value,
        address: address.value,
        frequency: frequency.value,
        objective: objective.value,
        startDate: startDate.value 
    };

    if (!isEdit) {
        getData.push(information);
    } else {
        isEdit = false;
        getData[editId] = information; 
    }

    localStorage.setItem('userProfile', JSON.stringify(getData));
    submitBtn.innerText = "Cadastrar";
    modalTitle.innerHTML = "Ficha de Cadastro do Aluno";

    showInfo();
    form.reset(); 
    imgInput.src = "./image/Profile Icon.webp"; 
});

function formatDate(dateString) {
    if (!dateString) return "";
    const dateParts = dateString.split('-');
    return `${dateParts[2]}/${dateParts[1]}/${dateParts[0]}`;
}

// Função para gerar o PDF
function generatePDF() {
    const { jsPDF } = window.jspdf;
    const doc = new jsPDF();
    const checkboxes = document.querySelectorAll('input[name="selectStudent"]:checked');
    let y = 30; // Posição Y inicial

    if (checkboxes.length === 0) {
        alert("Por favor, selecione pelo menos um aluno.");
        return;
    }

    // Função para adicionar a imagem e dados do aluno com retângulos
    const addStudentData = (index) => {
        const userData = getData[index];

        // Adicionando a imagem do aluno em um quadrado 60x60 antes dos campos
        if (userData.picture) {
            const img = new Image();
            img.src = userData.picture;
            img.onload = function() {
                doc.setDrawColor(0);  // Cor da borda
                doc.rect(10, y, 50, 50);  // Desenha quadrado 60x60 para a imagem
                doc.addImage(img, 'JPEG', 10, y, 60, 60); // Posicionar imagem no quadrado
                y += 70; // Espaçamento após a imagem e borda

                // Adicionar os campos após a imagem
                addFields();
            };
        } else {
            // Caso não tenha imagem, apenas adiciona os campos
            addFields();
        }

        // Função interna para adicionar campos com retângulos
        function addFields() {
            doc.setFontSize(11);
            const fields = [
                `Nome: ${userData.employeeName}`,
                `Data de Nascimento: ${formatDate(userData.birthDate)}`,
                `Telefone: ${userData.phone}`,
                `Endereço: ${userData.address}`,
                `Frequência: ${userData.frequency}`,
                `Objetivo: ${userData.objective}`,
                `Data de Início: ${formatDate(userData.startDate)}`
            ];

            fields.forEach(field => {
                doc.setDrawColor(0);
                doc.rect(10, y, 190, 10);  // Desenha retângulo em volta de cada campo
                doc.text(field, 15, y + 7);  // Texto dentro do retângulo
                y += 14 ; // Espaçamento entre os campos
            });

            y += 450; // Espaçamento entre os alunos

            // Adiciona uma nova página se a altura máxima for atingida
            if (y > 270) {
                doc.addPage();
                y = 10;
            }
        }
    };

    // Itera sobre os checkboxes selecionados e adiciona os dados
    checkboxes.forEach((checkbox) => {
        const index = checkbox.value;
        addStudentData(index);
    });

    // Salva o PDF após adicionar todos os alunos
    setTimeout(() => {
        doc.save("matriculas.pdf");
    }, 500); // Atraso para garantir que todas as imagens sejam carregadas
}


function formatDate(dateString) {
    if (!dateString) return "";
    const dateParts = dateString.split('-');
    return `${dateParts[2]}/${dateParts[1]}/${dateParts[0]}`; // formatando como DD/MM/YYYY
}

function calculateAge(birthDate) {
    const birth = new Date(birthDate);
    const today = new Date();
    let age = today.getFullYear() - birth.getFullYear();
    const monthDifference = today.getMonth() - birth.getMonth();
    if (monthDifference < 0 || (monthDifference === 0 && today.getDate() < birth.getDate())) {
        age--;
    }
    return age;
}

// Função para selecionar todos os checkboxes
selectAllCheckbox.addEventListener('change', (event) => {
    const checkboxes = document.querySelectorAll('input[name="selectStudent"]');
    checkboxes.forEach(checkbox => {
        checkbox.checked = event.target.checked;
    });
});

// Adiciona a função para salvar e carregar os dados
showInfo();

// Função para lidar com o evento de mudança do filtro
document.getElementById('filterSelect').addEventListener('change', (event) => {
    const filterType = event.target.value;
    if (filterType) {
        filterStudents(filterType);
    } else {
        showInfo(); // Exibir todos os alunos se nenhum filtro estiver selecionado
    }
});

// Função para filtrar alunos
// Função para filtrar alunos
function filterStudents(type) {
    const rows = document.querySelectorAll('#data tr');
    const students = Array.from(rows).map(row => {
        const matriculaDate = new Date(row.cells[8].innerText.split('/').reverse().join('-')); // Conversão para Date
        return { element: row, matriculaDate: matriculaDate };
    });

    // Ordenar alunos com base no tipo de filtro
    students.sort((a, b) => {
        return type === 'recent' 
            ? b.matriculaDate - a.matriculaDate // Últimos alunos (decrescente)
            : a.matriculaDate - b.matriculaDate; // Primeiros alunos (crescente)
    });

    // Limpar tabela
    const tbody = document.getElementById('data');
    tbody.innerHTML = '';

    // Adicionar alunos ordenados de volta à tabela
    students.forEach(student => {
        tbody.appendChild(student.element);
    });
}

