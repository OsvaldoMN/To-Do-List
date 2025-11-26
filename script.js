window.onload = function () {
    if (typeof tasksFromDB !== "undefined") {
        tasksFromDB.forEach(task => {
            const li = document.createElement("li");
            li.dataset.id = task.id; // <-- salva o ID no elemento

            li.innerHTML = `
            <span onclick="startInlineEdit(this)">${task.task}</span>
            <button class="editButton" onclick="editTask(this)"></button>
            <button class="deleteButton" onclick="deleteTask(this)"></button>
            `;
            taskList.appendChild(li);
        });
    }
};



const taskList = document.getElementById("taskList");
const taskInput = document.getElementById("taskInput");

function addTask(){
    const taskText = taskInput.value.trim();
    if (taskText === "") return;
    const formData = new FormData();
    formData.append("task", taskText);

    fetch("add_task.php", {
        method: "POST",
        body: formData
    }).then(response => response.text())
      .then(newId => {
        const li = document.createElement("li");
        li.dataset.id = newId; // Assumindo que add_task.php retorna o ID da nova tarefa
        li.innerHTML = `
        <span onclick="startInlineEdit(this)">${taskText}</span>
        <button class="editButton" onClick="editTask(this)"></button>
        <button class="deleteButton" onClick="deleteTask(this)"></button>
        `;
        taskList.appendChild(li);
        taskInput.value = "";


    });
}



function startInlineEdit(spanElement) {
    const li = spanElement.parentElement;
    const currentText = spanElement.textContent;

    // 1. Cria o campo de input
    const inputField = document.createElement('input');
    inputField.type = 'text';
    inputField.value = currentText;
    inputField.className = 'editInput'; // Adiciona uma classe para estilização, se necessário

    // 2. Cria o botão de salvar
    const saveButton = document.createElement('button');
    saveButton.textContent = 'Salvar';
    saveButton.className = 'saveButton';
    saveButton.onclick = function() {
        saveInlineEdit(li, inputField.value);
    };

    // 3. Cria o botão de cancelar
    const cancelButton = document.createElement('button');
    cancelButton.textContent = 'Cancelar';
    cancelButton.className = 'cancelButton';
    cancelButton.onclick = function() {
        cancelInlineEdit(li, currentText);
    };

    // 4. Remove o span e os botões originais
    const editButton = li.querySelector('.editButton');
    const deleteButton = li.querySelector('.deleteButton');

    spanElement.remove();
    editButton.style.display = 'none';
    deleteButton.style.display = 'none';

    // 5. Insere os novos elementos
    li.prepend(inputField);
    li.appendChild(saveButton);
    li.appendChild(cancelButton);
    inputField.focus();
}

function saveInlineEdit(li, newText) {
    newText = newText.trim();
    if (newText === "") {
        alert("A tarefa não pode estar vazia.");
        return;
    }

    const id = li.dataset.id;
    const formData = new FormData();
    formData.append("id", id);
    formData.append("task", newText);

    fetch("edit_task.php", {
        method: "POST",
        body: formData
    }).then(() => {
        // Recria o item da lista com o novo texto e botões originais
        li.innerHTML = `
            <span onclick="startInlineEdit(this)">${newText}</span>
            <button class="editButton" onclick="editTask(this)"></button>
            <button class="deleteButton" onclick="deleteTask(this)"></button>
        `;
    }).catch(error => {
        alert("Erro ao salvar a tarefa: " + error);
        // Se falhar, restaura o estado original (opcional, mas recomendado)
        li.innerHTML = `
            <span onclick="startInlineEdit(this)">${li.dataset.originalText}</span>
            <button class="editButton" onclick="editTask(this)"></button>
            <button class="deleteButton" onclick="deleteTask(this)"></button>
        `;
    });
}

function cancelInlineEdit(li, originalText) {
    // Restaura o item da lista com o texto original e botões originais
    li.innerHTML = `
        <span onclick="startInlineEdit(this)">${originalText}</span>
        <button class="editButton" onclick="editTask(this)"></button>
        <button class="deleteButton" onclick="deleteTask(this)"></button>
    `;
}

// A função editTask original agora apenas chama a nova função de edição inline
function editTask(button){
    const li = button.parentElement;
    const span = li.querySelector("span");
    // Salva o texto original para o caso de cancelamento
    li.dataset.originalText = span.textContent; 
    startInlineEdit(span);
}


function deleteTask(button){
    const li = button.parentElement;
    const id = li.dataset.id;
    const formData = new FormData();
    formData.append("id", id);

    fetch("delete_task.php", {
        method: "POST",
        body: formData
    }).then(() => {
        taskList.removeChild(li);
    });
}